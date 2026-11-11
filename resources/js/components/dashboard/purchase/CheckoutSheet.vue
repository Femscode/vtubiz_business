<template>
  <transition name="vxs-fade">
    <div v-if="open" class="vxs-overlay" @click.self="close" role="dialog" aria-modal="true" :aria-label="title">
      <div class="vxs-sheet" :class="'is-' + state">
        <span class="vxs-grip" aria-hidden="true"></span>
        <button v-if="state !== 'processing'" type="button" class="vxs-x" aria-label="Close" @click="close">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <!-- Review + PIN -->
        <div v-if="state === 'pin'" class="vxs-body">
          <span class="vxs-eyebrow">Review &amp; confirm</span>
          <h3 class="vxs-title">{{ title }}</h3>

          <ul class="vxs-lines">
            <li v-for="(line, i) in items" :key="i">
              <span>{{ line.label }}</span>
              <strong>{{ line.value }}</strong>
            </li>
          </ul>

          <div class="vxs-total">
            <span>You pay</span>
            <strong>₦{{ fmt(total) }}</strong>
          </div>

          <div v-if="insufficient" class="vxs-warn">
            <span>Your balance (₦{{ fmt(balance) }}) is not enough for this purchase.</span>
            <a href="/fundwallet">Fund wallet →</a>
          </div>

          <template v-else>
            <label class="vxs-pin-label" for="vxs-pin">Enter your 4-digit transaction PIN</label>
            <div class="vxs-pin" :class="{ shake: shake }" @click="focusPin()">
              <span
                v-for="n in 4"
                :key="n"
                class="vxs-pin-box"
                :class="{ filled: pin.length >= n, active: pinFocused && pin.length === n - 1 }"
              ></span>
              <input
                id="vxs-pin"
                ref="pin"
                :value="pin"
                type="password"
                inputmode="numeric"
                pattern="[0-9]*"
                autocomplete="off"
                maxlength="4"
                @input="onPin"
                @focus="pinFocused = true"
                @blur="pinFocused = false"
                @keydown.enter.prevent="confirm"
              />
            </div>
            <p class="vxs-pin-error" v-if="pinError">{{ pinError }}</p>
          </template>

          <button type="button" class="vxs-btn" :disabled="insufficient || pin.length !== 4" @click="confirm">
            Pay ₦{{ fmt(total) }}
          </button>
          <p class="vxs-secure">
            <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            Paid from your wallet · secured by your PIN
          </p>
        </div>

        <!-- Processing -->
        <div v-else-if="state === 'processing'" class="vxs-body vxs-center">
          <div class="vxs-loader"><span></span><span></span></div>
          <h3 class="vxs-title">Processing…</h3>
          <p class="vxs-muted">Hang tight, we're delivering your {{ noun }}. Please don't close this window.</p>
        </div>

        <!-- Success -->
        <div v-else-if="state === 'success'" class="vxs-body vxs-center">
          <div class="vxs-badge ok">
            <svg viewBox="0 0 52 52"><circle cx="26" cy="26" r="24" fill="none"></circle><path fill="none" d="M15 27l7 7 15-15"></path></svg>
          </div>
          <h3 class="vxs-title">{{ result.title || 'Purchase successful' }}</h3>
          <p class="vxs-muted">{{ result.message }}</p>

          <ul v-if="result.results && result.results.length" class="vxs-results">
            <li v-for="(r, i) in result.results" :key="i" :class="r.status">
              <span class="dot"></span>
              <span class="ph">{{ r.phone }}</span>
              <span class="st">{{ r.status === 'success' ? 'Delivered' : (r.message || 'Failed') }}</span>
            </li>
          </ul>

          <div class="vxs-actions">
            <a href="/mytransactions" class="vxs-btn ghost">View transactions</a>
            <button type="button" class="vxs-btn" @click="$emit('done')">Done</button>
          </div>
        </div>

        <!-- Error -->
        <div v-else class="vxs-body vxs-center">
          <div class="vxs-badge err">
            <svg viewBox="0 0 52 52"><circle cx="26" cy="26" r="24" fill="none"></circle><path fill="none" d="M18 18l16 16M34 18L18 34"></path></svg>
          </div>
          <h3 class="vxs-title">Purchase failed</h3>
          <p class="vxs-muted">{{ result.message }}</p>
          <div class="vxs-actions">
            <button type="button" class="vxs-btn ghost" @click="close">Close</button>
            <button type="button" class="vxs-btn" @click="retry">Try again</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { fmt } from './helpers';

