"use client";

import { useCallback, useEffect, useState } from "react";

/**
 * Favorites live in localStorage: the PRD's wishlist needs no account, and the
 * whole catalogue stays a public read-only API.
 */
const KEY = "gamehub.favorites.v1";
const EVENT = "gamehub:favorites";

function read(): string[] {
  if (typeof window === "undefined") return [];
  try {
    const raw = window.localStorage.getItem(KEY);
    const parsed = raw ? JSON.parse(raw) : [];
    return Array.isArray(parsed) ? parsed.filter((v): v is string => typeof v === "string") : [];
  } catch {
    return [];
  }
}

function write(slugs: string[]) {
  window.localStorage.setItem(KEY, JSON.stringify(slugs));
  window.dispatchEvent(new Event(EVENT));
}

export function useFavorites() {
  const [favorites, setFavorites] = useState<string[]>([]);
  const [ready, setReady] = useState(false);

  useEffect(() => {
    setFavorites(read());
    setReady(true);
    const sync = () => setFavorites(read());
    window.addEventListener(EVENT, sync);
    window.addEventListener("storage", sync);
    return () => {
      window.removeEventListener(EVENT, sync);
      window.removeEventListener("storage", sync);
    };
  }, []);

  const toggle = useCallback((slug: string) => {
    const current = read();
    const next = current.includes(slug) ? current.filter((s) => s !== slug) : [...current, slug];
    write(next);
    return next.includes(slug);
  }, []);

  const clear = useCallback(() => write([]), []);

  return {
    favorites,
    ready,
    count: favorites.length,
    isFavorite: (slug: string) => favorites.includes(slug),
    toggle,
    clear,
  };
}
