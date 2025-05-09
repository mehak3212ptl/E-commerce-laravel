<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::get();
        return view('role-permission.role.index',['roles'=> $roles]);
    }

    
    public function create()
    {
        return view('role-permission.role.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'

            ]
            ]);
            Role::create([
                'name'=>$request->name
            ]);
            return redirect('roles')->with('status','role create succesfully ');
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('role-permission.role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role )
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name,'.$role->id

            ]
            ]);
            $role->update([
                'name'=>$request->name
            ]);
            return redirect('roles')->with('status','role update  succesfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $roles=Role::find($roleId);
        $roles->delete();
        return redirect('roles')->with('status','role deleted   succesfully ');
    }

    public function addPermissionToRole($roleId)
    {    
        $permissions=Permission::get();
         $role=Role::findOrFail($roleId);
         $rolePermissions =DB::table('role_has_permissions')->where('role_has_permissions.role_id',$role->id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
         return view ('role-permission.role.add-permissions',
         [
         'role'=>$role,
         'permissions'=>$permissions,
         'rolePermissions'=>$rolePermissions
         ]);

    }

    public function givePermissionToRole(Request $request,$roleId)
    {
       $request->validate([
        'permission'=>'required'
       ]);
       $role= Role::findOrFail($roleId);
       $role->syncPermissions($request->permission );
       return redirect()->back()->with('status','permissions added to role ');
    }
}
