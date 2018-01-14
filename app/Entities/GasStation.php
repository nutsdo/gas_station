<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GasStation extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [

    ];

    protected $guarded = [];
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function comments()
    {
        return $this->hasMany('App\Entities\Comments');
    }

    public function series()
    {
        return $this->belongsToMany('App\Entities\Series')->withPivot('price');
    }

//    public function getCoverAttribute($value)
//    {
//        return url($value);
//    }
}
