<?php

namespace App\Support\Traits;

use Closure;
use Illuminate\Support\Facades\Cache;

trait HasCache
{
    protected function rememberCache(
        string $key,
        array $tags,
        Closure $callback,
        ?int $ttl = 3600
    ) {
        return Cache::tags($tags)->remember(
            $key,
            now()->addSeconds($ttl),
            $callback
        );
    }
}
