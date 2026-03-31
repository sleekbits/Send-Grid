<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment('Campaign Hub is ready.');
})->purpose('Display an inspiring message');
