"use client";

import Link from "next/link";
import { usePathname, useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { Logo, SearchIcon } from "./icons";
import { useFavorites } from "@/lib/favorites";

/**
 * Static shell of the navigation bar. Rendered as the Suspense fallback while
 * the interactive bar (which reads URL data) streams in after prerendering.
 */
export function NavbarFallback() {
  return (
    <header className="sticky top-0 z-50 border-b border-hairline/50 bg-deep/95 backdrop-blur">
      <div className="mx-auto flex h-16 w-full max-w-[1400px] items-center gap-4 px-4 sm:gap-8 sm:px-6">
        <Logo />
        <div className="hidden h-10 w-full max-w-[420px] rounded-full border border-hairline bg-field sm:block" />
        <nav className="ml-auto flex items-center gap-5 text-[15px] text-muted sm:gap-7">
          <span>Katalog</span>
          <span>Favorite</span>
        </nav>
      </div>
    </header>
  );
}

/**
 * Sticky top navigation: brand, catalogue search and the two primary
 * destinations (Katalog / Favorite) from the design.
 */
export function Navbar() {
  const pathname = usePathname();
  const router = useRouter();
  const { count, ready } = useFavorites();
  const [term, setTerm] = useState("");

  // Mirror the active query into the box when landing on /search?q=...
  useEffect(() => {
    if (pathname === "/search" && typeof window !== "undefined") {
      setTerm(new URLSearchParams(window.location.search).get("q") ?? "");
    } else {
      setTerm("");
    }
  }, [pathname]);

  function submit(event: React.FormEvent) {
    event.preventDefault();
    const q = term.trim();
    router.push(q ? `/search?q=${encodeURIComponent(q)}` : "/katalog");
  }

  const linkCls = (href: string) =>
    `relative text-[15px] transition-colors ${pathname === href ? "text-white" : "text-muted hover:text-white"}`;

  const searchInput = (extra: string) => (
    <input
      value={term}
      onChange={(e) => setTerm(e.target.value)}
      placeholder="Cari..."
      aria-label="Cari game"
      className={`h-10 rounded-full border border-hairline bg-field pl-10 pr-4 text-[14px] text-white placeholder-muted-deep outline-none transition-colors focus:border-brand focus:ring-1 focus:ring-brand ${extra}`}
    />
  );

  return (
    <header className="sticky top-0 z-50 border-b border-hairline/50 bg-deep/95 backdrop-blur">
      <div className="mx-auto flex h-16 w-full max-w-[1400px] items-center gap-4 px-4 sm:gap-8 sm:px-6">
        <Logo />

        <form onSubmit={submit} className="relative hidden min-w-0 flex-1 sm:block" role="search">
          <span className="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-muted-deep">
            <SearchIcon />
          </span>
          {searchInput("w-full max-w-[420px]")}
        </form>

        <nav className="ml-auto flex items-center gap-5 sm:gap-7">
          <Link href="/katalog" className={linkCls("/katalog")}>
            Katalog
          </Link>
          <Link href="/favorite" className={linkCls("/favorite")}>
            Favorite
            {ready && count > 0 ? (
              <span className="ml-1.5 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-lime px-1 text-[11px] font-bold text-abyss">
                {count}
              </span>
            ) : null}
          </Link>
        </nav>
      </div>

      {/* Compact search for narrow viewports */}
      <form onSubmit={submit} className="relative border-t border-hairline/40 px-4 py-2 sm:hidden" role="search">
        <span className="pointer-events-none absolute left-7 top-1/2 -translate-y-1/2 text-muted-deep">
          <SearchIcon />
        </span>
        {searchInput("w-full")}
      </form>
    </header>
  );
}
