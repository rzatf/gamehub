/** IDR formatting helpers — the whole UI prices in Rupiah. */
export function formatIDR(value: number | null | undefined): string {
  if (value === null || value === undefined || Number.isNaN(value)) return "—";
  return "Rp" + Math.round(value).toLocaleString("id-ID", { maximumFractionDigits: 0 });
}

/** Design uses "Rp1.073.021" on cards and "Rp 268.256" in the detail list. */
export function formatIDRSpaced(value: number | null | undefined): string {
  if (value === null || value === undefined || Number.isNaN(value)) return "—";
  return "Rp " + Math.round(value).toLocaleString("id-ID", { maximumFractionDigits: 0 });
}

export function formatNumber(value: number | null | undefined): string {
  if (value === null || value === undefined || Number.isNaN(value)) return "—";
  return Math.round(value).toLocaleString("id-ID");
}

export function formatCompact(value: number): string {
  if (value >= 1_000_000) return (value / 1_000_000).toFixed(value % 1_000_000 === 0 ? 0 : 1) + "M";
  if (value >= 1_000) return (value / 1_000).toFixed(0) + "k";
  return String(value);
}

export function formatRating(rating: number): string {
  return rating.toFixed(1);
}

export function formatDateID(value: string | null | undefined): string {
  if (!value) return "TBA";
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return "TBA";
  return date.toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" });
}

export function plural(count: number, word: string): string {
  return `${count} ${word}`;
}
