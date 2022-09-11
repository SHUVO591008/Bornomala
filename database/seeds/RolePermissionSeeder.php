<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //create role

        $roleSuperAdmin = Role::create(['name' => 'superadmin','guard_name'=>'admin']);
        $roleAdmin = Role::create(['name' => 'admin','guard_name'=>'admin']);
        $roleEditor = Role::create(['name' => 'editor','guard_name'=>'admin']);
        $roleUser = Role::create(['name' => 'user','guard_name'=>'admin']);


        //permission list as array
        $permissions = [

            //Dashboard
            [
                'group_name'=>'dashboard',
                'permissions'=>[
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
           

            //blog

             [
                'group_name'=>'blog',
                'permissions'=>[
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],

          
             //admin

             [
                'group_name'=>'admin',
                'permissions'=>[
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],

            
            //role
            [
                'group_name'=>'role',
                'permissions'=>[
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',

                ]
            ],
        
            //user
               [
                'group_name'=>'user',
                'permissions'=>[
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                    'user.approve',

                ]
            ],

               //profile
               [
                'group_name'=>'profile',
                'permissions'=>[
                    'profile.view',
                    'profile.edit',
    
             
                ]
            ],
          
         
        ];
        //create and 

        

        for ($i=0; $i < count($permissions); $i++) {

            $permissionGroup = $permissions[$i]['group_name'];

            for ($j=0; $j <count($permissions[$i]['permissions']); $j++) { 

                  //create permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j],'group_name'=>$permissionGroup]);

                //assign permission
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        
        }
        
    }
}
