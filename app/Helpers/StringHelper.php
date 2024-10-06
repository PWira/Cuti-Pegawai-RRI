<?php

if (!function_exists('format_jenis_cuti')) {
    function format_jenis_cuti($jenis_cuti) {
        return ucwords(str_replace('_', ' ', $jenis_cuti));
    }
}

if (!function_exists('format_jabatan')) {
    function format_jabatan($jabatan) {
        return ucwords(str_replace('_', ' ', $jabatan));
    }
}

if (!function_exists('format_status')) {
    function format_status($status) {
        return ucwords(str_replace('_', ' ', $status));
    }
}