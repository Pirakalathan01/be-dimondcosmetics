<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Contracts\Services\CustomerPortal\CardServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerPortal\Card\DeleteCardRequest;
use App\Http\Requests\CustomerPortal\Card\StoreCardRequest;
use App\Http\Requests\CustomerPortal\Card\UpdateCardRequest;
use App\Http\Resources\CustomerPortal\Card\CardCollection;
use App\Http\Resources\CustomerPortal\Card\CardResource;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

    private CardServiceInterface $cardService;

    public function __construct(CardServiceInterface $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CardCollection
    {
        return new CardCollection($this->cardService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'customer_id',
                'product_id',
            ]
        ));
    }

    public function all(Request $request): CardCollection
    {
        return new CardCollection($this->cardService->all(
            [
                'id',
                'customer_id',
                'product_id',
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Card created successfully',
            'Card' => new CardResource($this->cardService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $card): CardResource
    {
        $card = $this->cardService->find($card);
        return new CardResource($card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCardRequest $request, string $card): JsonResponse
    {
        $this->cardService->delete($card);
        return response()->json([
            'message' => 'Card deleted successfully',
        ], 200);
    }
}
