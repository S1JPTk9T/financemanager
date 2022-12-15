@extends("layouts.app")

@section("content")
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Recuperar Senha</small>
              </div>
              <form method="post" action="{{route('password.email')}}" role="form">
								@csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input required name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Digite Seu Email" type="email">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>


                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Login</button>
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
