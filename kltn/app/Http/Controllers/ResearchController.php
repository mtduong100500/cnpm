<?php

namespace App\Http\Controllers;

use App\Exports\ResearchsExport;
use Maatwebsite\Excel\Facades\Excel;

use Auth;
use App\Models\Field;
use App\Models\File;
use App\Models\Group;
use App\Models\Medal;
use App\Models\Province;
use App\Models\Research;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


function updateSchool($key, $nameEn)
{
    $school = School::where('key', $key)->firstOrFail();
    $school->nameEn = $nameEn;
    $school->save();
}

class ResearchController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:topic-list|topic-create|topic-edit|topic-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:research-list|research-create|research-edit|research-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:research-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:research-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:research-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:research-report', ['only' => ['export']]);
    }

    public function index(Request $request)
    {
        $param = $request->all();
        if (Auth::user()->can('research-report')) {
            $fields = Field::pluck('name', 'id')->all();
            $provinces = Province::pluck('name', 'id')->all();
            $users = User::whereIn('role', [3, 6])->pluck('name', 'id')->all();
            $groups = Group::pluck('name', 'id')->all();
            $medals = Medal::pluck('name', 'id')->all();
        }
        $researchs = Research::filter($param);

        if (Auth::user()->role > 2 && Auth::user()->role != 8) {
            $researchs->where('user_id', Auth::user()->id);
            $param = ['user_id' => Auth::user()->id];
        } else {
            $researchs->orderBy('id', 'ASC');
        }
        $researchs = $researchs->paginate(10)->appends($param);
        return view('researchs.index', compact('researchs', 'param', 'fields', 'provinces', 'users', 'groups', 'medals'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(Request $request)
    {
        $fields = Field::pluck('name', 'id')->all();
        $fieldsEn = Field::pluck('nameEn', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $user = Auth::user();
        return view('researchs.create', compact('user', 'fields', 'fieldsEn', 'provinces', 'users'));
    }


    public function store(Request $request)
    {
        if (!$request->get('school_1')) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'school_1' => 'Vui lòng chọn trường cho học sinh 1',
                ]);
        }
        if ($request->get('type') == 2 && !$request->get('school_2'))
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'school_2' => 'Vui lòng chọn trường cho học sinh 2',
                ]);
        request()->validate([
            'name' => 'required',
            'nameEn' => 'required',
            'field_id' => 'required',
            'school_1' => 'required'
        ]);
        $input = $request->all();
        $data = $request->only('_token', '_method', 'name', 'nameEn', 'field_id', 'type', 'level', 'school_1', 'school_2');
        $data['student_1'] = implode(',', [
            $input['student1'], $input['dob1'], $input['gender1'], $input['grade1'], $input['nation1'], $input['HL1'], $input['HK1'],
        ]);
        $data['student_2'] = implode(',', [
            $input['student2'] ?? '', $input['dob2'] ?? '', $input['gender2'] ?? '', $input['grade2'] ?? '', $input['nation2'] ?? '', $input['HL2'] ?? '', $input['HK2'] ?? ''
        ]);
        $data['teacher'] = implode(',', [$input['teacher_1'], $input['teacherSchool_1'], $input['teacher_2'] ?? '', $input['teacherSchool_2'] ?? '']);

        $data['province_id'] = $request->get('province_id') ?? Auth::user()->id_ref;
        $data['user_id'] = $request->get('user_id') ?? Auth::user()->id;
        $research = Research::create($data);
        if ($request->get('school1_nameEn')) {
            updateSchool($request->get('school_1'), $request->get('school1_nameEn'));
        }
        if ($request->get('school2_nameEn')) {
            updateSchool($request->get('school_2'), $request->get('school2_nameEn'));
        }
        Toastr::warning('Để đề tài được phê duyệt, hãy đính kèm các tệp tin!');
        // return redirect('/researchs/' . $research['id'].'#list-files');
        return redirect()->route('researchs.show', $research['id']);
        // ->with('success', 'Research created successfully.');
    }

    public function show(Research $research)
    {
        $files = File::where('research_id', $research->id)->get();

        $fields = Field::pluck('name', 'id')->all();
        $fieldsEn = Field::pluck('nameEn', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();
        $schools = School::where('province_id', $research->province_id);
        $schools = $schools->pluck('name', 'key');
        $users = User::pluck('name', 'id')->all();
        $research['student_1'] = explode(',', $research['student_1']);
        $research['student_2'] = explode(',', $research['student_2']);
        $research['teacher'] = explode(',', $research['teacher']);
        return view('researchs.show', compact('research', 'fields', 'users', 'fieldsEn', 'provinces', 'schools', 'files'));
    }

    public function edit(Research $research)
    {
        $fields = Field::pluck('name', 'id')->all();
        $fieldsEn = Field::pluck('nameEn', 'id')->all();
        $provinces = Province::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $schools = School::where('province_id', $research->province_id);
        $schools = $schools->pluck('name', 'key');
        // $student = array_merge(explode(',',$research['student_1']), explode(',',$research['student_2']));
        $research['teacher'] = explode(',', $research['teacher']);
        // $research['teacher'] = json_decode($research['teacher']);
        $research['student_1'] = explode(',', $research['student_1']);
        $research['student_2'] = explode(',', $research['student_2']);

        $user = Auth::user();
        return view('researchs.edit', compact('user', 'research', 'fields', 'users', 'fieldsEn', 'provinces', 'schools'));
    }

    public function update(Request $request, Research $research)
    {
        if (!$request->get('school_1')) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'school_1' => 'Vui lòng chọn trường cho học sinh 1',
                ]);
        }
        if ($request->get('type') == 2 && !$request->get('school_2'))
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'school_2' => 'Vui lòng chọn trường cho học sinh 2',
                ]);

        request()->validate([
            'name' => 'required',
            'nameEn' => 'required',
            'field_id' => 'required',
            'school_1' => 'required'
        ]);

        $input = $request->all();
        $data = $request->only('_token', '_method', 'name', 'nameEn', 'field_id', 'province_id', 'type', 'level', 'user_id', 'school_1', 'school_2');
        $data['student_1'] = implode(',', [
            $input['student1'], $input['dob1'], $input['gender1'], $input['grade1'], $input['nation1'], $input['HL1'], $input['HK1'],
        ]);
        $data['student_2'] = implode(',', [
            $input['student2'] ?? '', $input['dob2'] ?? '', $input['gender2'] ?? '', $input['grade2'] ?? '', $input['nation2'] ?? '', $input['HL2'] ?? '', $input['HK2'] ?? ''
        ]);
        $data['teacher'] = implode(',', [$input['teacher_1'], $input['teacherSchool_1'], $input['teacher_2'] ?? '', $input['teacherSchool_2'] ?? '']);
        $research->update($data);
        Toastr::success('Cập nhật đề tài thành công');

        if ($request->get('school1_nameEn')) {
            updateSchool($request->get('school_1'), $request->get('school1_nameEn'));
        }
        if ($request->get('school2_nameEn')) {
            updateSchool($request->get('school_2'), $request->get('school2_nameEn'));
        }
        return redirect()->route('researchs.show', $research['id']);
    }

    public function destroy(Research $research)
    {
        $research->delete();
        Toastr::warning('', 'Xóa đề tài thành công');
        return redirect()->route('researchs.index');
    }

    public function export(Request $request)
    {
        $param = $request->all();
        return Excel::download(new ResearchsExport($param), 'DS_de_tai.xlsx');
    }

    public function awardMedal(Request $request)
    {
        // dd($request->all());
        if ($request->has('medal_id')) {
            $rs = $request->get('medal_id');
            foreach ($rs as $k => $r) {
                $research = Research::find($k);
                $research->update(['medal_id' => $r ?? 0]);
            }
        }
        return back();
    }
    public function awardMedalGroup(Request $request)
    {
        if ($request->has('group_id')) {
            $group_id = $request->get('group_id');
            $medals = $request->get('medals');
            $sum = array_sum($medals);
            $rs = Research::where('group_id', $group_id)->orderBy('point', 'DESC')->get();
            $d = 0;
            foreach ($rs as $k => $r) {
                if ($k >= $sum)
                    $r->update(['medal_id' => 0]);
            }
            foreach ($medals as $k => $m) {
                for ($i = 0; $i < $m; $i++) {
                    $rs[$d]->update(['medal_id' => $k]);
                    $d++;
                }
            }
        }
        return back();
    }
}
