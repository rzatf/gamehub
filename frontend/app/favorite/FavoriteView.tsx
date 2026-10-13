"use client";

import Link from "next/link";
import type { Game, Paginated } from "@/lib/types";
import { useApi } from "@/lib/useApi";
import { useFavorites } from "@/lib/favorites";
import { GameGrid } from "@/components/GameCard";
import { CardGridSkeleton, EmptyState, ErrorState } from "@/components/skeletons";

/** Wishlist page: "Favorit Saya (N)" backed by localStorage slugs. */
export function FavoriteView() {
  const { favorites, ready, clear } = useFavorites();

  const games = useApi<Paginated<Game>>(ready && favorites.length > 0 ? "/api/games" : "", {
    slugs: favorites,
    per_page: 48,
  });

  const list = games.data?.data ?? [];

  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
      <header className="mb-8 flex flex-wrap items-center justify-between gap-4">
        <h1 className="text-[26px] font-extrabold tracking-tight text-white sm:text-[30px]">
          Favorit Saya ({ready ? favorites.length : 0})
        </h1>
        {ready && favorites.length > 0 ? (
          <button
            type="button"
            onClick={clear}
            className="rounded-lg border border-hairline px-4 py-2 text-[13.5px] text-muted transition-colors hover:border-danger hover:text-danger"
          >
            Hapus semua
          </button>
        ) : null}
      </header>

      {!ready ? (
        <CardGridSkeleton count={3} />
      ) : favorites.length === 0 ? (
        <EmptyState
          title="Belum ada game favorit"
          description="Simpan game dengan menekan ikon hati pada kartu game untuk memantau harganya di sini."
          action={
            <Link
              href="/katalog"
              className="rounded-lg bg-brand px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:bg-brand-bright"
            >
              Jelajahi Game
            </Link>
          }
        />
      ) : games.error ? (
        <ErrorState message={games.error} onRetry={games.refetch} />
      ) : games.loading && !games.data ? (
        <CardGridSkeleton count={favorites.length} />
      ) : list.length === 0 ? (
        <EmptyState title="Game favorit tidak ditemukan" description="Game mungkin sudah tidak ada di katalog." />
      ) : (
        <GameGrid games={list} priorityCount={3} />
      )}
    </div>
  );
}
