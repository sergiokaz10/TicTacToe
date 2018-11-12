<?php

namespace App\Repositories;


use App\Contracts\MatchRepositoryInterface;
use App\Services\Match;

class MatchRepository implements MatchRepositoryInterface
{

    /**
     * @return array
     */
    public function all(): array
    {
        return Match::all();
    }

    /**
     * @return void
     */
    public function create(): void
    {
        Match::create();
    }

    /**
     * @param string $id
     * @return array
     */
    public function findById(string $id): array
    {
        $match = Match::findById($id);

        if(is_null($match))
            abort(404);

        return $match;
    }

    /**
     * @param string $id
     * @param array $params
     * @return array
     */
    public function update(string $id, array $params): array
    {
        if(is_null(Match::findById($id)))
            abort(404);

        return Match::update($id, $params);
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        if(is_null(Match::findById($id)))
            abort(404);

        Match::delete($id);
    }
}