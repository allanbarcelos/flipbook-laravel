<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function contract()
    {
        return $this->hasOne('App\Contract');
    }

    public function cpf()
    {
        return $this->hasOne('App\Cpf');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class);
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
        abort(401, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasAnyPhone($user_id)
    {
        return null !== $this->phones()->whereIn('user_id', $user_id)->first();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAddress($user_id)
    {
        return null !== $this->address()->where('user_id', $user_id)->first();
    }

    public function hasContract($user_id)
    {
        return null !== $this->contract()->where('user_id', $user_id)->first();
    }

    public function hasPhone($user_id)
    {
        return null !== $this->phones()->where('user_id', $user_id)->first();
    }

}
