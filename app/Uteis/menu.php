<?php

namespace App\Uteis;

use App\Models\Menu as ModelsMenu;
use Illuminate\Support\Facades\Request;

class Menu {

    //make function mount menu to user role and permission
   public static function menu($user)
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function parse($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = parse($item, $value->id);
                    $value->children = $child ?: $child;
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->where('active', 1)->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        $roles = $user->roles;
        $menus = ModelsMenu::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('id', $roles->pluck('id'));
        })->get();
        return parse($menus, 0);
    }

   public static function nestable()
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function nest($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = nest($item, $value->id);
                    $value->children = $child ? $child : '';
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->orderBy('sequence', 'asc')->findAll(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return nest((new ModelsMenu())->orderBy('sequence', 'asc')->get(), 0);
    }

 public static function build($user)
    {
        $html = '';
        foreach (self::menu($user) as $parent) {
            $open = url()->current() == url($parent->route) || in_array(Request::segment(1).'.'.Request::segment(2), array_column($parent->children, 'route')) ? 'menu-open' : '';
            $active = url()->current() == url($parent->route) || in_array(Request::segment(1).'.'.Request::segment(2), array_column($parent->children, 'route')) ? 'active' : '';
            $link = isset($parent->route) ? url($parent->route) : '#';

            $html .= "<li class='nav-item has-treeview {$open}'>";
            $html .= "<a href='{$link}' class='nav-link {$active}'>";
            $html .= "<i class='nav-icon {$parent->icon}'></i>";
            $html .= '<p>';
            $html .= $parent->nome;
            if (count($parent->children)) {
                $html .= "<i class='right fas fa-angle-left'></i>";
            }
            $html .= '</p>';
            $html .= '</a>';
            if (count($parent->children)) {
                $html .= "<ul class='nav nav-treeview'>";
                foreach ($parent->children as $child) {
                    $link_child = isset($child->route) ? url($child->route) : '#';
                    $active_child = url()->current() == url($child->route) ? 'active' : '';
                    $html .= "<li class='nav-item has-treeview'>";
                    $html .= "<a href='{$link_child}'";
                    $html .= "class='nav-link {$active_child}'>";
                    $html .= "<i class='nav-icon {$child->icon}'></i>";
                    $html .= " <p>{$child->nome}</p>";
                    $html .= '</a>';
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }

    public static function mountMenu($user) {
        $menu = [];

        if (isset($user)) {
            # code...
        $roles = $user->roles;
        $menus = ModelsMenu::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('id', $roles->pluck('id'));
        })->get();

       foreach($roles as $role) {
            foreach($menus as $value) {
                $menu[$value->id] = [
                    'id' => $value->id,
                    'nome' => $value->nome,
                    'icon' => $value->icon,
                    'role_id' => $role->id,
                    'submenu' => []
                ];
            }
        }



        foreach ($roles as $role) {
            # code...
        foreach($role->permissions as $value) {
            foreach($menu as $menus){
                if($menus['role_id'] == $value->role_id) {
                    $menus['submenu'] = [
                        'id' => $value->id,
                        'name' => $value->name,
                        'icon' => $value->icon,
                        'role_id' => $value->role_id,
                        'menu_id' => $value->menu_id,
                        'route' => $value->route,
                    ];
                }
            }

        }
    }
}

      return $menu;
    }
}




