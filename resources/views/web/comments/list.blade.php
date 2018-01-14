<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/13
 * Time: 下午2:29
 */
?>
@foreach($comments as $comment)
<div class="media">
    <div class="media-left">
        <a href="javascript:;">
            {{ Html::image('assets/images/user-2.png', null, ['class'=>'media-object avatar']) }}
        </a>
    </div>
    <div class="media-body">
        <h5 class="media-heading">
            匿名用户
            <span class="pull-right">{{ $comment->created_at }}</span>
            <p class="filled-stars" style="width: 100%;">
                @for($i=1;$i<=$comment->stars;$i++)
                <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                @endfor
            </p>
        </h5>
        {{ $comment->content }}
    </div>
</div>
@endforeach