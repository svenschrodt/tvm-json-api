<?php declare(strict_types=1);

/**
 * Unit testing for index controller
 *
 * - Checking status codes and content type at this point only :(
 *
 * @todo Implementing more tests analysing JSON response
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
use App\Meta\Mapping;

class IndexControllerTest extends TestCase
{

    /**
     * Checking valid request route for status code 'OK'
     *
     */
    public function testIFStatusCodeIsOk()
    {
        $response = $this->call('GET', '/?q=Deadwood');
        $this->assertEquals(200, $response->status());
    }


    /**
     * Checking invalid request route for status code 'FILE NOT FOUND'
     *
     */
    public function testIFStatusCodeIsFileNotFound()
    {
        $response = $this->call('GET', '/Fooo/?q=America');
        $this->assertEquals(404, $response->status());
    }

    /**
     * Asserting, "normal" response is JSON
     */
    public function testIfResponseIsJson()
    {
        $this->get('/?q=Deadwood')->shouldReturnJson();
    }


    /**
     *  Asserting, error message response by requested invalid route is JSON
     *
     */
    public function testIfErrorResponseIsJson()
    {
        $this->get('/FOO/?q=Deadwood')->shouldReturnJson();
    }


    /**
     * Testing if json data structure of API response contains relevant attributes
     *
     * Workaround - @see TestCase::assertJsonHasAttributes() for explanation
     *
     * @return void
     */
    public function testIfJsonResponseContainsRequiredAttributes()
    {


        // Getting list of attributes of property show
        $mappping = new Mapping();
        // performing assertion for each attribute
        $this->assertJsonHasAttributes($this->get('/?q=Deadwood')->response->getContent(), $mappping->getShowAttributes());

        //@todo Checking this commented assertion below -> currently PHPUnit throws:
        // '1) IndexControllerTest::testIndexController
        //  Failed asserting that an array has the key 'id'.'
        //
        //        $this->get('/?q=Deadwood')->seeJsonStructure(['show' => [
        //            'id', 'url', 'name', 'type', 'language', 'genres', 'status', 'runtime',
        //            'premiered', 'officialSite', 'schedule', 'rating', 'weight', 'network'
        //        ]]);
    }
}