export default {
  props: {
    open: { type: Boolean, default: false },
    title: { type: String, default: 'Confirm purchase' },
    noun: { type: String, default: 'order' },
    items: { type: Array, default: () => [] },
    total: { type: Number, default: 0 },
    balance: { type: Number, default: null },
    // (pin) => Promise<{ ok, title?, message, results? }>
    submit: { type: Function, required: true },
  },
  data() {
    return { state: 'pin', pin: '', pinError: '', pinFocused: false, shake: false, result: {} };
  },
  computed: {
    insufficient() {
      return this.balance !== null && !isNaN(this.balance) && this.total > this.balance;
    },
  },
  watch: {
    open(v) {
      if (v) {
        this.state = 'pin';
        this.pin = '';
        this.pinError = '';
        this.result = {};
        document.addEventListener('keydown', this.onKey);
        this.focusPin(220);
      } else {
        document.removeEventListener('keydown', this.onKey);
      }
    },
  },
  beforeDestroy() {
    document.removeEventListener('keydown', this.onKey);
  },
  methods: {
    fmt,
    onKey(e) {
      if (e.key === 'Escape') this.close();
    },
    focusPin(delay = 0) {
      setTimeout(() => this.$refs.pin && this.$refs.pin.focus(), delay);
    },
    onPin(e) {
      this.pin = e.target.value.replace(/\D/g, '').slice(0, 4);
      e.target.value = this.pin;
      this.pinError = '';
      if (this.pin.length === 4) setTimeout(this.confirm, 160);
    },
    close() {
      if (this.state === 'processing') return;
      this.$emit(this.state === 'success' ? 'done' : 'close');
    },
    retry() {
      this.state = 'pin';
      this.pin = '';
      this.focusPin(60);
    },
    confirm() {
      if (this.state !== 'pin' || this.pin.length !== 4 || this.insufficient) return;
      this.state = 'processing';
      Promise.resolve(this.submit(this.pin))
        .then((res) => {
          this.result = res || {};
          if (this.result.ok) {
            this.state = 'success';
          } else if (/pin/i.test(this.result.message || '')) {
            // Wrong PIN: stay on the PIN step instead of a dead-end error screen.
            this.state = 'pin';
            this.pin = '';
            this.pinError = this.result.message;
            this.shake = true;
            setTimeout(() => (this.shake = false), 450);
            this.focusPin(60);
          } else {
            this.state = 'error';
          }
        })
        .catch(() => {
          this.result = { ok: false, message: 'Something went wrong. Please try again.' };
          this.state = 'error';
        });
    },
  },
};
</script>

<style scoped>
.vxs-overlay {
  position: fixed;
  inset: 0;
  z-index: 2000;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: rgba(6, 14, 26, .55);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
}

.vxs-sheet {
  position: relative;
  width: 100%;
  max-width: 440px;
  max-height: calc(100dvh - 40px);
  overflow-y: auto;
  background: #fff;
  border-radius: 28px;
  box-shadow: 0 40px 80px -20px rgba(0, 0, 0, .45);
  font-family: 'DM Sans', sans-serif;
  color: #0B1625;
  animation: vxs-pop .32s cubic-bezier(.2, .9, .3, 1.2);
}

.vxs-grip { display: none; }

