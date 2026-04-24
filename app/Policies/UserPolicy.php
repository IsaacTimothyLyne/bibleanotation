<?php

namespace App\Policies;

use App\Permissions\UserPermission;
use TrioTechnology\Permission\Policies\Policy;

class UserPolicy extends Policy
{
    protected ?string $enum = UserPermission::class;
}
