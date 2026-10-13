import Link from "next/link";

/** Landing hero: headline, supporting line and the two primary CTAs. */
export function HomeHero() {
  return (
    <section className="relative overflow-hidden pb-10 pt-12 sm:pb-14 sm:pt-20">
      {/* soft brand glow behind the headline */}
      <div
        aria-hidden="true"
        className="pointer-events-none absolute -left-24 -top-24 h-[420px] w-[620px] rounded-full bg-brand-bright/10 blur-3xl"
      />

      <div className="relative">
        <h1 className="max-w-3xl text-[34px] font-extrabold leading-[1.08] tracking-tight sm:text-[52px] lg:text-[60px]">
          <span className="hero-gradient-text block">Cari Game yang Kamu Mau.</span>
          <span className="block text-white">Cek Harganya.</span>
          <span className="block text-white">
            Temukan Deal <span className="text-lime">Terbaik.</span>
          </span>
        </h1>

        <p className="mt-6 max-w-xl text-[15px] leading-relaxed text-muted sm:text-[16.5px]">
          Lagi cari game? Cek harga dan diskonnya dari berbagai platform di sini
        </p>

        <div className="mt-8 flex flex-wrap items-center gap-3">
          <Link
            href="/katalog"
            className="rounded-lg bg-brand px-6 py-3 text-[14.5px] font-medium text-white transition-colors hover:bg-brand-bright"
          >
            Jelajahi Game
          </Link>
          <a
            href="#sale-events"
            className="rounded-lg border border-hairline px-6 py-3 text-[14.5px] font-medium text-white transition-colors hover:border-brand hover:text-brand-bright"
          >
            Lihat Promo
          </a>
        </div>
      </div>
    </section>
  );
}
