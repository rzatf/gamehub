import Link from "next/link";

export default function NotFound() {
  return (
    <div className="mx-auto flex w-full max-w-[1400px] flex-col items-center justify-center px-4 py-28 text-center sm:px-6">
      <p className="text-[64px] font-extrabold leading-none tracking-tight text-brand-bright">404</p>
      <h1 className="mt-4 text-[22px] font-semibold text-white">Halaman tidak ditemukan</h1>
      <p className="mt-2 max-w-md text-[14px] text-muted">
        Game atau halaman yang kamu cari tidak tersedia. Coba jelajahi katalog kami.
      </p>
      <div className="mt-7 flex flex-wrap items-center justify-center gap-3">
        <Link href="/katalog" className="rounded-lg bg-brand px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:bg-brand-bright">
          Jelajahi Game
        </Link>
        <Link href="/" className="rounded-lg border border-hairline px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:border-brand">
          Kembali ke Beranda
        </Link>
      </div>
    </div>
  );
}
