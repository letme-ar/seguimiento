<div class="col form-group">
    {!! Form::label($description) !!}
    {!! Form::select($name,$options,isset($selected) ? $selected : null,['class' => "form-control ". (isset($class) ? $class : '') ,isset($attributes) ? $attributes : '']) !!}
    <div class="alert-danger">{!! $error !!}</div>
</div>
