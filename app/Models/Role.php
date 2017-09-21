<?php

namespace App\Models;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    public function getRolesList()
    {
        return $this->sort()->paginate(10);
    }

    public function getRoles()
    {
        return $this->sort()->get();
    }

    public function storeRole($request)
    {
        $this->name = $request->name;
        $this->display_name = $request->display_name;
        $this->description = $request->description;

        $this->save();

        $this->permissions()->attach($request->permissions);
    }

    public function getRoleById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateRole($request, $id)
    {
        $role = $this->getRoleById($id);

        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->permissions()->sync($request->permissions);

        $role->touch();
        $role->save();
    }

    public function destroyRole($id)
    {
        $role = $this->getRoleById($id);
        $importantRelations = $role->admins()->count() || $role->users()->count();

        if (!$importantRelations) {
            $role->permissions()->detach();
            $role->users()->detach();
            $role->admins()->detach();
            $role->delete();
        }
    }

    public function scopeSort($query)
    {
        $query->orderBy('name');
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
