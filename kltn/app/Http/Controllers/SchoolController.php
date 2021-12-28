<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\School;
use App\Models\Province;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:school-list|school-create|school-edit|school-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:school-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:school-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:school-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $provinces = Province::pluck('name', 'id')->all();
        $param = $request->all();
        $schools = School::filter($param);

        if (Auth::user()->role > 2) {
            $schools->where('province_id', Auth::user()->id_ref);
        } else {
            $schools->orderBy('province_id', 'ASC');
        }
        $schools = $schools->paginate(10)->appends($param);
        return view('schools.index', compact('schools', 'provinces'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $provinces = Province::orderBy('id', 'ASC');
        if (Auth::user()->role > 2) {
            $provinces->where('id', Auth::user()->id_ref);
        }
        $provinces = $provinces->pluck('name', 'id')->all();
        return view('schools.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'key' => 'required|unique:schools',
            'name' => 'required',
            'level' => 'required',
            'province_id' => 'required',
        ]);

        School::create($request->all());

        return redirect()->route('schools.index')
            ->with('success', 'Tạo trường thành công.');
    }

    public function show($key)
    {
        $school = School::where('key', $key)->firstOrFail();
        $provinces = Province::where('id', $school->province_id)->pluck('name', 'id');
        return view('schools.show', compact('school', 'provinces'));
    }

    public function edit($key)
    {

        $provinces = Province::orderBy('id', 'ASC');
        if (Auth::user()->role > 2) {
            $provinces->where('id', Auth::user()->id_ref);
        }
        $provinces = $provinces->pluck('name', 'id')->all();
        $school = School::where('key', $key)->firstOrFail();
        return view('schools.edit', compact('school', 'provinces'));
    }

    public function update(Request $request, $key)
    {
        request()->validate([
            'name' => 'required',
            'level' => 'required',
        ]);
        $school = School::where('key', $key)->firstOrFail();
        $school->name = $request->get('name');
        $school->nameEn = $request->get('nameEn');
        $school->level = $request->get('level');
        $school->key = $request->get('key');
        $school->province_id = $request->get('province_id');
        $school->save(['key', $key]);
        return redirect()->route('schools.index')
            ->with('success', 'Cập nhật trường thành công.');
    }

    public function destroy($key)
    {
        $school = School::where('key', $key);
        $school->delete();

        return redirect()->route('schools.index')
            ->with('success', 'Xóa trường thành công');
    }
    /*List school*/
    public function list(Request $request)
    {
        $param = $request->all();
        $schools = School::filter($param);
        return $schools->get()->all();
    }

    public function schoolEn($id)
    {
        $school = School::where('key', $id);
        if (!$school->get('nameEn')) return '';
        return $school->get('nameEn');
    }
}
