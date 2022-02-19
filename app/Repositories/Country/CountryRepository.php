<?php

namespace App\Repositories\Country;

use App\Interfaces\Models\Country\CountryInterface;
use App\Models\Country\Country;
use App\Models\LocalizableModel;
use App\Repositories\BaseRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CountryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Country::class;
    }

    /**
     * @param array $data Data.
     *
     * @return CountryInterface|array
     */
    public function store(array $data): array|CountryInterface
    {
        DB::beginTransaction();

        try {
            $item = Country::createObject($data);
            /** Sync Multilingual */
            $item = $this->syncMultilingual($item, $data[LocalizableModel::LOCALIZATION_KEY]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return [
                'error' => true,
                'message' => __(
                    'exceptions.system_cant_action',
                    ['action' => __('create'), 'modelName' => __('country')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }

    /**
     * @param Country $role Country.
     * @param array   $data Data.
     *
     * @return CountryInterface|array
     */
    public function update(Country $role, array $data): array|CountryInterface
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
                    ['action' => __('update'), 'modelName' => __('country')]
                ),
                'status' => Response::HTTP_BAD_REQUEST,
            ];
        }

        DB::commit();

        return $item;
    }
}
