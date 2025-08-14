<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Mengambil nilai pengaturan dari database dengan dukungan multi-bahasa.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        // Jika pengaturan tidak ditemukan, kembalikan nilai default
        if (!$setting) {
            return $default;
        }

        // Ambil kode bahasa (locale) yang sedang aktif
        $locale = app()->getLocale();
        // dd($locale);
        // 1. Logika untuk data JSON (termasuk multi-bahasa)
        if ($setting->type === 'json') {
            $locale = app()->getLocale();
            $decodedValue = json_decode($setting->value, true);

            // TAMBAHKAN KEDUA BARIS INI UNTUK DEBUG
            // dd([
            //     'locale_aktif' => $locale,
            //     'hasil_json_decode' => $decodedValue,
            //     'apakah_locale_ada_di_json' => isset($decodedValue[$locale]),
            // ]);

            if (is_array($decodedValue) && isset($decodedValue[$locale])) {
                return $decodedValue[$locale];
            }
            return $default;
        }

        // 2. Logika untuk tipe data boolean
        if ($setting->type === 'boolean') {
            return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
        }

        // 3. Logika untuk tipe data lain (misalnya 'text', 'image', dll.)
        return $setting->value;
    }
}
