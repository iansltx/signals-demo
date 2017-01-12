<?php

echo "PID: " . posix_getpid() . "\n";

pcntl_signal(SIGINT, function(int $signal) {
    error_log('Got signal ' . $signal . "; And if you want some fun sing ob la di bla da");
    exit();
});

pcntl_signal(SIGINT, function(int $signal, array $sigInfo) { // this replaces the above
    error_log('Got signal ' . $signal . "; And if you want some fun sing ob la di bla da");
    echo "Signal info (new in 7.1!): " . json_encode($sigInfo, JSON_PRETTY_PRINT) . "\n";
    sleep(1); // still in the main execution thread!
    exit();
});

$lyrics = ['Ob la di', 'ob la da', 'life goes on', 'bra', 'la la how the life goes on'];

pcntl_async_signals(true);

for ($i = 0;; $i++) {
    echo $lyrics[$i % count($lyrics)] . "\n";
    usleep(500000);
}
