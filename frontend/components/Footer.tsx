"use client";

import { useEffect, useState } from "react";

export function Footer() {
  return (
    <footer className="mt-16 border-t border-hairline/50 bg-deep/60">
      <div className="mx-auto w-full max-w-[1400px] px-4 py-10 text-center sm:px-6">
        <p className="mx-auto max-w-4xl text-[12.5px] leading-relaxed text-muted-deep">
          Game Hub adalah direktori &amp; tracker diskon game non-komersial. Kami bukan reseller dan tidak
          menjual game — kami hanya menampilkan informasi harga referensi dan mengarahkan pengguna ke
          platform resmi untuk pembelian.
        </p>
        <p className="mx-auto mt-3 max-w-4xl text-[12.5px] leading-relaxed text-muted-deep">
          Game Hub tidak berafiliasi dengan Steam/Valve, Epic Games, GOG, atau publisher terkait. Harga
          bersifat referensi; harga final &amp; proses pembayaran mengacu ke platform resmi saat checkout.
        </p>
        <p className="mt-6 text-[11.5px] text-muted-deep/70">
          © <CopyrightYear /> Game Hub — Tracker Diskon Multi-Platform
        </p>
      </div>
    </footer>
  );
}

/**
 * Rendered on the client: reading the current year during prerendering is an
 * unstable value that Cache Components rejects.
 */
function CopyrightYear() {
  const [year, setYear] = useState<number | null>(null);

  useEffect(() => {
    setYear(new Date().getFullYear());
  }, []);

  return <>{year ?? 2026}</>;
}
