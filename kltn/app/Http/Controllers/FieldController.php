<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:field-list|field-create|field-edit|field-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:field-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:field-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:field-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $param = $request->all();
        $fields = Field::withCount('researchs');
        $fields = $fields->filter($param)->paginate(10);
        return view('fields.index', compact('fields'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('fields.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            // 'detail' => 'required',
        ]);

        Field::create($request->all());

        return redirect()->route('fields.index')
            ->with('success', 'field created successfully.');
    }

    public function show(Field $field)
    {
        $researchs = $field->researchs()->paginate(10);
        $param = ['field_id' => $field->id];
        return view('fields.show', compact('field', 'param', 'researchs'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit(Field $field)
    {
        return view('fields.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        request()->validate([
            'name' => 'required',
            // 'detail' => 'required',
        ]);

        $field->update($request->all());

        return redirect()->route('fields.index')
            ->with('success', 'field updated successfully');
    }

    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()->route('fields.index')
            ->with('success', 'field deleted successfully');
    }
}
