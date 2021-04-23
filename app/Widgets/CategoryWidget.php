<?php

namespace App\Widgets;

use App\transaction;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Interfaces\WidgetInterface;

class CategoryWidget implements WidgetInterface
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
        $count = DB::table('categories')->count();
        return [
            'label' => 'Kategori',
            /** Fill in the label as desired **/
            'value' => $count,
            /** Fill in the value as desired **/
        ];
    }
}
