<?php

namespace App\Contracts;


interface MatchRepositoryInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return void
     */
    public function create(): void;

    /**
     * @param string $id
     * @return array
     */
    public function findById(string $id): array;

    /**
     * @param string $id
     * @param array $params
     * @return array
     */
    public function update(string $id, array $params): array;

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void;

}