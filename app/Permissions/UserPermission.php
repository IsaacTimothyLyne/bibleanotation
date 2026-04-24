<?php

namespace App\Permissions;

enum UserPermission: string
{
    case viewAny = 'users.view_any';
    case view = 'users.view';
    case create = 'users.create';
    case update = 'users.update';
    case delete = 'users.delete';
    case forceDelete = 'users.force_delete';

    case forceDeleteAny = 'users.force_delete_any';
    case restore = 'users.restore';
    case reorder = 'users.reorder';
    case replicate = 'users.replicate';
}
