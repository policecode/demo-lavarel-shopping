<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Module;
use App\Models\Product;
use App\Models\User;
use App\Policies\CategoriesPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoriesPolicy::class,
        Product::class => ProductPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Nhấp vào nút bên dưới để xác minh địa chỉ email của bạn.')
                ->action('Verify Email Address', $url);
        });
        $moduleList = Module::all();
        if ($moduleList->count() > 0) {
            foreach ($moduleList as $module) {
                Gate::define($module->name . '.view', function (User $user) use ($module) {
                    if (!empty($user->group_id)) {
                        $permissionArr = json_decode($user->group->permission, true);
                        if (!empty($permissionArr)) {
                            $check = isRole($permissionArr, $module->name, 'view');
                            return $check;
                        }
                    } else {
                        return true;
                    }
                    return false;
                });

                Gate::define($module->name . '.create', function (User $user) use ($module) {
                    if (!empty($user->group_id)) {
                        $permissionArr = json_decode($user->group->permission, true);
                        if (!empty($permissionArr)) {
                            $check = isRole($permissionArr, $module->name, 'create');
                            return $check;
                        }
                    } else {
                        return true;
                    }
                    return false;
                });

                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    if (!empty($user->group_id)) {
                        $permissionArr = json_decode($user->group->permission, true);
                        if (!empty($permissionArr)) {
                            $check = isRole($permissionArr, $module->name, 'edit');
                            return $check;
                        }
                    } else {
                        return true;
                    }
                    return false;
                });

                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    if (!empty($user->group_id)) {
                        $permissionArr = json_decode($user->group->permission, true);
                        if (!empty($permissionArr)) {
                            $check = isRole($permissionArr, $module->name, 'delete');
                            return $check;
                        }
                    } else {
                        return true;
                    }
                    return false;
                });

                if ($module->name == 'groups') {
                    Gate::define($module->name . '.permission', function (User $user) use ($module) {
                        if (!empty($user->group_id)) {
                            $permissionArr = json_decode($user->group->permission, true);
                            if (!empty($permissionArr)) {
                                $check = isRole($permissionArr, $module->name, 'permission');
                                return $check;
                            }
                        } else {
                            return true;
                        }
                        return false;
                    });
                }
            }
        }
    }
}
