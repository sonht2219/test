<?php


namespace App\Services\Impls;


use App\Enums\CommonStatus;
use App\Exceptions\RepositoryException;
use App\Http\Requests\Attribute\AttributeRequest;
use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepository;
use App\Services\Interfaces\AttributeService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AttributeServiceImpl implements AttributeService
{
    private AttributeRepository $attribute_repo;

    public function __construct(AttributeRepository $attribute_repo)
    {
        $this->attribute_repo = $attribute_repo;
    }

    /**
     * @param AttributeRequest $req
     * @return Attribute
     */
    public function create(AttributeRequest $req): Attribute
    {
        return $this->attribute_repo->create($req->validated());
    }

    /**
     * @param int $id
     * @param AttributeRequest $req
     * @return Attribute
     * @throws RepositoryException
     */
    public function edit(int $id, AttributeRequest $req): Attribute
    {
        $attribute = $this->single($id);

        return $this->attribute_repo->update($attribute, $req->validated());
    }

    /**
     * @param int $id
     * @return Attribute
     * @throws RepositoryException
     */
    public function delete(int $id): Attribute
    {
        $attribute = $this->single($id);

        return $this->attribute_repo->update($attribute, ['status' => CommonStatus::INACTIVE]);
    }

    /**
     * @param int $id
     * @return Attribute
     * @throws RepositoryException
     */
    public function single(int $id): Attribute
    {
        return $this->attribute_repo->findByOrFail(compact('id'));
    }

    /**
     * @param int $limit
     * @param string $search
     * @param int $status
     * @return LengthAwarePaginator
     */
    public function list(int $limit, string $search, int $status): LengthAwarePaginator
    {
        $query = $this->attribute_repo->buildQuery();

        if ($search)
            $query->where('title', 'like', "%$search%");

        if ($status)
            $query->where('status', $status);

        return $query->paginate($limit);
    }
}
