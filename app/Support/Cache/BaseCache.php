<?php

namespace App\Support\Cache;

use Illuminate\Support\Facades\Cache;

abstract class BaseCache
{
    abstract public static function tags(): array;

    abstract public static function key(): string;

    /**
     * 
     * @param callable $callback
     * @param int $ttl
     */
    public static function remember(callable $callback, int $ttl = 3600)
    {
        return Cache::tags(static::tags())->remember(
            static::key(),
            now()->addSeconds($ttl),
            $callback
        );
    }

    public static function forget()
    {
        return Cache::tags(static::tags())
            ->forget(static::key());
    }
}
