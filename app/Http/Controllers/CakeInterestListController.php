<?php

namespace App\Http\Controllers;

use App\Contracts\CakeRepositoryInterface;
use App\Http\Requests\StoreCakeInterestListRequest;
use App\Http\Resources\CakeInterestListResource;
use App\Jobs\SendInterestCakeEmail;
use App\Repositories\CakeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CakeInterestListController extends Controller
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
     * Create a new interest list item
     *
     * @param StoreCakeInterestListRequest $request
     * @param $cakeId
     * @return JsonResponse
     */
    public function store(StoreCakeInterestListRequest $request, $cakeId)
    {
        $interest = [
            'email' => $request->email
        ];

        try {
            $cakeInterest = $this->cakeRepository->create_interest_list($interest, $cakeId);
            //SendInterestCakeEmail::dispatch($this->cakeRepository)->delay(now()->addMinutes(1));
            $cakeResourceInterest = new CakeInterestListResource($cakeInterest);
            return $cakeResourceInterest;
        }catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(
                [
                    'message' => 'Cake not found.',
                    'errors' => [
                    ]
                ],
                404
            );
        }catch (Throwable $e) {
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
