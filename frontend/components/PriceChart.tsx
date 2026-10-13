"use client";

import { useMemo, useState } from "react";
import type { HistorySeries } from "@/lib/types";
import { formatDateID, formatIDR } from "@/lib/format";

const W = 840;
const H = 340;
const PAD = { top: 18, right: 56, bottom: 40, left: 76 };
const PLOT_W = W - PAD.left - PAD.right;
const PLOT_H = H - PAD.top - PAD.bottom;

const SERIES_META = {
  normal: { label: "Harga Normal (Rp)", color: "#706ee6" },
  final: { label: "Harga Akhir (Rp)", color: "#54c4ad" },
  discount: { label: "Persentase Diskon (%)", color: "#ff9189" },
} as const;

function niceMax(value: number): number {
  if (value <= 0) return 1000;
  const magnitude = 10 ** Math.floor(Math.log10(value));
  for (const step of [1, 1.25, 1.5, 2, 2.5, 3, 4, 5, 6, 8, 10]) {
    const candidate = step * magnitude;
    if (candidate >= value) return candidate;
  }
  return 10 * magnitude;
}

/**
 * "Riwayat harga & diskon" — six-month multi-series chart:
 * normal price and final price on the left axis, discount % on the right.
 * Hovering reveals the month with the Rupiah values (PRD tooltip requirement).
 */
