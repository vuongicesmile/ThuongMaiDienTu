<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyCheckAccess {

    public function setGateAndPolicyAcess()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateSettings();
        $this->defineGateUser();
        $this->defineGateRoles();
        $this->defineGateSlider();

    }

    public function defineGateCategory()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
    public function defineGateMenu()
    {
        Gate::define('menu-list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu-add', 'App\Policies\MenuPolicy@create');
        Gate::define('menu-edit', 'App\Policies\MenuPolicy@update');
        Gate::define('menu-delete', 'App\Policies\MenuPolicy@delete');
    }

    public function defineGateProduct()
    {
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }
    public function defineGateSettings()
    {
        Gate::define('setting-list', 'App\Policies\SettingsPolicy@view');
        Gate::define('setting-add', 'App\Policies\SettingsPolicy@create');
        Gate::define('setting-edit', 'App\Policies\SettingsPolicy@update');
        Gate::define('setting-delete', 'App\Policies\SettingsPolicy@delete');
    }
    public function defineGateUser()
    {
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }
    public function defineGateRoles()
    {
        Gate::define('roles-list', 'App\Policies\RolesPolicy@view');
        Gate::define('roles-add', 'App\Policies\RolesPolicy@create');
        Gate::define('roles-edit', 'App\Policies\RolesPolicy@update');
        Gate::define('roles-delete', 'App\Policies\RolesPolicy@delete');
    }

    public function defineGateSlider()
    {
        Gate::define('slider-list', 'App\Policies\SlidersPolicy@view');
        Gate::define('slider-add', 'App\Policies\SlidersPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SlidersPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SlidersPolicy@delete');
    }

}
