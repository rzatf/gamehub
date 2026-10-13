"use client";

/** Numbered pagination with ellipses, mirroring the design's "1 2 3 4 5 ...". */
export function Pagination({
  current,
  lastPage,
  onChange,
}: {
  current: number;
  lastPage: number;
  onChange: (page: number) => void;
}) {
  if (lastPage <= 1) return null;

  const pages: (number | "gap")[] = [];
  const push = (page: number | "gap") => {
    if (!pages.includes(page)) pages.push(page);
  };

  push(1);
  if (current > 3) push("gap");
  for (let p = Math.max(2, current - 1); p <= Math.min(lastPage - 1, current + 1); p++) push(p);
  if (current < lastPage - 2) push("gap");
  if (lastPage > 1) push(lastPage);

  const btn =
    "flex h-9 min-w-9 items-center justify-center rounded-lg border px-3 text-[13px] transition-colors";

  return (
    <nav className="mt-10 flex items-center justify-center gap-2" aria-label="Navigasi halaman">
      <button
        type="button"
        onClick={() => onChange(current - 1)}
        disabled={current <= 1}
        className={`${btn} border-hairline text-muted enabled:hover:border-brand enabled:hover:text-white disabled:opacity-40`}
        aria-label="Halaman sebelumnya"
      >
        ‹
      </button>

      {pages.map((page, index) =>
        page === "gap" ? (
          <span key={`gap-${index}`} className="px-1 text-muted-deep">
            ...
          </span>
        ) : (
          <button
            key={page}
            type="button"
            onClick={() => onChange(page)}
            aria-current={page === current ? "page" : undefined}
            className={`${btn} ${
              page === current
                ? "border-brand bg-brand text-white"
                : "border-hairline text-muted hover:border-brand hover:text-white"
            }`}
          >
            {page}
          </button>
        ),
      )}

      <button
        type="button"
        onClick={() => onChange(current + 1)}
        disabled={current >= lastPage}
        className={`${btn} border-hairline text-muted enabled:hover:border-brand enabled:hover:text-white disabled:opacity-40`}
        aria-label="Halaman berikutnya"
      >
        ›
      </button>
    </nav>
  );
}
