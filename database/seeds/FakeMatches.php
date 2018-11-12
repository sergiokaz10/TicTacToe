<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Redis;


class FakeMatches extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Match',
                'next' => 2,
                'winner' => 1,
                'board' => [
                    1, 0, 2,
                    0, 1, 2,
                    0, 2, 1,
                ],
            ],
            [
                'name' => 'Match',
                'next' => 1,
                'winner' => 0,
                'board' => [
                    1, 0, 2,
                    0, 1, 2,
                    0, 0, 0,
                ],
            ],
            [
                'name' => 'Match',
                'next' => 1,
                'winner' => 0,
                'board' => [
                    1, 0, 2,
                    0, 1, 2,
                    0, 2, 0,
                ],
            ],

        ];

        foreach ($data as $match){
            $id = uniqid();
            $match['id'] = $id;
            $match['name'] .= ' - ' .$this->getNumber();
            Redis::set("match:$id", json_encode( $match ) );
        }

    }

    /**
     * Return number of match
     *
     * @return int
     */
    public function getNumber(): int
    {
        return Redis::incr('matches:count');
    }
}
