<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Interfaces\Models\User\UserInterface;
use App\Models\User\Token;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Login user.
     *
     * @param LoginRequest $request Login Request.
     *
     * @return JsonResponse Json Response.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        /** @var UserInterface $user */
        $user = User::whereEmail($request->get(User::EMAIL))->first();
        if ($user) {
            if (Hash::check($request->get(User::PASSWORD), $user->getPassword())) {
                return $this->getTokenResponse($user, $request->get(Token::FIREBASE_TOKEN));
            }
        }

        return $this->getResponse(
            ['message' => __('error.incorrect_user_pass')],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * @param UserInterface $user          User.
     * @param string|null   $firebaseToken Firebase Token.
     *
     * @return JsonResponse
     */
    protected function getTokenResponse(UserInterface $user, ?string $firebaseToken = null): JsonResponse
    {
        try {
            DB::beginTransaction();
            $token = $user->createToken('new user')->accessToken;
            $response = [
                'token' => $token,
                'user' => $user->load('roles', 'roles.permissions'),
            ];
            Token::createObject(
                $user,
                $token,
                $firebaseToken,
                isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
            );
            DB::commit();
            return $this->getResponse($response);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->getResponse(
                ['message' => __('error.token_not_generated')],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Log out.
     *
     * @param Request $request Login Request.
     *
     * @return JsonResponse Json Response.
     */
    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->token();
        $token->revoke();
        $default = 'Bearer ';
        $token = $request->header('Authorization', $default);
        $token = str_replace($default, '', $token);
        if (!empty($token)) {
            Token::whereTokenStringIs($token)->delete();
        }

        return $this->getResponse();
    }
}
