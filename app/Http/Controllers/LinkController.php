<?php

namespace App\Http\Controllers;

use App\Models\UserLink;
use App\Services\UserLinkService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LinkController extends Controller
{
    public function disable(UserLink $userLink, UserLinkService $userLinkService):  Application|Redirector|RedirectResponse
    {
        $userLinkService->disable($userLink);
        return redirect('/');
    }

    public function regenerate(UserLink $userLink, UserLinkService $userLinkService): Application|Redirector|RedirectResponse
    {
        $newUserLink = $userLinkService->regenerate($userLink);
        return redirect(route('lucky.index', ['link' => $newUserLink->getLink()]));
    }
}
