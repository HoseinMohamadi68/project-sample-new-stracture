<?php

namespace App\Http\Controllers\User;

use App\Filters\PermissionFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\PermissionResource;
use App\Models\User\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PermissionFilter $filters Filter.
     *
     * @param Request          $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(PermissionFilter $filters, Request $request): AnonymousResourceCollection
    {
        return PermissionResource::collection(Permission::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * * Display the specified resource.
     *
     * @param Permission $permission Permission.
     *
     * @return PermissionResource
     */
    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission);
    }
}
