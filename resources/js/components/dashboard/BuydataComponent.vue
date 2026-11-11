<template>
  <div class="vx-buy">
    <!-- Mode -->
    <div class="vx-tabs" role="tablist">
      <button type="button" role="tab" :aria-selected="String(mode === 'single')" :class="['vx-tab', { on: mode === 'single' }]" @click="mode = 'single'">
        <i class="fa-solid fa-user"></i> Single
      </button>
      <button type="button" role="tab" :aria-selected="String(mode === 'group')" :class="['vx-tab', { on: mode === 'group' }]" @click="mode = 'group'">
        <i class="fa-solid fa-users"></i> Group
      </button>
    </div>

    <div class="vx-grid">
      <div class="vx-main">
        <!-- ============ SINGLE ============ -->
        <div v-if="mode === 'single'" class="vx-card">
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
            </div>
            <network-picker v-model="network" :detected="detected" />
          </section>

          <!-- 2. Plan -->
          <section :class="['vx-step', { done: !!selectedPlan }]">
            <div class="vx-step-head">
              <h3 class="vx-step-title"><span class="vx-step-num"><span>2</span></span>Pick a plan</h3>
              <span class="vx-step-meta" v-if="network && currentPlans.length">{{ currentPlans.length }} plans</span>
            </div>

            <div v-if="!network" class="vx-empty">Select a network above to see available plans.</div>

            <div v-else-if="loading[network]" class="vx-plan-grid">
              <div v-for="n in 6" :key="n" class="vx-skel" style="height: 108px"></div>
            </div>

            <div v-else-if="planError[network]" class="vx-empty">
              {{ planError[network] }}
              <div><button type="button" class="vx-link-btn" @click="loadPlans(network, true)">Retry</button></div>
            </div>

            <div v-else-if="!currentPlans.length" class="vx-empty">No plans are available for {{ networkName(network) }} right now.</div>

            <template v-else>
              <div class="vx-plan-tools">
                <div class="vx-chips" v-if="planTypes.length > 1">
                  <button type="button" :class="['vx-chip', { on: planType === 'all' }]" @click="planType = 'all'">All</button>
                  <button v-for="t in planTypes" :key="t" type="button" :class="['vx-chip', { on: planType === t }]" @click="planType = t">{{ t }}</button>
                </div>
                <div class="vx-field vx-plan-search" v-if="currentPlans.length > 8">
                  <span class="vx-field-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                  <input v-model.trim="planQuery" type="search" class="vx-input has-icon" placeholder="Search e.g. 2GB, 30 days" />
                </div>
              </div>

              <div class="vx-plan-grid" role="radiogroup" aria-label="Data plans">
                <button
                  v-for="p in filteredPlans"
                  :key="p.id"
                  type="button"
                  role="radio"
                  :aria-checked="String(selectedPlanId == p.id)"
                  :class="['vx-plan', { on: selectedPlanId == p.id }]"
                  @click="selectedPlanId = p.id"
                >
                  <span v-if="p._meta.type" class="vx-plan-type">{{ p._meta.type }}</span>
                  <span class="vx-plan-size">{{ p._meta.size || p.plan_name }}</span>
                  <span class="vx-plan-valid">{{ p._meta.validity || (p._meta.size ? p.plan_name : '') }}</span>
                  <span class="vx-plan-price">₦{{ fmt(p.admin_price) }}</span>
                </button>
              </div>
              <div v-if="!filteredPlans.length" class="vx-empty">No plans match “{{ planQuery }}”.</div>
            </template>
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
                placeholder="Name, e.g. Mum's line"
              />
            </template>
          </section>
        </div>

        <!-- ============ GROUP ============ -->
        <div v-else class="vx-card">
          <section class="vx-step vx-step-flat">
            <div class="vx-step-head">
              <h3 class="vx-step-title">Recipients</h3>
              <span class="vx-step-meta">{{ groupReadyCount }} of {{ group.length }} ready</span>
            </div>

            <div class="vx-rows">
              <div v-for="(row, i) in group" :key="row.uid" :class="['vx-row', { ready: rowReady(row) }]">
                <div class="vx-row-top">
                  <span class="vx-row-idx">{{ i + 1 }}</span>
                  <div class="vx-field vx-row-phone">
                    <input
                      v-model="row.phone"
                      type="tel"
                      inputmode="numeric"
                      maxlength="16"
                      placeholder="Phone number"
                      :class="['vx-input', { invalid: row.phone && normalize(row.phone).length >= 11 && !validPhone(row.phone) }]"
                      @input="onRowPhone(row)"
                    />
                    <span class="vx-field-suffix" v-if="row.detecting"><span class="vx-spin"></span></span>
                  </div>
                  <button type="button" class="vx-row-x" :aria-label="'Remove recipient ' + (i + 1)" @click="removeRow(i)">
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                </div>

                <network-picker :value="row.network_id" :detected="row.detected" compact @input="setRowNetwork(row, $event)" />

                <div class="vx-row-plan">
                  <select v-model="row.plan_id" class="vx-input vx-select" :disabled="!row.network_id || loading[row.network_id]">
                    <option value="">{{ !row.network_id ? 'Choose a network first' : (loading[row.network_id] ? 'Loading plans…' : 'Select a plan') }}</option>
                    <option v-for="p in plansFor(row.network_id)" :key="p.id" :value="p.id">
                      {{ p.plan_name }} — ₦{{ fmt(p.admin_price) }}
                    </option>
                  </select>
                  <span class="vx-row-price" v-if="rowPlan(row)">₦{{ fmt(rowPlan(row).admin_price) }}</span>
                </div>
              </div>
            </div>

            <div class="vx-row-actions">
              <button type="button" class="vx-add" @click="addRow()"><i class="fa-solid fa-plus"></i> Add recipient</button>
              <button type="button" class="vx-add ghost" @click="pasteOpen = !pasteOpen"><i class="fa-regular fa-clipboard"></i> Paste numbers</button>
            </div>

            <div v-if="pasteOpen" class="vx-paste">
              <textarea v-model="pasteText" rows="4" class="vx-input" placeholder="Paste numbers separated by commas, spaces or new lines"></textarea>
              <div class="vx-paste-foot">
                <span class="vx-step-meta">{{ pastedNumbers.length }} valid number(s) found</span>
                <button type="button" class="vx-chip on" :disabled="!pastedNumbers.length" @click="importPasted">Add to list</button>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- ============ SUMMARY ============ -->
      <aside class="vx-side">
        <div class="vx-summary">
          <span class="vx-sum-eyebrow">Order summary</span>

          <template v-if="mode === 'single'">
            <div class="vx-sum-hero">
              <span :class="['vx-sum-logo', netKey(network)]">{{ netMono(network) }}</span>
              <div>
                <div class="vx-sum-big">{{ selectedPlan ? (selectedPlan._meta.size || selectedPlan.plan_name) : 'Data bundle' }}</div>
                <div class="vx-sum-small">{{ selectedPlan ? (selectedPlan._meta.validity || networkName(network)) : 'Choose a network & plan' }}</div>
              </div>
            </div>
            <ul class="vx-sum-rows">
              <li><span>Network</span><strong>{{ networkName(network) || '—' }}</strong></li>
              <li><span>Plan</span><strong :title="selectedPlan && selectedPlan.plan_name">{{ selectedPlan ? selectedPlan.plan_name : '—' }}</strong></li>
              <li><span>Recipient</span><strong>{{ phoneValid ? formatPhone(phone) : '—' }}</strong></li>
            </ul>
          </template>

          <template v-else>
            <div class="vx-sum-hero">
              <span class="vx-sum-logo"><i class="fa-solid fa-users"></i></span>
              <div>
                <div class="vx-sum-big">{{ groupReadyCount }} recipient{{ groupReadyCount === 1 ? '' : 's' }}</div>
                <div class="vx-sum-small">Group data purchase</div>
              </div>
            </div>
            <ul class="vx-sum-rows">
              <li v-for="n in groupNetworkBreakdown" :key="n.id"><span>{{ n.name }}</span><strong>{{ n.count }} × · ₦{{ fmt(n.amount) }}</strong></li>
              <li v-if="!groupNetworkBreakdown.length"><span>Recipients</span><strong>—</strong></li>
            </ul>
          </template>

          <div class="vx-sum-total"><span>Total</span><strong>₦{{ fmt(total) }}</strong></div>

          <button type="button" class="vx-cta" :disabled="!isReady" @click="openCheckout">
            {{ ctaLabel }}
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </button>
          <p class="vx-cta-hint" v-if="!isReady">{{ missingHint }}</p>

          <div v-if="balance !== null" :class="['vx-balance', { low: total > balance }]">
            <span><i class="fa-solid fa-wallet"></i>&nbsp; Wallet ₦{{ fmt(balance) }}</span>
            <a href="/fundwallet">Top up</a>
          </div>
        </div>
      </aside>
    </div>

    <!-- Mobile pay bar -->
    <div class="vx-paybar">
      <div class="vx-paybar-total"><small>{{ isReady ? 'Total' : missingHint }}</small><strong>₦{{ fmt(total) }}</strong></div>
      <button type="button" class="vx-cta" :disabled="!isReady" @click="openCheckout">Buy now</button>
    </div>

    <checkout-sheet
      :open="sheetOpen"
      :title="mode === 'single' ? 'Buy data' : 'Group data purchase'"
      noun="data"
      :items="sheetItems"
      :total="total"
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
import {
  NETWORKS, networkById, normalizePhone, isValidPhone, formatPhone, fmt,
  detectNetwork, parsePlan, isSuccess, errorMessage,
} from './purchase/helpers';

