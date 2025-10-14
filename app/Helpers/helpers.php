<?php

if (!function_exists('cekRange')) {
    function cekRange($value, $min, $max)
    {
        if ($value === null) return '';
        if ($value >= $min && $value <= $max) {
            return 'text-success';  // contoh class CSS jika sesuai range
        } else {
            return 'text-danger';   // contoh class CSS jika di luar range
        }
    }
}
