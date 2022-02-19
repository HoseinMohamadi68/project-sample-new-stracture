<?php

namespace App\Http\Controllers\User;

use App\Constants\PermissionTitle;
use App\Filters\PermissionFilter;
use App\Filters\RoleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PermissionRoleRequest;
use App\Http\Requests\User\RoleRequest;
use App\Http\Resources\User\PermissionResource;
use App\Http\Resources\User\RoleResource;
use App\Interfaces\Models\User\RoleInterface;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Repositories\User\RoleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /** @var \App\Repositories\User\RoleRepository $repository */
    private RoleRepository $repository;

    /**
     * RoleController constructor.
     * @param \App\Repositories\User\RoleRepository $repository Repository.
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param RoleFilter $filters RoleFilter.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(RoleFilter $filters, Request $request): AnonymousResourceCollection
    {
        return RoleResource::collection(Role::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request RoleRequest.
     *
     * @return JsonResponse|RoleResource
     */
    public function store(RoleRequest $request): JsonResponse|RoleResource
    {
        $result = $this->repository->store($request->validated());

        if (isset($result['error'])) {
            return $this->getResponse(['message' => $result['message']], $result['status']);
        }
        if ($result instanceof RoleInterface) {
            $result->permissions()->sync($request->get('permissions'));
        }

        return new RoleResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role Role.
     *
     * @return RoleResource
     */
    public function show(Role $role): RoleResource
    {
        $user = Auth::user();
        if ($user->hasPermission(PermissionTitle::GET_ALL_PERMISSIONS)) {
            return new RoleResource($role->load('permissions'));
        }

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request RoleRequest.
     *
     * @param Role        $role    Role.
     *
     * @return JsonResponse|RoleResource
     */
    public function update(RoleRequest $request, Role $role): JsonResponse|RoleResource
    {
        $result = $this->repository->update($role, $request->validated());

        if (isset($result['error'])) {
            return $this->getResponse(['message' => $result['message']], $result['status']);
        }
        if ($result instanceof RoleInterface) {
            $result->permissions()->sync($request->get('permissions'));
        }

        return new RoleResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role Role.
     *
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            $role->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Role Error : ' . $exception->getMessage());

            return $this->getResponse(
                ['message' => __('error.can_not_delete_parameter', ['parameter' => __('error.role')])],
                Response::HTTP_CONFLICT
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Role             $role    Role.
     * @param PermissionFilter $filters Filter.
     * @param Request          $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function getPermissions(
        Role $role,
        PermissionFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        return PermissionResource::collection(
            $role->permissions()->filter($filters)->paginate($this->getPageSize($request))
        );
    }

    /**
     * @param Role             $role       Role.
     * @param Permission       $permission Permission.
     * @param PermissionFilter $filters    Filters.
     * @param Request          $request    Request.
     *
     * @return AnonymousResourceCollection
     */
    public function addPermission(
        Role $role,
        Permission $permission,
        PermissionFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        if (!$role->permissions()->find($permission->getId())) {
            $role->permissions()->attach($permission->getId());
        }

        return $this->getPermissions($role, $filters, $request);
    }

    /**
     * @param Role                  $role    Role.
     * @param PermissionRoleRequest $request Request.
     * @param PermissionFilter      $filters Filters.
     *
     * @return AnonymousResourceCollection
     */
    public function syncPermissions(
        Role $role,
        PermissionRoleRequest $request,
        PermissionFilter $filters
    ): AnonymousResourceCollection {
        $role->permissions()->sync($request->get('permission_ids'));

        return $this->getPermissions($role, $filters, $request);
    }

    /**
     * @param Role             $role       Role.
     * @param Permission       $permission Permission.
     * @param PermissionFilter $filters    Filters.
     * @param Request          $request    Request.
     *
     * @return AnonymousResourceCollection
     */
    public function deletePermission(
        Role $role,
        Permission $permission,
        PermissionFilter $filters,
        Request $request
    ): AnonymousResourceCollection {
        $role->permissions()->detach([$permission->id]);

        return $this->getPermissions($role, $filters, $request);
    }
}
