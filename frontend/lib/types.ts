export type Platform = {
  name: string | null;
  slug: string | null;
  color: string | null;
};

export type PlatformOffer = Platform & {
  normal_price: number;
  final_price: number;
  discount_percent: number;
  url: string | null;
  is_lowest?: boolean;
};

export type Game = {
  id: number;
  slug: string;
  title: string;
  cover_image: string;
  portrait_image: string | null;
  rating: number;
  rating_count: number;
  release_year: number | null;
  is_featured: boolean;
  genres: string[];
  genre_slugs: string[];
  normal_price: number | null;
  final_price: number | null;
  discount_percent: number;
  max_discount_percent: number;
  best_platform: Platform | null;
  platform_count: number;
  platforms: PlatformOffer[];
};

export type RequirementRow = { label: string; value: string };

export type HistorySeries = {
  platform: Platform;
  normal: (number | null)[];
  final: (number | null)[];
  discount: (number | null)[];
  min_6_months: number | null;
  is_lowest_6_months: boolean;
};

export type GameDetail = {
  id: number;
  slug: string;
  title: string;
  steam_appid: number | null;
  steam_url: string | null;
  description: string | null;
  developer: string | null;
  publisher: string | null;
  release_date: string | null;
  release_year: number | null;
  rating: number;
  rating_count: number;
  cover_image: string;
  portrait_image: string | null;
  hero_image: string | null;
  wide_image: string | null;
  screenshots: string[];
  genres: string[];
  genre_slugs: string[];
  min_requirements: RequirementRow[];
  rec_requirements: RequirementRow[];
  normal_price: number | null;
  final_price: number | null;
  discount_percent: number;
  best_platform: Platform | null;
  prices: PlatformOffer[];
  history: {
    months: string[];
    labels: string[];
    dates: (string | null)[];
    series: HistorySeries[];
    min_6_months: number | null;
    is_lowest_6_months: boolean;
  };
};

export type SaleEvent = {
  title: string;
  subtitle: string | null;
  badge: string | null;
  image: string | null;
  url: string;
  platform: string | null;
  platform_slug?: string | null;
};

export type HomePayload = {
  sale_events: SaleEvent[];
  sections: {
    title: string;
    slug: string;
    color: string | null;
    store_url: string | null;
    games: Game[];
  }[];
  featured: Game[];
};

export type Paginated<T> = {
  data: T[];
  links: { first: string | null; last: string | null; prev: string | null; next: string | null };
  meta: {
    current_page: number;
    from: number | null;
    to: number | null;
    per_page: number;
    total: number;
    last_page: number;
    links: { url: string | null; label: string; page: number | null; active: boolean }[];
  };
};

export type GenreOption = {
  id: number;
  name: string;
  slug: string;
  is_filterable: boolean;
};

export type ApiError = {
  message: string;
  errors?: Record<string, string[]>;
};
