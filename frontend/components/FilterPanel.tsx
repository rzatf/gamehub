"use client";

import type { GenreOption } from "@/lib/types";

export type CatalogFilters = {
  shops: string[];
  genres: string[];
  minPrice: string;
  maxPrice: string;
};

export const EMPTY_FILTERS: CatalogFilters = { shops: [], genres: [], minPrice: "", maxPrice: "" };

function Checkbox({
  checked,
  label,
  onChange,
  hint,
}: {
  checked: boolean;
  label: string;
  onChange: () => void;
  hint?: string;
}) {
  return (
    <label className="flex cursor-pointer items-center gap-2.5 py-1.5 text-[14px] text-muted transition-colors hover:text-white">
      <span
        className={`flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded-[4px] border transition-colors ${
          checked ? "border-lime bg-lime text-abyss" : "border-muted-deep bg-field"
        }`}
      >
        {checked ? (
          <svg className="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3.5" aria-hidden="true">
            <path d="m5 13 4.5 4.5L19 7" strokeLinecap="round" strokeLinejoin="round" />
          </svg>
        ) : null}
      </span>
      <input type="checkbox" className="sr-only" checked={checked} onChange={onChange} />
      <span className="flex-1">{label}</span>
      {hint ? <span className="text-[11.5px] text-muted-deep">{hint}</span> : null}
    </label>
  );
}

/**
 * Catalogue sidebar: Shops and Genre (multi-select) plus the Rupiah price
 * range required by the PRD. Every change re-queries the API without a reload.
 */
export function FilterPanel({
  shops,
  genres,
  filters,
  onChange,
  resultCount,
}: {
  shops: { slug: string; name: string }[];
  genres: GenreOption[];
  filters: CatalogFilters;
  onChange: (next: CatalogFilters) => void;
  resultCount?: number;
}) {
  const toggle = (key: "shops" | "genres", value: string) => {
    const current = filters[key];
    const next = current.includes(value) ? current.filter((v) => v !== value) : [...current, value];
    onChange({ ...filters, [key]: next });
  };

  const activeCount = filters.shops.length + filters.genres.length + (filters.minPrice ? 1 : 0) + (filters.maxPrice ? 1 : 0);

  return (
    <aside className="h-fit rounded-xl border border-hairline/60 bg-panel p-5 lg:sticky lg:top-24">
      <div className="mb-4 flex items-center justify-between">
        <h2 className="text-[15.5px] font-semibold text-white">Filters</h2>
        {activeCount > 0 ? (
          <button
            type="button"
            onClick={() => onChange(EMPTY_FILTERS)}
            className="text-[12px] text-brand-bright transition-colors hover:text-white"
          >
            Reset
          </button>
        ) : null}
      </div>

      <section className="mb-5">
        <h3 className="mb-1.5 text-[13.5px] font-semibold text-white">Shops</h3>
        {shops.map((shop) => (
          <Checkbox
            key={shop.slug}
            label={shop.name}
            checked={filters.shops.includes(shop.slug)}
            onChange={() => toggle("shops", shop.slug)}
          />
        ))}
      </section>

      <section className="mb-5">
        <h3 className="mb-1.5 text-[13.5px] font-semibold text-white">Genre</h3>
        {genres.map((genre) => (
          <Checkbox
            key={genre.slug}
            label={genre.name}
            checked={filters.genres.includes(genre.slug)}
            onChange={() => toggle("genres", genre.slug)}
          />
        ))}
      </section>

      <section>
        <h3 className="mb-2 text-[13.5px] font-semibold text-white">Rentang Harga (Rp)</h3>
        <div className="flex items-center gap-2">
          <input
            type="number"
            min={0}
            inputMode="numeric"
            placeholder="Min"
            value={filters.minPrice}
            onChange={(e) => onChange({ ...filters, minPrice: e.target.value })}
            className="h-9 w-full rounded-md border border-hairline bg-field px-2.5 text-[13px] text-white placeholder-muted-deep outline-none focus:border-brand"
          />
          <span className="text-muted-deep">–</span>
          <input
            type="number"
            min={0}
            inputMode="numeric"
            placeholder="Max"
            value={filters.maxPrice}
            onChange={(e) => onChange({ ...filters, maxPrice: e.target.value })}
            className="h-9 w-full rounded-md border border-hairline bg-field px-2.5 text-[13px] text-white placeholder-muted-deep outline-none focus:border-brand"
          />
        </div>
      </section>

      {typeof resultCount === "number" ? (
        <p className="mt-5 border-t border-hairline/60 pt-4 text-[12.5px] text-muted-deep">
          {resultCount} game ditemukan
        </p>
      ) : null}
    </aside>
  );
}