let uid = 0;
const newRow = (phone = '') => ({ uid: ++uid, phone, network_id: '', plan_id: '', detected: null, detecting: false });

export default {
  components: { NetworkPicker, CheckoutSheet },
  props: {
    user: { type: Object, default: () => ({}) },
    beneficiaries: { type: Array, default: () => [] },
  },
  data() {
    return {
      mode: 'single',
      network: '',
      phone: '',
      phoneTouched: false,
      detected: null,
      detecting: false,
      selectedPlanId: '',
      planType: 'all',
      planQuery: '',
      plansByNetwork: {},
      loading: {},
      planError: {},
      saveBen: false,
      benName: '',
      group: [newRow()],
      pasteOpen: false,
      pasteText: '',
      sheetOpen: false,
    };
  },
  computed: {
    balance() {
      const b = this.user ? parseFloat(this.user.balance) : NaN;
      return isNaN(b) ? null : b;
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
    currentPlans() {
      return this.plansFor(this.network);
    },
    planTypes() {
      const set = [];
      this.currentPlans.forEach((p) => {
        if (p._meta.type && set.indexOf(p._meta.type) === -1) set.push(p._meta.type);
      });
      return set;
    },
    filteredPlans() {
      const q = this.planQuery.toLowerCase();
      return this.currentPlans.filter((p) => {
        if (this.planType !== 'all' && p._meta.type !== this.planType) return false;
        return !q || String(p.plan_name).toLowerCase().indexOf(q) !== -1;
      });
    },
    selectedPlan() {
      return this.currentPlans.find((p) => p.id == this.selectedPlanId) || null;
    },
    groupReadyCount() {
      return this.group.filter(this.rowReady).length;
    },
    groupNetworkBreakdown() {
      const out = {};
      this.group.filter(this.rowReady).forEach((r) => {
        const n = networkById(r.network_id);
        if (!out[n.id]) out[n.id] = { id: n.id, name: n.name, count: 0, amount: 0 };
        out[n.id].count++;
        out[n.id].amount += Number(this.rowPlan(r).admin_price) || 0;
      });
      return Object.values(out);
    },
    total() {
      if (this.mode === 'single') return this.selectedPlan ? Number(this.selectedPlan.admin_price) || 0 : 0;
      return this.groupNetworkBreakdown.reduce((s, n) => s + n.amount, 0);
    },
    isReady() {
      if (this.mode === 'single') return !!(this.network && this.selectedPlan && this.phoneValid);
      return this.group.length > 0 && this.group.every(this.rowReady);
    },
    missingHint() {
      if (this.mode === 'single') {
        if (!this.network) return 'Choose a network';
        if (!this.selectedPlan) return 'Pick a data plan';
        if (!this.phoneValid) return 'Enter the recipient number';
        return '';
      }
      const pending = this.group.length - this.groupReadyCount;
      return pending ? `Complete ${pending} recipient${pending === 1 ? '' : 's'}` : '';
    },
    ctaLabel() {
      if (!this.isReady) return 'Buy data';
      return `Pay ₦${fmt(this.total)}`;
    },
    sheetItems() {
      if (this.mode === 'single') {
        if (!this.selectedPlan) return [];
        const items = [
          { label: 'Network', value: this.networkName(this.network) },
          { label: 'Plan', value: this.selectedPlan.plan_name },
          { label: 'Recipient', value: formatPhone(this.phone) },
        ];
        if (this.knownBeneficiary) items.push({ label: 'Beneficiary', value: this.knownBeneficiary.name });
        return items;
      }
      return [
        { label: 'Recipients', value: String(this.groupReadyCount) },
        ...this.groupNetworkBreakdown.map((n) => ({ label: n.name, value: `${n.count} × · ₦${fmt(n.amount)}` })),
      ];
    },
    pastedNumbers() {
      const seen = {};
      return String(this.pasteText)
        .split(/[\s,;]+/)
        .map(normalizePhone)
        .filter((p) => isValidPhone(p) && !seen[p] && (seen[p] = true));
    },
  },
  watch: {
    network(id) {
      this.selectedPlanId = '';
      this.planType = 'all';
      this.planQuery = '';
      if (id) this.loadPlans(id);
    },
    phone() {
      if (!this.phoneValid) {
        this.detected = null;
        return;
      }
      const p = normalizePhone(this.phone);
      this.detecting = true;
      detectNetwork(p).then((id) => {
        if (normalizePhone(this.phone) !== p) return; // user kept typing
        this.detecting = false;
        this.detected = id;
        // Only fill the network in when the user hasn't chosen one; never silently override (ported numbers).
        if (id && !this.network) this.network = id;
      });
    },
  },
  methods: {
    fmt,
    formatPhone,
    normalize: normalizePhone,
    validPhone: isValidPhone,
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
    plansFor(id) {
      return (id && this.plansByNetwork[id]) || [];
    },
    loadPlans(id, force = false) {
      if (!id || this.loading[id] || (this.plansByNetwork[id] && !force)) return;
      this.$set(this.loading, id, true);
      this.$set(this.planError, id, '');
      axios
        .get('/fetchplan/' + id)
        .then((r) => {
          const list = Array.isArray(r.data) ? r.data : [];
          this.$set(this.plansByNetwork, id, list.map((p) => Object.assign({}, p, { _meta: parsePlan(p) })));
        })
        .catch(() => this.$set(this.planError, id, "We couldn't load plans."))
        .then(() => this.$set(this.loading, id, false));
    },
    useBeneficiary(ben) {
      this.phone = normalizePhone(ben.phone);
      this.phoneTouched = true;
    },

    // ----- group -----
    rowPlan(row) {
      return this.plansFor(row.network_id).find((p) => p.id == row.plan_id) || null;
    },
    rowReady(row) {
      return isValidPhone(row.phone) && !!row.network_id && !!this.rowPlan(row);
    },
    setRowNetwork(row, id) {
      if (row.network_id == id) return;
      row.network_id = id;
      row.plan_id = '';
      this.loadPlans(id);
    },
    onRowPhone(row) {
      if (!isValidPhone(row.phone)) {
        row.detected = null;
        return;
      }
      const p = normalizePhone(row.phone);
      row.detecting = true;
      detectNetwork(p).then((id) => {
        row.detecting = false;
        if (normalizePhone(row.phone) !== p) return;
        row.detected = id;
        if (id && !row.network_id) this.setRowNetwork(row, id);
      });
    },
    addRow(phone = '') {
      const row = newRow(phone);
      this.group.push(row);
      if (phone) this.onRowPhone(row);
      return row;
    },
    removeRow(i) {
      if (this.group.length > 1) this.group.splice(i, 1);
      else this.group.splice(0, 1, newRow());
    },
    importPasted() {
      this.group = this.group.filter((r) => r.phone);
      const existing = this.group.map((r) => normalizePhone(r.phone));
      this.pastedNumbers.filter((p) => existing.indexOf(p) === -1).forEach((p) => this.addRow(p));
      if (!this.group.length) this.group.push(newRow());
      this.pasteText = '';
      this.pasteOpen = false;
    },

    // ----- checkout -----
    openCheckout() {
      if (this.isReady) this.sheetOpen = true;
    },
    submitPurchase(pin) {
      const fd = new FormData();
      fd.append('pin', pin);
      fd.append('purchase_type', this.mode);
      let endpoint = '/buydata';

      if (this.mode === 'single') {
        fd.append('network', this.network);
        fd.append('plan', this.selectedPlan.plan_id);
        fd.append('phone_number', normalizePhone(this.phone));
      } else {
        endpoint = '/bulk_buydata';
        const recipients = this.group.map((r) => ({
          phone: normalizePhone(r.phone),
          network: r.network_id,
          plan: this.rowPlan(r).plan_id,
        }));
        fd.append('recipients', JSON.stringify(recipients));
      }

      return axios
        .post(endpoint, fd)
        .then((res) => {
          const d = res.data || {};
          if (!isSuccess(d)) return { ok: false, message: d.message || 'Transaction failed.' };
          this.maybeSaveBeneficiary();
          if (this.mode === 'group') {
            return { ok: true, title: 'Group purchase complete', message: d.message, results: d.results || [] };
          }
          return {
            ok: true,
            message: d.message || `${this.selectedPlan.plan_name} sent to ${formatPhone(this.phone)}.`,
          };
        })
        .catch((err) => ({ ok: false, message: errorMessage(err) }));
    },
    maybeSaveBeneficiary() {
      if (this.mode !== 'single' || !this.saveBen || !this.benName || this.knownBeneficiary) return;
      const fd = new FormData();
      fd.append('phone', normalizePhone(this.phone));
      fd.append('name', this.benName);
      fd.append('type', 'data');
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

/* Plans */
.vx-plan-tools { display: flex; flex-direction: column; gap: 12px; margin-bottom: 14px; }
.vx-plan-search .vx-input { padding-top: 12px; padding-bottom: 12px; font-size: .95rem; }

.vx-plan-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 12px;
  max-height: 460px;
  overflow-y: auto;
  padding: 4px;
  margin: -4px;
}

.vx-plan {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 2px;
  min-height: 108px;
  padding: 16px;
  text-align: left;
  background: #fff;
  border: 1.5px solid var(--vx-line);
  border-radius: 18px;
  cursor: pointer;
  font-family: inherit;
  transition: border-color .15s, box-shadow .15s, transform .15s;
}
.vx-plan:hover { transform: translateY(-2px); box-shadow: 0 10px 22px -14px rgba(11, 22, 37, .35); }
.vx-plan.on { border-color: var(--vx-navy); background: linear-gradient(160deg, #fff 40%, #FFF6EC); box-shadow: 0 0 0 4px rgba(0, 31, 63, .07); }
.vx-plan.on::after {
  content: '';
  position: absolute;
  top: 12px;
  right: 12px;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background: var(--vx-navy) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E") center / 10px no-repeat;
}
.vx-plan-type { font-size: .64rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--vx-orange-2); background: #FFF3E6; padding: 2px 7px; border-radius: 6px; margin-bottom: 6px; }
.vx-plan-size { font-family: 'Fraunces', serif; font-size: 1.4rem; font-weight: 500; letter-spacing: -.02em; color: var(--vx-ink); line-height: 1.15; word-break: break-word; }
.vx-plan-valid { font-size: .78rem; color: var(--vx-sec); line-height: 1.3; }
.vx-plan-price { margin-top: auto; padding-top: 8px; font-weight: 700; font-size: .95rem; color: var(--vx-ink); }

/* Group */
.vx-step-flat { padding-left: 0; }
.vx-rows { display: flex; flex-direction: column; gap: 12px; }
.vx-row {
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding: 14px;
  border: 1.5px solid var(--vx-line);
  border-radius: 20px;
  background: #fff;
  transition: border-color .2s;
}
.vx-row.ready { border-color: rgba(31, 157, 87, .35); }
.vx-row-top { display: flex; align-items: center; gap: 10px; }
.vx-row-idx { width: 28px; height: 28px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; font-size: .75rem; font-weight: 700; background: #F3F3EF; color: var(--vx-sec); }
.vx-row.ready .vx-row-idx { background: #1F9D57; color: #fff; }
.vx-row-phone { flex: 1; min-width: 0; }
.vx-row-phone .vx-input, .vx-row-plan .vx-input { padding: 12px 14px; font-size: .95rem; border-radius: 12px; }
.vx-row-x { width: 36px; height: 36px; flex-shrink: 0; border: 0; border-radius: 50%; background: #FEF2F2; color: #DC2626; cursor: pointer; }
.vx-row-x:hover { background: #FEE4E2; }
.vx-row-plan { position: relative; }
.vx-select { appearance: none; -webkit-appearance: none; padding-right: 90px !important; cursor: pointer; text-overflow: ellipsis;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 14px center; background-size: 16px; }
.vx-select:disabled { cursor: not-allowed; opacity: .7; }
.vx-row-price { position: absolute; right: 38px; top: 50%; transform: translateY(-50%); font-weight: 700; font-size: .9rem; pointer-events: none; }

.vx-row-actions { display: flex; gap: 10px; margin-top: 14px; flex-wrap: wrap; }
.vx-add {
  flex: 1;
  min-width: 160px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px;
  border-radius: 999px;
  border: 1.5px dashed rgba(11, 22, 37, .2);
  background: transparent;
  color: var(--vx-ink);
  font-weight: 600;
  font-family: inherit;
  cursor: pointer;
  transition: border-color .15s, color .15s, background .15s;
}
.vx-add:hover { border-color: var(--vx-orange); color: var(--vx-orange-2); background: #FFF8F0; }
.vx-add.ghost { border-style: solid; border-color: var(--vx-line); color: var(--vx-sec); }

.vx-paste { margin-top: 12px; }
.vx-paste textarea { font-size: .95rem; resize: vertical; }
.vx-paste-foot { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; }
.vx-paste-foot .vx-chip:disabled { opacity: .4; cursor: not-allowed; }

@media (max-width: 575px) {
  .vx-plan-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
  .vx-plan { min-height: 100px; padding: 14px; }
  .vx-plan-size { font-size: 1.2rem; }
  .vx-row { padding: 12px; }
}
</style>
