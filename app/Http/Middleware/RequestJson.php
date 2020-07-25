<?php declare(strict_types=1);
/**
 * Middleware for each http request:
 *
 * - checking if current search is cached, or
 * - calling external TVMaze's JSON API endpoint
 * - and returning query result
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

use Laravel\Lumen\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Closure;
use App\Models\Show;

class RequestJson
{

    /**
     * Model representing Show data
     *
     * @var \App\Models\Show
     */
    protected $showModel;

    /**
     * RequestJson constructor.
     */
    public function __construct()
    {
        $this->showModel = new Show();
    }


    /**
     * Handle external request for an incoming request, if data is not cached
     * Storing data to cache
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       $caseOff = strtolower($request->input('q'));
        if(!$this->showModel->isInCache($caseOff)) {
            $this->showModel->storeToCache($caseOff,    $this->showModel->callExternalApi($caseOff));
        }
        return $next($request);
    }




}
