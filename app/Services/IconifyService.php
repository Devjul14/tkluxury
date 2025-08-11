<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class IconifyService
{
    const API_URL = 'https://api.iconify.design';

    public const PREFIX = 'fa6-solid';

    public static function getIcons()
    {
        return Cache::remember('iconify-icons:' . self::PREFIX, now()->addDay(), function () {
            $response = Http::get(self::API_URL . '/collection?pretty=1&prefix=' . self::PREFIX);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();

            $uncategorized = $data['uncategorized'] ?? [];
            $categories = $data['categories'] ?? [];

            $categorizedIcons = Arr::flatten(array_values($categories));
            $allIcons = array_merge($uncategorized, $categorizedIcons);
            $uniqueIcons = array_unique($allIcons);
            sort($uniqueIcons);

            return $uniqueIcons;
        });
    }

    public static function getIcon(string $icon, ?string $color = null)
    {
        // yellow
        $color = $color ?? '#FFC107';
        return sprintf('%s/%s/%s.svg?height=16&color=%s', self::API_URL, self::PREFIX, $icon, urlencode($color));
    }
}
