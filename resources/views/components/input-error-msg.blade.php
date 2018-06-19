@if($errors->has($name))
    @foreach($errors->get($name) as $error)
        <p class="help-block">{!! $error !!}</p>
    @endforeach
@endif