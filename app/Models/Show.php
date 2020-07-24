<?php declare(strict_types=1);
/**
 * Model representing entity Show with data originating from external API and being temporary stored in cache
 *
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Show
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
    protected $cacheTtl = 0;

    /**
     * Mode of filtering
     * @var string
     */
    protected $filterMode = 'CONTAINS';

    /**
     * List of valid filter modes
     *
     * @var string[]
     */
    protected $validFilterModes = ['CONTAINS', 'EQUALS'];

    /**
     * RequestJson constructor
     *
     */
    public function __construct()
    {
        $this->externalApi = config('main.extApi');
        $this->cacheTtl = config('main.cacheTtl');
    }

    /**
     * Requesting data by query string from external API
     *
     * @param string $query
     * @return array
     */
    public function callExternalApi(string $query)
    {
        // Getting value from GET parameter q
        $req = Http::get($this->externalApi . $query);

        // Decoding JSON response to PHP data structure for further useage
        $response = json_decode((string)$req->getBody());

        // Returning filtered result
        return $this->filterResults($query, $response);

    }


    /**
     * Filtering result from external API by the following criteria:
     *
     * - non-typo-tolerant
     * - non-case-sensitive
     *
     * @param string $query
     * @param array $data
     * @return array
     */
    public function filterResults(string $query, array $data): array
    {
        /**
         * Array holding response data
         * @var array
         */
        $result = [];

        /**
         * Converting query value to lower case for case insensitive comparison
         * @var string
         */
        $caseOff = strtolower($query);

        /**
         * Iterating over result set, filtering non-typo-tolerant, case-insensitive
         */
        foreach ($data as $item) {
            // Checking if current filter mode
            if ($this->processFilter($item->show->name, $caseOff)) {
                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * Filter current show name by expected value with current filter mode - case-insensitive
     *
     * @param string $current
     * @param $expected
     * @return false|string
     */
    protected function processFilter(string $current, $expected)
    {
        $res = false;

        switch ($this->filterMode) {
            // Name is containing query value - case-insensitive
            case 'CONTAINS':
                if (strstr(strtolower($current), $expected) !== false) {
                    $res = true;
                    break;
                }
            // Name equals query value - case-insensitive
            case 'EQUALS':
                if (strtolower($current) === $expected) {
                    $res = true;
                    break;
                }
        }
        return $res;
    }



    /**
     * Checking if a result for current query exists in cache
     *
     * @param string $query
     * @return bool
     */
    public function isInCache(string $query)
    {
        return Cache::has(strtolower($query));
    }

    /**
     * Adding data for query to cache, setting up application global TTL for it
     *
     * @param string $query
     * @param array $data
     */
    public function storeToCache(string $query, array $data)
    {
        $date = new \DateTime();
        // Adding $this->cacheTtl seconds (from config/main.php) to current date time
        Cache::put(strtolower($query), $data, $date->add(new \DateInterval('PT' . $this->cacheTtl . 'S')));
    }

    /**
     * Adding data for query to cache, setting up application global TTL for it
     *
     * @param string $query
     * @param array $data
     */
    public function retrieveFromCache(string $query)
    {
        return Cache::get(strtolower($query));
    }

    /**
     * Setting mode for filtering query results
     *
     * @param string $mode
     * @return \App\Models\Show
     */
    public function setFilterMode(string $mode): \App\Models\Show
    {
        if (in_array($mode, $this->validFilterModes)) {
            $this->filterMode = $mode;
        }
        return $this;
    }

    /**
     * Getter function for current filter mode
     *
     * @return string
     */
    public function getFilterMode()
    {
        return $this->filterMode;
    }
}
