<?php declare(strict_types=1);
/**
 * Middleware calling external TVMaze's JSON API endpoint
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

namespace App\Http\Middleware;

use Closure;

class RequestJson
{


    /**
     * URI of external API endpoint
     *
     * @var string
     */
    protected $externalApi = '';


    /**
     * Time to live for static file cache
     *
     * @var int
     */
    protected $cacheTtl =0;

    /**
     * Handle external request for an incoming request, if data is not cached
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->externalApi = config('main.extApi');
        $this->cacheTtl = config('main.cacheTtl');

        return $next($request);
    }


    protected function callExternalApi(string $query)
    {

    }


    protected function filterResults(string $query)
    {

    }

    protected function checkIfInCache(string $query)
    {

    }
}
