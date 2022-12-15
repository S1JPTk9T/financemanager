<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet as Carteira;
use Illuminate\Support\Facades\Auth;

class Wallet extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.wallet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        unset($data["_token"]);
        $objWallet = new Carteira();
        $objWallet->create($data);
        return redirect()->route('wallet');

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
    public function show()
    {

      $funds = DB::table('wallets')
          ->join('profiles', 'wallets.user_id', '=', 'profiles.user_id')
          ->select('wallets.*','wallets.id as wid', 'profiles.*')
          ->get();

        return json_encode($funds,true);


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
    public function update(Request $request)
    {
        $objWallet = new Carteira();

        if($dados = $request->all())
          {
            if($dados["id"] && $dados["wid"])
            {
              $wid = $dados["wid"];
              $dados["id"]=$wid;
              unset($dados["_token"]);
              unset($dados["wid"]);
              echo var_dump($dados);
              $objWallet->where(["id"=>$wid])->update($dados);

            };
          };

          return redirect()->route('wallet');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $objWallet = new Carteira();

      if($dados = $request->all())
        {
          if($dados["id"])
          {
            unset($dados["_token"]);
            $objWallet->where(["id"=>$dados["id"]])->delete();
            echo "Deletado Com Sucesso!";
          };
        };


    }
}
