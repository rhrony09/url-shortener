<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;

class UrlShortenerService {
    /**
     * Generate a unique slug
     * 
     * @param int $length
     * @return string
     */
    public function generateSlug($length = 6) {
        $slug = Str::random($length);

        // Ensure slug uniqueness
        while (Url::where('slug', $slug)->exists()) {
            $slug = Str::random($length);
        }

        return $slug;
    }

    /**
     * Create a shortened URL
     * 
     * @param string $originalUrl
     * @param string|null $customSlug
     * @return \App\Models\Url
     * @throws \Exception
     */
    public function createShortUrl($originalUrl, $customSlug = null) {
        // Use custom slug if provided, otherwise generate one
        $slug = $customSlug ?: $this->generateSlug();

        // Check if custom slug already exists
        if ($customSlug && Url::where('slug', $customSlug)->exists()) {
            throw new \Exception('Custom slug already exists');
        }

        // Create and return the URL record
        return Url::create([
            'original_url' => $originalUrl,
            'slug' => $slug,
        ]);
    }

    /**
     * Get original URL by slug
     * 
     * @param string $slug
     * @return string|null
     */
    public function getOriginalUrl($slug) {
        $url = Url::where('slug', $slug)->first();

        if ($url) {
            return $url->original_url;
        }

        return null;
    }
}
