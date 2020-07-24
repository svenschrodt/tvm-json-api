<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');
        $cfg = config('main');
        $this->assertEquals(
            3600, $cfg['cacheTtl']
        );
        var_dump($this->app->version());
//strstr($cfg['extApi'],'https'
   $this->assertTrue(substr($cfg['extApi'],0,5)==='https');
    }
}
