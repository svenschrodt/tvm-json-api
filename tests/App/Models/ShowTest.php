<?php declare(strict_types=1);

/**
 * Unit testing for model 'Show'
 *
 * @package tvm-json-api
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.9
 * @since 2020-07-24
 * @link https://github.com/svenschrodt/tvm-json-api
 * @link https://travis-ci.org/github/svenschrodt/tvm-json-api
 * @license https://github.com/svenschrodt/tvm-json-api/blob/master/LICENSE.md
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Show;
use Illuminate\Support\Facades\Cache;
use App\Meta\Mapping;

class ShowTest extends TestCase
{
    /**
     * Testing if data could be retrieved from external API and checking attributes
     *
     * @return void
     */
    public function testExternalApi()
    {
        $sw = new Show();
        $result = $sw->callExternalApi('Deadwood');
        $this->assertIsArray($result);
        // External API query result could be empty, so we test for properties only, if it is not
        if(!empty($result)) {
            // Iterating over list of attribute names
            foreach(Mapping::getShowAttributes() as $att) {
                // Checking, if attribute is set
                $this->assertObjectHasAttribute($att, $result[0]->show);
            }
        }

    }

    /**
     * Testing caching functionality
     *
     * @return void
     */
    public function testCaching()
    {
        Cache::flush();
        $sw = new Show();
        $sw->storeToCache('foo', [1, 22, 55, 998]);
        $cached = $sw->retrieveFromCache('foo');
        $this->assertTrue( $sw->isInCache('foo'));
        $this->assertIsArray($cached);
        $this->assertTrue(count($cached) == 4);
        $this->assertTrue($cached[2] === 55);
    }

    /**
     * Testing valid and invalid filter mode settings
     */
    public function testFilterSetting()
    {

        $sw = new Show();
        $this->assertEquals($sw->getFilterMode(), 'CONTAINS');
        $this->assertEquals($sw->setFilterMode('FOO')->getFilterMode(), 'CONTAINS');
        $this->assertEquals($sw->setFilterMode('EQUALS')->getFilterMode(), 'EQUALS');

    }
}
