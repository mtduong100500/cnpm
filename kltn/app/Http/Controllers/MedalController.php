<?php

namespace App\Http\Controllers;

use App\Models\Medal;
use Illuminate\Http\Request;

class MedalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:medal-list|medal-create|medal-edit|medal-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:medal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:medal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:medal-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $param = $request->all();
        $medals = Medal::withCount('researchs');
        $medals = $medals->filter($param)->paginate(10);
        return view('medals.index', compact('medals'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('medals.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required'
        ]);

        Medal::create($request->only('name', 'status'));

        return redirect()->route('medals.index')
            ->with('success', 'Tạo thành công.');
    }

    public function show(Medal $medal)
    {
        $researchs = $medal->researchs()->paginate(10);
        $param = ['medal_id' => $medal->id];
        return view('medals.show', compact('medal', 'param', 'researchs'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit(Medal $medal)
    {
        return view('medals.edit', compact('medal'));
    }

    public function update(Request $request, Medal $medal)
    {
        request()->validate([
            'name' => 'required'
        ]);

        $medal->update($request->only('name', 'status'));

        return redirect()->route('medals.index')
            ->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Medal $medal)
    {
        $medal->delete();

        return redirect()->route('medals.index')
            ->with('success', 'Xóa thành công.');
    }
}
