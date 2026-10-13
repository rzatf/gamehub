"use client";

import { useEffect, useState } from "react";
import type { Game, Paginated } from "@/lib/types";
import { useApi } from "@/lib/useApi";
import { GameGrid } from "@/components/GameCard";
import { CardGridSkeleton, EmptyState, ErrorState } from "@/components/skeletons";

/** Search results page: "Ditemukan N hasil untuk "<query>"". */
export function SearchView() {
  const [term, setTerm] = useState<string | null>(null);

  useEffect(() => {
    const q = new URLSearchParams(window.location.search).get("q") ?? "";
    setTerm(q.trim());
  }, []);

  const results = useApi<Paginated<Game>>(term ? "/api/games" : "", {
    search: term ?? undefined,
    per_page: 12,
  });

  const total = results.data?.meta.total ?? 0;

  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
      <h1 className="text-[26px] font-extrabold tracking-tight text-white sm:text-[30px]">Hasil Pencarian</h1>

      {term === null ? null : (
        <p className="mt-2 text-[14px] text-muted">
          {term
            ? `Ditemukan ${total} hasil untuk “${term}”`
            : "Masukkan kata kunci untuk mencari game."}
        </p>
      )}

      <div className="mt-8">
        {results.error ? (
          <ErrorState message={results.error} onRetry={results.refetch} />
        ) : results.loading && !results.data ? (
          <CardGridSkeleton count={3} />
        ) : results.data && results.data.data.length === 0 ? (
          <EmptyState
            title="Game tidak ditemukan"
            description={term ? `Tidak ada game yang cocok dengan “${term}”.` : "Coba kata kunci lain."}
          />
        ) : results.data ? (
          <GameGrid games={results.data.data} priorityCount={3} />
        ) : null}
      </div>
    </div>
  );
}
