"use client";

import Link from "next/link";
import { useEffect } from "react";

export default function GlobalError({
  error,
  reset,
}: {
  error: Error & { digest?: string };
  reset: () => void;
}) {
  useEffect(() => {
    console.error("GameHub page error:", error);
  }, [error]);

  return (
    <div className="mx-auto flex w-full max-w-[1400px] flex-col items-center justify-center px-4 py-28 text-center sm:px-6">
      <h1 className="text-[22px] font-semibold text-white">Terjadi kesalahan</h1>
      <p className="mt-2 max-w-md text-[14px] text-muted">
        Kami tidak dapat memuat halaman ini. Periksa koneksi ke server Game Hub lalu coba lagi.
      </p>
      <div className="mt-7 flex flex-wrap items-center justify-center gap-3">
        <button
          onClick={reset}
          className="rounded-lg bg-brand px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:bg-brand-bright"
        >
          Coba lagi
        </button>
        <Link href="/" className="rounded-lg border border-hairline px-5 py-2.5 text-[14px] font-medium text-white transition-colors hover:border-brand">
          Kembali ke Beranda
        </Link>
      </div>
    </div>
  );
}
