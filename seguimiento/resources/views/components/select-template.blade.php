<div class="col form-group">
    {!! Form::label($description) !!}
    {!! Form::select($name,$options,isset($selected) ? $selected : null,['class' => 'form-control selectpicker',isset($attributes) ? $attributes : '']) !!}
    <div class="alert-danger">{!! $error !!}</div>
</div>
