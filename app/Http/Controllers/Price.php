<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Price as Preco;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class Price extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ibovespaCreate()
    {
        $dolar = $this->realNow();
        $br3 = file_get_contents("https://sistemaswebb3-listados.b3.com.br/indexProxy/indexCall/GetPortfolioDay/eyJsYW5ndWFnZSI6InB0LWJyIiwicGFnZU51bWJlciI6MSwicGFnZVNpemUiOjEyMCwiaW5kZXgiOiJJQk9WIiwic2VnbWVudCI6IjEifQ==");
        $dados = json_decode($br3,true);
        foreach($dados["results"] as $result)
        {
	         Preco::create(['abrev'=>($result["cod"]),'price'=>(intval($result['part'])*$dolar),'type'=>'bovespa']);
           echo "salvo com sucesso!";
        };


    }


    public function create()
    {
      $token = "efded71e1cccad6136f7aea57ef7abdd";
      $dolar = $this->realNow();
      $response = Http::get("http://api.coinlayer.com/live?access_key={$token}");
      if($response)
      {
        $dados = json_decode($response,true);
        if($dados["success"] == True)
        {
           $rates = preg_replace( "/[{}\"]/i",
                              "",
                              json_encode($dados["rates"],true));

           if($rates)
           {
              $prixes = explode(",",$rates);
              foreach($prixes as $prx)
              {
                try {
                  $pxs = explode(":",$prx);
                  Preco::create(['abrev'=>$pxs[0],'price'=>($pxs[1]*$dolar),'type'=>'crypto']);

                } catch (Exception $e) {
                  echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                };
              };
              echo "Salvo com Sucesso!";
           };

        };

      };

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function realNow()
    {
      $url = "https://br.investing.com/currencies/usd-brl";
      $page = file_get_contents("https://br.investing.com/currencies/usd-brl");
      if($page)
      {
        $brl = explode("<",explode("instrument-price-last",$page)[1]);
        if($brl)
        {
          $brl =  preg_replace('/">/i',"",$brl[0]);
          $dolar = str_replace(',','.',$brl);
          $dolar = number_format($dolar, 2);
          if($dolar)
          {
            return $dolar;

          };

 };

}

    }

    public function showMetric($limit,$points)
    {
      $data=[];
      foreach(json_decode($limit,true) as $coin)
      {

        $total = DB::table('prices')
            ->join('wallets', 'wallets.abrev', '=', 'prices.abrev')
            ->select('wallets.abrev')
            ->where('wallets.abrev',$coin['coin'])
            ->count('wallets.abrev');



        $priceFund = DB::table('prices')
          ->join('wallets', 'wallets.abrev', '=', 'prices.abrev')
          ->select('prices.*','prices.id as ordem','wallets.*')
          ->where('wallets.abrev',$coin['coin'])
          ->orderBy('ordem',"desc")
          ->limit($points)
          ->get();

          $priceFund["cotado"]=$coin['cotado'];
          $priceFund["coin"]=$coin['coin'];
          $priceFund["total"]=($total>$points)?$points:$total;
          array_push($data,$priceFund);
       };

       return $data;
    }


    public function show()
    {
        $user_id = Auth::id();
        $objUser = new User();

        if($user_id)
        {


          $limit = DB::table('wallets')
              ->select('wallets.abrev as coin','wallets.cotado as cotado')
              ->where('user_id',$user_id)
              ->get();



          $data = $this->showMetric($limit,6);
          echo json_encode($data,true);
        };

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
