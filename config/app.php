<?php

return [
    'plugin_path' => ABSPATH . '/wp-content/plugins/' . env('PLUGIN_SLUG'),
    'plugin_file' => env('PLUGIN_PATH', env('WORDPRESS_PATH', ABSPATH)) . env('PLUGIN_FILENAME'),
    'plugin_filename' => env('PLUGIN_FILENAME', env('PLUGIN_SLUG') . '.php'),
    'plugin_uri' => env('WORDPRESS_URI', get_site_url()) . '/wp-content/plugins/' . env('PLUGIN_FILENAME'),
    'plugin_slug' => env('PLUGIN_SLUG', str_slug(env('PLUGIN_FILENAME'))),
    'plugin_namespace' => env('PLUGIN_NAMESPACE'),
    'wordpress_path' => env('WORDPRESS_PATH', ABSPATH),
    'wordpress_uri' => env('WORDPRESS_URI', get_site_url())
];
