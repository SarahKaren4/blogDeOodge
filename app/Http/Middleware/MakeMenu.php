<?php

namespace App\Http\Middleware;

use Closure;
use Kaishiyoku\Menu\Facades\Menu;
use App\Models\Category;

class MakeMenu
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

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

        /////////////////////////////////////////////////////////////////////////////////////////////////

        $categoriesArray = [];

        foreach($this->categoryModel->getCategories() as $category) {
            $categoriesArray[] = Menu::link('site.category.show', '<i class="fa fa-circle-o"></i>&nbsp;&nbsp;' . $category->title, ['slug' => $category->slug]);
        }

        Menu::register('site_nav', [
            Menu::link('site.home', '<i class="fa fa-home"></i> ' . __('site/common.menu.blog')),
            Menu::dropdown($categoriesArray, '<i class="fa fa-th-list"></i> ' . __('site/common.menu.categories')),
            Menu::link('site.contacts', '<i class="fa fa-phone"></i> ' . __('site/common.menu.contacts')),
            Menu::link('site.aboutus', '<i class="fa fa-info-circle"></i> ' . __('site/common.menu.about_us')),
        ], ['class' => 'nav navbar-nav']);

        return $next($request);
    }
}
