<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profile as Prof;

class Profile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return (Auth::check())?view('dashboard.user'):redirect()->route('login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $my_id = Auth::id();
        $objUser = new User();
        $objProf = new Prof();
        $dados = (empty($request->all())==False)?$request->all():"";

        if($dados && $my_id)
        {
          $dados["user_id"]=$my_id;
          unset($dados["_token"]);
          $perfil = $objProf->where('user_id',$my_id)->first();
          if($perfil) {
            $result = $objProf->where(['user_id'=>$my_id])->update($dados);
            $userUpdate = $objUser->where(['id'=>$my_id])->update(['name'=>$dados["nome"],'email'=>$dados["email"]]);
          } else {
            $result = Prof::create($dados);
            $result->save();
          };

        };


        return (Auth::check())?redirect()->route('user'):redirect()->route('login');

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
      $my_id = Auth::id();
      $objUser = new User();
      if($my_id) {
        echo $objUser->find($my_id)->relProfile;
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
