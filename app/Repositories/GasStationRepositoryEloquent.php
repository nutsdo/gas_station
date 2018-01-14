<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GasStationRepository;
use App\Entities\GasStation;
use App\Validators\GasStationValidator;

/**
 * Class GasStationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GasStationRepositoryEloquent extends BaseRepository implements GasStationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GasStation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GasStationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
