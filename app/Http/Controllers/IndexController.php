<?php declare(strict_types=1);
/**
 * Default controller
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Laravel\Lumen\Routing\Controller;

class IndexController extends Controller
{
    /***
     * Action method performing search
     * - from cache, if in it
     * - from external TVMaze API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     */
    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        /**
         * Middleware implemented
         * @see \App\Http\Middleware\RequestJson
         *
         * Getting data from cache
         *
         * */
        $result = Cache::get(strtolower($request->input('q')));

        // Encoding response as JSON and send appropriate headers
        return response()->json($result);
    }
}
