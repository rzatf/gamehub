/** Typed fetch helpers for the Game Hub API (proxied through /api). */

export class ApiRequestError extends Error {
  status: number;
  payload: unknown;

  constructor(message: string, status: number, payload: unknown) {
    super(message);
    this.name = "ApiRequestError";
    this.status = status;
    this.payload = payload;
  }
}

const BASE = process.env.NEXT_PUBLIC_API_BASE ?? "";

type Params = Record<string, string | number | boolean | undefined | null | (string | number)[]>;

export function buildQuery(params?: Params): string {
  if (!params) return "";
  const search = new URLSearchParams();
  for (const [key, value] of Object.entries(params)) {
    if (value === undefined || value === null || value === "") continue;
    if (Array.isArray(value)) {
      if (value.length === 0) continue;
      search.set(key, value.join(","));
    } else {
      search.set(key, String(value));
    }
  }
  const qs = search.toString();
  return qs ? `?${qs}` : "";
}

export async function apiGet<T>(path: string, params?: Params, signal?: AbortSignal): Promise<T> {
  const url = `${BASE}${path}${buildQuery(params)}`;
  const res = await fetch(url, {
    signal,
    headers: { Accept: "application/json" },
    cache: "no-store",
  });

  let payload: unknown = null;
  const text = await res.text();
  if (text) {
    try {
      payload = JSON.parse(text);
    } catch {
      payload = text;
    }
  }

  if (!res.ok) {
    const message =
      (payload && typeof payload === "object" && "message" in payload && typeof (payload as { message: unknown }).message === "string"
        ? (payload as { message: string }).message
        : null) ?? `Permintaan gagal (${res.status})`;
    throw new ApiRequestError(message, res.status, payload);
  }

  return payload as T;
}
