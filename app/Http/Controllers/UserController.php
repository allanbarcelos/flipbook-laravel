<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $user = User::where('users.id', \Auth::user()->id)
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
      return view('user/index')->with('user',$value);
    }

  }

  public function changePassword(Request $request)
  {
    $this->validate($request, [
      'oldPassword' => 'required',
      'newPassword' => 'required|min:6|confirmed',
    ]);

    $user = User::find(Auth::id());
    $hashedPassword = $user->newPassword;

    if (Hash::check($request->oldPassword, $hashedPassword)) {
      //Change the password
      $user->fill([
        'password' => Hash::make($request->newPassword)
        ])->save();

        $request->session()->flash('success', 'Your password has been changed.');

        return back();
      }

      $request->session()->flash('failure', 'Your password has not been changed.');

      return back();
    }
  }
