"use client";

import { useEffect, useRef, useState } from "react";
import { ApiRequestError, apiGet } from "./api";

type Params = Record<string, string | number | boolean | undefined | null | (string | number)[]>;

export type QueryState<T> = {
  data: T | null;
  error: string | null;
  status: number | null;
  loading: boolean;
  refetch: () => void;
};

/**
 * Small client-side data hook: fetches on mount and whenever the query key
 * changes, aborts in-flight requests and exposes loading/error state so every
 * screen can render the PRD's "data belum tersedia" / error messages.
 */
export function useApi<T>(path: string, params?: Params): QueryState<T> {
  const key = path + JSON.stringify(params ?? {});
  const [data, setData] = useState<T | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [status, setStatus] = useState<number | null>(null);
  const [loading, setLoading] = useState(true);
  const [nonce, setNonce] = useState(0);
  const cache = useRef<Map<string, T>>(new Map());

  useEffect(() => {
    if (!path) {
      setLoading(false);
      return;
    }
    const controller = new AbortController();
    let active = true;

    const cached = cache.current.get(key);
    if (cached !== undefined) {
      setData(cached);
      setLoading(false);
      setError(null);
    } else {
      setLoading(true);
    }
    setError(null);

    apiGet<T>(path, params, controller.signal)
      .then((result) => {
        if (!active) return;
        cache.current.set(key, result);
        setData(result);
        setError(null);
        setStatus(200);
      })
      .catch((err: unknown) => {
        if (!active || controller.signal.aborted) return;
        if (err instanceof DOMException && err.name === "AbortError") return;
        if (err instanceof ApiRequestError) {
          setError(err.message);
          setStatus(err.status);
        } else {
          setError("Tidak dapat memuat data. Coba lagi.");
          setStatus(null);
        }
      })
      .finally(() => {
        if (active) setLoading(false);
      });

    return () => {
      active = false;
      controller.abort();
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [key, nonce]);

  return {
    data,
    error,
    status,
    loading,
    refetch: () => {
      cache.current.delete(key);
      setNonce((n) => n + 1);
    },
  };
}

/** Debounce a fast-changing value (search boxes, sliders). */
export function useDebounced<T>(value: T, delay = 300): T {
  const [debounced, setDebounced] = useState(value);
  useEffect(() => {
    const timer = setTimeout(() => setDebounced(value), delay);
    return () => clearTimeout(timer);
  }, [value, delay]);
  return debounced;
}
