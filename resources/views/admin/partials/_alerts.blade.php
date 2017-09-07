<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has($msg))
                        <p class="alert alert-{{ $msg }}">
                            {{ Session::get($msg) }} 
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                    @endif
                @endforeach
            </div> <!-- end .flash-message -->

        </div>
    </div>
</div>
