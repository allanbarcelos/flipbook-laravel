<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ClientsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function list(Request $request)
  {
      $request->user()->authorizeRoles(['administrator']);

      $users = User::join('role_user','users.id', '=', 'role_user.user_id')
                    ->join('roles','role_user.role_id','=','roles.id')
                    ->where('roles.name','=','client')
                    ->select('users.id','users.name','users.email','users.created_at','users.updated_at')
                    ->paginate(10);

      return view('admin/clients/list', compact('users'));
  }

  public function edit(Request $request)
  {
    return view('admin/clients/create');
  }

  public function create(Request $request)
  {
    $request->user()->authorizeRoles(['administrator']);

    return view('admin/clients/create');
  }

  public function delete(Request $request)
  {
    $request->user()->authorizeRoles(['administrator']);

    $idClients = $request->post();

    $i = 0;
    foreach ($idClients['idClient'] as $key)
    {
      if(User::find($key))
      {
        if(User::find($key)->delete())
          $i++;
      }
    }

    if($i == count($idClients['idClient']))
    return response()->json([
        'success' => 'Os clientes foram removidos'
    ]);
    else
    return response()->json([
        'error' => 'Houve um erro'
    ]);

  }
}
