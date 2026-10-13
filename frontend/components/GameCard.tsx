"use client";

import Image from "next/image";
import Link from "next/link";
import type { Game } from "@/lib/types";
import { useFavorites } from "@/lib/favorites";
import { GenrePill, PriceTag, Rating } from "./primitives";
import { HeartIcon } from "./icons";

/**
 * Catalogue card: cover art, title, deal price, rating and genre tags —
 * the repeating unit of every grid and carousel in the design.
 */
export function GameCard({ game, priority = false }: { game: Game; priority?: boolean }) {
  const { isFavorite, toggle } = useFavorites();
  const liked = isFavorite(game.slug);

  return (
    <article className="group relative flex h-full flex-col overflow-hidden rounded-xl border border-hairline/60 bg-surface transition-colors hover:border-brand/70">
      <Link href={`/game/${game.slug}`} className="relative block aspect-[16/10] overflow-hidden bg-deep">
        <Image
          src={game.cover_image}
          alt={`Sampul ${game.title}`}
          fill
          priority={priority}
          sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
          className="object-cover transition-transform duration-300 group-hover:scale-[1.04]"
        />
        <span className="absolute inset-0 bg-gradient-to-t from-abyss/80 via-transparent to-transparent" />
        {game.discount_percent > 0 && (
          <span className="absolute bottom-2.5 left-2.5 inline-flex items-center rounded bg-danger px-1.5 py-0.5 text-[11px] font-bold leading-none text-white">
            {game.discount_percent}%
          </span>
        )}
      </Link>

      <button
        type="button"
        onClick={() => toggle(game.slug)}
        aria-label={liked ? `Hapus ${game.title} dari favorit` : `Simpan ${game.title} ke favorit`}
        aria-pressed={liked}
        className={`absolute right-2.5 top-2.5 z-10 rounded-full border p-1.5 backdrop-blur-sm transition-colors ${
          liked
            ? "border-lime/60 bg-abyss/70 text-lime"
            : "border-hairline/70 bg-abyss/60 text-muted hover:text-white"
        }`}
      >
        <HeartIcon filled={liked} className="h-4 w-4" />
      </button>

      <div className="flex flex-1 flex-col gap-2.5 p-4">
        <Link href={`/game/${game.slug}`} className="block">
          <h3 className="line-clamp-2 min-h-[2.6em] text-[15px] font-semibold leading-snug text-white transition-colors group-hover:text-brand-bright">
            {game.title}
          </h3>
        </Link>

        <PriceTag normal={game.normal_price} final={game.final_price} discount={game.discount_percent} />

        <Rating value={game.rating} count={game.rating_count} />

        <div className="mt-auto flex flex-wrap items-center gap-1.5 pt-0.5">
          {game.best_platform ? (
            <span
              className="inline-flex items-center gap-1.5 rounded-full border border-hairline/70 bg-deep px-2 py-[3px] text-[11px] text-white"
              title={`Harga termurah di ${game.best_platform.name}`}
            >
              <span
                className="h-1.5 w-1.5 rounded-full"
                style={{ background: game.best_platform.color ?? "#b8bfc6" }}
                aria-hidden="true"
              />
              {game.best_platform.name}
            </span>
          ) : null}
          {game.genres.slice(0, 2).map((genre) => (
            <GenrePill key={genre} label={genre} />
          ))}
        </div>
      </div>
    </article>
  );
}

export function GameGrid({ games, priorityCount = 0 }: { games: Game[]; priorityCount?: number }) {
  return (
    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      {games.map((game, index) => (
        <div key={game.slug} className="animate-fade-up" style={{ animationDelay: `${Math.min(index, 8) * 35}ms` }}>
          <GameCard game={game} priority={index < priorityCount} />
        </div>
      ))}
    </div>
  );
}
