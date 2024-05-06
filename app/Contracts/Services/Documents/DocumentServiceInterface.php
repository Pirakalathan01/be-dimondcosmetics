<?php

namespace App\Contracts\Services\Documents;

use App\Models\Document;

interface DocumentServiceInterface
{
    /**
     * @param string $class
     * @param string $id
     * @param array $data
     * @return Document
     */
    public function create(string $class, string $id, array $data): Document;

    /**
     * @param string $id
     */
    public function find(string $id): ?Document;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}
