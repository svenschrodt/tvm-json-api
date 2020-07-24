<?php declare(strict_types=1);
/**
 * Defining route(s) to API endpoint(s)
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */


/**
 * @var \Laravel\Lumen\Routing\Router $router
 */
// Only allowed route: invoking search action of index controller
$router->get('/', ['uses' => 'IndexController@search']);

