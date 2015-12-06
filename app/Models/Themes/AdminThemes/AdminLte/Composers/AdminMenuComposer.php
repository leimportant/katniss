<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Tuan Linh
 * Date: 2015-09-24
 * Time: 15:39
 */

namespace Katniss\Models\Themes\AdminThemes\AdminLte\Composers;

use Katniss\Models\Helpers\Menu;
use Katniss\Models\Helpers\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class AdminMenuComposer
{

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $currentUrl = currentUrl();
        $menu = new Menu('ul', 'sidebar-menu', $currentUrl);

        $user = authUser();

        if ($user->can('access-admin')) {
            // Dashboard
            $menu->addItem(new MenuItem( // add a menu item
                adminUrl(),
                trans('pages.admin_dashboard_title'), 'li', '', '', '<i class="fa fa-dashboard"></i> <span>', '</span>'
            ));
            // File Manager
            $menu->addItem(new MenuItem( // add a menu item
                adminUrl('my-documents'),
                trans('pages.my_documents_title'), 'li', '', '', '<i class="fa fa-file"></i> <span>', '</span>'
            ));


            if ($user->hasRole('admin')) {
                // System Settings
                $menu->addItem(new MenuItem( // add a menu header
                    null,
                    mb_strtoupper(trans('pages.admin_system_settings_title')), 'li', 'header'
                ));
                $menu->addItem(new MenuItem( // add a menu item
                    adminUrl('app-options'),
                    trans('pages.admin_app_options_title'), 'li', '', '', '<i class="fa fa-table"></i> <span>', '</span>'
                ));
                $menu->addItem(new MenuItem( // add a menu item
                    adminUrl('roles'),
                    trans('pages.admin_roles_title'), 'li', '', '', '<i class="fa fa-unlock-alt"></i> <span>', '</span>'
                ));
                $menu->addItem(new MenuItem( // add a menu item
                    adminUrl('users'),
                    trans('pages.admin_users_title'), 'li', '', '', '<i class="fa fa-user"></i> <span>', '</span>'
                ));
                // Theme Settings
                $menu->addItem(new MenuItem( // add a menu header
                    null,
                    mb_strtoupper(trans('pages.admin_theme_settings_title')), 'li', 'header'
                ));
                $menu->addItem(new MenuItem( // add a menu item
                    adminUrl('extensions'),
                    trans('pages.admin_extensions_title'), 'li', '', '', '<i class="fa fa-table"></i> <span>', '</span>'
                ));
                $menu->addItem(new MenuItem( // add a menu item
                    adminUrl('widgets'),
                    trans('pages.admin_widgets_title'), 'li', '', '', '<i class="fa fa-table"></i> <span>', '</span>'
                ));
                $menu->addItem(new MenuItem(  // add an example menu item which have sub menu
                    '#',
                    trans('pages.admin_ui_lang_title'), 'li', 'treeview', '', '<i class="fa fa-table"></i> <span>', '</span> <i class="fa fa-angle-left pull-right"></i>'
                ));
                $sub_menu = new Menu('ul', 'treeview-menu', $currentUrl);
                $sub_menu->addItem(new MenuItem( // add a menu item
                    adminUrl('ui-lang/php'),
                    trans('pages.admin_ui_lang_php_title'), 'li', '', '', '<i class="fa fa-table"></i> <span>', '</span>'
                ));
                $sub_menu->addItem(new MenuItem( // add a menu item
                    adminUrl('ui-lang/email'),
                    trans('pages.admin_ui_lang_email_title'), 'li', '', '', '<i class="fa fa-table"></i> <span>', '</span>'
                ));
                $menu->last()->setChildMenu($sub_menu);
            }
        }

        $view->with('admin_menu', $menu->render());
    }
}