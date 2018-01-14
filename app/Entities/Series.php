<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Series extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $guarded = [];

    public function gasStation()
    {
        return $this->belongsToMany('App\Entities\GasStation')->withPivot('price');
    }
}
