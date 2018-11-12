<?php

namespace App\Http\Resources;


class MatchResource
{

    /**
     * Create matches resource collection.
     *
     * @param array $matches
     * @return array
     */
    public static function collection(array $matches): array
    {
        $data = [];
        foreach ($matches as $match){
            array_push($data, self::make($match));
        }
        return $data;
    }

    /**
     * Create match resource item.
     *
     * @param array $match
     * @return array
     */
    public static function make(array $match):array
    {
        if(empty($match))
            return [];

        return [
            'id' => $match['id'],
            'name' => $match['name'],
            'next' => $match['next'],
            'winner' => $match['winner'],
            'board' => $match['board'],
        ];
    }
}