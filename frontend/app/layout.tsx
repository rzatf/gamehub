import type { Metadata } from "next";
import { Suspense } from "react";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import { Navbar, NavbarFallback } from "@/components/Navbar";
import { Footer } from "@/components/Footer";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: {
    default: "GameHub — Tracker Diskon Game Multi-Platform",
    template: "%s · GameHub",
  },
  description:
    "Game Hub adalah direktori & tracker diskon game non-komersial. Cek harga dan diskon game dari Steam, Epic Games Store, dan GOG dalam Rupiah.",
  keywords: ["game", "diskon game", "harga game", "steam", "epic games", "gog", "game hub"],
  openGraph: {
    title: "GameHub — Tracker Diskon Game Multi-Platform",
    description: "Cek harga dan diskon game dari berbagai platform di satu tempat.",
    locale: "id_ID",
    type: "website",
  },
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="id" className={`${geistSans.variable} ${geistMono.variable} h-full antialiased`}>
      <body className="flex min-h-full flex-col">
        <Suspense fallback={<NavbarFallback />}>
          <Navbar />
        </Suspense>
        <main className="flex-1">{children}</main>
        <Footer />
      </body>
    </html>
  );
}
