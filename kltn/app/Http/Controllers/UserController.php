<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Research;
use App\Models\User;
use App\Models\Topic;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $param = $request->all();
        $users = User::filter($param)->orderBy('id', 'ASC');
        if (Auth::user()->can('user-list')) {
            $users->where('role', ">", Auth::user()->role)->withCount('topics');
        }
        $users = $users->paginate(10)->appends($param);
        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
        // $topics = Topic::all();
        // echo $topics;
    }

    public function create()
    {
        $roles = Role::where('id', ">", Auth::user()->role)->pluck('name', 'id')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users|alpha_dash',
            'email' => 'sometimes|nullable|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role'] = $input['roles'][0];
        if (Auth::user()->role >= intval($input['role'])) {
            Toastr::error("Bạn không thể gắn quyền với quyền lớn hơn.");
            return back()->withInput();
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        $topics = Topic::where('user_id', $user->id)->paginate(10);
        $param = ['user_id' => $user->id];
        return view('users.show', compact('user', 'param', 'topics'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('id', ">", Auth::user()->role)->pluck('name', 'id')->all();
        $userRole = $user->roles->pluck('id', 'id')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id . '|alpha_dash',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $input['role'] = $input['roles'][0];
        if (Auth::user()->role >= intval($input['role'])) {
            Toastr::error("Bạn không thể gắn quyền với quyền lớn hơn.");
            return back()->withInput();
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Cập nhập tài khoản thành công');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function showListUser() {
        $users = DB::table('users')->get();
        return $users;
    }
}
