<?php declare(strict_types=1);
/**
 * Custom configuration file
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

return ['extApi' => 'https://api.tvmaze.com/search/shows?q=',  // external API endpoint
        'cacheTtl' => 3600,                                    // TTL of cache content
        'queryTarget' => 'show.name'];                        // 'path' to targeted query value
