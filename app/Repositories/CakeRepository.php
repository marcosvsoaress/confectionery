<?php

namespace App\Repositories;

use App\Contracts\CakeRepositoryInterface;
use App\Models\Cake;
use App\Models\CakeInterestList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

class CakeRepository implements CakeRepositoryInterface
{
    /**
     * @param array $cake
     * @return Cake
     */
    public function create(array $cake): Cake
    {
        return Cake::create($cake);
    }

    /**
     * @param int $cakeId
     * @return Cake
     */
    public function get(int $cakeId): Cake
    {
        return Cake::findOrFail($cakeId);
    }

    /**
     * @param int $itemsPerPage
     * @return AbstractPaginator
     */
    public function getList($itemsPerPage = 10): AbstractPaginator
    {
        return Cake::paginate($itemsPerPage);
    }

    /**
     * @return Collection
     */
    public function getInterestListCakeWithStoke(): Collection
    {
        return Cake::with('interestList')->where('quantity', '>', 0)->get();
    }

    /**
     * @param array $cakeData
     * @param $cakeId
     * @return Cake
     */
    public function update(array $cakeData, $cakeId): Cake
    {
        $cake = $this->get($cakeId);
        $cake->fill($cakeData)->save();
        return $cake;
    }

    /**
     * @param int $cakeId
     * @return bool
     */
    public function delete(int $cakeId): bool
    {
        $cake = $this->get($cakeId);
        return $cake->delete();
    }

    /**
     * @param array $data
     * @param $cakeId
     * @return CakeInterestList
     */
    public function create_interest_list(array $data, $cakeId): CakeInterestList
    {
        $interestList = new CakeInterestList($data);

        /**
         * @var Cake
         */
        $cake = $this->get($cakeId);
        $cake->InterestList()->save($interestList);

        return $interestList;
    }
}
