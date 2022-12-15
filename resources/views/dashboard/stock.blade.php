@extends('dashboard.main')

@section('content')

<div class="content">
  <div class="row mt-4 row-cols-auto">
      <div class="stockIndicate "></div>

        <div class="col-md-auto align-self-start">
          <h1 class="ml-2 mb-0">{{$description}}</h1>
        </div>
        <div class="w-100"></div>
        <div class="col-md-auto ">
          <h2 class="ml-2 p-1 mt-0 pt-0">{{$cotado}}</h2>
        </div>
        <div class="col-md-auto ">
          <h3 class="ml-2 text-muted p-1 mt-0 pt-0">{{$coin}}</h3>
        </div>
        <div class="col-md-auto ">
          <h3 id="profit" class="ml-2  p-1 mt-0 pt-0">0</h3>
        </div>
        <div class="col-md-auto ">
          <h3 id="porcentProfit" class="ml-2  text-danger p-1 mt-0 pt-0">0%</h3>
        </div>

        <div class="col-12 mr-0">
          <div class="card card-chart">
            <div class="card-header ">
              <div class="row">
                <div class="col-sm-6 text-left">
                  <h5 class="card-category">Cotação</h5>
                  <h2 id="card_pct" class="graphCard card-title"></h2>
                </div>
                <div class="col-sm-6">
                  <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">


                    <label class="btn btn-sm btn-primary btn-simple active" id="0">
                      <input type="radio" name="options" checked>
                      <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Week</span>
                      <span class="d-block d-sm-none">
                        <i class="tim-icons icon-single-02"></i>
                      </span>
                    </label>

                    <label class="btn btn-sm btn-primary btn-simple" id="graphWeek">
                      <input type="radio" class="d-none d-sm-none" name="options">
                      <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Fortnight</span>
                      <span class="d-block d-sm-none">
                        <i class="tim-icons icon-gift-2"></i>
                      </span>
                    </label>
                    <label class="btn btn-sm btn-primary btn-simple" id="graphMonth">
                      <input type="radio" class="d-none" name="options">
                      <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Month</span>
                      <span class="d-block d-sm-none">
                        <i class="tim-icons icon-tap-02"></i>
                      </span>
                    </label>

                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-area">
                <canvas id="analyzeGraph"></canvas>
              </div>
            </div>
          </div>
        </div>

</div>

<style>
.stockIndicate{
  width:1vw;
  height:14vh;
  background-color:red;
  position:absolute;
}
</style>

<script language="javascript">
 //{id:"graphcrypto",url:"./graph/timecrypto"};
var analGraph = {id:"analyzeGraph",url:"./graph/graphtime?dias=7&coin=PETR4"}; 
</script>

<script src="../assets/demo/demo.js"></script>
<script language="javascript">
var analyzeGraph = document.querySelector("#analyzeGraph");
var graphWeek  = document.querySelector("#graphWeek");
var graphMonth = document.querySelector("#graphMonth");
var profit = document.querySelector("#profit");
var porcentProfit = document.querySelector("#porcentProfit");

function testUpdate()
{
  return (typeof(graphUpdate)=='function')?true:false;
};

analyzeGraph.getValue = function (value) {

  let walletc = "{{$cotado}}";
  let stockc = parseFloat(value);
  let walstockc =  parseFloat(stockc/walletc)-1;
  let porcentoc = parseFloat((walstockc*100).toFixed(2));
  let valuationc = (stockc - walletc);

      porcentProfit.innerText="("+porcentoc+"%)";
      profit.innerText=valuationc.toFixed(2);
};

function defineDate(dias)
{
    dias = (typeof(dias)=='undefined' || dias <1)?1:dias;
    dd = new Date();
    dd.setDate(dd.getDate()-dias);
    return (dd.getFullYear()+"-"+dd.getMonth()+"-"+dd.getDate());
};


//depois que houve o load dos dados adicionar o click


 let fortnight = [];
 let month = [];

 function xhr_data (url){
  let xhr = new XMLHttpRequest();
      xhr.open("get",url,true);
      xhr.send();
      return xhr;
 };

 var coin = "{{$coin}}";
 function getdatatime(coin,dias,planilha)
 {

   let url = "./graph/graphtime?dias="+dias+"&coin="+coin;
   let xhr = xhr_data(url);
   xhr.addEventListener("load",function(response)
   {
      if(response.target)
      {
        let target = response.target;
        let txt = (target.responseText)?target.responseText:"";
        if(txt)
        {
          let dados = JSON.parse(txt);

          if(dados[0])
          {
            let priceValue  = dados[0].map((d)=>{ return d['price']; });
                planilha.addEventListener("click",function(event) { graphUpdate(myChart,priceValue); });
          };

        };
      };
   });

 };
 getdatatime(coin,"15",graphWeek);
 getdatatime(coin,"30",graphMonth);


</script>
<script languaeg="javscript">var pageIndex=true; </script>
@endsection
