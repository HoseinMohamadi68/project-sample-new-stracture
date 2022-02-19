<?php

namespace App\Repositories\User;

use App\Interfaces\Models\User\RoleInterface;
use App\Models\LocalizableModel;
use App\Models\User\Role;
use App\Repositories\BaseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * @param array $data Data.
     *
     * @return RoleInterface|array
     */
    public function store(array $data): array|RoleInterface
    {
        DB::beginTransaction();

        try {
            $item = Role::createObject(
                $data[Role::OWNER_VISIBILITY],
                $data[Role::COMPANY_VISIBILITY],
            );
            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('create'), 'modelName' => __('role')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }

    /**
     * @param Role  $role Role.
     * @param array $data Data.
     *
     * @return RoleInterface|array
     */
    public function update(Role $role, array $data): array|RoleInterface
    {
        DB::beginTransaction();

        try {
            $item = $role->updateObject(
                $data[Role::OWNER_VISIBILITY],
                $data[Role::COMPANY_VISIBILITY],
            );

            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('update'), 'modelName' => __('role')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }
}
