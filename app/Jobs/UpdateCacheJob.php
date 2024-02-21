<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class UpdateCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $key;
    protected $serializedClosure;
    protected $ttl;

    public function __construct($key, $serializedClosure, $ttl)
    {
        $this->key = $key;
        $this->serializedClosure = $serializedClosure;
        $this->ttl = $ttl;
    }

    public function handle()
    {
        $closure = unserialize($this->serializedClosure)->getClosure();

        $data = $closure();

        Cache::put($this->key, $data, $this->ttl);
    }
}