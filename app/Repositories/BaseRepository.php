<?php

namespace App\Repositories;

use App\Models\Translations\CountryTranslation;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Application
     */
    protected Application $app;

    /**
     * @param Application $app Application.
     *
     * @throws \Exception Exception.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @throws \Exception Exception.
     *
     * @return Model
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception(
                __(
                    'exceptions.class_must_beInstance_of',
                    ['model' => $this->model(), 'parent' => 'Illuminate\\Database\\Eloquent\\Model']
                )
            );
        }

        return $this->model = $model;
    }

    /**
     * Find model record for given id
     *
     * @param integer $id      Id.
     * @param array   $columns Columns.
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id, array $columns = ['*']): Model|Collection|Builder|array|null
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * @param Model $modelObject Object.
     *
     * @return mixed
     */
    public function delete(Model $modelObject): mixed
    {
        $query = $this->model()::query();

        $model = $query->findOrFail($modelObject->getId());

        return $model->delete();
    }

    /**
     * @param Model $model     Model.
     * @param array $languages Languages.
     *
     * @return Model
     */
    protected function syncMultilingual(Model $model, array $languages): Model
    {
        $model->translations()->delete();
        $model->translations()->createMany($languages);

        return $model;
    }
}
