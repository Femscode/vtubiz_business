<template>
  <div class="vx-buy">
    <div class="vx-tabs" role="tablist">
      <button type="button" role="tab" aria-selected="true" class="vx-tab on"><i class="fa-solid fa-user"></i> Single</button>
      <button type="button" role="tab" aria-selected="false" class="vx-tab" disabled>
        <i class="fa-solid fa-users"></i> Group <span class="vx-soon">Soon</span>
      </button>
    </div>

    <div class="vx-grid">
      <div class="vx-main">
        <div class="vx-card">
          <!-- Saved beneficiaries -->
          <section v-if="beneficiaries.length" class="vx-step vx-step-bens">
            <div class="vx-step-head">
              <h3 class="vx-step-title">Quick pick</h3>
              <span class="vx-step-meta">Saved beneficiaries</span>
            </div>
            <div class="vx-bens">
              <button
                v-for="ben in beneficiaries"
                :key="ben.id"
                type="button"
                :class="['vx-ben', { on: samePhone(ben.phone, phone) }]"
                @click="useBeneficiary(ben)"
              >
                <span class="vx-ben-av">{{ initials(ben.name) }}</span>
                <span class="vx-ben-txt">
                  <span class="vx-ben-name">{{ ben.name }}</span>
                  <span class="vx-ben-phone">{{ formatPhone(ben.phone) }}</span>
                </span>
              </button>
            </div>
          </section>

          <!-- 1. Network -->
          <section :class="['vx-step', { done: !!network }]">
            <div class="vx-step-head">
              <h3 class="vx-step-title"><span class="vx-step-num"><span>1</span></span>Choose network</h3>
              <span class="vx-step-meta" v-if="network && rate !== null && rate > 0">{{ rate }}% off on {{ networkName(network) }}</span>
            </div>
            <network-picker v-model="network" :detected="detected" />
          </section>

          <!-- 2. Amount -->
          <section :class="['vx-step', { done: amountValid }]">
            <div class="vx-step-head">
              <h3 class="vx-step-title"><span class="vx-step-num"><span>2</span></span>How much?</h3>
              <span class="vx-step-meta">Min ₦{{ fmt(minAmount) }}</span>
            </div>

            <div class="vx-chips vx-amounts">
              <button
                v-for="a in quickAmounts"
                :key="a"
                type="button"
                :class="['vx-chip', { on: Number(amount) === a }]"
                @click="amount = a"
              >₦{{ fmt(a) }}</button>
            </div>

            <div class="vx-field">
              <span class="vx-field-icon vx-naira">₦</span>
              <input
                v-model="amount"
                type="number"
                inputmode="numeric"
                min="0"
                step="1"
                placeholder="Other amount"
                :class="['vx-input', 'lg', 'has-icon', { invalid: amount !== '' && !amountValid }]"
              />
            </div>

            <p v-if="amount !== '' && !amountValid" class="vx-hint err">Minimum airtime purchase is ₦{{ fmt(minAmount) }}.</p>
            <p v-else-if="amountValid && discount > 0" class="vx-hint ok">
              <i class="fa-solid fa-tag"></i> You pay ₦{{ fmt(payable) }} — you save ₦{{ fmt(discount) }}
            </p>
          </section>

          <!-- 3. Recipient -->
          <section :class="['vx-step', { done: phoneValid }]">
            <div class="vx-step-head">
              <h3 class="vx-step-title"><span class="vx-step-num"><span>3</span></span>Recipient number</h3>
            </div>
            <div class="vx-field">
              <span class="vx-field-icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
              <input
                v-model="phone"
                type="tel"
                inputmode="numeric"
                autocomplete="tel"
                maxlength="16"
                placeholder="0803 000 0000"
                :class="['vx-input', 'has-icon', { invalid: phoneTouched && phone && !phoneValid }]"
                @blur="phoneTouched = true"
              />
              <span class="vx-field-suffix" v-if="detecting"><span class="vx-spin"></span></span>
            </div>

            <p v-if="phoneTouched && phone && !phoneValid" class="vx-hint err">Enter a valid 11-digit Nigerian number.</p>
            <div v-else-if="mismatch" class="vx-hint warn">
              <i class="fa-solid fa-triangle-exclamation"></i>
              <span>This looks like a {{ networkName(detected) }} number. Ported? Keep {{ networkName(network) }}, or</span>
              <button type="button" class="vx-link-btn" @click="network = detected">switch to {{ networkName(detected) }}</button>
            </div>
            <p v-else-if="phoneValid && detected" class="vx-hint ok"><i class="fa-solid fa-circle-check"></i> {{ networkName(detected) }} number</p>

            <div v-if="knownBeneficiary" class="vx-saved-tag"><i class="fa-solid fa-bookmark"></i> Saved as <b>{{ knownBeneficiary.name }}</b></div>
            <template v-else>
              <label class="vx-switch">
                <input type="checkbox" v-model="saveBen" />
                <span class="vx-switch-track"></span>
                Save as beneficiary
              </label>
              <input
                v-if="saveBen"
                v-model.trim="benName"
                type="text"
                maxlength="40"
                class="vx-input vx-ben-name-input"
                placeholder="Name, e.g. My second line"
              />
            </template>
          </section>
        </div>
      </div>

      <!-- Summary -->
      <aside class="vx-side">
        <div class="vx-summary">
          <span class="vx-sum-eyebrow">Order summary</span>
          <div class="vx-sum-hero">
            <span :class="['vx-sum-logo', netKey(network)]">{{ netMono(network) }}</span>
            <div>
              <div class="vx-sum-big">₦{{ fmt(amountValid ? amount : 0) }}</div>
              <div class="vx-sum-small">{{ network ? networkName(network) + ' airtime' : 'Airtime top-up' }}</div>
            </div>
          </div>
          <ul class="vx-sum-rows">
            <li><span>Network</span><strong>{{ networkName(network) || '—' }}</strong></li>
            <li><span>Airtime value</span><strong>₦{{ fmt(amountValid ? amount : 0) }}</strong></li>
            <li v-if="discount > 0"><span>Discount ({{ rate }}%)</span><strong class="save">−₦{{ fmt(discount) }}</strong></li>
            <li><span>Recipient</span><strong>{{ phoneValid ? formatPhone(phone) : '—' }}</strong></li>
          </ul>

          <div class="vx-sum-total"><span>You pay</span><strong>₦{{ fmt(payable) }}</strong></div>

          <button type="button" class="vx-cta" :disabled="!isReady" @click="openCheckout">
            {{ isReady ? 'Pay ₦' + fmt(payable) : 'Buy airtime' }}
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </button>
          <p class="vx-cta-hint" v-if="!isReady">{{ missingHint }}</p>

          <div v-if="balance !== null" :class="['vx-balance', { low: payable > balance }]">
            <span><i class="fa-solid fa-wallet"></i>&nbsp; Wallet ₦{{ fmt(balance) }}</span>
            <a href="/fundwallet">Top up</a>
          </div>
        </div>
      </aside>
    </div>

    <div class="vx-paybar">
      <div class="vx-paybar-total"><small>{{ isReady ? 'You pay' : missingHint }}</small><strong>₦{{ fmt(payable) }}</strong></div>
      <button type="button" class="vx-cta" :disabled="!isReady" @click="openCheckout">Buy now</button>
    </div>

    <checkout-sheet
      :open="sheetOpen"
      title="Buy airtime"
      noun="airtime"
      :items="sheetItems"
      :total="payable"
      :balance="balance"
      :submit="submitPurchase"
      @close="sheetOpen = false"
      @done="finish"
    />
  </div>
