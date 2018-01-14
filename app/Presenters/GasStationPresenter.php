<?php

namespace App\Presenters;

use App\Transformers\GasStationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GasStationPresenter
 *
 * @package namespace App\Presenters;
 */
class GasStationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GasStationTransformer();
    }
}
