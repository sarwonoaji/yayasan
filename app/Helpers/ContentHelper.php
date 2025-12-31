<?php

if (! function_exists('renderContent')) {
    function renderContent($content)
    {
        $content = trim($content);

        // Jika hanya URL Google Maps
        if (
            filter_var($content, FILTER_VALIDATE_URL) &&
            str_contains($content, 'google.com/maps')
        ) {
            // Ambil koordinat
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $content, $c)) {
                $lat = $c[1];
                $lng = $c[2];

                return '<div class="not-prose">
                    <iframe
                      src="https://www.google.com/maps?q='.$lat.','.$lng.'&z=17&output=embed"
                      width="100%"
                      height="450"
                      style="border:0;"
                      loading="lazy"
                      allowfullscreen>
                    </iframe>
                </div>';
            }

            // fallback jika tidak ada koordinat
            return '<div class="not-prose">
                <iframe
                  src="https://www.google.com/maps?q='.urlencode($content).'&output=embed"
                  width="100%"
                  height="450"
                  style="border:0;"
                  loading="lazy"
                  allowfullscreen>
                </iframe>
            </div>';
        }

        // Bukan maps → tampilkan apa adanya
        return $content;
    }
}
