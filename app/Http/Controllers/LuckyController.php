<?php

namespace App\Http\Controllers;

use App\Models\UserLink;
use App\Repositories\LuckyResultRepository;
use App\Services\GameService;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

class LuckyController extends Controller
{
    public function index(UserLink $userLink): Response
    {
        return Inertia::render('Lucky', [
            'link' => $userLink->getLink()
        ]);
    }

    public function history(UserLink $userLink, LuckyResultRepository $luckyResultRepository): JsonResource
    {
        return JsonResource::make($luckyResultRepository->getLastLuckyResult($userLink->getUser()->getId()));
    }

    public function game(UserLink $userLink, GameService $gameService): JsonResource
    {
        $gameService->setUser($userLink->getUser());
        $result = $gameService->feelingLucky();

        return JsonResource::make([
           'result' => $result->getResult(),
           'amount' => $result->getWinAmount()
        ]);
    }
}
