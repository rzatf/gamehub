import { DiscountBadge } from "./primitives";

export function CardSkeleton() {
  return (
    <div className="overflow-hidden rounded-xl border border-hairline/60 bg-surface">
      <div className="skeleton aspect-[16/10] w-full" />
      <div className="space-y-3 p-4">
        <div className="skeleton h-4 w-3/4 rounded" />
        <div className="skeleton h-4 w-1/2 rounded" />
        <div className="skeleton h-3 w-1/3 rounded" />
      </div>
    </div>
  );
}

export function CardGridSkeleton({ count = 9 }: { count?: number }) {
  return (
    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      {Array.from({ length: count }).map((_, i) => (
        <CardSkeleton key={i} />
      ))}
    </div>
  );
}

export function CarouselSkeleton({ count = 4 }: { count?: number }) {
  return (
    <div className="flex gap-5 overflow-hidden">
      {Array.from({ length: count }).map((_, i) => (
        <div key={i} className="w-[280px] shrink-0">
          <CardSkeleton />
        </div>
      ))}
    </div>
  );
}

export function EmptyState({
  title,
  description,
  action,
}: {
  title: string;
  description?: string;
  action?: React.ReactNode;
}) {
  return (
    <div className="flex flex-col items-center justify-center rounded-xl border border-dashed border-hairline bg-surface/40 px-6 py-16 text-center">
      <div className="mb-4 text-muted-deep">
        <svg className="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" aria-hidden="true">
          <circle cx="11" cy="11" r="7" />
          <path d="m20 20-3.5-3.5" strokeLinecap="round" />
        </svg>
      </div>
      <p className="text-[16px] font-semibold text-white">{title}</p>
      {description ? <p className="mt-1.5 max-w-md text-[13px] text-muted">{description}</p> : null}
      {action ? <div className="mt-5">{action}</div> : null}
    </div>
  );
}

export function ErrorState({ message, onRetry }: { message: string; onRetry?: () => void }) {
  return (
    <div
      role="alert"
      className="flex flex-col items-start gap-3 rounded-xl border border-danger/40 bg-danger/10 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"
    >
      <div className="flex items-start gap-3">
        <span className="mt-0.5 text-danger">
          <svg className="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" aria-hidden="true">
            <circle cx="12" cy="12" r="9" />
            <path d="M12 8v4.5M12 16h.01" strokeLinecap="round" />
          </svg>
        </span>
        <p className="text-[13.5px] text-white">{message}</p>
      </div>
      {onRetry ? (
        <button
          onClick={onRetry}
          className="shrink-0 rounded-lg border border-hairline px-3.5 py-1.5 text-[13px] text-white transition-colors hover:border-brand hover:text-brand-bright"
        >
          Coba lagi
        </button>
      ) : null}
    </div>
  );
}

export function SectionHeading({
  title,
  action,
  actionHref,
}: {
  title: string;
  action?: string;
  actionHref?: string;
}) {
  return (
    <div className="mb-5 flex items-end justify-between gap-4">
      <h2 className="text-[19px] font-semibold tracking-tight text-white sm:text-[21px]">{title}</h2>
      {action && actionHref ? (
        <a
          href={actionHref}
          className="shrink-0 text-[13.5px] text-muted transition-colors hover:text-brand-bright"
        >
          {action}
        </a>
      ) : null}
    </div>
  );
}

export { DiscountBadge };
