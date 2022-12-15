<div class="sidebar-wrapper">
  <div class="logo">
    <img  class="logow" src="./auth/img/brand/logowhite.png"></img>
    <style>
    .logow{
      width: 80%;
      margin-top:20px;
      margin-left: auto;
      margin-right: auto;
      display: block;
    }
    </style>
  </div>
  <ul class="nav">
    <li class="active">
      <a href="{{route('dashboard')}}">
        <i class="tim-icons icon-chart-pie-36"></i>
        <p>Dashboard</p>
      </a>
    </li>
    @can('admin')
    <li >
      <a href="{{route('wallet')}}">
        <i class="tim-icons icon-wallet-43"></i>
        <p>Carteira</p>
      </a>
    </li>
    @endcan
    <li>
      <a href="{{route('tabela')}}">
        <i class="tim-icons icon-chart-bar-32"></i>
        <p>Ativos</p>
      </a>
    </li>
    <li>
      <a href="{{route('user')}}">
        <i class="tim-icons icon-single-02"></i>
        <p>Meus Dados</p>
      </a>
    </li>


    @can('admin')
    <li>
      <a href="{{route('investors')}}">
        <i class="tim-icons icon-settings"></i>
        <p>Usúarios</p>
      </a>
    </li>
    @endcan
  </ul>
</div>
