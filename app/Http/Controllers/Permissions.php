<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Permissions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.investors');
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
    public function release_access($id)
    {
      $users = DB::table('permissions')
                  ->join('model_has_permissions', 'permissions.id', '=', 'model_has_permissions.permission_id')
                  ->select('model_has_permissions.model_id')
                  ->where('permissions.name','admin')
                  ->where('model_id',$id)
                  ->get();
                  $teste = json_decode($users,true);

                  return ($teste[0]['model_id'])??False;
    }

    public function show()
    {


      $users = DB::table('users')
                  ->join('model_has_permissions', 'users.id', '=', 'model_has_permissions.model_id')
                  ->join('permissions','model_has_permissions.permission_id','=','permissions.id')
                  ->join('profiles','model_has_permissions.model_id','=','profiles.user_id')
                  ->select('users.name','profiles.phone','permissions.name as cargo','model_has_permissions.*')
                  ->get();

          if($this->release_access(Auth::id())!=False)
          {
              return json_encode($users);
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
