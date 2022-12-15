<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Price as Preco;
use App\Models\User;
use App\Http\Controllers\Price as Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Graphic extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
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

    public function graphTime()
    {
       $valuePrice = [];
       $dias = $_GET['dias']??"";
       $coin = $_GET['coin']??"";
       if($dias && $coin)
       {
          $dias = (0-$dias);
         $result = DB::select( DB::raw("select price From prices where abrev='{$coin}' and created_at > adddate(date(now()), INTERVAL {$dias} day) and created_at < date(now()) order by id desc ") );

         if($result[0]->price != NULL)
         {
             $valuePrice['ignore']=true;
             array_push($valuePrice,$result);
         };
         echo json_encode($valuePrice,true);
       };

    }

    public function timeFund()
    {
       //13
      $timeline = [];
      for($a=0;$a<13;$a++) {
        $result = DB::select( DB::raw("select wallets.abrev,(investido/cotado) * (select price from prices where abrev=wallets.abrev order by id desc  limit {$a},1) as valor, (select sum(investido) from wallets) as total  from wallets") );
        if($result[0]->valor != NULL)
        {
            array_push($timeline,$result);
        };

      };

      echo json_encode($timeline,true);


    }

    public function timeBovespa()
    {
       //13
      $timeline = [];
      for($a=0;$a<13;$a++) {
        $result = DB::select( DB::raw("select wallets.abrev,(investido/cotado) * (select price from prices where type='bovespa' order by id desc  limit {$a},1) as valor, (select sum(investido) from wallets) as total  from wallets") );
        if($result[0]->valor != NULL)
        {
            array_push($timeline,$result);
        };

      };

      echo json_encode($timeline,true);


    }

    public function timeCrypto()
    {
       //13
      $timeline = [];
      for($a=0;$a<13;$a++) {
        $result = DB::select( DB::raw("select wallets.abrev,(investido/cotado) * (select price from prices where type='crypto' order by id desc  limit {$a},1) as valor, (select sum(investido) from wallets) as total  from wallets") );
        if($result[0]->valor != NULL)
        {
            array_push($timeline,$result);
        };

      };

      echo json_encode($timeline,true);


    }

    public function highValues()
    {
      $user_id = Auth::id();
      $objUser = new User();

      if($user_id)
      {

        $values = DB::table('wallets')
            ->select('abrev as coin','investido','wallets.cotado as cotado')
            ->where('user_id',$user_id)
            ->orderByDesc('investido')
            ->limit(5)
            ->get();


           $points = 6;
          $data = stock::showMetric($values,$points);

          echo json_encode($data,true);
      };


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
