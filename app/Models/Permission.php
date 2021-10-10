<?php

namespace App\Models;

use Spatie\Permission\Guard;
use App\Contracts\Permission as PermissionContract;

class Permission extends \Spatie\Permission\Models\Permission implements PermissionContract
{

    /**
     * Create only new permission by attributes.
     *
     * @param array $attributes
     *
     * @return \App\Contracts\Permission
     */
    public static function createOnlyNew(array $attributes)
    {
        // $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $attributes['guard_name'] = $attributes['guard_name'] ?? 'admin';
        
        $permission = static::getPermissions(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])->first();
        
        if (! $permission) {
            return static::query()->create($attributes);
        }

        return $permission;
    }
}
