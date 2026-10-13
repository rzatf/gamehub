"use client";

import Image from "next/image";
import Link from "next/link";
import { useParams } from "next/navigation";
import { useState } from "react";
import type { GameDetail } from "@/lib/types";
import { useApi } from "@/lib/useApi";
import { useFavorites } from "@/lib/favorites";
import { formatDateID, formatIDR } from "@/lib/format";
import { BackButton } from "@/components/BackButton";
import { PlatformPriceList } from "@/components/PlatformPriceList";
import { SystemRequirements } from "@/components/SystemRequirements";
import { PriceChart } from "@/components/PriceChart";
import { DiscountBadge, GenrePill, Rating } from "@/components/primitives";
import { HeartIcon, ExternalIcon } from "@/components/icons";
import { ErrorState } from "@/components/skeletons";

/** Game detail: hero art, per-platform prices, about, specs and price history. */
export function GameDetailView() {
  const params = useParams<{ slug: string }>();
  const slug = params?.slug;
  const detail = useApi<{ data: GameDetail }>(slug ? `/api/games/${slug}` : "");
  const { isFavorite, toggle, ready } = useFavorites();
  const [activeImage, setActiveImage] = useState<string | null>(null);

  const game = detail.data?.data;

  if (detail.loading && !game) {
    return (
      <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
        <div className="skeleton h-9 w-32 rounded-lg" />
        <div className="skeleton mt-6 h-9 w-2/3 rounded" />
        <div className="mt-8 grid gap-8 lg:grid-cols-[1fr_420px]">
          <div className="skeleton aspect-video w-full rounded-xl" />
          <div className="skeleton h-[260px] w-full rounded-xl" />
        </div>
        <div className="skeleton mt-10 h-40 w-full rounded-xl" />
      </div>
    );
  }

  if (detail.status === 404 || (!detail.loading && !game && !detail.error)) {
    return (
      <div className="mx-auto flex w-full max-w-[1400px] flex-col items-center justify-center px-4 py-24 text-center sm:px-6">
        <h1 className="text-[24px] font-bold text-white">Game tidak ditemukan</h1>
        <p className="mt-2 max-w-md text-[14px] text-muted">
          Game yang kamu cari tidak ada di katalog Game Hub.
        </p>
        <Link
          href="/katalog"
          className="mt-6 rounded-lg bg-brand px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:bg-brand-bright"
        >
          Kembali ke Katalog
        </Link>
      </div>
    );
  }

  if (detail.error) {
    return (
      <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
        <ErrorState message={detail.error} onRetry={detail.refetch} />
      </div>
    );
  }

  if (!game) return null;

  const liked = ready && isFavorite(game.slug);
  const heroImage = game.hero_image ?? game.cover_image;
  const gallery = [heroImage, ...(game.screenshots ?? [])].filter(Boolean) as string[];
  const shownImage = activeImage ?? heroImage;

  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-8 sm:px-6">
      <BackButton />

      <div className="mt-6 flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1 className="text-[26px] font-extrabold leading-tight tracking-tight text-white sm:text-[36px]">
            {game.title}
          </h1>
          <div className="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-[13.5px] text-muted">
            <Rating value={game.rating} count={game.rating_count} />
            <span>{formatDateID(game.release_date)}</span>
            {game.developer ? <span>{game.developer}</span> : null}
            {game.publisher && game.publisher !== game.developer ? <span>{game.publisher}</span> : null}
          </div>
          <div className="mt-3 flex flex-wrap gap-1.5">
            {game.genres.map((genre) => (
              <GenrePill key={genre} label={genre} />
            ))}
          </div>
        </div>

        <div className="flex items-center gap-3">
          {game.steam_url ? (
            <a
              href={game.steam_url}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-1.5 rounded-lg border border-hairline px-3.5 py-2 text-[13.5px] text-muted transition-colors hover:border-brand hover:text-white"
            >
              Lihat di Steam
              <ExternalIcon className="h-3.5 w-3.5" />
            </a>
          ) : null}
          <button
            type="button"
            onClick={() => toggle(game.slug)}
            aria-pressed={liked}
            className={`inline-flex items-center gap-2 rounded-lg border px-3.5 py-2 text-[13.5px] transition-colors ${
              liked ? "border-lime/60 text-lime" : "border-hairline text-muted hover:border-brand hover:text-white"
            }`}
          >
            <HeartIcon filled={liked} className="h-4 w-4" />
            {liked ? "Tersimpan" : "Favoritkan"}
          </button>
        </div>
      </div>

      <div className="mt-7 grid gap-8 lg:grid-cols-[1fr_420px]">
        <div>
          <div className="relative aspect-video w-full overflow-hidden rounded-xl border border-hairline/60 bg-deep">
            <Image
              src={shownImage}
              alt={`Pratinjau ${game.title}`}
              fill
              priority
              sizes="(max-width: 1024px) 100vw, 66vw"
              className="object-cover"
            />
            <span className="absolute inset-0 bg-gradient-to-t from-abyss/70 via-transparent to-transparent" />
            <div className="absolute bottom-4 left-4 flex items-center gap-2">
              {game.best_platform ? (
                <span className="rounded bg-abyss/85 px-2 py-1 text-[11.5px] font-medium text-lime backdrop-blur-sm">
                  Termurah di {game.best_platform.name}
                </span>
              ) : null}
              <DiscountBadge percent={game.discount_percent} />
            </div>
          </div>

          <div className="mt-4 flex flex-wrap items-baseline gap-3">
            <span className="text-[13px] text-muted">Harga terbaik saat ini</span>
            <span className="text-[24px] font-bold text-lime">{formatIDR(game.final_price)}</span>
            {game.normal_price && game.normal_price > (game.final_price ?? 0) ? (
              <span className="text-[14px] text-[#6b7076] line-through">{formatIDR(game.normal_price)}</span>
            ) : null}
          </div>

          {gallery.length > 1 ? (
            <div className="mt-4">
              <h2 className="mb-2.5 text-[13.5px] font-medium text-muted">Screenshot</h2>
              <div className="grid grid-cols-4 gap-3">
                {gallery.map((src, index) => (
                  <button
                    key={src}
                    type="button"
                    onClick={() => setActiveImage(index === 0 ? null : src)}
                    aria-label={`Tampilkan gambar ${index + 1} dari ${gallery.length}`}
                    aria-pressed={shownImage === src}
                    className={`relative aspect-video overflow-hidden rounded-lg border transition-colors ${
                      shownImage === src ? "border-brand" : "border-hairline/60 hover:border-brand/60"
                    }`}
                  >
                    <Image
                      src={src}
                      alt={`Screenshot ${game.title} ${index + 1}`}
                      fill
                      sizes="(max-width: 1024px) 25vw, 16vw"
                      className="object-cover"
                    />
                  </button>
                ))}
              </div>
            </div>
          ) : null}
        </div>

        <PlatformPriceList prices={game.prices} />
      </div>

      <section className="mt-12">
        <h2 className="mb-4 text-[19px] font-semibold tracking-tight text-white">Tentang Game ini</h2>
        <p className="max-w-4xl text-[14px] leading-relaxed text-muted">
          {game.description?.trim() ? game.description : "Deskripsi game belum tersedia."}
        </p>
      </section>

      <SystemRequirements min={game.min_requirements} rec={game.rec_requirements} />

      <PriceChart labels={game.history.labels} dates={game.history.dates} series={game.history.series} />
    </div>
  );
}
