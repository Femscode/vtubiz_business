<template>
  <div class="vxn" role="radiogroup" aria-label="Network">
    <button
      v-for="n in networks"
      :key="n.id"
      type="button"
      role="radio"
      :aria-checked="String(value == n.id)"
      :class="['vxn-tile', 'vxn-' + n.key, { on: value == n.id, compact: compact }]"
      @click="$emit('input', n.id)"
    >
      <span class="vxn-logo">{{ n.mono }}</span>
      <span class="vxn-name">{{ n.name }}</span>
      <span v-if="detected == n.id" class="vxn-detected">Detected</span>
      <span class="vxn-tick" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
      </span>
    </button>
  </div>
</template>

<script>
import { NETWORKS } from './helpers';

export default {
  props: {
    value: { type: [String, Number], default: '' },
    detected: { type: [String, Number], default: null },
    compact: { type: Boolean, default: false },
  },
  data() {
    return { networks: NETWORKS };
  },
};
</script>

<style scoped>
.vxn {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 12px;
}

.vxn-tile {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  padding: 18px 8px 14px;
  background: #fff;
  border: 1.5px solid rgba(11, 22, 37, .08);
  border-radius: 18px;
  cursor: pointer;
  transition: border-color .18s, box-shadow .18s, transform .18s;
  font-family: inherit;
}

.vxn-tile:hover { transform: translateY(-2px); box-shadow: 0 10px 24px -14px rgba(11, 22, 37, .35); }
.vxn-tile:focus-visible { outline: 3px solid rgba(251, 145, 41, .45); outline-offset: 2px; }

.vxn-logo {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  font-weight: 800;
  font-size: 13px;
  letter-spacing: -.02em;
  transition: transform .2s;
}

.vxn-name { font-size: .85rem; font-weight: 600; color: #0B1625; }

.vxn-mtn .vxn-logo { background: #FFCC00; color: #0B1625; }
.vxn-glo .vxn-logo { background: linear-gradient(135deg, #5BBF21, #00843D); color: #fff; font-size: 15px; }
.vxn-airtel .vxn-logo { background: #E40000; color: #fff; font-size: 11px; }
.vxn-nine .vxn-logo { background: linear-gradient(135deg, #A4C639, #006E3C); color: #fff; font-size: 20px; }

.vxn-tile.on { border-color: var(--net, #001f3f); box-shadow: 0 0 0 4px var(--net-ring, rgba(0, 31, 63, .08)); }
.vxn-tile.on .vxn-logo { transform: scale(1.06); }
.vxn-mtn { --net: #E6B800; --net-ring: rgba(255, 204, 0, .22); }
.vxn-glo { --net: #00843D; --net-ring: rgba(0, 132, 61, .14); }
.vxn-airtel { --net: #E40000; --net-ring: rgba(228, 0, 0, .12); }
.vxn-nine { --net: #006E3C; --net-ring: rgba(0, 110, 60, .14); }

.vxn-tick {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: var(--net);
  color: #fff;
  display: grid;
  place-items: center;
  opacity: 0;
  transform: scale(.5);
  transition: opacity .18s, transform .18s;
}
.vxn-mtn .vxn-tick { color: #0B1625; }
.vxn-tile.on .vxn-tick { opacity: 1; transform: scale(1); }

.vxn-detected {
  position: absolute;
  top: -9px;
  left: 50%;
  transform: translateX(-50%);
  background: #0B1625;
  color: #fff;
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;
  padding: 3px 8px;
  border-radius: 999px;
  white-space: nowrap;
}

/* Compact variant (group rows) */
.vxn-tile.compact { flex-direction: row; padding: 8px 10px; gap: 8px; border-radius: 12px; justify-content: center; }
.vxn-tile.compact .vxn-logo { width: 26px; height: 26px; font-size: 8px; }
.vxn-tile.compact .vxn-name { font-size: .78rem; }
.vxn-tile.compact .vxn-tick, .vxn-tile.compact .vxn-detected { display: none; }

@media (max-width: 480px) {
  .vxn { gap: 8px; }
  .vxn-tile { padding: 14px 4px 10px; border-radius: 16px; }
  .vxn-logo { width: 40px; height: 40px; }
  .vxn-name { font-size: .78rem; }
  .vxn-tile.compact .vxn-name { display: none; }
}
</style>
