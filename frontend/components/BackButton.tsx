"use client";

import { useRouter } from "next/navigation";
import { ArrowLeftIcon } from "./icons";

/** "Back" control at the top of the game-detail page. */
export function BackButton() {
  const router = useRouter();

  function goBack() {
    if (typeof window !== "undefined" && window.history.length > 1) {
      router.back();
    } else {
      router.push("/katalog");
    }
  }

  return (
    <button
      type="button"
      onClick={goBack}
      className="inline-flex items-center gap-2 rounded-lg border border-hairline bg-deep px-3.5 py-2 text-[13.5px] text-muted transition-colors hover:border-brand hover:text-white"
    >
      <ArrowLeftIcon className="h-4 w-4" />
      Back
    </button>
  );
}
