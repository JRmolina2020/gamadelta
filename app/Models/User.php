<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
  use HasRoles;

  public function getAllPermissionsAttribute()
  {
    $permissions = [];
    foreach (Permission::all() as $permission) {
      if (Auth::user()->can($permission->name)) {
        $permissions[] = $permission->name;
      }
    }
    return $permissions;
  }

  function facture_bills()
  {
    return $this->hasMany('App\Model\Bill');
  }
  function companies()
  {
    return $this->hasMany('App\Model\Company');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
