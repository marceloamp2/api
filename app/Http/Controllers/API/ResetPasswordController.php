<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword\ResetPasswordRequest;
use App\Http\Requests\ResetPassword\SendPasswordResetRequest;
use App\Services\ResetPassword\ResetPasswordService;
use App\Services\ResetPassword\SendLinkResetPasswordService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    public function sendResetPasswordLink(
        SendPasswordResetRequest     $sendPasswordResetRequest,
        SendLinkResetPasswordService $sendLinkResetPasswordService
    ): Response|Application|ResponseFactory
    {
        $data = $sendPasswordResetRequest->validated();
        $response = $sendLinkResetPasswordService->run($data['email']);
        return response($response);
    }

    public function tokenResetEmail($token): Response|Application|ResponseFactory
    {
        return response($token);
    }

    public function resetPassword(
        ResetPasswordRequest $resetPasswordRequest,
        ResetPasswordService $resetPasswordService
    ): Response|Application|ResponseFactory
    {
        $data = $resetPasswordRequest->validated();
        $response = $resetPasswordService->run($data);
        return response($response);
    }
}
