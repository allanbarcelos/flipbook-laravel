<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Carbon\Carbon;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Validator;
use Event;

class ClientsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $request->user()->authorizeRoles(['administrator']);

    $post = $request->post();

    if(!$post || !isset($post['search']))
    {
      $users = User::join('role_user','users.id', '=', 'role_user.user_id')
      ->join('roles','role_user.role_id','=','roles.id')
      ->where([
        ['roles.name','=','client']
      ])
      ->select('users.id','users.name','users.email','users.created_at','users.updated_at')
      ->paginate(10);
    }else
    {
      $explodeSpaces = explode(" ", $post['search']);


      $where = [
        ['roles.name','=','client'],
      ];
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
        ->select('users.id','users.name','users.email','users.created_at','users.updated_at')
        ->paginate(10);
      }

      return view('clients.index', compact('users'));
    }

    public function edit(Request $request,$id)
    {
        $request->user()->authorizeRoles(['administrator']);

        $user = User::where('users.id', $id)
                    ->join('cpf_user', 'users.id', '=', 'cpf_user.user_id')

                    ->join('phone_user as mobileMap','users.id','=','mobileMap.user_id')
                    ->join('phones as cell', function ($join) {
                      $join->where('cell.type', '=', 'cellphone');
                    })

                    ->join('phone_user as homeMap','users.id','=','homeMap.user_id')
                    ->join('phones as home', function ($join) {
                      $join->where('home.type', '=', 'landline');
                    })

                    ->join('address_user as address','users.id','=','address.user_id')

                    ->select('users.*',
                             'cpf_user.cpf as cpf',
                             'cell.phone as cellphone',
                             'home.phone as landline'
                    )->get();

        foreach ($user as $key => $value)
        {
          return view('users/edit')->with('user',$value);
        }
    }

    public function create(Request $request)
    {
      $request->user()->authorizeRoles(['administrator']);


      if($request->isMethod('post'))
      {


        $validator = Validator::make($request->all(), [
          'cpf' => 'required|unique:cpf_user,cpf',
          'email' => 'required|email|unique:users,email',
          'contract' => 'required|unique:contract_user,number',
        ]);

        if ($validator->fails())
        {
          return back()->withInput()
          ->withErrors($validator)
          ->withInput();
        }


        $user = User::create($request->all());

        $user->roles()
          ->attach(Role::where('name', 'client')->first());

        //Fire the event
        Event::fire(new UserCreated($user));

        return redirect()->back()->with('message', 'Cliente cadastrado com sucesso');

      }

      return view('clients.create');
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
