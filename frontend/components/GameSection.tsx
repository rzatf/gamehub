"use client";

import Image from "next/image";
import Link from "next/link";
import { useRef } from "react";
import type { Game, SaleEvent } from "@/lib/types";
import { GameCard } from "./GameCard";
import { ChevronIcon } from "./icons";

/** A store carousel section ("Steam", "Epic Games Store") with arrow controls. */
export function GameSection({
  title,
  games,
  moreHref,
  moreLabel = "More...",
}: {
  title: string;
  games: Game[];
  moreHref?: string;
  moreLabel?: string;
}) {
  const scroller = useRef<HTMLDivElement>(null);

  function scrollBy(direction: 1 | -1) {
    const el = scroller.current;
    if (!el) return;
    el.scrollBy({ left: direction * Math.max(280, el.clientWidth * 0.8), behavior: "smooth" });
  }

  if (games.length === 0) return null;

  return (
    <section className="mb-12">
      <div className="mb-5 flex items-center justify-between gap-4">
        <h2 className="text-[19px] font-semibold tracking-tight text-white sm:text-[21px]">{title}</h2>
        <div className="flex items-center gap-3">
          {moreHref ? (
            <Link href={moreHref} className="text-[13.5px] text-muted transition-colors hover:text-brand-bright">
              {moreLabel}
            </Link>
          ) : null}
          <div className="hidden items-center gap-1.5 sm:flex">
            <button
              type="button"
              onClick={() => scrollBy(-1)}
              aria-label="Geser ke kiri"
              className="rounded-full border border-hairline p-1.5 text-muted transition-colors hover:border-brand hover:text-white"
            >
              <ChevronIcon dir="left" className="h-4 w-4" />
            </button>
            <button
              type="button"
              onClick={() => scrollBy(1)}
              aria-label="Geser ke kanan"
              className="rounded-full border border-hairline p-1.5 text-muted transition-colors hover:border-brand hover:text-white"
            >
              <ChevronIcon dir="right" className="h-4 w-4" />
            </button>
          </div>
        </div>
      </div>

      <div ref={scroller} className="no-scrollbar -mx-1 flex snap-x snap-mandatory gap-5 overflow-x-auto px-1 pb-1">
        {games.map((game, index) => (
          <div key={game.slug} className="w-[280px] shrink-0 snap-start sm:w-[300px]">
            <GameCard game={game} priority={index < 2} />
          </div>
        ))}
      </div>
    </section>
  );
}

/** Wide, clickable sale banner (design: "Banner ketika di klik diarahkan ke halaman sale"). */
export function SaleEventBanner({ event }: { event: SaleEvent }) {
  return (
    <a
      href={event.url}
      target="_blank"
      rel="noopener noreferrer"
      className="group relative mb-12 block overflow-hidden rounded-2xl border border-hairline/60"
    >
      <div className="relative h-[220px] w-full sm:h-[300px]">
        {event.image ? (
          <Image src={event.image} alt={event.title} fill sizes="100vw" className="object-cover object-center opacity-70 transition-transform duration-500 group-hover:scale-105" />
        ) : (
          <div className="h-full w-full bg-gradient-to-r from-brand/40 to-abyss" />
        )}
        <div className="absolute inset-0 bg-gradient-to-r from-abyss via-abyss/80 to-transparent" />

        <div className="absolute inset-0 flex flex-col justify-center gap-2 p-6 sm:p-10">
          {event.subtitle ? (
            <span className="w-fit rounded bg-lime px-2 py-0.5 text-[11px] font-bold uppercase tracking-wide text-abyss">
              {event.subtitle}
            </span>
          ) : null}
          <h3 className="max-w-lg text-[26px] font-extrabold leading-tight tracking-tight text-white sm:text-[38px]">
            {event.title}
          </h3>
          {event.badge ? <p className="text-[14px] text-muted sm:text-[16px]">{event.badge}</p> : null}
          <span className="mt-2 w-fit rounded-lg bg-brand px-4 py-2 text-[13.5px] font-medium text-white transition-colors group-hover:bg-brand-bright">
            Lihat penawaran di {event.platform ?? "toko"}
          </span>
        </div>
      </div>
    </a>
  );
}
