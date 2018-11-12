<?php

namespace App\Http\Controllers;

use App\Contracts\MatchRepositoryInterface;
use App\Http\Resources\MatchResource;
use Illuminate\Http\Request;

class MatchController extends Controller {

    /**
     * @var MatchRepositoryInterface
     */
    protected $matches;

    public function __construct(MatchRepositoryInterface $matches)
    {
        $this->matches = $matches;
    }

    /**
     * Return view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('index');
    }

    /**
     * Returns a list of matches
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all() {
        return response()->json( MatchResource::collection( $this->matches->all() ) );
    }

    /**
     * Returns the state of a single match
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id) {

        return response()->json(
            MatchResource::make( $this->matches->findById( $id ) )
        );
    }

    /**
     * Makes a move in a match
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request) {

        return response()->json(
            MatchResource::make( $this->matches->update( $id, $request->all() ) )
        );
    }

    /**
     * Creates a new match and returns the new list of matches
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store() {
        $this->matches->create();
        return response()->json( MatchResource::collection( $this->matches->all() ) );
    }

    /**
     * Deletes the match and returns the new list of matches
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $id) {
        $this->matches->delete($id);
        return response()->json( MatchResource::collection( $this->matches->all() ) );
    }

}