<?php

namespace App\Contracts\Repositories\Documents;

use App\Contracts\Repositories\BaseRepositoryInterface;
use App\Models\Document;

interface DocumentRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $data): Document;
}
