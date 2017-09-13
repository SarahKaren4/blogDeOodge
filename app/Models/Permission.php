<?php

namespace App\Models;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public function getPermissionsList()
    {
        return $this->sort()->paginate(10);
    }

    public function getPermissions()
    {
        return $this->sort()->get();
    }

    public function storePermission($request)
    {
        $this->name = $request->name;
        $this->display_name = $request->display_name;
        $this->description = $request->description;

        $this->save();
    }

    public function getPermissionById($id)
    {
        return $this->findOrFail($id);
    }

    public function updatePermission($request, $id)
    {
        $permission = $this->getPermissionById($id);

        $permission->display_name = $request->display_name;
        $permission->description = $request->description;

        $permission->touch();
        $permission->save();
    }

    public function destroyPermission($id)
    {
        $permission = $this->getPermissionById($id);

        $permission->roles()->detach();
        $permission->users()->detach();
        $permission->admins()->detach();

        $permission->delete();
    }

    public function scopeSort($query)
    {
        $query->latest('id');
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
        $this->attributes['name'] = strtolower($value);
    }
}
