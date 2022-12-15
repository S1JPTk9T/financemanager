@extends('dashboard.main')

@section('content')


<div class="content">
  <form id="formUser" method="post" action="{{route('postuser')}}">
    @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Meus Perfil</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Companhia</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="P2PCRIPTO"></input>
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Usuário</label>
                        <input name="username" type="text" class="form-control" placeholder="Username" value="Usuário {{Auth::id()}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="mike@email.com" value="{{Auth::user()->email}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" value="{{Auth::user()->name}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Sobrenome</label>
                        <input name="sobrenome" type="text" class="form-control" placeholder="Sobrenome">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Fixo</label>
                        <input name="fixo" type="text" class="form-control" placeholder="xxx-xxx" >
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Celular</label>
                        <input name="phone"  type="text" class="form-control" placeholder="(xx) xxx-xxx" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>RG</label>
                        <input name="rg" type="text" class="form-control" placeholder="xxxxxxxx">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>CPF</label>
                        <input name="cpf" type="text" class="form-control" placeholder="xxx.xxx.xxx-xx">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input name="endereco" type="text" class="form-control" placeholder="Rua ,numero">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input name="cidade" type="text" class="form-control" placeholder="Cidade" >
                      </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label>Estado</label>
                        <input name="estado" type="text" class="form-control" placeholder="Estado" >
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label>Cep</label>
                        <input name="cep" type="number" class="form-control" placeholder="ZIP Code">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Bio</label>
                        <input name="bio" rows="4" cols="80" class="form-control" placeholder="Um pouco sobre você." ></input>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Guardar</button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="javascript:void(0)">
                      <img class="avatar" src="../assets/img/emilyz.jpg" alt="...">
                      <h5 class="title">Mike Andrew</h5>
                    </a>
                    <p class="description">
                      Ceo/Co-Founder
                    </p>
                  </div>
                </p>
                <div class="card-description">
                  Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                </div>
              </div>
              <div class="card-footer">
                <div class="button-container">
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                    <i class="fab fa-facebook"></i>
                  </button>
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                    <i class="fab fa-twitter"></i>
                  </button>
                  <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                    <i class="fab fa-google-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <script language="javascript">
       (function () {
         let form = document.querySelector("#formUser");
          let text = new XMLHttpRequest();
              text.onload=function(response) {
                var about =  (this.responseText)?JSON.parse(this.responseText):"";
                if(about)
                {
                  form.querySelectorAll("input").forEach((inp) => {
                    if(about){if(inp.name!= "_token") { inp.value = about[inp.name]; }; };

                  });
                };

              };
              text.open("get","./profile",true);
              text.send();

       }());

      </script>



@endsection
