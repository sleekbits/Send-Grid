<?php

return [
    'session_timeout' => env('SESSION_TIMEOUT_MINUTES', 30),
    'account_lock_threshold' => env('ACCOUNT_LOCK_THRESHOLD', 5),
    'account_lock_minutes' => env('ACCOUNT_LOCK_MINUTES', 30),
];
