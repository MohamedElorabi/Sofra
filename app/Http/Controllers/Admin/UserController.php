<?php

namespace App\Http\Controllers\Admin;
use App\Models\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $records = User::paginate(5);
       return view('admin.users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $model)
    {
        return view('admin.users.create', compact('model'));
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
          'name'  => 'required',
          'password'  => 'required|confirmed',
          'email' => 'required|email',
          'roles_list'  => 'required'
        ];

        $messages = [
          'name.required' => 'Name is Required',
          'password.required' => 'password is Required',
          'email.required' => 'Email is Required',
          'roles_list.required' => 'Role list is Required',
        ];

        $request->merge(['password' => bcrypt($request->password)]);
        $this->validate($request,$rules,$messages);

        $user = User::create($request->excpt('roles_list'));

        flash()->success("Success");
        return redirect(route('admin.users.index'));
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
        $model = User::findOrFail($id);
        return view('users.edit',compact('model'));
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
        'name'  => 'required',
        'password'  => 'required|confirmed',
        'email' => 'required|email',
        'roles_list'  => 'required'
      ];

      $messages = [
        'name.required' => 'Name is Required',
        'password.required' => 'password is Required',
        'email.required' => 'Email is Required',
        'roles_list.required' => 'Role list is Required',
      ];
        $user = User::findOrFail($id);
        $user->roles()->sync((array) $request->input('roles_list'));
        $request->merge(['password' => bcrypt($request->password)]);
        $update = $user->update($request->all());
        flash()->success("Edited");
        return redirect(route('admin.users.index',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = User::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return redirect(route('admin.users.index'));
    }


    public function getChangePassword()
    {
      return view('admin.users.change-password');
    }

    public function changePassword_save(Request $request){
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
}
