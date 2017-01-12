<?php

pcntl_signal(SIGALRM, function(int $signal) {
    echo "and there's the alarm!\n";
});

pcntl_async_signals(true);

pcntl_alarm(2);

echo "Alarms work in the middle of sleeps...";
sleep(10); // will get cut short by the alarm
sleep(5); // will execute as normal post-alarm
echo "...and there's the end of the script!\n";
