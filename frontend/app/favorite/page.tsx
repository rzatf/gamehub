import type { Metadata } from "next";
import { FavoriteView } from "./FavoriteView";

export const metadata: Metadata = {
  title: "Favorit Saya",
  description: "Daftar game favorit yang kamu simpan di Game Hub.",
};

export default function FavoritePage() {
  return <FavoriteView />;
}
