<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Comments extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $guarded = [];

    public function station()
    {
        return $this->belongsTo('App\Entities\GasStation');
    }
}
