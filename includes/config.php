<?php
$base_url = "http://localhost/kesiswaan/";

// Mendapatkan segmen URL setelah 'localhost/lat'
$url_segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$current_segment = isset($url_segments[2]) ? $url_segments[2] : '';
