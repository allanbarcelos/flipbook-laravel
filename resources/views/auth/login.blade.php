@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (config('app.env') === 'developmet'
    || config('app.env') === 'dev'
    || config('app.env') === 'staging'
    || config('app.env') === 'local' )
    <div class="row">
        &nbsp;
    </div>
    <div class="row  justify-content-center">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle"></i> Atenção! dados de acesso para testes
                    </div>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Você pode acessar tanto com email quanto com cpf (sem pontuação)
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h5><i class="fa fa-user-cog"></i> <b>Acesso administrativo</b></h5>
                        <hr     />
                        <p><strong>CPF : </strong>118.463.866-75</p>
                        <p><strong>Email : </strong>admin@mail.com</p>
                        <p><strong>Senha : </strong>admi123456</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h5><i class="fa fa-user"></i> <b>Acesso cliente</b></h5>
                        <hr />
                        <p><strong>CPF :</strong> 909.786.935-82</p>
                        <p><strong>Email :</strong> jeff@mail.com</p>
                        <p><strong>Senha :</strong> jeff123456</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
</div>
@endsection
