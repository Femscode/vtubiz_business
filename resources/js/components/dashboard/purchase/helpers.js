// Shared helpers for the data / airtime purchase screens.

export const NETWORKS = [
  { id: '1', key: 'mtn', name: 'MTN', mono: 'MTN' },
  { id: '2', key: 'glo', name: 'Glo', mono: 'glo' },
  { id: '3', key: 'airtel', name: 'Airtel', mono: 'airtel' },
  { id: '4', key: 'nine', name: '9mobile', mono: '9' },
];

export function networkById(id) {
  return NETWORKS.find((n) => n.id == id) || null;
}

/** Strip spaces/symbols and turn +234 / 234 / 10-digit input into the 0XXXXXXXXXX form. */
export function normalizePhone(raw) {
  let d = String(raw || '').replace(/\D/g, '');
  if (d.indexOf('234') === 0 && d.length >= 13) d = '0' + d.slice(3);
  if (d.length === 10 && d[0] !== '0') d = '0' + d;
  return d;
}

export function isValidPhone(raw) {
  return /^0[789]\d{9}$/.test(normalizePhone(raw));
}

export function formatPhone(raw) {
  const d = normalizePhone(raw);
  if (d.length !== 11) return raw || '';
  return `${d.slice(0, 4)} ${d.slice(4, 7)} ${d.slice(7)}`;
}

const money = new Intl.NumberFormat('en-NG', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
export function fmt(val) {
  return money.format(Number(val) || 0);
}

const detectCache = {};
/** Resolves to a network id string ("1".."4") or null when the prefix is unknown. */
export function detectNetwork(phone) {
  const p = normalizePhone(phone);
  if (detectCache[p] !== undefined) return Promise.resolve(detectCache[p]);
  return axios
    .get('/fetchnetwork/' + p)
    .then((r) => {
      const id = String(r.data);
      detectCache[p] = id !== '0' && networkById(id) ? id : null;
      return detectCache[p];
    })
    .catch(() => null);
}

/** Pull size / validity / type out of a free-text plan name like "1GB SME - 30 Days". */
export function parsePlan(plan) {
  const name = String((plan && plan.plan_name) || '');
  const size = name.match(/(\d+(?:\.\d+)?)\s*(TB|GB|MB)/i);
  const validity =
    name.match(/(\d+)\s*(hrs?|hours?|days?|weeks?|months?|years?)\b/i) ||
    name.match(/\b(daily|weekly|monthly|yearly)\b/i);
  const type = name.match(/\b(SME\s?2?|CG|Corporate(?:\s+Gifting)?|Gifting|Awoof|Direct|Data\s?Share|Social|Coupon)\b/i);

  let typeLabel = '';
  if (type) {
    const t = type[1].replace(/\s+/g, ' ').trim();
    if (/^corporate/i.test(t)) typeLabel = 'Corporate';
    else if (/^(sme|cg)/i.test(t)) typeLabel = t.toUpperCase();
    else typeLabel = t.charAt(0).toUpperCase() + t.slice(1).toLowerCase();
  }

  let validityLabel = '';
  if (validity) {
    validityLabel = validity[2]
      ? `${validity[1]} ${validity[2].charAt(0).toUpperCase()}${validity[2].slice(1).toLowerCase()}`
      : validity[1].charAt(0).toUpperCase() + validity[1].slice(1).toLowerCase();
  }

  return {
    size: size ? `${size[1]}${size[2].toUpperCase()}` : '',
    validity: validityLabel,
    type: typeLabel,
  };
}

/** Normalise the different success shapes the purchase endpoints return. */
export function isSuccess(data) {
  return !!data && (data.success === true || data.success == 'true' || data.status == 'success');
}

export function errorMessage(err, fallback = 'Something went wrong. Please try again.') {
  const d = err && err.response && err.response.data;
  if (d && d.errors) {
    const first = Object.values(d.errors)[0];
    if (first && first.length) return first[0];
  }
  if (d && d.message) return d.message;
  if (err && !err.response) return 'Network error — check your connection and try again.';
  return fallback;
}
