<?php

namespace App\Services\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\CardRepositoryInterface;
use App\Contracts\Services\CustomerPortal\CardServiceInterface;
use App\Models\Card;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class CardServices implements CardServiceInterface
{
    /**
     * @var CardRepositoryInterface
     */
    private CardRepositoryInterface $cardRepository;

    /**
     * @param CardRepositoryInterface $cardRepository
     */
    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->cardRepository->all($columns);
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->cardRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Card
    {
        return $this->cardRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Card
    {
        return $this->cardRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Card|null
     */
    public function findBy(string $column, string $value): ?Card
    {
        return $this->cardRepository->findBy($column, $value);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, array $data): bool
    {
        return $this->cardRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return $this->cardRepository->delete($id);
    }
}
