<?php

function measureResource($callback) {
    $startTime = microtime(true);
    $startMemoryGetUsage = memory_get_usage();
    $startMemoryGetRealUsage = memory_get_usage(true);
    $startMemoryGetPeakUsage = memory_get_peak_usage();
    $startMemoryGetPeakRealUsage = memory_get_peak_usage(true);

    $callback();

    printf('Time: %s' . PHP_EOL, microtime(true) - $startTime);
    printf('Memory get usage: %s kb' . PHP_EOL, (memory_get_usage() - $startMemoryGetUsage)/1024);
    printf('Memory get real usage: %s kb' . PHP_EOL, (memory_get_usage(true) - $startMemoryGetRealUsage)/1024);
    printf('Memory get peak usage: %s kb' . PHP_EOL, (memory_get_peak_usage() - $startMemoryGetPeakUsage)/1024);
    printf('Memory get peak real usage: %s kb' . PHP_EOL, (memory_get_peak_usage(true) - $startMemoryGetPeakRealUsage)/1024);
}