<?php
/**
 * Polylang — đã loại bỏ khỏi INOX FUTURE
 * File giữ lại để tránh lỗi require_once nếu có file nào gọi
 */

// Stub pll__ để không lỗi nếu còn sót reference
if (!function_exists('pll__')) {
    function pll__($string) { return $string; }
}
if (!function_exists('pll_e')) {
    function pll_e($string) { echo $string; }
}
if (!function_exists('pll_current_language')) {
    function pll_current_language($field = 'slug') { return 'vi'; }
}
if (!function_exists('pll_the_languages')) {
    function pll_the_languages($args = []) { return []; }
}
if (!function_exists('pll_get_post')) {
    function pll_get_post($id) { return $id; }
}
if (!function_exists('pll_register_string')) {
    function pll_register_string($name, $string, $group) {}
}
