<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Stock extends Controller
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

    public function getAbrev($abrev)
    {
      $url = "https://api.investing.com/api/search/v2/search?q={$abrev}";
      $dados = file_get_contents($url);
      if($dados)
      {
        $data = json_decode($dados,true);
        $description = $data['quotes'][0]['description'];
        return $description;
      };



    }
    public function show()
    {
        $coin = $_GET['coin']??"";
        $cotado = $_GET['cotado']??"";
        $description= $this->getAbrev($coin);
        return view('dashboard.stock',["coin"=>$coin,"cotado"=>$cotado,"description"=>$description]);
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
