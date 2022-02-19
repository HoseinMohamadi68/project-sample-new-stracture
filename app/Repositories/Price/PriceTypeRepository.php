<?php

namespace App\Repositories\Price;

use App\Interfaces\Models\Perice\PriceTypeInterface;
use App\Models\LocalizableModel;
use App\Models\Price\PriceType;
use App\Repositories\BaseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PriceTypeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return PriceType::class;
    }

    /**
     * @param array $data Data.
     *
     * @return array|PriceTypeInterface
     */
    public function store(array $data): array|PriceTypeInterface
    {
        DB::beginTransaction();

        try {
            $item = PriceType::createObject();

            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('create'), 'modelName' => __('priceType')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }


    /**
     * @param PriceType $priceType PriceType.
     * @param array     $data      Data.
     *
     * @return array|PriceTypeInterface
     */
    public function update(PriceType $priceType, array $data): array|PriceTypeInterface
    {
        DB::beginTransaction();

        try {
            $item = $priceType->updateObject();

            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data['languages']);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('update'), 'modelName' => __('priceType')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }
}
