<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      $request->user()->authorizeRoles(['administrator','client']);
      return view('users/index');
    }

    public function list(Request $request)
    {

      $request->user()->authorizeRoles(['administrator']);

      $post = $request->post();

      if(!$post || !isset($post['search']))
      {
        $users = User::join('role_user','users.id', '=', 'role_user.user_id')
        ->join('roles','role_user.role_id','=','roles.id')
        ->select('users.id','roles.name AS rolename','users.name','users.email','users.created_at','users.updated_at')
        ->paginate(10);
      }else
      {
        $explodeSpaces = explode(" ", $post['search']);


        $where = [];
        $email = [];
        $i = 0;

        foreach ($explodeSpaces as $key)
        {
          if(filter_var($key, FILTER_VALIDATE_EMAIL))
          {
            $email = ['users.email','=',$key];
            array_push($where,$email);
            unset($explodeSpaces[$i]);

          }
          $i++;
        }

        $dateRegex = "#^(0[1-9]|[12][0-9]|3[01])[// /.](0[1-9]|1[012])[// /.](19|20)\d\d$#";
          $date = [];
          $i = 0;
          $j = 0;
          foreach ($explodeSpaces as $key)
          {
            if(preg_match($dateRegex,$key))
            {
              $date[$i] = $key;
              unset($explodeSpaces[$j]);
              $i++;
            }
            $j++;
          }

          $whereBetween = [Carbon::createFromTimestamp(-1)->toDateTimeString(),Carbon::now()];

          if(!empty($date))
          {
            if(count($date) > 1)
            {
              $d1 = explode("/",$date[0]);
              $d2 = explode("/",$date[1]);
              $whereBetween = [$d1[2] . "-" . $d1[1] . "-" . $d1[0] . " 23:59:59", $d2[2] . "-" . $d2[1] . "-" . $d2[0] . " 23:59:59"];
            }else
            {
              $d1 = explode("/",$date[0]);
              array_push($where, ['users.created_at', "like" , "%" . $d1[2] . "-" . $d1[1] . "-" . $d1[0] . "%"]);
            }
          }

          if(!empty($explodeSpaces)){
            array_push($where, ['users.name','like','%' . implode(" ", $explodeSpaces) . '%']);
          }

          $users = User::join('role_user','users.id', '=', 'role_user.user_id')
          ->join('roles','role_user.role_id','=','roles.id')
          ->where($where)
          ->whereBetween('users.created_at',$whereBetween)
          ->select('users.id','roles.name AS rolename','users.name','users.email','users.created_at','users.updated_at')
          ->paginate(10);
        }

        return view('users.list', compact('users'));


    }


    public function edit($id)
    {
      $client = User::findOrFail($id);
    //  dd($client);
      return view('users.create', ['client' => $client]);
    }

    public function create(Request $request)
    {
      $request->user()->authorizeRoles(['administrator']);

      if($request->post())
      {

        if(User::where('cpf','=',$request->post()['cpf']))
        {
          return view('clients.create');
        }

        $user = User::create([
          'name'     => $data['name'],
          'email'    => $data['email'],
          'password' => bcrypt($data['password']),
        ]);

        $user->roles()
             ->attach(Role::where('name', 'client')->first());

        return $user;

      }

      return view('users.create');
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
