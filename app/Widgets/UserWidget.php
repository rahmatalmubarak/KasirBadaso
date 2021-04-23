<?php

namespace App\Widgets;

use App\transaction;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Interfaces\WidgetInterface;

class UserWidget implements WidgetInterface
{
    /**
     * Set permission for widget
     * set null to allow all role
     * multiple permission allowed, separate by comma.
     */
    public function getPermissions()
    {
        return 'browse_permissions';
    }

    public function run($params = null)
    {
        $count = DB::table('users')->count();
        return [
            'label' => 'Pengguna',
            /** Fill in the label as desired **/
            'value' => $count,
            /** Fill in the value as desired **/
        ];
    }
}
