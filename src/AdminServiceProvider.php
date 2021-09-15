<?php

namespace Sislamrafi\Admin;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

use \Symfony\Component\Console\Output\ConsoleOutput as cso;

class AdminServiceProvider extends ServiceProvider
{
    public const HOME = '/admin';

    public function boot()
    {
        $this->co = new cso;

        if ($this->app->runningInConsole()) {
            $this->publishRoutes();
            $this->publishMigrations();
            $this->publishes([
                __DIR__.'/public' => public_path('vendor/sislamrafi/admin'),
            ], 'public');
            $this->publishes([
                __DIR__.'/config/admin.php' => config_path('admin.php'),
              ], 'config');
        }
        
        $this->registerRoutes();
        $this->registerMiddleware();
        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');
        //$this->verifyEmail();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/auth.php', 'auth');
    }

    protected function registerRoutes()
    {
        if (!is_dir(base_path('routes/admin')))return;
        Route::middleware(['web'])  
                ->prefix('admin')
                ->name('admin.')
                ->namespace('Sislamrafi\Admin')
                ->group(base_path('routes/admin/web.php'));
        Route::middleware(['api'])
                ->prefix('admin/api')
                ->name('admin.api')
                ->namespace('Sislamrafi\Admin')
                ->group(base_path('routes/admin/api.php'));
    }

    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, $this->mergeConfig(require $path, $config));
    }

    protected function mergeConfig(array $original, array $merging)
    {
        $array = array_merge($original, $merging);

        foreach ($original as $key => $value) {
            if (! is_array($value)) {
                continue;
            }

            if (! Arr::exists($merging, $key)) {
                continue;
            }

            if (is_numeric($key)) {
                continue;
            }

            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }

        return $array;
    }

    protected function publishRoutes()
    {
        $this->publishes([
            __DIR__.'/routes/web.php' => base_path().'/routes/admin/web.php',
             __DIR__.'/routes/api.php' => base_path().'/routes/admin/api.php',
          ], 'routes');
    }

    protected function publishMigrations()
    {
        $this->co->writeln("Attempt to create migration");
        if (!$this->migrationExists('create_admins_table.php')) {
            $this->publishes([
              __DIR__ . '/database/migrations/create_admins_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_admins_table.php'),
              // you can add any number of migrations here
            ], 'migrations');
            $this->co->writeln("Migration created");
            return;
        }
        $this->co->writeln("Migration exists!");
    }

    protected function migrationExists($mgr)
    {
        $path = database_path('migrations/');
        $files = scandir($path);
        $pos = false;
        $this->co->writeln("Searching migration : " . $mgr);
        foreach ($files as &$value) {
            //$this->co->writeln($value);
            $pos = strpos($value, $mgr);
            if ($pos !== false) {
                return true;
            }
        }
        return false;
    }

    protected function registerMiddleware()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('auth-admin', \Sislamrafi\Admin\app\Http\Middlewares\AdminAuth::class);
        $router->aliasMiddleware('admin-verified', \Sislamrafi\Admin\app\Http\Middlewares\AdminEmailVerify::class);
        //$router->pushMiddlewareToGroup('admin', \Sislamrafi\Admin\app\Http\Middlewares\AdminAuth::class);
    }

    
}
