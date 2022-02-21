<?php

namespace App\Http\Controllers;

use App\Contracts\CakeRepositoryInterface;
use App\Http\Requests\StoreCakeRequest;
use App\Http\Requests\UpdateCakeRequest;
use App\Http\Resources\CakeResource;
use App\Http\Resources\CakeResourceCollection;
use App\Repositories\CakeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Throwable;

class CakeController extends Controller
{
    /**
     *
     * @var CakeRepository $cakeRepository
     */
    private $cakeRepository;

    function __construct(CakeRepositoryInterface $cakeRepository)
    {
        $this->cakeRepository = $cakeRepository;
    }

    /**
     * Get all cakes
     */
    public function index()
    {
        $itemsPerPage = 10;
        $cakeResource = new CakeResourceCollection($this->cakeRepository->getList($itemsPerPage));
        return $cakeResource->response()->setStatusCode(200);
    }

    /**
     * Get one Cake
     *
     * @param $cakeId
     */
    public function show($cakeId)
    {
        try {
            $cakeResource = new CakeResource($this->cakeRepository->get($cakeId));
            return $cakeResource->response()->setStatusCode(200);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'Cake not found.',
                    'errors' => [
                    ]
                ],
                404
            );
        }catch (Throwable $e){
            Log::error($e->getMessage());
            return response()->json(
                [
                    'message' => 'Unable to process the request.',
                    'errors' => [
                    ]
                ],
                500
            );
        }
    }

    /**
     * Create a new cake
     *
     * @param StoreCakeRequest $request
     */
    public function store(StoreCakeRequest $request)
    {
        $cake = [
            'name' => $request->name,
            'weight' => $request->weight,
            'price' => $request->price,
            'quantity' => $request->quantity
        ];

        try {
            return new CakeResource($this->cakeRepository->create($cake));
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(
                [
                    'message' => 'Unable to process the request.',
                    'errors' => [
                    ]
                ],
                500
            );
        }
    }

    /**
     * Update a cake existing
     *
     * @param UpdateCakeRequest $request
     * @param $cakeId
     */
    public function update(UpdateCakeRequest $request, $cakeId)
    {
        $cake = [];
        if($request->name){
            $cake['name'] = $request->name;
        }

        if($request->weight){
            $cake['weight'] = $request->weight;
        }

        if($request->price){
            $cake['price'] = $request->price;
        }

        if($request->quantity){
            $cake['quantity'] = $request->quantity;
        }

        try {
            return new CakeResource($this->cakeRepository->update($cake, $cakeId));
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(
                [
                    'message' => 'Unable to process the request.',
                    'errors' => [
                    ]
                ],
                500
            );

        }
    }

    /**
     * @param $cakeId
     */
    public function destroy($cakeId)
    {
        try {
            if($this->cakeRepository->delete($cakeId)){
                return response()->json(
                    [
                        'message' => 'The cake has been removed.',
                    ],
                    200
                );
            }else{
                return response()->json(
                    [
                        'message' => 'It was not possible remove cake.',
                    ],
                    204
                );
            }

        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(
                [
                    'message' => 'Unable to process the request.',
                    'errors' => [
                    ]
                ],
                500
            );
        }
    }
}
