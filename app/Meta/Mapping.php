<?php declare(strict_types=1);
/**
 * Meta information for (optional) mapping data structure from external API
 *
 * - currently only used for usage in unit testing
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

namespace App\Meta;

class Mapping
{
    /**
     * List of attributes of 'show'property from external API
     *
     * @var string[]
     */
    protected static $showAttributes = [
        'id', 'url', 'name', 'type', 'language', 'genres', 'status', 'runtime',
        'premiered', 'officialSite', 'schedule', 'rating', 'weight', 'network'
    ];

    /**
     * Getter function for attributes of 'show' property from external API
     *
     * @return array|string[]
     */
    public static function getShowAttributes() : array
    {
        return self::$showAttributes;
    }
}
