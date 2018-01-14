<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/14
 * Time: 下午3:43
 */

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GasStationSeries extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $guarded = [];

}