<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}


// User Define Constant Start
define('SITE_SUB', '');
define('SITE_HOST', $_SERVER['HTTP_HOST']);
define('SITE_HTTP', ((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http'));

// Define Site URL
define('SITE_URL', SITE_HTTP . '://' . SITE_HOST . SITE_SUB);
define('SITE_URI', $_SERVER['REQUEST_URI']);

require_once __DIR__.'/public/index.php';
