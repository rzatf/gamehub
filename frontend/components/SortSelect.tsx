"use client";

export const SORT_OPTIONS = [
  { value: "terbaru", label: "Terbaru" },
  { value: "terlaris", label: "Terlaris" },
  { value: "diskon", label: "Diskon Tertinggi" },
  { value: "harga", label: "Harga Terendah" },
  { value: "harga_tertinggi", label: "Harga Tertinggi" },
] as const;

export type SortValue = (typeof SORT_OPTIONS)[number]["value"];

/** Sort control shown at the top-right of the catalogue, as in the design. */
export function SortSelect({ value, onChange }: { value: SortValue; onChange: (v: SortValue) => void }) {
  return (
    <label className="relative inline-flex items-center">
      <span className="sr-only">Urutkan berdasarkan</span>
      <select
        value={value}
        onChange={(e) => onChange(e.target.value as SortValue)}
        className="h-10 appearance-none rounded-lg border border-hairline bg-deep pl-3.5 pr-9 text-[13.5px] text-white outline-none transition-colors focus:border-brand"
      >
        {SORT_OPTIONS.map((option) => (
          <option key={option.value} value={option.value} className="bg-deep text-white">
            {option.label}
          </option>
        ))}
      </select>
      <span className="pointer-events-none absolute right-3 text-muted-deep">
        <svg className="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" aria-hidden="true">
          <path d="m6 9 6 6 6-6" strokeLinecap="round" strokeLinejoin="round" />
        </svg>
      </span>
    </label>
  );
}
