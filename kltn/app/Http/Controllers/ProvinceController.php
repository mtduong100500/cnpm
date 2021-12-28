<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Province;
use App\Models\Research;
use App\Models\User;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:province-list|province-create|province-edit|province-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:province-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:province-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:province-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $provinces = Province::withCount('researchs')->paginate(10);
        return view('provinces.index', compact('provinces'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Province::create($request->all());

        return redirect()->route('provinces.index')
            ->with('success', 'Province created successfully.');
    }

    public function show(Province $province)
    {
        $researchs = Research::where('province_id', $province->id)->paginate(10);
        $fields = Field::pluck('name', 'id')->all();
        $users = User::where('id_ref', $province->id)->pluck('name', 'id')->all();
        $param = ['province_id' => $province->id];
        return view('provinces.show', compact('province', 'researchs', 'users', 'fields', 'param'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $province->update($request->all());

        return redirect()->route('provinces.index')
            ->with('success', 'Province updated successfully');
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()->route('provinces.index')
            ->with('success', 'Province deleted successfully');
    }
}
