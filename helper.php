<?php

function measureResource($callback) {
    $startTime = microtime(true);
    $startMemoryGetUsage = memory_get_usage();
    $startMemoryGetRealUsage = memory_get_usage(true);
    $startMemoryGetPeakUsage = memory_get_peak_usage();
    $startMemoryGetPeakRealUsage = memory_get_peak_usage(true);

    $callback();

    printf('Time: %s' . PHP_EOL, microtime(true) - $startTime);
    printf('Memory get usage: %s' . PHP_EOL, formatBytes(memory_get_usage() - $startMemoryGetUsage));
    printf('Memory get real usage: %s' . PHP_EOL, formatBytes(memory_get_usage(true) - $startMemoryGetRealUsage));
    printf('Memory get peak usage: %s' . PHP_EOL, formatBytes(memory_get_peak_usage() - $startMemoryGetPeakUsage));
    printf('Memory get peak real usage: %s' . PHP_EOL, formatBytes(memory_get_peak_usage(true) - $startMemoryGetPeakRealUsage));
}

function formatBytes($bytes, $precision = 2) {
    $units = array("b", "kb", "mb", "gb", "tb");

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . " " . $units[$pow];
}