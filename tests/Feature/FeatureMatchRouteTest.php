<?php

namespace Tests\Feature;

use App\Services\Match;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class FeatureMatchRouteTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        Redis::flushDB();
    }

    /**
     * @var array
     */
    protected $structure = [
        'id' ,
        'name' ,
        'next' ,
        'winner' ,
        'board' ,
    ];

    /**
     * @return void
     */
    public function testItStoreAMatch()
    {
        $this->postJson('/api/match')
            ->assertJsonStructure([ '*' => $this->structure ])
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testItReturnsAllMatches()
    {
        Match::create();
        Match::create();

        $this->getJson('/api/match')
            ->assertJsonStructure([ '*' => $this->structure ])
            ->assertJsonCount(2,'*')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testItShowAMatch()
    {
        Match::create();

        $key = Redis::keys('match:*')[0];
        $data = json_decode(Redis::get($key), true);

        $this->getJson('/api/match/' . $data['id'])
            ->assertJsonStructure($this->structure )
            ->assertJson($data)
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testItShowAWrongMatch()
    {
        Match::create();

        $this->getJson('/api/match/fakeid' )
            ->assertStatus(404);
    }

    /**
     * @return void
     */
    public function testItUpdateAMatch()
    {
        Match::create();

        $key = Redis::keys('match:*')[0];
        $formatKey = sscanf($key, "match:%s")[0];

        $data =[
            'position' => 3
        ];

        $this->putJson('/api/match/' . $formatKey, $data)
            ->assertJsonStructure($this->structure )
            ->assertStatus(200);

        $data = json_decode(Redis::get($key), true);

        $this->assertEquals( 1, $data['board'][3] );
        $this->assertEquals( 2, $data['next'] );

    }

    /**
     * @return void
     */
    public function testItDeleteAMatch()
    {
        Match::create();

        $key = Redis::keys('match:*')[0];
        $key = sscanf($key, "match:%s")[0];

        $this->deleteJson('/api/match/' . $key)
            ->assertStatus(200);

        $this->assertNull( Redis::get($key) );
    }


}
