<?php

namespace App\Http\Middleware;

use Closure;
use Kaishiyoku\Menu\Facades\Menu;

class MakeMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        Menu::register('admin_nav', [
            Menu::link('admin.home', '<i class="fa fa-home"></i> ' . __('admin/common.menu.main')),
            Menu::dropdown([
                Menu::link('admin.admins', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.admin_users')),
                Menu::link('admin.users', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.site_users')),
                Menu::dropdownDivider(),
                Menu::link('admin.roles', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.roles')),
                Menu::link('admin.permissions', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.permissions')),
            ], '<i class="fa fa-users"></i> ' . __('admin/common.menu.users')),
            Menu::dropdown([
                Menu::link('admin.posts', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.posts')),
                Menu::link('admin.categories', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.categories')),
                Menu::link('admin.comments', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . __('admin/common.menu.comments')),
            ], '<i class="fa fa-th-list"></i> ' . __('admin/common.menu.blog')),
        ], ['class' => 'nav navbar-nav']);

        return $next($request);
    }
}
