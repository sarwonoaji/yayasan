<?php
if (! function_exists('renderContent')) {
    function renderContent($content)
    {
        $content = html_entity_decode(trim($content));
        $zoom = 15;

        /**
         * =========================
         * 1. oEmbed Google Maps SAJA
         * =========================
         */
        if (
            preg_match(
                '/^<oembed[^>]*url="([^"]+google\.com\/maps[^"]+)"[^>]*><\/oembed>$/i',
                $content,
                $m
            )
        ) {
            $url = $m[1];

            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $c)) {
                $lat = $c[1];
                $lng = $c[2];

                return '
                <div class="not-prose space-y-4">
                    <iframe
                        src="https://www.google.com/maps?q='.$lat.','.$lng.'&z='.$zoom.'&output=embed"
                        width="100%"
                        height="450"
                        style="border:0;"
                        loading="lazy"
                        allowfullscreen>
                    </iframe>
                </div>';
            }
        }

        /**
         * =========================
         * 2. URL Google Maps polos SAJA
         * =========================
         */
        if (
            filter_var($content, FILTER_VALIDATE_URL) &&
            str_contains($content, 'google.com/maps')
        ) {
            return '
            <div class="not-prose space-y-4">
                <iframe
                    src="https://www.google.com/maps?q='.urlencode($content).'&z='.$zoom.'&output=embed"
                    width="100%"
                    height="450"
                    style="border:0;"
                    loading="lazy"
                    allowfullscreen>
                </iframe>
            </div>';
        }

        /**
         * =========================
         * 3. Ada konten lain → biarkan
         * =========================
         */
        return $content;
    }
}
