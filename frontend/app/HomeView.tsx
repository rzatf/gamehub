"use client";

import { HomeHero } from "@/components/HomeHero";
import { GameSection, SaleEventBanner } from "@/components/GameSection";
import { CarouselSkeleton, ErrorState } from "@/components/skeletons";
import { useApi } from "@/lib/useApi";
import type { HomePayload } from "@/lib/types";

/** Landing page: hero, sale-event banner and one carousel per store. */
export function HomeView() {
  const { data, error, loading, refetch } = useApi<HomePayload>("/api/home");

  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 sm:px-6">
      <HomeHero />

      {error ? (
        <div className="mb-10">
          <ErrorState message={error} onRetry={refetch} />
        </div>
      ) : null}

      {loading && !data ? (
        <div className="space-y-10">
          <div className="skeleton h-[220px] w-full rounded-2xl sm:h-[300px]" />
          <CarouselSkeleton />
          <CarouselSkeleton />
        </div>
      ) : null}

      {data ? (
        <>
          {data.sale_events.length > 0 ? (
            <section id="sale-events" className="mb-12">
              <h2 className="mb-5 text-[19px] font-semibold tracking-tight text-white sm:text-[21px]">
                Sale Events
              </h2>
              <div className="space-y-6">
                {data.sale_events.map((event) => (
                  <SaleEventBanner key={event.title} event={event} />
                ))}
              </div>
            </section>
          ) : null}

          {data.sections.map((section) => (
            <GameSection
              key={section.slug}
              title={section.title}
              games={section.games}
              moreHref={`/katalog?platform=${section.slug}`}
            />
          ))}

          {data.sections.length === 0 && data.sale_events.length === 0 ? (
            <p className="rounded-xl border border-dashed border-hairline bg-surface/40 px-6 py-16 text-center text-[14px] text-muted">
              Data game belum tersedia.
            </p>
          ) : null}
        </>
      ) : null}
    </div>
  );
}
