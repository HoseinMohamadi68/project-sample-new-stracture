<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RoleUserRequest;
use App\Models\User\Role;
use App\Http\Resources\User\RoleResource;
use App\Filters\RoleFilter;
use App\Filters\UserFilter;
use App\Http\Requests\User\UserProfileRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserFilter $filters UserFilter.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(UserFilter $filters, Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(User::filter($filters)
            ->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request UserRequest.
     *
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
        $user = User::createObject(
            $request->get(User::MOBILE),
            $request->get(User::FIRST_NAME),
            $request->get(User::LAST_NAME),
            $request->get(User::APPROVED),
            $request->get(User::PASSWORD),
            $request->get(User::EMAIL),
            $request->get(User::CHARGE),
            $request->get(User::PHONE)
        );

        $roles = $request->get('roles');
        if (!empty($roles)) {
            $user->roles()->sync($roles);
        }

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user User.
     *
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request UserRequest.
     * @param User        $user    User.
     *
     * @return UserResource
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $user->updateObject(
            $request->get(User::MOBILE),
            $request->get(User::FIRST_NAME),
            $request->get(User::LAST_NAME),
            $request->get(User::APPROVED),
            $request->get(User::PASSWORD),
            $request->get(User::EMAIL),
            $request->get(User::CHARGE),
            $request->get(User::PHONE)
        );

        $roles = $request->get('roles');
        if (!empty($roles)) {
            $user->roles()->sync($roles);
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user User.
     *
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete User Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __('error.can_not_delete_parameter', ['parameter' => __('error.user')])],
                Response::HTTP_CONFLICT
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserProfileRequest $request UserRequest.
     * @param User               $user    User.
     *
     * @return UserResource
     *
     * @throws AuthorizationException Authorization Exception.
     */
    public function updateUserProfile(UserProfileRequest $request, User $user): UserResource
    {
        $this->authorize('updateProfile', $user);

        $user->updateObject(
            $user->getMobile(),
            $request->get(User::FIRST_NAME),
            $request->get(User::LAST_NAME),
            true,
            $request->get(User::PASSWORD),
            $request->get(User::EMAIL),
            $user->getCharge(),
            $request->get(User::PHONE)
        );

        return new UserResource($user);
    }

    /**
     *
     * @param Request $request       Request.
     * @param string  $firebaseToken Token.
     *
     * @return JsonResponse
     */
    public function setFirebaseToken(Request $request, string $firebaseToken): JsonResponse
    {
        try {
            $token = $request->user()
                ->firebaseTokens()
                ->whereTokenStringIs(
                    str_replace('Bearer ', '', $request->header('Authorization', 'Bearer '))
                )
                ->first();
            $token->setFirebaseToken($firebaseToken);
            $token->save();

            return $this->getResponse();
        } catch (\Exception $exception) {
            return $this->getResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param User       $user    User.
     * @param RoleFilter $filters Filter.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function getRoles(
        User $user,
        RoleFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        return RoleResource::collection(
            $user->roles()->filter($filters)->paginate($this->getPageSize($request))
        );
    }

    /**
     * @param User       $user    User.
     * @param Role       $role    Role.
     * @param RoleFilter $filters Filters.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function addRole(
        User $user,
        Role $role,
        RoleFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        if (!$user->roles()->find($role->getId())) {
            $user->roles()->attach($role->getId());
        }

        return $this->getRoles($user, $filters, $request);
    }

    /**
     * @param User            $user    User.
     * @param RoleUserRequest $request Request.
     * @param RoleFilter      $filters Filters.
     *
     * @return AnonymousResourceCollection
     */
    public function syncRoles(
        User $user,
        RoleUserRequest $request,
        RoleFilter $filters
    ): AnonymousResourceCollection {
        $user->roles()->sync($request->get('role_ids'));

        return $this->getRoles($user, $filters, $request);
    }

    /**
     * @param User       $user    User.
     * @param Role       $role    Role.
     * @param RoleFilter $filters Filters.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function deleteRole(
        User $user,
        Role $role,
        RoleFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        $user->roles()->detach([$role->getId()]);

        return $this->getRoles($user, $filters, $request);
    }
}
