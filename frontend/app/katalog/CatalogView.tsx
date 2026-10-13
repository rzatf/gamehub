"use client";

import { useCallback, useEffect, useMemo, useState } from "react";
import type { Game, GenreOption, Paginated } from "@/lib/types";
import { useApi, useDebounced } from "@/lib/useApi";
import { FilterPanel, EMPTY_FILTERS, type CatalogFilters } from "@/components/FilterPanel";
import { SortSelect, SORT_OPTIONS, type SortValue } from "@/components/SortSelect";
import { Pagination } from "@/components/Pagination";
import { GameGrid } from "@/components/GameCard";
import { CardGridSkeleton, EmptyState, ErrorState } from "@/components/skeletons";

const PER_PAGE = 9;

type PlatformOption = { id: number; name: string; slug: string };

function readInitialState() {
  if (typeof window === "undefined") {
    return { filters: EMPTY_FILTERS, sort: "terbaru" as SortValue, page: 1 };
  }
  const qs = new URLSearchParams(window.location.search);
  const filters: CatalogFilters = {
    shops: (qs.get("platform") ?? "").split(",").filter(Boolean),
    genres: (qs.get("genre") ?? "").split(",").filter(Boolean),
    minPrice: qs.get("min_price") ?? "",
    maxPrice: qs.get("max_price") ?? "",
  };
  const sortParam = qs.get("sort");
  const sort: SortValue = SORT_OPTIONS.some((option) => option.value === sortParam)
    ? (sortParam as SortValue)
    : "terbaru";
  return { filters, sort, page: Math.max(1, Number(qs.get("page") ?? 1) || 1) };
}

/**
 * Catalogue: server-side search, multi-select genre/platform filters, a Rupiah
 * price range, sorting and pagination — every change re-queries the API and the
 * URL is rewritten so the current view is shareable (no full page reload).
 */
export function CatalogView() {
  const initial = useMemo(readInitialState, []);
  const [filters, setFilters] = useState<CatalogFilters>(initial.filters);
  const [sort, setSort] = useState<SortValue>(initial.sort);
  const [page, setPage] = useState(initial.page);
  const [search, setSearch] = useState("");

  const debouncedMin = useDebounced(filters.minPrice, 350);
  const debouncedMax = useDebounced(filters.maxPrice, 350);

  const genres = useApi<{ data: GenreOption[] }>("/api/genres");
  const platforms = useApi<{ data: PlatformOption[] }>("/api/platforms");

  const games = useApi<Paginated<Game>>("/api/games", {
    search: search || undefined,
    genre: filters.genres,
    platform: filters.shops,
    min_price: debouncedMin || undefined,
    max_price: debouncedMax || undefined,
    sort,
    page,
    per_page: PER_PAGE,
  });

  // Keep the address bar in sync with the active filters.
  useEffect(() => {
    if (typeof window === "undefined") return;
    const qs = new URLSearchParams();
    if (filters.shops.length) qs.set("platform", filters.shops.join(","));
    if (filters.genres.length) qs.set("genre", filters.genres.join(","));
    if (filters.minPrice) qs.set("min_price", filters.minPrice);
    if (filters.maxPrice) qs.set("max_price", filters.maxPrice);
    if (sort !== "terbaru") qs.set("sort", sort);
    if (page > 1) qs.set("page", String(page));
    const next = qs.toString();
    window.history.replaceState(null, "", next ? `?${next}` : window.location.pathname);
  }, [filters, sort, page]);

  const handleFilters = useCallback((next: CatalogFilters) => {
    setFilters(next);
    setPage(1);
  }, []);

  const result = games.data;
  const meta = result?.meta;

  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
      <header className="mb-8 flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1 className="text-[26px] font-extrabold tracking-tight text-white sm:text-[30px]">Katalog Game</h1>
          <p className="mt-1.5 text-[14px] text-muted">
            Temukan berbagai game dan bandingkan harga dari beberapa platform
          </p>
        </div>
        <SortSelect
          value={sort}
          onChange={(value) => {
            setSort(value);
            setPage(1);
          }}
        />
      </header>

      <div className="grid gap-8 lg:grid-cols-[280px_1fr]">
        <FilterPanel
          shops={platforms.data?.data ?? []}
          genres={(genres.data?.data ?? []).filter((g) => g.is_filterable)}
          filters={filters}
          onChange={handleFilters}
          resultCount={meta?.total}
        />

        <div>
          <div className="mb-5 flex flex-wrap items-center gap-3">
            <div className="relative min-w-0 flex-1">
              <input
                value={search}
                onChange={(e) => {
                  setSearch(e.target.value);
                  setPage(1);
                }}
                placeholder="Cari game berdasarkan nama..."
                className="h-10 w-full rounded-lg border border-hairline bg-field px-3.5 text-[14px] text-white placeholder-muted-deep outline-none focus:border-brand"
              />
            </div>
          </div>

          {games.error ? (
            <ErrorState message={games.error} onRetry={games.refetch} />
          ) : games.loading && !result ? (
            <CardGridSkeleton count={PER_PAGE} />
          ) : result && result.data.length === 0 ? (
            <EmptyState
              title="Game tidak ditemukan"
              description="Coba ubah kata kunci, kurangi filter, atau perluas rentang harga."
            />
          ) : result ? (
            <>
              <GameGrid games={result.data} priorityCount={3} />
              <Pagination current={meta?.current_page ?? 1} lastPage={meta?.last_page ?? 1} onChange={setPage} />
            </>
          ) : null}
        </div>
      </div>
    </div>
  );
}