.vxs-x {
  position: absolute;
  top: 16px;
  right: 16px;
  width: 36px;
  height: 36px;
  border: 0;
  border-radius: 50%;
  background: #F3F3EF;
  color: #6B7280;
  display: grid;
  place-items: center;
  cursor: pointer;
  z-index: 1;
}
.vxs-x:hover { background: #E9E8E2; color: #0B1625; }

.vxs-body { padding: 30px 28px 26px; }
.vxs-center { text-align: center; padding-top: 40px; }

.vxs-eyebrow {
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: #FB9129;
}

.vxs-title {
  font-family: 'Fraunces', serif;
  font-weight: 500;
  font-size: 1.55rem;
  letter-spacing: -.02em;
  margin: 6px 0 18px;
  padding-right: 32px;
}
.vxs-center .vxs-title { padding-right: 0; margin-bottom: 8px; }

.vxs-muted { color: #6B7280; font-size: .92rem; line-height: 1.55; margin: 0 auto 22px; max-width: 320px; }

.vxs-lines { list-style: none; margin: 0 0 14px; padding: 4px 16px; background: #FAFAF8; border-radius: 18px; }
.vxs-lines li { display: flex; justify-content: space-between; gap: 16px; padding: 12px 0; font-size: .9rem; color: #6B7280; }
.vxs-lines li + li { border-top: 1px dashed rgba(11, 22, 37, .1); }
.vxs-lines strong { color: #0B1625; font-weight: 600; text-align: right; }

.vxs-total { display: flex; justify-content: space-between; align-items: baseline; padding: 4px 4px 20px; }
.vxs-total span { font-weight: 600; color: #6B7280; }
.vxs-total strong { font-family: 'Fraunces', serif; font-weight: 500; font-size: 2rem; letter-spacing: -.02em; }

.vxs-warn {
  display: flex;
  flex-direction: column;
  gap: 6px;
  padding: 14px 16px;
  margin-bottom: 18px;
  border-radius: 16px;
  background: #FEF2F2;
  color: #B42318;
  font-size: .88rem;
}
.vxs-warn a { color: #B42318; font-weight: 700; text-decoration: none; }

.vxs-pin-label { display: block; text-align: center; font-size: .85rem; font-weight: 600; color: #6B7280; margin-bottom: 12px; }

.vxs-pin { position: relative; display: flex; justify-content: center; gap: 12px; margin-bottom: 8px; cursor: text; }
.vxs-pin input {
  position: absolute;
  inset: 0;
  width: 100%;
  opacity: 0;
  border: 0;
  font-size: 16px; /* stop iOS zoom */
  caret-color: transparent;
}
.vxs-pin-box {
  width: 56px;
  height: 60px;
  border-radius: 16px;
  border: 1.5px solid rgba(11, 22, 37, .1);
  background: #FAFAF8;
  display: grid;
  place-items: center;
  transition: border-color .15s, background .15s, transform .15s;
}
.vxs-pin-box::after {
  content: '';
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #0B1625;
  transform: scale(0);
  transition: transform .18s cubic-bezier(.2, .9, .3, 1.4);
}
.vxs-pin-box.filled { background: #fff; border-color: #0B1625; }
.vxs-pin-box.filled::after { transform: scale(1); }
.vxs-pin-box.active { border-color: #FB9129; box-shadow: 0 0 0 4px rgba(251, 145, 41, .15); }
.vxs-pin.shake { animation: vxs-shake .4s; }
.vxs-pin.shake .vxs-pin-box { border-color: #EF4444; }
.vxs-pin-error { text-align: center; color: #DC2626; font-size: .85rem; font-weight: 600; margin: 6px 0 0; }

.vxs-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  margin-top: 20px;
  padding: 16px;
  border: 0;
  border-radius: 999px;
  background: linear-gradient(135deg, #FFA23F, #FF7A00);
  color: #fff;
  font-weight: 700;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  box-shadow: 0 12px 24px -10px rgba(255, 122, 0, .6);
  transition: transform .15s, box-shadow .15s, opacity .15s;
}
.vxs-btn:hover:not(:disabled) { transform: translateY(-1px); color: #fff; }
.vxs-btn:disabled { opacity: .45; cursor: not-allowed; box-shadow: none; }
.vxs-btn.ghost { background: #F3F3EF; color: #0B1625; box-shadow: none; }
.vxs-btn.ghost:hover { color: #0B1625; background: #E9E8E2; }

.vxs-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.vxs-actions .vxs-btn { margin-top: 0; }

.vxs-secure { display: flex; align-items: center; justify-content: center; gap: 6px; margin: 14px 0 0; font-size: .78rem; color: #A0A6B1; }

/* Processing loader */
.vxs-loader { position: relative; width: 72px; height: 72px; margin: 0 auto 22px; }
.vxs-loader span { position: absolute; inset: 0; border-radius: 50%; border: 4px solid transparent; }
.vxs-loader span:first-child { border-top-color: #FB9129; border-right-color: #FB9129; animation: vxs-spin 0.9s linear infinite; }
.vxs-loader span:last-child { inset: 12px; border-bottom-color: #001f3f; border-left-color: #001f3f; animation: vxs-spin 1.3s linear infinite reverse; }

/* Result badges */
.vxs-badge { width: 84px; height: 84px; margin: 0 auto 18px; border-radius: 50%; display: grid; place-items: center; }
.vxs-badge svg { width: 84px; height: 84px; stroke-width: 3.5; stroke-linecap: round; stroke-linejoin: round; }
.vxs-badge circle { stroke-dasharray: 151; stroke-dashoffset: 151; animation: vxs-draw .5s ease-out forwards; }
.vxs-badge path { stroke-dasharray: 48; stroke-dashoffset: 48; animation: vxs-draw .35s .4s ease-out forwards; }
.vxs-badge.ok { background: #ECFDF3; }
.vxs-badge.ok svg { stroke: #1F9D57; }
.vxs-badge.err { background: #FEF2F2; }
.vxs-badge.err svg { stroke: #DC2626; }

.vxs-results { list-style: none; padding: 0; margin: 0 0 22px; text-align: left; max-height: 220px; overflow-y: auto; border-radius: 16px; background: #FAFAF8; }
.vxs-results li { display: grid; grid-template-columns: 10px auto 1fr; align-items: center; gap: 10px; padding: 11px 14px; font-size: .85rem; }
.vxs-results li + li { border-top: 1px solid rgba(11, 22, 37, .06); }
.vxs-results .dot { width: 8px; height: 8px; border-radius: 50%; background: #DC2626; }
.vxs-results li.success .dot { background: #1F9D57; }
.vxs-results .ph { font-weight: 600; }
.vxs-results .st { text-align: right; color: #6B7280; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.vxs-results li.success .st { color: #1F9D57; font-weight: 600; }

.vxs-fade-enter-active, .vxs-fade-leave-active { transition: opacity .2s; }
.vxs-fade-enter, .vxs-fade-leave-to { opacity: 0; }

@keyframes vxs-pop { from { opacity: 0; transform: translateY(24px) scale(.97); } to { opacity: 1; transform: none; } }
@keyframes vxs-up { from { transform: translateY(100%); } to { transform: none; } }
@keyframes vxs-spin { to { transform: rotate(360deg); } }
@keyframes vxs-draw { to { stroke-dashoffset: 0; } }
@keyframes vxs-shake { 20%, 60% { transform: translateX(-8px); } 40%, 80% { transform: translateX(8px); } }

/* Phones: bottom sheet */
@media (max-width: 575px) {
  .vxs-overlay { align-items: flex-end; padding: 0; }
  .vxs-sheet {
    max-width: none;
    border-radius: 28px 28px 0 0;
    max-height: 92dvh;
    padding-bottom: env(safe-area-inset-bottom);
    animation: vxs-up .34s cubic-bezier(.2, .9, .3, 1);
  }
  .vxs-grip { display: block; width: 42px; height: 5px; border-radius: 999px; background: #E5E4DE; margin: 10px auto 0; }
  .vxs-body { padding: 22px 20px 24px; }
  .vxs-pin-box { width: 52px; height: 56px; }
}

@media (prefers-reduced-motion: reduce) {
  .vxs-sheet, .vxs-pin.shake, .vxs-badge circle, .vxs-badge path { animation: none; stroke-dashoffset: 0; }
}
</style>
