<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\SiteResetPasswordNotification;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $table = 'users';

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

    public function getUsersList()
    {
        return $this->sort()->paginate(10);
    }

    public function getUsers()
    {
        return $this->sort()->get();
    }

    public function storeUser($request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);

        $this->save();
    }

    public function getUserById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateUser($request, $id)
    {
        $user = $this->getUserById($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->changePassword) {
            $user->password = bcrypt($request->password);
        }

        $user->touch();
        $user->save();
    }

    public function destroyUser($id)
    {
        $user = $this->getUserById($id);

        $user->delete();
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SiteResetPasswordNotification($token, $this->getEmailForPasswordReset()));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('j, m, Y | g:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('j, m, Y | g:i a', strtotime($value));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function comments()
    {
        return $this->morphMany('App\Model\Comment', 'user');
    }
}
