<?php

namespace App\Services\AdminPortal;


use App\Contracts\Repositories\AdminPortal\CustomerRepositoryInterface;
use App\Contracts\Services\AdminPortal\CustomerServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class CustomerService implements CustomerServiceInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->customerRepository->all($columns);
    }

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->customerRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->customerRepository->create($data);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return $this->customerRepository->find($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        if (isset($data['password'])) $data['password'] = Hash::make($data['password']);
        return $this->customerRepository->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->customerRepository->delete($id);
    }


}
