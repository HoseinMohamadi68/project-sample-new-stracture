<?php

namespace App\Repositories\SaleSystem;

use App\Interfaces\Models\SaleSystem\SaleSystemInterface;
use App\Models\LocalizableModel;
use App\Models\SaleSystem\SaleSystem;
use App\Repositories\BaseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SaleSystemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return SaleSystem::class;
    }

    /**
     * @param array $data Data.
     *
     * @return SaleSystemInterface|array
     */
    public function store(array $data): array|SaleSystemInterface
    {
        DB::beginTransaction();

        try {
            $item = SaleSystem::createObject($data);
            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            dump($e->getMessage());
            die;
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('create'), 'modelName' => __('sale_system')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }

    /**
     * @param SaleSystem $role Role.
     * @param array      $data Data.
     *
     * @return SaleSystemInterface|array
     */
    public function update(SaleSystem $role, array $data): array|SaleSystemInterface
    {
        DB::beginTransaction();

        try {
            $item = $role->updateObject($data);

            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('update'), 'modelName' => __('sale_system')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }
}
