import { CardGridSkeleton } from "@/components/skeletons";

export default function Loading() {
  return (
    <div className="mx-auto w-full max-w-[1400px] px-4 py-14 sm:px-6">
      <div className="skeleton mb-8 h-8 w-56 rounded" />
      <CardGridSkeleton count={6} />
    </div>
  );
}
