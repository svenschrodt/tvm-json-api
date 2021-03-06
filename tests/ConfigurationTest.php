<?php declare(strict_types=1);

/**
 * Unit testing for application's configuration
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ConfigurationTest extends TestCase
{
    /**
     * Testing application configuration - config/main.php
     *
     * @return void
     */
    public function testMainConfig()
    {
      //  retrieving main configuration
        $cfg = config('main');

        // @todo Checking for int!!!
        // Testing, if TTL is integer
        $this->assertIsInt($cfg['cacheTtl']);

        // Testing, if schema of external API endpoint's URL is https
        $this->assertTrue(substr($cfg['extApi'], 0, 5) === 'https');
    }
}
