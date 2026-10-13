import type { Metadata } from "next";
import { SearchView } from "./SearchView";

export const metadata: Metadata = {
  title: "Hasil Pencarian",
};

export default function SearchPage() {
  return <SearchView />;
}
