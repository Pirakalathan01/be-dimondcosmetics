<?php

namespace App\Services\Role;

use App\Contracts\Repositories\Role\RoleRepositoryInterface;
use App\Contracts\Services\Role\RoleServiceInterface;
use Spatie\Permission\Models\Role;

/**
 *
 */
class RoleService implements RoleServiceInterface
{
    /**
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $roleRepository;

    /**
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Role
    {
        return $this->roleRepository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $column, string $value): ?Role
    {
        return $this->roleRepository->findBy($column, $value);
    }
}
