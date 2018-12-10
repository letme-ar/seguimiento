@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change password</div>

                    <div class="card-body">
                            {{ csrf_field() }}

                            <div class="row justify-content-md-center">
                                <div class="col-6 form-group">
                                    <label for="nombre" class="form-control-label">Nombre</label>
                                    <input class="form-control" type="text" name="nombre" maxlength="100" value="{!! old('nombre') !!}" autofocus required>
                                    <div class="alert-danger">{!! $errors->first('nombre', ':message') !!}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection