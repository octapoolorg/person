<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class UpdateCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $key;
    protected $callback;
    protected $ttl;

    public function __construct($key, $callback, $ttl)
    {
        $this->key = $key;
        $this->callback = $callback;
        $this->ttl = $ttl;
    }

    public function handle()
    {
        // Execute the callback and update the cache
        $value = call_user_func($this->callback);
        Cache::put($this->key, $value, $this->ttl);
    }
}