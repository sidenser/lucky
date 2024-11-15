<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLink;
use App\Models\UserLinkedInterface;
use App\Repositories\LuckyResultRepository;
use App\Services\GameService;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class LuckyController extends Controller
{
    public function index(UserLink $userLink)
    {
        return Inertia::render('Lucky', [
            'link' => $userLink->getLink()
        ]);
    }

    public function history(UserLink $userLink, LuckyResultRepository $luckyResultRepository)
    {
        return JsonResource::make($luckyResultRepository->getLastLuckyResult($userLink->getUser()->getId()));
    }

    public function game(UserLink $userLink, GameService $gameService)
    {
        $gameService->setUser($userLink->getUser());
        $result = $gameService->feelingLucky();

        return JsonResource::make([
           'result' => $result->getResult(),
           'amount' => $result->getWinAmount()
        ]);
    }
}
