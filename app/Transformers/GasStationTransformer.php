<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\GasStation;

/**
 * Class GasStationTransformer
 * @package namespace App\Transformers;
 */
class GasStationTransformer extends TransformerAbstract
{

    /**
     * Transform the GasStation entity
     * @param App\Entities\GasStation $model
     *
     * @return array
     */
    public function transform(GasStation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
