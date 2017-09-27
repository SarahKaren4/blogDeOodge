<div class="panel panel-default">
    <div class="panel-heading">
        <small>
            <i class="fa fa-clock-o"></i> {{ $comment->created_at }}&nbsp;&nbsp;&nbsp;
            <i class="fa fa-user"></i> {{ $comment->user->name }}
            @if($comment->user instanceof App\Models\Admin)
                <span class="label label-warning">@lang('site/blog.admin')</span>
            @endif
        </small>
    </div>
    <div class="panel-body">
        {{ $comment->comment }}
    </div>
</div>
