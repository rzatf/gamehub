<?php

// AUTO-GENERATED seed data (real Steam store data, IDR).
// Regenerate with: python .work/gen_seed_data.py
return [
    'platforms' => [
        [
            'name' => 'Steam',
            'slug' => 'steam',
            'color' => '#66C0F4',
            'store_url' => 'https://store.steampowered.com',
            'sort_order' => 1,
            'show_on_home' => 1,
        ],
        [
            'name' => 'Epic Games',
            'slug' => 'epic',
            'color' => '#B7B7B7',
            'store_url' => 'https://store.epicgames.com',
            'sort_order' => 2,
            'show_on_home' => 1,
        ],
        [
            'name' => 'GOG',
            'slug' => 'gog',
            'color' => '#A855F7',
            'store_url' => 'https://www.gog.com',
            'sort_order' => 3,
            'show_on_home' => 0,
        ],
    ],
    'genres' => [
        [
            'name' => 'Action',
            'slug' => 'action',
            'filterable' => 1,
            'sort_order' => 1,
        ],
        [
            'name' => 'RPG',
            'slug' => 'rpg',
            'filterable' => 1,
            'sort_order' => 2,
        ],
        [
            'name' => 'Adventure',
            'slug' => 'adventure',
            'filterable' => 1,
            'sort_order' => 3,
        ],
        [
            'name' => 'Strategy',
            'slug' => 'strategy',
            'filterable' => 1,
            'sort_order' => 4,
        ],
        [
            'name' => 'Simulation',
            'slug' => 'simulation',
            'filterable' => 1,
            'sort_order' => 5,
        ],
        [
            'name' => 'Racing',
            'slug' => 'racing',
            'filterable' => 1,
            'sort_order' => 6,
        ],
        [
            'name' => 'Sports',
            'slug' => 'sports',
            'filterable' => 1,
            'sort_order' => 7,
        ],
        [
            'name' => 'Indie',
            'slug' => 'indie',
            'filterable' => 1,
            'sort_order' => 8,
        ],
        [
            'name' => 'FPS',
            'slug' => 'fps',
            'filterable' => 0,
            'sort_order' => 9,
        ],
        [
            'name' => 'Open World',
            'slug' => 'open-world',
            'filterable' => 0,
            'sort_order' => 10,
        ],
        [
            'name' => 'Interactive Drama',
            'slug' => 'interactive-drama',
            'filterable' => 0,
            'sort_order' => 11,
        ],
        [
            'name' => 'Horror',
            'slug' => 'horror',
            'filterable' => 0,
            'sort_order' => 12,
        ],
        [
            'name' => 'Roguelike',
            'slug' => 'roguelike',
            'filterable' => 0,
            'sort_order' => 13,
        ],
        [
            'name' => 'Souls-like',
            'slug' => 'souls-like',
            'filterable' => 0,
            'sort_order' => 14,
        ],
    ],
    'games' => [
        [
            'slug' => 'battlefield-6',
            'title' => 'Battlefield™ 6',
            'appid' => 2807960,
            'description' => 'The ultimate all-out warfare experience. In a war of tanks, fighter jets, and massive combat arsenals, your squad is the deadliest weapon.',
            'developer' => 'Battlefield Studios',
            'publisher' => 'Electronic Arts',
            'release_date' => '2025-10-10',
            'rating' => 6.8,
            'rating_count' => 41230,
            'cover_image' => '/covers/battlefield-6-card.jpg',
            'portrait_image' => '/covers/battlefield-6-portrait.jpg',
            'hero_image' => '/covers/battlefield-6-hero.jpg',
            'wide_image' => '/covers/battlefield-6-header.jpg',
            'screenshots' => ['/screenshots/battlefield-6-1.jpg', '/screenshots/battlefield-6-2.jpg', '/screenshots/battlefield-6-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-8400, AMD Ryzen 5 2600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia RTX 2060, AMD Radeon RX 5600 XT 6GB, Intel Arc A380',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '55 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'No Recommendation',
                ],
                [
                    'label' => 'Mendukung VR',
                    'value' => 'Not Supported',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'TPM 2.0 Enabled UEFI SECURE BOOT Enabled HVCI Capable VBS Capable',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i7-10700, AMD Ryzen 7 3700X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia RTX 3060Ti, AMD Radeon RX 6700-XT, Intel Arc B580',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '80 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'No Recommendation',
                ],
                [
                    'label' => 'Mendukung VR',
                    'value' => 'Not Supported',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'TPM 2.0 Enabled UEFI SECURE BOOT Enabled HVCI Capable VBS Capable',
                ],
            ],
            'is_featured' => 1,
            'sort_order' => 1,
            'genres' => ['fps', 'action'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.steampowered.com/app/2807960/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Battlefield+6',
                ],
            ],
        ],
        [
            'slug' => 'detroit-become-human',
            'title' => 'Detroit: Become Human',
            'appid' => 1222140,
            'description' => 'Detroit: Become Human puts the destiny of both mankind and androids in your hands, taking you to a near future where machines have become more intelligent than humans. Every choice you make affects the outcome of the game, with one of the most intricately branching narratives ever created.',
            'developer' => 'Quantic Dream',
            'publisher' => 'Quantic Dream',
            'release_date' => '2020-06-18',
            'rating' => 8.7,
            'rating_count' => 98540,
            'cover_image' => '/covers/detroit-become-human-card.jpg',
            'portrait_image' => '/covers/detroit-become-human-portrait.jpg',
            'hero_image' => '/covers/detroit-become-human-hero.jpg',
            'wide_image' => '/covers/detroit-become-human-header.jpg',
            'screenshots' => ['/screenshots/detroit-become-human-1.jpg', '/screenshots/detroit-become-human-2.jpg', '/screenshots/detroit-become-human-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (64 bit)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-2300 @ 2.8 GHz or AMD Ryzen 3 1200 @ 3.1GHz or AMD FX-8350 @ 4.2GHz',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia GeForce GTX 780 or AMD HD 7950 with 3GB VRAM minimum (Support of Vulkan 1.1 required)',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '55 GB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (64 bit)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-6600 @ 3.3 GHz or AMD Ryzen 3 1300 X @ 3.4 GHz',
                ],
                [
                    'label' => 'Memori',
                    'value' => '12 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia GeForce GTX 1060 or AMD Radeon RX 580 with 4GB VRAM minimum (Support of Vulkan 1.1 required)',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '55 GB ruang tersedia',
                ],
            ],
            'is_featured' => 1,
            'sort_order' => 2,
            'genres' => ['adventure', 'interactive-drama'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.steampowered.com/app/1222140/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Detroit%3A+Become+Human',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://www.gog.com/en/games?query=Detroit%3A+Become+Human',
                ],
            ],
        ],
        [
            'slug' => 'sekiro-shadows-die-twice',
            'title' => 'Sekiro™: Shadows Die Twice - GOTY Edition',
            'appid' => 814380,
            'description' => 'Game of the Year - The Game Awards 2019 Best Action Game of 2019 - IGN Carve your own clever path to vengeance in the award winning adventure from developer FromSoftware, creators of Bloodborne and the Dark Souls series. Take Revenge. Restore Your Honor. Kill Ingeniously.',
            'developer' => 'FromSoftware, Inc.',
            'publisher' => 'Activision (Excluding Japan and Asia), FromSoftware, Inc. (Japan), 方块游戏 (Asia)',
            'release_date' => '2019-03-21',
            'rating' => 8.9,
            'rating_count' => 214380,
            'cover_image' => '/covers/sekiro-shadows-die-twice-card.jpg',
            'portrait_image' => '/covers/sekiro-shadows-die-twice-portrait.jpg',
            'hero_image' => '/covers/sekiro-shadows-die-twice-hero.jpg',
            'wide_image' => '/covers/sekiro-shadows-die-twice-header.jpg',
            'screenshots' => ['/screenshots/sekiro-shadows-die-twice-1.jpg', '/screenshots/sekiro-shadows-die-twice-2.jpg', '/screenshots/sekiro-shadows-die-twice-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS *',
                    'value' => 'Windows 7 64-bit | Windows 8 64-bit | Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i3-2100 | AMD FX-6300',
                ],
                [
                    'label' => 'Memori',
                    'value' => '4 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GeForce GTX 760 | AMD Radeon HD 7950',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '25 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'DirectX 11 Compatible',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS *',
                    'value' => 'Windows 7 64-bit | Windows 8 64-bit | Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-2500K | AMD Ryzen 5 1400',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GeForce GTX 970 | AMD Radeon RX 570',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '25 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'DirectX 11 Compatible',
                ],
            ],
            'is_featured' => 1,
            'sort_order' => 3,
            'genres' => ['action', 'open-world', 'souls-like'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.steampowered.com/app/814380/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 1251888,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Sekiro%3A+Shadows+Die+Twice+-+GOTY+Edition',
                ],
            ],
        ],
        [
            'slug' => 'red-dead-redemption-2',
            'title' => 'Red Dead Redemption 2',
            'appid' => 1174180,
            'description' => 'Red Dead Redemption 2 adalah permainan video aksi-penjelajahan (action-adventure) berlatar dunia terbuka (open-world) yang dikembangkan dan diterbitkan oleh Rockstar Games. Dirilis pada tahun 2018, game ini merupakan prekuel dari Red Dead Redemption (2010).',
            'developer' => 'Rockstar Games',
            'publisher' => 'Rockstar Games',
            'release_date' => '2018-10-26',
            'rating' => 9,
            'rating_count' => 512980,
            'cover_image' => '/covers/red-dead-redemption-2-card.jpg',
            'portrait_image' => '/covers/red-dead-redemption-2-portrait.jpg',
            'hero_image' => '/covers/red-dead-redemption-2-hero.jpg',
            'wide_image' => '/covers/red-dead-redemption-2-header.jpg',
            'screenshots' => ['/screenshots/red-dead-redemption-2-1.jpg', '/screenshots/red-dead-redemption-2-2.jpg', '/screenshots/red-dead-redemption-2-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 - 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i5-2500K / AMD FX-6300',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia GeForce GTX 770 2GB / AMD Radeon R9 280 3GB',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '150 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'Direct X Compatible',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 - 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i7-4770K / AMD Ryzen 5 1500X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '12 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia GeForce GTX 1060 6GB / AMD Radeon RX 480 4GB',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '150 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'Direct X Compatible',
                ],
            ],
            'is_featured' => 1,
            'sort_order' => 4,
            'genres' => ['action', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 1073021,
                    'discount' => 75,
                    'url' => 'https://store.steampowered.com/app/1174180/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 1073021,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Red+Dead+Redemption+2',
                ],
            ],
        ],
        [
            'slug' => 'cyberpunk-2077',
            'title' => 'Cyberpunk 2077',
            'appid' => 1091500,
            'description' => 'Cyberpunk 2077 is an open-world, action-adventure RPG set in the dark future of Night City — a dangerous megalopolis obsessed with power, glamor, and ceaseless body modification.',
            'developer' => 'CD PROJEKT RED',
            'publisher' => 'CD PROJEKT RED',
            'release_date' => '2020-12-10',
            'rating' => 8.6,
            'rating_count' => 689210,
            'cover_image' => '/covers/cyberpunk-2077-card.jpg',
            'portrait_image' => '/covers/cyberpunk-2077-portrait.jpg',
            'hero_image' => '/covers/cyberpunk-2077-hero.jpg',
            'wide_image' => '/covers/cyberpunk-2077-header.jpg',
            'screenshots' => ['/screenshots/cyberpunk-2077-1.jpg', '/screenshots/cyberpunk-2077-2.jpg', '/screenshots/cyberpunk-2077-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => '64-bit Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Core i7-6700 or Ryzen 5 1600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '12 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce GTX 1060 6GB or Radeon RX 580 8GB or Arc A380',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '70 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required. Attention: In this game you will encounter a variety of visual effects that may provide seizures or loss of consciousness in a minority of people. If you or someone you know experiences any of the above symptoms while playing, stop and seek medical attention immediately.',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => '64-bit Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Core i7-12700 or Ryzen 7 7800X3D',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce RTX 2060 SUPER or Radeon RX 5700 XT or Arc A770',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '70 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required.',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 5,
            'genres' => ['rpg', 'action', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 699999,
                    'discount' => 60,
                    'url' => 'https://store.steampowered.com/app/1091500/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 699999,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Cyberpunk+2077',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 699999,
                    'discount' => 65,
                    'url' => 'https://www.gog.com/en/games?query=Cyberpunk+2077',
                ],
            ],
        ],
        [
            'slug' => 'elden-ring',
            'title' => 'ELDEN RING',
            'appid' => 1245620,
            'description' => 'THE CRITICALLY ACCLAIMED FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.',
            'developer' => 'FromSoftware, Inc.',
            'publisher' => 'FromSoftware, Inc., Bandai Namco Entertainment',
            'release_date' => '2022-02-24',
            'rating' => 9.5,
            'rating_count' => 741220,
            'cover_image' => '/covers/elden-ring-card.jpg',
            'portrait_image' => '/covers/elden-ring-portrait.jpg',
            'hero_image' => '/covers/elden-ring-hero.jpg',
            'wide_image' => '/covers/elden-ring-header.jpg',
            'screenshots' => ['/screenshots/elden-ring-1.jpg', '/screenshots/elden-ring-2.jpg', '/screenshots/elden-ring-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'INTEL CORE I5-8400 or AMD RYZEN 3 3300X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '12 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GEFORCE GTX 1060 3 GB or AMD RADEON RX 580 4 GB',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'Windows Compatible Audio Device',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => '',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'INTEL CORE I7-8700K or AMD RYZEN 5 3600X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GEFORCE GTX 1070 8 GB or AMD RADEON RX VEGA 56 8 GB',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 GB ruang tersedia',
                ],
                [
                    'label' => 'Kartu suara',
                    'value' => 'Windows Compatible Audio Device',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => '',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 6,
            'genres' => ['rpg', 'action', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 599000,
                    'discount' => 40,
                    'url' => 'https://store.steampowered.com/app/1245620/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 599000,
                    'discount' => 30,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=ELDEN+RING',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 599000,
                    'discount' => 40,
                    'url' => 'https://www.gog.com/en/games?query=ELDEN+RING',
                ],
            ],
        ],
        [
            'slug' => 'the-witcher-3-wild-hunt',
            'title' => 'The Witcher 3: Wild Hunt — Remastered',
            'appid' => 292030,
            'description' => 'The Witcher 3: Wild Hunt — Remastered modernizes the acclaimed role-playing game with a range of upgrades and enhancements. Become monster slayer for hire Geralt of Rivia and journey across a dark fantasy open world in an epic quest to find your adopted daughter Ciri.',
            'developer' => 'CD PROJEKT RED',
            'publisher' => 'CD PROJEKT RED',
            'release_date' => '2015-05-19',
            'rating' => 9.8,
            'rating_count' => 812330,
            'cover_image' => '/covers/the-witcher-3-wild-hunt-card.jpg',
            'portrait_image' => '/covers/the-witcher-3-wild-hunt-portrait.jpg',
            'hero_image' => '/covers/the-witcher-3-wild-hunt-hero.jpg',
            'wide_image' => '/covers/the-witcher-3-wild-hunt-header.jpg',
            'screenshots' => ['/screenshots/the-witcher-3-wild-hunt-1.jpg', '/screenshots/the-witcher-3-wild-hunt-2.jpg', '/screenshots/the-witcher-3-wild-hunt-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS',
                    'value' => '64-bit Windows 11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Core i5-8400 / Ryzen 5 2600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '12 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce GTX 1660 / Radeon RX 5500 XT 8GB / Arc A580',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 SSD GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'VRAM 6 GB',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS',
                    'value' => '64-bit Windows 11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i7 8700K / AMD Ryzen 5 3600X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'RTX 2060 Super / AMD Radeon RX 6600 XT / Intel Arc B580',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 SSD GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'VRAM 8 GB',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 7,
            'genres' => ['rpg', 'adventure', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 539000,
                    'discount' => 80,
                    'url' => 'https://store.steampowered.com/app/292030/',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 539000,
                    'discount' => 85,
                    'url' => 'https://www.gog.com/en/games?query=The+Witcher+3%3A+Wild+Hunt+%E2%80%94+Remastered',
                ],
            ],
        ],
        [
            'slug' => 'god-of-war',
            'title' => 'God of War',
            'appid' => 1593500,
            'description' => 'His vengeance against the Gods of Olympus years behind him, Kratos now lives as a man in the realm of Norse Gods and monsters. It is in this harsh, unforgiving world that he must fight to survive… and teach his son to do the same.',
            'developer' => 'Santa Monica Studio, Jetpack Interactive',
            'publisher' => 'PlayStation Publishing LLC',
            'release_date' => '2022-01-14',
            'rating' => 9.4,
            'rating_count' => 322110,
            'cover_image' => '/covers/god-of-war-card.jpg',
            'portrait_image' => '/covers/god-of-war-portrait.jpg',
            'hero_image' => '/covers/god-of-war-hero.jpg',
            'wide_image' => '/covers/god-of-war-header.jpg',
            'screenshots' => ['/screenshots/god-of-war-1.jpg', '/screenshots/god-of-war-2.jpg', '/screenshots/god-of-war-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel i5-2500k (4 core 3.3 GHz) or AMD Ryzen 3 1200 (4 core 3.1 GHz)',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GTX 960 (4 GB) or AMD R9 290X (4 GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '70 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'DirectX feature level 11_1 required',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel i5-6600k (4 core 3.5 GHz) or AMD Ryzen 5 2400 G (4 core 3.6 GHz)',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GTX 1060 (6 GB) or AMD RX 570 (4 GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '70 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'DirectX feature level 11_1 required',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 8,
            'genres' => ['action', 'adventure'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 729000,
                    'discount' => 50,
                    'url' => 'https://store.steampowered.com/app/1593500/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 729000,
                    'discount' => 40,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=God+of+War',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 729000,
                    'discount' => 55,
                    'url' => 'https://www.gog.com/en/games?query=God+of+War',
                ],
            ],
        ],
        [
            'slug' => 'hades-ii',
            'title' => 'Hades II',
            'appid' => 1145350,
            'description' => 'Battle beyond the Underworld using dark sorcery to take on the Titan of Time in this bewitching sequel to the award-winning rogue-like dungeon crawler.',
            'developer' => 'Supergiant Games',
            'publisher' => 'Supergiant Games',
            'release_date' => '2025-09-25',
            'rating' => 9,
            'rating_count' => 88640,
            'cover_image' => '/covers/hades-ii-card.jpg',
            'portrait_image' => '/covers/hades-ii-portrait.jpg',
            'hero_image' => '/covers/hades-ii-hero.jpg',
            'wide_image' => '/covers/hades-ii-header.jpg',
            'screenshots' => ['/screenshots/hades-ii-1.jpg', '/screenshots/hades-ii-2.jpg', '/screenshots/hades-ii-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Dual Core 2.4 GHz',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce GTX 950, Radeon R7 360, or Intel HD Graphics 630',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '11 GB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Quad Core 2.4ghz',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce RTX 2060, Radeon RX 5600 XT, or Intel Arc A580',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '11 GB ruang tersedia',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 9,
            'genres' => ['action', 'indie', 'roguelike'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 245999,
                    'discount' => 25,
                    'url' => 'https://store.steampowered.com/app/1145350/',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 245999,
                    'discount' => 25,
                    'url' => 'https://www.gog.com/en/games?query=Hades+II',
                ],
            ],
        ],
        [
            'slug' => 'baldurs-gate-3',
            'title' => 'Baldur\'s Gate 3',
            'appid' => 1086940,
            'description' => 'Baldur’s Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons &amp; Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.',
            'developer' => 'Larian Studios',
            'publisher' => 'Larian Studios',
            'release_date' => '2023-08-03',
            'rating' => 9.6,
            'rating_count' => 623440,
            'cover_image' => '/covers/baldurs-gate-3-card.jpg',
            'portrait_image' => '/covers/baldurs-gate-3-portrait.jpg',
            'hero_image' => '/covers/baldurs-gate-3-hero.jpg',
            'wide_image' => '/covers/baldurs-gate-3-header.jpg',
            'screenshots' => ['/screenshots/baldurs-gate-3-1.jpg', '/screenshots/baldurs-gate-3-2.jpg', '/screenshots/baldurs-gate-3-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel I5 4690 / AMD FX 8350 / Snapdragon X Elite',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia GTX 970 / RX 480 / Intel Arc A380 / Qualcomm Adreno X1 (4GB+ of VRAM)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '150 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel i7 8700K / AMD r5 3600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia 2060 Super / RX 5700 XT / Intel Arc A580 (8GB+ of VRAM)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 11',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '150 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 10,
            'genres' => ['rpg', 'strategy'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 699999,
                    'discount' => 30,
                    'url' => 'https://store.steampowered.com/app/1086940/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 699999,
                    'discount' => 25,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Hades+II',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 699999,
                    'discount' => 30,
                    'url' => 'https://www.gog.com/en/games?query=Hades+II',
                ],
            ],
        ],
        [
            'slug' => 'forza-horizon-5',
            'title' => 'Forza Horizon 5',
            'appid' => 1551360,
            'description' => 'Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars.',
            'developer' => 'Playground Games',
            'publisher' => 'Xbox Game Studios',
            'release_date' => '2021-11-08',
            'rating' => 8.6,
            'rating_count' => 199870,
            'cover_image' => '/covers/forza-horizon-5-card.jpg',
            'portrait_image' => '/covers/forza-horizon-5-portrait.jpg',
            'hero_image' => '/covers/forza-horizon-5-hero.jpg',
            'wide_image' => '/covers/forza-horizon-5-header.jpg',
            'screenshots' => ['/screenshots/forza-horizon-5-1.jpg', '/screenshots/forza-horizon-5-2.jpg', '/screenshots/forza-horizon-5-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 version 18362.0 or higher',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel i5-4460 or AMD Ryzen 3 1200',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVidia GTX 970, AMD RX 470, OR Intel Arc A380',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '110 GB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 version 18362.0 or higher',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel i5-8400 or AMD Ryzen 5 1500X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVidia GTX 1070, AMD RX 590, OR Intel Arc A750',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '110 GB ruang tersedia',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 11,
            'genres' => ['racing', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 699000,
                    'discount' => 65,
                    'url' => 'https://store.steampowered.com/app/1551360/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 699000,
                    'discount' => 55,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Forza+Horizon+5',
                ],
            ],
        ],
        [
            'slug' => 'stardew-valley',
            'title' => 'Stardew Valley',
            'appid' => 413150,
            'description' => 'You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life. Can you learn to live off the land and turn these overgrown fields into a thriving home?',
            'developer' => 'ConcernedApe',
            'publisher' => 'ConcernedApe',
            'release_date' => '2016-02-26',
            'rating' => 9.7,
            'rating_count' => 512300,
            'cover_image' => '/covers/stardew-valley-card.jpg',
            'portrait_image' => '/covers/stardew-valley-portrait.jpg',
            'hero_image' => '/covers/stardew-valley-hero.jpg',
            'wide_image' => '/covers/stardew-valley-header.jpg',
            'screenshots' => ['/screenshots/stardew-valley-1.jpg', '/screenshots/stardew-valley-2.jpg', '/screenshots/stardew-valley-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS *',
                    'value' => 'Windows Vista or greater',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => '2 Ghz',
                ],
                [
                    'label' => 'Memori',
                    'value' => '2 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => '256 mb video memory, shader model 3.0+',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 10',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '500 MB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => 'OS',
                    'value' => 'Windows 11 64-bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i7 / AMD Ryzen 7',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA RTX 3060 / AMD RX 6700',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '50 GB SSD',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 12,
            'genres' => ['simulation', 'indie', 'rpg'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 115999,
                    'discount' => 40,
                    'url' => 'https://store.steampowered.com/app/413150/',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 115999,
                    'discount' => 45,
                    'url' => 'https://www.gog.com/en/games?query=Stardew+Valley',
                ],
            ],
        ],
        [
            'slug' => 'cities-skylines-2',
            'title' => 'Cities: Skylines II',
            'appid' => 949230,
            'description' => 'Raise a city from the ground up and transform it into a thriving metropolis with the most realistic city builder ever. Push your creativity and problem-solving to build on a scale you\'ve never experienced. With deep simulation and a living economy, this is world-building without limits.',
            'developer' => 'Iceflake Studios, Colossal Order',
            'publisher' => 'Paradox Interactive',
            'release_date' => '2023-10-24',
            'rating' => 6.5,
            'rating_count' => 72450,
            'cover_image' => '/covers/cities-skylines-2-card.jpg',
            'portrait_image' => '/covers/cities-skylines-2-portrait.jpg',
            'hero_image' => '/covers/cities-skylines-2-hero.jpg',
            'wide_image' => '/covers/cities-skylines-2-header.jpg',
            'screenshots' => ['/screenshots/cities-skylines-2-1.jpg', '/screenshots/cities-skylines-2-2.jpg', '/screenshots/cities-skylines-2-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows® 10 Home 64 Bit',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i7-6700K | AMD® Ryzen™ 5 2600X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia® GeForce™ GTX 970 (4 GB)  | AMD® Radeon™ RX 480 (8 GB)',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 GB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows® 10 Home 64 Bit | Windows® 11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i5-12600K | AMD® Ryzen™ 7 5800X',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia® GeForce™ RTX 3080 (10 GB) | AMD® Radeon™ RX 6800 XT (16 GB)',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '60 GB ruang tersedia',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 13,
            'genres' => ['simulation', 'strategy'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 563999,
                    'discount' => 60,
                    'url' => 'https://store.steampowered.com/app/949230/',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 563999,
                    'discount' => 55,
                    'url' => 'https://www.gog.com/en/games?query=Cities%3A+Skylines+II',
                ],
            ],
        ],
        [
            'slug' => 'hollow-knight-silksong',
            'title' => 'Hollow Knight: Silksong',
            'appid' => 1030300,
            'description' => 'Discover a vast, haunted kingdom in Hollow Knight: Silksong! Explore, fight and survive as you ascend to the peak of a land ruled by silk and song.',
            'developer' => 'Team Cherry',
            'publisher' => 'Team Cherry',
            'release_date' => '2025-09-04',
            'rating' => 9.2,
            'rating_count' => 50430,
            'cover_image' => '/covers/hollow-knight-silksong-card.jpg',
            'portrait_image' => '/covers/hollow-knight-silksong-portrait.jpg',
            'hero_image' => '/covers/hollow-knight-silksong-hero.jpg',
            'wide_image' => '/covers/hollow-knight-silksong-header.jpg',
            'screenshots' => ['/screenshots/hollow-knight-silksong-1.jpg', '/screenshots/hollow-knight-silksong-2.jpg', '/screenshots/hollow-knight-silksong-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 version 21H1 (build 19043) or newer',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i3-3240, AMD FX-4300',
                ],
                [
                    'label' => 'Memori',
                    'value' => '4 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce GTX 560 Ti (1GB), Radeon HD 7750 (1GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 10',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '8 GB ruang tersedia',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 version 21H1 (build 19043) or newer',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-3470',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'GeForce GTX 1050 (2GB), Radeon R9 380 (2GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 10',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '8 GB ruang tersedia',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 14,
            'genres' => ['indie', 'action', 'adventure'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 165999,
                    'discount' => 15,
                    'url' => 'https://store.steampowered.com/app/1030300/',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 165999,
                    'discount' => 15,
                    'url' => 'https://www.gog.com/en/games?query=Hollow+Knight%3A+Silksong',
                ],
            ],
        ],
        [
            'slug' => 'assassins-creed-shadows',
            'title' => 'Assassin’s Creed Shadows',
            'appid' => 3159330,
            'description' => 'Experience an epic action-adventure story set in feudal Japan! Become a lethal shinobi assassin and powerful legendary samurai as you explore a beautiful open world in a time of chaos.',
            'developer' => 'Ubisoft Quebec, Ubisoft Belgrade, Ubisoft Bordeaux, Ubisoft Bucharest & Craiova, Ubisoft Chengdu, Ubisoft Montpellier, Ubisoft Montreal, Ubisoft Osaka, Ubisoft Philippines, Ubisoft Shanghai, Ubisoft Singapore, Ubisoft Sofia, Ubisoft Ukraine',
            'publisher' => 'Ubisoft',
            'release_date' => '2025-03-19',
            'rating' => 7.9,
            'rating_count' => 61220,
            'cover_image' => '/covers/assassins-creed-shadows-card.jpg',
            'portrait_image' => '/covers/assassins-creed-shadows-portrait.jpg',
            'hero_image' => '/covers/assassins-creed-shadows-hero.jpg',
            'wide_image' => '/covers/assassins-creed-shadows-header.jpg',
            'screenshots' => ['/screenshots/assassins-creed-shadows-1.jpg', '/screenshots/assassins-creed-shadows-2.jpg', '/screenshots/assassins-creed-shadows-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'INTEL® Core TM i7 8700K AMD RYZEN 5 3600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA® GEFORCE GTX 1650 4GB / AMD RX-5500 XT 8GB / INTEL® ARC TM A380 6GB (REBAR ON)"',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '115 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'The game must be installed on a SSD.',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i5 11600k/AMD Ryzen™ 5 5600x',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'Nvidia® GeForce RTX™ 3060Ti 8GB/AMD Radeon™ RX 6700 XT 12GB/Intel® Arc™ B580 12GB (REBAR ON)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '115 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'The game must be installed on a SSD.',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 15,
            'genres' => ['action', 'adventure', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 799000,
                    'discount' => 45,
                    'url' => 'https://store.steampowered.com/app/3159330/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 799000,
                    'discount' => 40,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Assassin%E2%80%99s+Creed+Shadows',
                ],
            ],
        ],
        [
            'slug' => 'resident-evil-4',
            'title' => 'Resident Evil 4',
            'appid' => 2050650,
            'description' => 'Survival is just the beginning. Six years have passed since the biological disaster in Raccoon City. Leon S. Kennedy, one of the survivors, tracks the president\'s kidnapped daughter to a secluded European village, where there is something terribly wrong with the locals.',
            'developer' => 'CAPCOM Co., Ltd.',
            'publisher' => 'CAPCOM Co., Ltd.',
            'release_date' => '2023-03-23',
            'rating' => 9.1,
            'rating_count' => 187660,
            'cover_image' => '/covers/resident-evil-4-card.jpg',
            'portrait_image' => '/covers/resident-evil-4-portrait.jpg',
            'hero_image' => '/covers/resident-evil-4-hero.jpg',
            'wide_image' => '/covers/resident-evil-4-header.jpg',
            'screenshots' => ['/screenshots/resident-evil-4-1.jpg', '/screenshots/resident-evil-4-2.jpg', '/screenshots/resident-evil-4-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (64 bit)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'AMD Ryzen 3 1200 / Intel Core i5-7500',
                ],
                [
                    'label' => 'Memori',
                    'value' => '8 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'AMD Radeon RX 560 with 4GB VRAM / NVIDIA GeForce GTX 1050 Ti with 4GB VRAM',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'Estimated performance (when set to Prioritize Performance): 1080p/45fps. ・Framerate might drop in graphics-intensive scenes. ・AMD Radeon RX 6700 XT or NVIDIA GeForce RTX 2060 required to support ray tracing.',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (64 bit)/Windows 11 (64 bit)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'AMD Ryzen 5 3600 / Intel Core i7 8700',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'AMD Radeon RX 5700 / NVIDIA GeForce GTX 1070',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'Estimated performance: 1080p/60fps ・Framerate might drop in graphics-intensive scenes. ・AMD Radeon RX 6700 XT or NVIDIA GeForce RTX 2070 required to support ray tracing.',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 16,
            'genres' => ['action', 'adventure', 'horror'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 519000,
                    'discount' => 55,
                    'url' => 'https://store.steampowered.com/app/2050650/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 519000,
                    'discount' => 50,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Resident+Evil+4',
                ],
            ],
        ],
        [
            'slug' => 'starfield',
            'title' => 'Starfield',
            'appid' => 1716740,
            'description' => 'Starfield is the first new universe in 25 years from Bethesda Game Studios, the award-winning creators of The Elder Scrolls V: Skyrim and Fallout 4.',
            'developer' => 'Bethesda Game Studios',
            'publisher' => 'Bethesda Softworks',
            'release_date' => '2023-09-05',
            'rating' => 7.2,
            'rating_count' => 141290,
            'cover_image' => '/covers/starfield-card.jpg',
            'portrait_image' => '/covers/starfield-portrait.jpg',
            'hero_image' => '/covers/starfield-hero.jpg',
            'wide_image' => '/covers/starfield-header.jpg',
            'screenshots' => ['/screenshots/starfield-1.jpg', '/screenshots/starfield-2.jpg', '/screenshots/starfield-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 version 21H1 (10.0.19043)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'AMD Ryzen 5 2600X, Intel Core i7-6800K',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'AMD Radeon RX 5700, NVIDIA GeForce 1070 Ti',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '125 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD Required',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => '',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11 with updates',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'AMD Ryzen 5 3600X, Intel i5-10600K',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'AMD Radeon RX 6800 XT, NVIDIA GeForce RTX 2080',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '125 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD Required',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 17,
            'genres' => ['rpg', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 699000,
                    'discount' => 70,
                    'url' => 'https://store.steampowered.com/app/1716740/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 699000,
                    'discount' => 60,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Starfield',
                ],
            ],
        ],
        [
            'slug' => 'a-plague-tale-requiem',
            'title' => 'A Plague Tale: Requiem',
            'appid' => 1182900,
            'description' => 'Embark on a heartrending journey into a brutal, breathtaking world, and discover the cost of saving those you love in a desperate struggle for survival. Strike from the shadows or unleash hell with a variety of weapons, tools and unearthly powers.',
            'developer' => 'Asobo Studio',
            'publisher' => 'Focus Entertainment',
            'release_date' => '2022-10-18',
            'rating' => 8.4,
            'rating_count' => 53210,
            'cover_image' => '/covers/a-plague-tale-requiem-card.jpg',
            'portrait_image' => '/covers/a-plague-tale-requiem-portrait.jpg',
            'hero_image' => '/covers/a-plague-tale-requiem-hero.jpg',
            'wide_image' => '/covers/a-plague-tale-requiem-header.jpg',
            'screenshots' => ['/screenshots/a-plague-tale-requiem-1.jpg', '/screenshots/a-plague-tale-requiem-2.jpg', '/screenshots/a-plague-tale-requiem-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (20H1 64 bits)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-4690K (3.5 GHz)/AMD FX-8300 (3.3 GHz)',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => '4 GB, GeForce GTX 970/Radeon RX 590',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '55 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => '30 FPS, 1920x1080 in low. DirectX 12 Feature Level 12 and Shader Model 6.0 are needed.',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10 (20H1 64 bits)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i7-8700K (3.7 GHz) / AMD Ryzen 5 3600 (3.6 GHz)',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => '8 GB, GeForce RTX 3070/Radeon RX 6800 XT',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '55 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => '60 FPS, 1920x1080 in ultra. SSD storage is recommended.',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 18,
            'genres' => ['adventure', 'action'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 539000,
                    'discount' => 75,
                    'url' => 'https://store.steampowered.com/app/1182900/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 539000,
                    'discount' => 70,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=A+Plague+Tale%3A+Requiem',
                ],
                [
                    'platform' => 'gog',
                    'normal' => 539000,
                    'discount' => 75,
                    'url' => 'https://www.gog.com/en/games?query=A+Plague+Tale%3A+Requiem',
                ],
            ],
        ],
        [
            'slug' => 'marvels-spider-man-2',
            'title' => 'Marvel\'s Spider-Man 2',
            'appid' => 2651280,
            'description' => 'Be Greater. Together. The incredible power of the symbiote forces Peter Parker and Miles Morales into a desperate fight as they balance their lives, friendships, and their duty to protect in an exciting chapter of the critically acclaimed Spider-Man franchise on PC.',
            'developer' => 'Insomniac Games, Nixxes Software',
            'publisher' => 'PlayStation Publishing LLC',
            'release_date' => '2025-01-30',
            'rating' => 8.8,
            'rating_count' => 96510,
            'cover_image' => '/covers/marvels-spider-man-2-card.jpg',
            'portrait_image' => '/covers/marvels-spider-man-2-portrait.jpg',
            'hero_image' => '/covers/marvels-spider-man-2-hero.jpg',
            'wide_image' => '/covers/marvels-spider-man-2-header.jpg',
            'screenshots' => ['/screenshots/marvels-spider-man-2-1.jpg', '/screenshots/marvels-spider-man-2-2.jpg', '/screenshots/marvels-spider-man-2-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11 (version 1909 or higher)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i3-8100 or AMD Ryzen 3 3100',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GeForce GTX 1650 or AMD Radeon RX 5500 XT',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '140 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD Required',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows 10/11 (version 1909 or higher)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel Core i5-8400 or AMD Ryzen 5 3600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA GeForce RTX 3060 or AMD Radeon RX 5700',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '140 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD Required',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 19,
            'genres' => ['action', 'adventure', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 879000,
                    'discount' => 40,
                    'url' => 'https://store.steampowered.com/app/2651280/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 879000,
                    'discount' => 35,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=A+Plague+Tale%3A+Requiem',
                ],
            ],
        ],
        [
            'slug' => 'monster-hunter-wilds',
            'title' => 'Monster Hunter Wilds',
            'appid' => 2246340,
            'description' => 'The unbridled force of nature runs wild and relentless, with environments transforming drastically from one moment to the next. This is a story of monsters and humans and their struggles to live in harmony in a world of duality.',
            'developer' => 'CAPCOM Co., Ltd.',
            'publisher' => 'CAPCOM Co., Ltd.',
            'release_date' => '2025-02-27',
            'rating' => 8.5,
            'rating_count' => 74420,
            'cover_image' => '/covers/monster-hunter-wilds-card.jpg',
            'portrait_image' => '/covers/monster-hunter-wilds-portrait.jpg',
            'hero_image' => '/covers/monster-hunter-wilds-hero.jpg',
            'wide_image' => '/covers/monster-hunter-wilds-header.jpg',
            'screenshots' => ['/screenshots/monster-hunter-wilds-1.jpg', '/screenshots/monster-hunter-wilds-2.jpg', '/screenshots/monster-hunter-wilds-3.jpg'],
            'min_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows®10 (64-bit Required)/Windows®11 (64-bit Required)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i5-10400 or Intel® Core™ i3-12100 or AMD Ryzen™ 5 3600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA® GeForce® GTX 1660(VRAM 6GB) or AMD Radeon™ RX 5500 XT(VRAM 8GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '75 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required. This game is expected to run at 1080p (upscaled from 720 native resolution) / 30 fps under the "Lowest" graphics setting. DirectStorage supported.',
                ],
            ],
            'rec_requirements' => [
                [
                    'label' => '',
                    'value' => 'Prosesor 64-bit dan OS diperlukan',
                ],
                [
                    'label' => 'OS',
                    'value' => 'Windows®10 (64-bit Required)/Windows®11 (64-bit Required)',
                ],
                [
                    'label' => 'Prosesor',
                    'value' => 'Intel® Core™ i5-10400 or Intel® Core™ i3-12100 or AMD Ryzen™ 5 3600',
                ],
                [
                    'label' => 'Memori',
                    'value' => '16 GB RAM',
                ],
                [
                    'label' => 'Grafis',
                    'value' => 'NVIDIA® GeForce® RTX 2060 Super(VRAM 8GB) or　AMD Radeon™  RX 6600(VRAM 8GB)',
                ],
                [
                    'label' => 'DirectX',
                    'value' => 'Versi 12',
                ],
                [
                    'label' => 'Jaringan',
                    'value' => 'Koneksi Internet Broadband',
                ],
                [
                    'label' => 'Penyimpanan',
                    'value' => '75 GB ruang tersedia',
                ],
                [
                    'label' => 'Catatan Tambahan',
                    'value' => 'SSD required. This game is expected to run at 1080p / 60 fps (with Frame Generation enabled) under the "Medium" graphics setting. DirectStorage supported.',
                ],
            ],
            'is_featured' => 0,
            'sort_order' => 20,
            'genres' => ['action', 'rpg', 'open-world'],
            'offers' => [
                [
                    'platform' => 'steam',
                    'normal' => 519000,
                    'discount' => 35,
                    'url' => 'https://store.steampowered.com/app/2246340/',
                ],
                [
                    'platform' => 'epic',
                    'normal' => 519000,
                    'discount' => 30,
                    'url' => 'https://store.epicgames.com/en-US/browse?q=Monster+Hunter+Wilds',
                ],
            ],
        ],
    ],
    'sale_events' => [
        [
            'title' => 'Steam Autumn Sale',
            'subtitle' => 'Sale Event',
            'badge' => 'Up to 75% OFF',
            'image' => '/covers/red-dead-redemption-2-hero.jpg',
            'platform' => 'steam',
            'url' => 'https://store.steampowered.com/specials',
            'sort_order' => 1,
        ],
    ],
];
