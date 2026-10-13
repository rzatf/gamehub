"use client";

import type { PlatformOffer } from "@/lib/types";
import { formatIDRSpaced } from "@/lib/format";
import { DiscountBadge } from "./primitives";
import { ExternalIcon } from "./icons";

/**
 * "Harga per platform" panel: every store side by side with its normal price,
 * discount price and discount badge. The cheapest offer is flagged, per the
 * PRD's "platform dengan harga termurah ditandai secara visual".
 */
export function PlatformPriceList({ prices }: { prices: PlatformOffer[] }) {
  return (
    <div className="rounded-xl border border-hairline/60 bg-panel p-5">
      <h2 className="mb-4 text-[16px] font-semibold text-white">Harga per platform</h2>

      <div className="divide-y divide-hairline/60">
        {prices.map((price) => (
          <div key={price.slug ?? price.name} className="flex items-center justify-between gap-4 py-3.5">
            <div className="min-w-0">
              <div className="flex items-center gap-2">
                <span
                  className="h-2.5 w-2.5 shrink-0 rounded-full"
                  style={{ background: price.color ?? "#B8BFC6" }}
                  aria-hidden="true"
                />
                <span className="truncate text-[14.5px] font-medium text-white">{price.name}</span>
                {price.is_lowest ? (
                  <span className="shrink-0 rounded bg-lime/15 px-1.5 py-0.5 text-[10.5px] font-semibold uppercase tracking-wide text-lime">
                    Termurah
                  </span>
                ) : null}
              </div>
              {price.url ? (
                <a
                  href={price.url}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="mt-1 inline-flex items-center gap-1 text-[12px] text-brand-bright transition-colors hover:text-white"
                >
                  Buka di {price.name}
                  <ExternalIcon className="h-3 w-3" />
                </a>
              ) : null}
            </div>

            <div className="flex items-center gap-3">
              <div className="text-right leading-tight">
                <div className="text-[12.5px] text-[#6b7076] line-through">
                  {formatIDRSpaced(price.normal_price)}
                </div>
                <div className="text-[18px] font-bold text-lime">{formatIDRSpaced(price.final_price)}</div>
              </div>
              <DiscountBadge percent={price.discount_percent} className="shrink-0" />
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
