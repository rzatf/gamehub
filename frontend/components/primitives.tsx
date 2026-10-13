import { formatIDR, formatIDRSpaced, formatRating } from "@/lib/format";
import { StarIcon } from "./icons";

export function DiscountBadge({ percent, className = "" }: { percent: number; className?: string }) {
  if (!percent || percent <= 0) return null;
  return (
    <span
      className={`inline-flex items-center rounded bg-danger px-1.5 py-0.5 text-[11px] font-bold leading-none text-white ${className}`}
    >
      {percent}%
    </span>
  );
}

export function Rating({ value, count, className = "" }: { value: number; count?: number; className?: string }) {
  return (
    <span className={`inline-flex items-center gap-1 text-[12.5px] text-white/90 ${className}`}>
      <StarIcon className="h-3.5 w-3.5 text-gold" />
      <span className="font-medium">{formatRating(value)}</span>
      {count ? <span className="text-muted-deep">({count.toLocaleString("id-ID")})</span> : null}
    </span>
  );
}

export function GenrePill({ label }: { label: string }) {
  return (
    <span className="inline-flex items-center rounded bg-muted-deep/60 px-1.5 py-0.5 text-[11px] leading-tight text-muted">
      {label}
    </span>
  );
}

/** Card price block: struck-through normal price + lime final price. */
export function PriceTag({
  normal,
  final,
  discount,
  size = "md",
}: {
  normal: number | null;
  final: number | null;
  discount?: number;
  size?: "sm" | "md" | "lg";
}) {
  const normalCls =
    size === "lg" ? "text-[15px]" : size === "sm" ? "text-[11.5px]" : "text-[12.5px]";
  const finalCls =
    size === "lg" ? "text-[26px]" : size === "sm" ? "text-[15px]" : "text-[18px]";

  return (
    <div className="flex items-baseline gap-2">
      <span className={`${normalCls} text-[#474747] line-through`}>{formatIDR(normal)}</span>
      <span className={`${finalCls} font-bold text-lime`}>{formatIDR(final)}</span>
      {discount ? <DiscountBadge percent={discount} className="translate-y-[-1px]" /> : null}
    </div>
  );
}

/** Detail-page variant, matching the "Rp 268.256" spacing in the design. */
export function PriceTagSpaced({ normal, final }: { normal: number; final: number }) {
  return (
    <div className="text-right leading-tight">
      <div className="text-[13px] text-[#474747] line-through">{formatIDRSpaced(normal)}</div>
      <div className="text-[19px] font-bold text-lime">{formatIDRSpaced(final)}</div>
    </div>
  );
}
