@extends('dashboard.main')


@section('content')
@include('react.cdn')

<div class="content">

  <div class="content" id="listGraphic">





  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-chart">
        <div class="card-header ">
          <div class="row">
            <div class="col-sm-6 text-left">
              <h5 class="card-category">Crypto</h5>
              <h2 id="card_pct" class="graphCard card-title">0%</h2>
            </div>
            <div class="col-sm-6">
              <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                  <input type="radio" name="options" checked>
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Crypto</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-single-02"></i>
                  </span>
                </label>
                <!--
                <label class="btn btn-sm btn-primary btn-simple" id="1">
                  <input type="radio" class="d-none d-sm-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-gift-2"></i>
                  </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple" id="2">
                  <input type="radio" class="d-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-tap-02"></i>
                  </span>
                </label>
              -->
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="graphcrypto"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-chart">
        <div class="card-header ">
          <div class="row">
            <div class="col-sm-6 text-left">
              <h5 class="card-category">Ações</h5>
              <h2 id="card_pct" class="graphCard card-title">0%</h2>
            </div>
            <div class="col-sm-6">
              <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                  <input type="radio" name="options" checked>
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Ações</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-single-02"></i>
                  </span>
                </label>
                <!--
                <label class="btn btn-sm btn-primary btn-simple" id="1">
                  <input type="radio" class="d-none d-sm-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-gift-2"></i>
                  </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple" id="2">
                  <input type="radio" class="d-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-tap-02"></i>
                  </span>
                </label>
              -->
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="graphbovespa"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-chart">
        <div class="card-header ">
          <div class="row">
            <div class="col-sm-6 text-left">
              <h5 class="card-category">Fundo</h5>
              <h2 id="card_pct" class="graphCard card-title">0%</h2>
            </div>
            <div class="col-sm-6">
              <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                  <input type="radio" name="options" checked>
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Fundo</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-single-02"></i>
                  </span>
                </label>
                <!--
                <label class="btn btn-sm btn-primary btn-simple" id="1">
                  <input type="radio" class="d-none d-sm-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-gift-2"></i>
                  </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple" id="2">
                  <input type="radio" class="d-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-tap-02"></i>
                  </span>
                </label>
              -->
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="graphTm"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content" id="listAll"></div>
  <!--
  <div class="col-lg-4">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">BTC</h5>
        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="chartLinePurple"></canvas>
        </div>
      </div>
    </div>
  </div>

  -->


  <script type="text/babel">

    var cardGraphic = [];
    var listGraphic = document.querySelector("#listGraphic");
    var listAll = document.querySelector("#listAll");
    var invest = new XMLHttpRequest();
    var listInvest = new XMLHttpRequest();


    class Graphic extends React.Component {


        render(props) {


           const wallet = parseFloat(this.props.investido).toFixed(2);
           const stock = parseFloat(this.props.preco);
           const walstock =  parseFloat(stock/wallet)-1;
           const porcento = parseFloat((walstock*100).toFixed(2));
           const coin = this.props.coin;


           function stockWallet() {
              if(wallet && coin)
              {
                let url = "{{route('stock')}}";
                if(url)
                {
                  location=(url+"?coin="+coin+"&cotado="+wallet);
                };
              };
            };
          return (

            <div className="col-lg-4 cardsinfo">
              <div className="card card-chart">
                <div className="card-header">
                  <h5 onClick={stockWallet} className="sigla card-category">{this.props.coin}</h5>
                  <h3 className="card-title"><i className=" tim-icons icon-sound-wave icon-graph"></i><h3 className="graphCard">{porcento}%</h3></h3>
                </div>
                <div className="card-body">
                  <div className="chart-area chartam">
                    <canvas  alt={this.props.investido} className="graphPrice" id={'coin'+this.props.coin+this.props.id}></canvas>
                  </div>
                </div>
              </div>
            </div>
          )}

    };

    class ListCard extends React.Component {

      render() {
        return (
          <div className="row">
            {this.props.cards}
          </div>

        );
      };


    };
    function loadCards(url,xhr,local) {
          xhr.id = local;



          xhr.onload=function(response)
          {
            while(cardGraphic.length = 0){ cardGraphic.pop(cardGraphic.length-1);};
             let text = this.responseText;
             if(text)
             {
               let dados = JSON.parse(this.responseText);

                   dados.map((dt,ncd)=> {
                     if(dt['total'])
                     {

                      cardGraphic.push(<Graphic preco={dt[((dt['total']-1))]['price']}  investido={parseFloat(dt['cotado'])} id={ncd} coin={dt['coin']}/>);
                     };


                   });

                   ReactDOM.render(<ListCard cards={cardGraphic} />,local);

             };
          };
          xhr.open("get",url,true);
          xhr.send();


    };

    loadCards("{{route('highValues')}}",invest,listGraphic);
    loadCards("{{route('showprice')}}",listInvest,listAll);



  </script>

</div>
<script language="javascript">

 var graphfundo = {id:"graphTm",url:"./graph/timefund"};
 var graphbovespa = {id:"graphbovespa",url:"./graph/timebovespa"};
 var graphcrypto = {id:"graphcrypto",url:"./graph/timecrypto"};

</script>

<script src="../assets/demo/demo.js"></script>
<script languaeg="javscript">var pageIndex=true; </script>
<style>
.cardsinfo{
  max-width:15vw !important;


}
.graphPrice{
  max-width: 13vw !important;
  max-height: 8vh !important;
}
.chartam{
  max-height: 7vh !important;
}
.icon-graph{
  color:blue !important;
}
.sigla{
  cursor:pointer;
}
</style>

@endsection
