import type { RequirementRow } from "@/lib/types";

function ReqList({ rows }: { rows: RequirementRow[] }) {
  if (!rows || rows.length === 0) {
    return <p className="text-[13px] text-muted-deep">Data persyaratan belum tersedia.</p>;
  }

  return (
    <ul className="space-y-1.5">
      {rows.map((row, index) => (
        <li key={`${row.label}-${index}`} className="text-[13.5px] leading-relaxed text-muted">
          {row.label ? <span className="text-white/80">{row.label}: </span> : null}
          {row.value}
        </li>
      ))}
    </ul>
  );
}

/** Minimum / Recommended system requirements, side by side as in the design. */
export function SystemRequirements({ min, rec }: { min: RequirementRow[]; rec: RequirementRow[] }) {
  return (
    <section className="mt-10">
      <h2 className="mb-5 text-[19px] font-semibold tracking-tight text-white">Persyaratan Sistem</h2>
      <div className="grid gap-8 rounded-xl border border-hairline/60 bg-surface/60 p-6 sm:grid-cols-2">
        <div>
          <h3 className="mb-3 text-[14.5px] font-semibold text-white">Minimum:</h3>
          <ReqList rows={min} />
        </div>
        <div>
          <h3 className="mb-3 text-[14.5px] font-semibold text-white">Direkomendasikan:</h3>
          <ReqList rows={rec} />
        </div>
      </div>
    </section>
  );
}
