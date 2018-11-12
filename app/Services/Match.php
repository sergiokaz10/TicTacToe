<?php

namespace App\Services;


use Illuminate\Support\Facades\Redis;

class Match
{
    /**
     * Store new match
     *
     * @return void
     */
    public static function create():void
    {
        $id = uniqid();
        $data = [
            'id' => $id,
            'name' => 'Match - ' . self::getNumber(),
            'next' => 1,
            'winner' => 0,
            'board' => [
                0, 0, 0,
                0, 0, 0,
                0, 0, 0,
            ],
        ];

        Redis::set("match:$id", json_encode( $data ) );
    }


    /**
     * Returns all actives matches
     *
     * @return array
     */
    public static function all():array
    {
        $keys = self::getKeys();
        $matches = [];

        foreach ($keys as $key){
            array_push($matches, json_decode(Redis::get($key), true));
        }

        return $matches;
    }

    /**
     * Return by id
     *
     * @param string $id
     * @return array|null
     */
    public static function findById(string $id)
    {
        return json_decode(Redis::get("match:$id"), true);
    }


    /**
     * Update match and determine if has winner
     *
     * @param string $id
     * @param array $params
     *
     * @return array
     */
    public static function update(string $id, array $params):array
    {
        $data = self::findById($id);
        $data['board'][$params['position']] = $data['next'];
        $data['winner'] = self::hasWinner($data['board']);
        $data['next'] = ($data['next'] == 1 ? 2 : 1);

        Redis::set("match:$id", json_encode( $data ) );
        return $data;
    }


    /**
     * Determine if has winner
     *
     * @param array $board
     * @return int
     */
    public static function hasWinner(array $board): int
    {
        $d1 = $board[0];
        $d2 = $board[2];

        for( $i=0; $i<3; $i++ ){

            $row = $board[$i * 3];
            $col = $board[$i];

            for( $j = 0; $j < 3; $j++){

                $row = ( $board[$j + $i * 3] == $row ? $row  : 0 );
                $col = ( $board[$j * 3 + $i ] == $col ? $col  : 0 );
            }

            if($row){
                return $row;
            }

            if($col){
                return $col;
            }

            $d1 = ( $board[$i * 4] == $d1 ? $d1  : 0 );
            $d2 = ( $board[($i + 1) * 2 ] == $d2 ? $d2  : 0 );

        }

        if($d1)
            return $d1;

        if($d2)
            return $d2;

        return 0;
    }

    /**
     * Delete match
     *
     * @param string $id
     */
    public static function delete(string $id):void
    {
        Redis::del("match:$id");
    }

    /**
     * Returns list of keys
     *
     * @return array
     */
    public static function getKeys(): array
    {
        return Redis::keys('match:*');
    }

    /**
     * Return number of match
     *
     * @return int
     */
    public static function getNumber(): int
    {
        return Redis::incr('matches:count');
    }
}