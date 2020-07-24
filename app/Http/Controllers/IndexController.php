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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class IndexController extends Controller
{

    public function search(Request $request)
    {

        //@todo --> to config file
        $dta = config('main.extApi');

        $ep = 'https://api.tvmaze.com/search/shows?q='. $request->input('q');
//
        $req= Http::get($ep);
        $response = $req->getBody();
        echo $response ;
     $result = [1,2,3, $request->input('q')];
     return response()->json($result);
    }


}
