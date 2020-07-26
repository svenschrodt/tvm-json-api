<?php declare(strict_types=1);
/**
 * Abstract test case with project specific assertion(s)
 *
 * @todo Implementing more test analysing JSON response
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /***
     * Asserting, that a given Json data structure has given attributes
     *
     * Since the assertion within "$this->get('/?q=Deadwood')->seeJsonStructure()"
     * seems not to work properly (or as expected by me?), we do this quick & dirty
     * workaround
     *
     * @todo analyze seeJsonStructure() in more detail
     *
     * @param string $json
     * @param array $attributes
     *
     *
     */
    public function assertJsonHasAttributes(string $json, array $attributes)
    {
        $data= json_decode($json);
        // #Checking, if each attribute is set
        foreach($attributes as $name) {
                  $this->assertObjectHasAttribute($name, $data[0]->show);
        };
    }
}
