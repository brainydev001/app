<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Type;
use App\Models\User;
use App\Models\Setup;
use App\Models\Role;


class SetupController extends Controller
{
    //gets the welcome blade
    public function landing()
    {
        return view('welcome');
    }

    // authorization for set up
    public function setup()
    {
        $data = [
            'username' => 'System',
            'password' => 'pafidsysadmin001'
        ];
        //check if data exists and if not create system set up authorization data
        $check = Setup::where([
            ['username', '=', 'System']
        ])->first();
        if (!$check) {
            Setup::create($data);
        }

        return view('setup_auth');
    }


    // set up user types and system permissions
    public function setupAuth(Request $request)
    {
        // check if details match
        $username = $request['username'];
        $password = $request['password'];

        $check = Setup::where([
            ['username', '=', $username],
            ['password', '=', $password]
        ])->first();

        if ($check) {
            return $this->setupItems();
        } else {
            return redirect('setup')->with('warning-message', 'Unauthorized access!!');
        }
    }

    private function setupItems()
    {
        // declare types variables with relevant data
        $check = Type::where([
            ['display_name', '=', 'Administrator']
        ])->first();
        // admin
        if (!$check) {
            $admin_data = [
                'display_name' => 'Administrator',
                'description' => 'System administrator',
                'designation' => 'administartor',
                'created_by' => '1'
            ];
            $type = Type::create($admin_data);

            // setup system permissions
            $permissions_data = [
                ['name' => 'create user', 'display_name' => 'User', 'description' => 'is able to create users'],
                ['name' => 'access user', 'display_name' => 'User', 'description' => 'is able to access users'],
                ['name' => 'edit user', 'display_name' => 'User', 'description' => 'is able to edit users'],
                ['name' => 'delete user', 'display_name' => 'User', 'description' => 'is able to delete users'],
                ['name' => 'access region', 'display_name' => 'Region', 'description' => 'is able to access regions'],
                ['name' => 'create region', 'display_name' => 'Region', 'description' => 'is able to create regions'],
                ['name' => 'delete region', 'display_name' => 'Region', 'description' => 'is able to delete regions'],
                ['name' => 'access type', 'display_name' => 'Type', 'description' => 'is able to access types'],
                ['name' => 'create type', 'display_name' => 'Type', 'description' => 'is able to create types'],
                ['name' => 'delete type', 'display_name' => 'Type', 'description' => 'is able to delete types'],
                ['name' => 'access access control', 'display_name' => 'Access Control', 'description' => 'is able to access access control'],
                ['name' => 'create role', 'display_name' => 'Role', 'description' => 'is able to create role'],
                ['name' => 'edit role', 'display_name' => 'Role', 'description' => 'is able to edit role'],
                ['name' => 'delete role', 'display_name' => 'Role', 'description' => 'is able to delete role'],
            ];
           
            // set up system role
            $role_data = [
                'name' => 'System',
                'display_name' => 'System',
                'description' => 'unlimited access'
            ];

            // create system role
            $sys_role = Role::create($role_data);

            // create user
            $no_data = 'n/a';
            $admin_user = [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'phone_number' => '0722931145',
                'age' => $no_data,
                'gender' => $no_data,
                'email' => 'admin@pafidkenya.org',
                'county' => $no_data,
                'sub_county' => $no_data,
                'region_id' => '0',
                'constituency_id' => '0',
                'ward_id' => '0',
                'type_id' => $type->id,
                'password' => Hash::make('pafidsysadmin001'),
                'is_approved' => true
            ];
            $sys_user = User::create($admin_user);

            // update type data to correct created by
            $update = [
                'created_by' => $sys_user->id,
            ];
            $type = Type::find($type->id);
            $type->update($update);

            // sync all permissions to system role
            // create system permission
            foreach ($permissions_data as $permission_data) {
                $perm = Permission::create($permission_data);
                $sys = Role::find($sys_role->id);
                $sys->attachPermission($perm->id);
            }

            // sync system role to system user
            $user = User::find($sys_user->id);
            $user->attachRole($sys_role);

            // redirect to login page
            return redirect('login');
        }

        // delete type and system details if error occurs
            // type
        $type = Type::where([
            ['display_name', '=', 'Administrator']
        ])->first();
        $type = Type::find($type->id);
        $type->delete();
        // system details
        $system = Setup::where([
            ['username', '=', 'System']
        ])->first();
        $system = Setup::find($system->id);
        $system->delete();

        return redirect('setup')->with('warning-message', 'Error occured during setup. Please run the /setup route again!!');
    }
}