</template>

<script>
import NetworkPicker from './purchase/NetworkPicker.vue';
import CheckoutSheet from './purchase/CheckoutSheet.vue';
import { networkById, normalizePhone, isValidPhone, formatPhone, fmt, detectNetwork, isSuccess, errorMessage } from './purchase/helpers';

export default {
  components: { NetworkPicker, CheckoutSheet },
  props: {
    user: { type: Object, default: () => ({}) },
    beneficiaries: { type: Array, default: () => [] },
  },
  data() {
    return {
      minAmount: 100, // matches the server-side validation in SubscriptionController@buyairtime
      quickAmounts: [100, 200, 500, 1000, 2000, 5000],
      network: '',
      amount: '',
      phone: '',
      phoneTouched: false,
      detected: null,
      detecting: false,
      rates: {},
      saveBen: false,
      benName: '',
      sheetOpen: false,
    };
  },
  computed: {
    balance() {
      const b = this.user ? parseFloat(this.user.balance) : NaN;
      return isNaN(b) ? null : b;
    },
    amountValid() {
      const a = Number(this.amount);
      return this.amount !== '' && !isNaN(a) && a >= this.minAmount;
    },
    rate() {
      const r = this.rates[this.network];
      return r === undefined ? null : r;
    },
    discount() {
      if (!this.amountValid || !this.rate) return 0;
      return Math.round(((Number(this.amount) * this.rate) / 100) * 100) / 100;
    },
    payable() {
      if (!this.amountValid) return 0;
      return Math.round((Number(this.amount) - this.discount) * 100) / 100;
    },
    phoneValid() {
      return isValidPhone(this.phone);
    },
    mismatch() {
      return this.phoneValid && this.detected && this.network && this.detected != this.network;
    },
    knownBeneficiary() {
      if (!this.phoneValid) return null;
      return this.beneficiaries.find((b) => this.samePhone(b.phone, this.phone)) || null;
    },
    isReady() {
      return !!(this.network && this.amountValid && this.phoneValid);
    },
    missingHint() {
      if (!this.network) return 'Choose a network';
      if (!this.amountValid) return 'Enter an amount';
      if (!this.phoneValid) return 'Enter the recipient number';
      return '';
    },
    sheetItems() {
      const items = [
        { label: 'Network', value: this.networkName(this.network) },
        { label: 'Airtime value', value: '₦' + fmt(this.amount) },
      ];
      if (this.discount > 0) items.push({ label: `Discount (${this.rate}%)`, value: '−₦' + fmt(this.discount) });
      items.push({ label: 'Recipient', value: formatPhone(this.phone) });
      if (this.knownBeneficiary) items.push({ label: 'Beneficiary', value: this.knownBeneficiary.name });
      return items;
    },
  },
  watch: {
    network(id) {
      if (id) this.loadRate(id);
    },
    phone() {
      if (!this.phoneValid) {
        this.detected = null;
        return;
      }
      const p = normalizePhone(this.phone);
      this.detecting = true;
      detectNetwork(p).then((id) => {
        if (normalizePhone(this.phone) !== p) return;
        this.detecting = false;
        this.detected = id;
        if (id && !this.network) this.network = id;
      });
    },
  },
  methods: {
    fmt,
    formatPhone,
    networkName(id) {
      const n = networkById(id);
      return n ? n.name : '';
    },
    netKey(id) {
      const n = networkById(id);
      return n ? n.key : '';
    },
    netMono(id) {
      const n = networkById(id);
      return n ? n.mono : '?';
    },
    initials(name) {
      return String(name || '?').trim().split(/\s+/).slice(0, 2).map((w) => w[0]).join('').toUpperCase();
    },
    samePhone(a, b) {
      return !!a && !!b && normalizePhone(a) === normalizePhone(b);
    },
    loadRate(id) {
      if (this.rates[id] !== undefined) return;
      axios
        .get('/fetch_airtime_rate/' + id + '/' + this.user.company_id)
        .then((r) => {
          const v = parseFloat(r.data);
          this.$set(this.rates, id, isNaN(v) ? 0 : v);
        })
        .catch(() => this.$set(this.rates, id, 0));
    },
    useBeneficiary(ben) {
      this.phone = normalizePhone(ben.phone);
      this.phoneTouched = true;
    },
    openCheckout() {
      if (this.isReady) this.sheetOpen = true;
    },
    submitPurchase(pin) {
      const fd = new FormData();
      fd.append('phone_number', normalizePhone(this.phone));
      fd.append('network', this.network);
      fd.append('amount', Number(this.amount));
      fd.append('discounted_amount', this.payable);
      fd.append('pin', pin);

      return axios
        .post('/buyairtime', fd)
        .then((res) => {
          const d = res.data || {};
          if (!isSuccess(d)) return { ok: false, message: d.message || 'Transaction failed.' };
          this.maybeSaveBeneficiary();
          return {
            ok: true,
            message: d.message || `₦${fmt(this.amount)} ${this.networkName(this.network)} airtime sent to ${formatPhone(this.phone)}.`,
          };
        })
        .catch((err) => ({ ok: false, message: errorMessage(err) }));
    },
    maybeSaveBeneficiary() {
      if (!this.saveBen || !this.benName || this.knownBeneficiary) return;
      const fd = new FormData();
      fd.append('phone', normalizePhone(this.phone));
      fd.append('name', this.benName);
      axios.post('/saveBeneficiary', fd).catch(() => {});
    },
    finish() {
      this.sheetOpen = false;
      window.location.reload();
    },
  },
};
</script>

<style src="./purchase/purchase.css"></style>

<style scoped>
.vx-step-bens { padding-bottom: 8px; }
.vx-step-bens .vx-step-head { margin-bottom: 10px; }
.vx-amounts { margin-bottom: 12px; }
.vx-amounts .vx-chip { flex: 1 0 calc(33.333% - 8px); padding: 12px 8px; font-size: .92rem; }
.vx-naira { font-family: 'Fraunces', serif; font-size: 1.4rem; color: var(--vx-sec); }
@media (min-width: 768px) {
  .vx-amounts .vx-chip { flex-basis: calc(16.666% - 8px); }
}
</style>
