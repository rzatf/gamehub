import type { Metadata } from "next";
import { Suspense } from "react";
import { GameDetailView } from "./GameDetailView";

type Props = { params: Promise<{ slug: string }> };

function humanize(slug: string): string {
  return slug
    .split("-")
    .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
    .join(" ");
}

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { slug } = await params;
  const title = humanize(slug);

  return {
    title,
    description: `Bandingkan harga dan diskon ${title} di Steam, Epic Games Store, dan GOG dalam Rupiah.`,
  };
}

function DetailSkeleton() {
  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-10 sm:px-6">
      <div className="skeleton h-9 w-32 rounded-lg" />
      <div className="skeleton mt-6 h-9 w-2/3 rounded" />
      <div className="mt-8 grid gap-8 lg:grid-cols-[1fr_420px]">
        <div className="skeleton aspect-video w-full rounded-xl" />
        <div className="skeleton h-[260px] w-full rounded-xl" />
      </div>
      <div className="skeleton mt-10 h-40 w-full rounded-xl" />
    </div>
  );
}

export default function GameDetailPage() {
  return (
    <Suspense fallback={<DetailSkeleton />}>
      <GameDetailView />
    </Suspense>
  );
}
