import type { NextConfig } from "next";

/**
 * The Next.js app is the only client of the Game Hub API. Requests to /api/*
 * are proxied to the Laravel backend so the browser always talks same-origin
 * (no CORS, and the API host never leaks into the client bundle).
 */
const apiUrl = process.env.API_URL ?? "http://127.0.0.1:8000";

const nextConfig: NextConfig = {
  /* config options here */
  experimental: {
    agentFeedback: true,
  },
  // Allow the dev server to be opened on 127.0.0.1 as well as localhost.
  allowedDevOrigins: ["127.0.0.1", "localhost"],
  cacheComponents: true,
  partialPrefetching: true,
  turbopack: {
    rules: {
      "*.css": {
        loaders: ["@tailwindcss/turbopack"],
        as: "*.css",
      },
    },
  },
  async rewrites() {
    return [
      {
        source: "/api/:path*",
        destination: `${apiUrl}/api/:path*`,
      },
    ];
  },
};

export default nextConfig;
