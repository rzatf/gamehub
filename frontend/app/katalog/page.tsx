import type { Metadata } from "next";
import { CatalogView } from "./CatalogView";

export const metadata: Metadata = {
  title: "Katalog Game",
  description: "Jelajahi katalog game, filter berdasarkan toko dan genre, lalu bandingkan harganya.",
};

export default function KatalogPage() {
  return <CatalogView />;
}
