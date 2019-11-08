<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records = Role::paginate(5);
       return view('admin.roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
          'name'  => 'required|unique:roles,name',
          'permissions_list'  => 'required|array'
        ];

        $messages = [
          'name.required' => 'Name is Required',
          'permissions_list.required'  => 'permission is Required'
        ];

        $this->validate($request,$rules,$messages);

        $record = Role::create($request->all());
        $record->permissions()->attach($request->permissions_list);
        flash()->success("Success");
        return Redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Role::findOrFail($id);
        return view('admin.roles.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = [
        'name'  => 'required|unique:roles,name,'.$id,
        'display_name'  => 'required|unique:roles,name',
        'permissions_list'  => 'required|array'
      ];

      $messages = [
        'name.required' => 'Name is Required',
        'display_name.required' => 'Display Name is Required',
        'permissions_list.required'  => 'permission is Required'
      ];

      $this->validate($request,$rules,$messages);
      $record = Role::findOrFail($id);
      $record->update($request->all());
      $record->permissions()->sync($request->permissions_list);
      flash()->success("Edited");
      return redirect(route('admin.roles.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Role::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return redirect(route('admin.roles.index'));
    }
}
