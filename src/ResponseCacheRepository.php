<?php

namespace Vis\FullCache;

use Illuminate\Contracts\Config\Repository as Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Cache;

class ResponseCacheRepository
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @var \Spatie\ResponseCache\ResponseSerializer
     */
    protected $responseSerializer;

    /**
     * @var string
     */
    protected $cacheStoreName;

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \Spatie\ResponseCache\ResponseSerializer     $responseSerializer
     */
    public function __construct(ResponseSerializer $responseSerializer)
    {

        $this->responseSerializer = $responseSerializer;
    }

    /**
     * @param string                                     $key
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param \DateTime|int                              $minutes
     */
    public function put($key, $response)
    {
   /*
        Cache::forever($key, $this->responseSerializer->serialize($response));
*/

        Cache::tags(config('full_cache.tagsCache'))->put($key, $this->responseSerializer->serialize($response), 100);

    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return Cache::tags(config('full_cache.tagsCache'))->has($key);
    }

    /**
     * @param string $key
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get($key)
    {
        return $this->responseSerializer->unserialize(Cache::tags(config('full_cache.tagsCache'))->get($key));
    }

}
