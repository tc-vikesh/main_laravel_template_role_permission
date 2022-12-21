<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Guard;
use DB;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add permission routes';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $routes = Route::getRoutes()->getRoutes();
        foreach ($routes as $route) {
            if($route->getName() && in_array('permission', $route->getAction()['middleware'])){
                // dd($route->getName());
                $name_parts = explode('.',$route->getName());
                if($name_parts[0] == 'admin' && array_key_exists(1,$name_parts)){
                    $permission = Permission::where('name', $route->getName())->first();

                    if (is_null($permission)) {
                        Permission::create(['name' => $route->getName(), 'group_name' => $name_parts[1]]);
                    }
                }
            }

        }
        $this->info('Permission routes added successfully.');
        return Command::SUCCESS;
    }
}
