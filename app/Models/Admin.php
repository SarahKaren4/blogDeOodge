<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $table = 'admins';

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

    public function getAdminsList()
    {
        return $this->sort()->paginate(10);
    }

    public function getAdmins()
    {
        return $this->sort()->get();
    }

    public function storeAdmin($request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);

        $this->save();
        $this->attachRoles($request->roles);
    }

    public function getAdminById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateAdmin($request, $id)
    {
        $admin = $this->getAdminById($id);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->changePassword) {
            $admin->password = bcrypt($request->password);
        }

        $admin->syncRoles($request->roles);
        $admin->touch();
        $admin->save();
    }

    public function destroyAdmin($id)
    {
        $admin = $this->getAdminById($id);

        $importantRelations = $admin->posts()->count() || $admin->comments()->count();

        if (!$importantRelations) {
            $admin->detachPermissions();
            $admin->detachRoles();
            $admin->comments()->delete();
            $admin->posts()->delete();
            $admin->delete();
        }
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token, $this->getEmailForPasswordReset()));
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
        return $this->morphMany('App\Models\Comment', 'user');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }
}
