<?php

namespace App\Contracts;

use App\Models\Cake;
use App\Models\CakeInterestList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;

interface CakeRepositoryInterface
{
    /**
     * @param array $cake
     * @return Cake
     */
    public function create(array $cake) : Cake;

    /**
     * @param int $cakeId
     * @return Cake
     */
    public function get(int $cakeId) : Cake;

    /**
     * @param int $itemsPerPage
     * @return AbstractPaginator
     */
    public function getList($itemsPerPage = 10) : AbstractPaginator;

    /**
     * @return Collection
     */
    public function getInterestListCakeWithStoke() : Collection;

    /**
     * @param array $cakeData
     * @param $cakeId
     * @return Cake
     */
    public function update(array $cakeData, $cakeId) : Cake;

    /**
     * @param int $cakeId
     * @return bool
     */
    public function delete(int $cakeId) : bool;

    /**
     * @param array $data
     * @param $cakeId
     * @return CakeInterestList
     */
    public function create_interest_list(array $data, $cakeId) : CakeInterestList;
}
