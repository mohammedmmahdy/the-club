<?php

namespace App\Contracts;

use Spatie\Permission\Contracts\Permission as PermissionContract;

interface Permission extends PermissionContract
{

    /**
     * Create only new permission by attributes.
     *
     * @param array $attributes
     *
     * @return Permission
     */
    public static function createOnlyNew(array $attributes);
}
