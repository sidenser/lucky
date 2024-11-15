<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;
use Inertia\Inertia;
use Inertia\Response;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationService $registrationService): Response
    {

        $registrationService->setUsername($request->get('username'));
        $registrationService->setPhone($request->get('phone'));

        $userLink = $registrationService->register();

        return Inertia::render('RegisterSuccess', [
            'link' => url(route('lucky.index', ['link' => $userLink->getLink()])),
        ]);
    }
}
