@extends('layouts.app')



  @section("content")
  <div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-white">LOGIN</h1>

          </div>
        </div>
      </div>
    </div>

  </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small class="text-white">Digite seu dados abaixo:</small>
              </div>
              <form method="post" action="{{route('login')}}" role="form">
								@csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input autocomplete="off" required name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Email" type="email">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input autocomplete="off" required name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha" value="old('password')" type="password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" name="remember" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Lembrar de mim</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="button_form btn btn-primary my-4">Login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{route('password.request')}}" class="text-light"><small>Esqueceu a senha?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Criar nova conta</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