export function PriceChart({ labels, dates, series }: { labels: string[]; dates: (string | null)[]; series: HistorySeries[] }) {
  const [activeIndex, setActiveIndex] = useState(0);
  const [hover, setHover] = useState<number | null>(null);

  const active: HistorySeries | undefined = series[activeIndex];

  const maxPrice = useMemo(() => {
    const values = series.flatMap((s) => [...s.normal, ...s.final]).filter((v): v is number => typeof v === "number");
    return niceMax(values.length ? Math.max(...values) : 0);
  }, [series]);

  if (!active || active.final.filter((v) => v !== null).length === 0) {
    return (
      <section className="mt-12">
        <h2 className="mb-5 text-[19px] font-semibold tracking-tight text-white">Riwayat harga &amp; diskon</h2>
        <p className="rounded-xl border border-hairline/60 bg-surface/60 p-6 text-[13px] text-muted-deep">
          Riwayat harga belum tersedia.
        </p>
      </section>
    );
  }

  const n = active.final.length;
  const ticks = [0, maxPrice / 4, maxPrice / 2, (maxPrice * 3) / 4, maxPrice];

  const x = (index: number) => PAD.left + (n <= 1 ? PLOT_W / 2 : (index / (n - 1)) * PLOT_W);
  const yPrice = (value: number) => PAD.top + PLOT_H - (Math.max(0, value) / maxPrice) * PLOT_H;
  const yDiscount = (value: number) => PAD.top + PLOT_H - (Math.min(100, Math.max(0, value)) / 100) * PLOT_H;

  const path = (values: (number | null)[], yFn: (v: number) => number) =>
    values
      .map((value, index) => (typeof value === "number" ? `${x(index)},${yFn(value)}` : null))
      .filter(Boolean)
      .join(" ");

  return (
    <section className="mt-12">
      <div className="mb-5 flex flex-wrap items-center justify-between gap-3">
        <div className="flex flex-wrap items-center gap-3">
          <h2 className="text-[19px] font-semibold tracking-tight text-white">Riwayat harga &amp; diskon</h2>
          {active.is_lowest_6_months ? (
            <span className="rounded bg-lime/15 px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wide text-lime">
              Harga Terendah dalam 6 Bulan
            </span>
          ) : null}
        </div>

        <div className="flex items-center gap-1.5 rounded-lg border border-hairline/60 bg-deep p-1">
          {series.map((s, index) => (
            <button
              key={s.platform.slug ?? index}
              type="button"
              onClick={() => {
                setActiveIndex(index);
                setHover(null);
              }}
              className={`rounded-md px-3 py-1.5 text-[12.5px] transition-colors ${
                index === activeIndex ? "bg-brand text-white" : "text-muted hover:text-white"
              }`}
            >
              {s.platform.name}
            </button>
          ))}
        </div>
      </div>

      <div className="relative rounded-xl border border-hairline/60 bg-surface/40 p-4">
        <svg viewBox={`0 0 ${W} ${H}`} className="h-auto w-full" role="img" aria-label="Grafik riwayat harga enam bulan">
          {ticks.map((tick) => (
            <g key={tick}>
              <line
                x1={PAD.left}
                x2={PAD.left + PLOT_W}
                y1={yPrice(tick)}
                y2={yPrice(tick)}
                stroke="#0e2a45"
                strokeWidth="1"
                strokeDasharray="3 5"
              />
              <text x={PAD.left - 10} y={yPrice(tick) + 4} textAnchor="end" fontSize="11.5" fill="#b8bfc6">
                {Math.round(tick).toLocaleString("id-ID")}
              </text>
            </g>
          ))}

          {[0, 25, 50, 75, 100].map((tick) => (
            <text key={tick} x={PAD.left + PLOT_W + 10} y={yDiscount(tick) + 4} fontSize="11.5" fill="#334c5f">
              {tick}%
            </text>
          ))}

          <polyline points={path(active.normal, yPrice)} fill="none" stroke={SERIES_META.normal.color} strokeWidth="2.5" strokeLinecap="round" />
          <polyline points={path(active.final, yPrice)} fill="none" stroke={SERIES_META.final.color} strokeWidth="2.5" strokeLinecap="round" />
          <polyline
            points={path(active.discount, yDiscount)}
            fill="none"
            stroke={SERIES_META.discount.color}
            strokeWidth="2"
            strokeDasharray="5 4"
            strokeLinecap="round"
          />

          {active.normal.map((value, index) =>
            typeof value === "number" ? (
              <circle key={`n-${index}`} cx={x(index)} cy={yPrice(value)} r="3" fill={SERIES_META.normal.color} />
            ) : null,
          )}
          {active.final.map((value, index) =>
            typeof value === "number" ? (
              <circle key={`f-${index}`} cx={x(index)} cy={yPrice(value)} r="3.5" fill={SERIES_META.final.color} />
            ) : null,
          )}

          {hover !== null ? (
            <line x1={x(hover)} x2={x(hover)} y1={PAD.top} y2={PAD.top + PLOT_H} stroke="#0094ff" strokeWidth="1" strokeDasharray="3 3" />
          ) : null}

          {Array.from({ length: n }).map((_, index) => (
            <text key={`x-${index}`} x={x(index)} y={H - 14} textAnchor="middle" fontSize="12" fill="#b8bfc6">
              {labels[index] ?? ""}
            </text>
          ))}

          <rect
            x={PAD.left}
            y={PAD.top}
            width={PLOT_W}
            height={PLOT_H}
            fill="transparent"
            onMouseMove={(event) => {
              const rect = (event.currentTarget as SVGRectElement).getBoundingClientRect();
              const relative = (event.clientX - rect.left) / rect.width;
              const index = Math.round(relative * (n - 1));
              setHover(Math.min(n - 1, Math.max(0, index)));
            }}
            onMouseLeave={() => setHover(null)}
          />
        </svg>

        <div className="mt-3 flex flex-wrap items-center justify-center gap-5">
          {Object.values(SERIES_META).map((meta) => (
            <span key={meta.label} className="inline-flex items-center gap-2 text-[12.5px] text-muted">
              <span className="h-2.5 w-2.5 rounded-full" style={{ background: meta.color }} />
              {meta.label}
            </span>
          ))}
        </div>

        {hover !== null ? (
          <div
            className="pointer-events-none absolute top-6 z-10 min-w-[170px] rounded-lg border border-hairline bg-abyss/95 p-3 text-[12px] shadow-2xl"
            style={{
              left: `${(x(hover) / W) * 100}%`,
              transform: `translateX(${hover > n / 2 ? "-104%" : "4%"})`,
            }}
          >
            <p className="mb-1.5 font-semibold text-white">{active.platform.name}</p>
            <p className="mb-1 text-muted-deep">
              {dates[hover] ? formatDateID(dates[hover]) : labels[hover] ?? `Bulan ${hover + 1}`}
            </p>
            <p className="flex justify-between gap-4 text-muted">
              <span>Harga Normal</span>
              <span className="text-white">{formatIDR(active.normal[hover] ?? null)}</span>
            </p>
            <p className="flex justify-between gap-4 text-muted">
              <span>Harga Akhir</span>
              <span className="text-lime">{formatIDR(active.final[hover] ?? null)}</span>
            </p>
            <p className="flex justify-between gap-4 text-muted">
              <span>Diskon</span>
              <span className="text-white">{active.discount[hover] ?? 0}%</span>
            </p>
          </div>
        ) : null}
      </div>

      <p className="mt-3 text-center text-[12px] text-muted-deep">
        Harga minimum 6 bulan terakhir pada {active.platform.name}: {formatIDR(active.min_6_months)}
      </p>
    </section>
  );
}
