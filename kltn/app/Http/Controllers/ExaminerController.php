<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Examiner;
use App\Models\ExaminerConfig;
use App\Models\Group;
use App\Models\Research;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;

class ExaminerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:examiner-point', ['only' => ['index', 'update']]);
    }

    public function index(Request $request)
    {
        $round = $request->get('round');
        if ($request->has('key')) {
            $key = explode('-', $request->get('key'));
            if (count($key) == 3) {
                $round = intval($key[0]);
                if ($round == 1 || $round == 2) {
                    if (Auth::user()->can('round-' . $round)) {
                        $key = $key[1] . '-' . $key[2];
                        $examiner = Examiner::where('key', $key)->firstOrFail();
                        if ($examiner->id) {
                            $config = ExaminerConfig::where([['key', $key], ['round', $round]])->first();
                            if (($config->status ?? 1) || Auth::user()->can('examiner-setup')) {
                                $group = Group::find($examiner->group_id);
                                $researchs = Research::where('group_id', $examiner->group_id)->orderBy('key', 'ASC')->get();
                                if (Auth::user()->id == $group->user_id || Auth::user()->role <= 2) {
                                    return view('examiners.index', compact('examiner', 'round', 'researchs'));
                                } else {
                                    Toastr::warning('Bạn không có quyền truy cập: ' . $request->get('key'));
                                    return view('examiners.index', compact('round'));
                                }
                            } else {
                                Toastr::warning('Đã khóa điểm!');
                                return redirect('/examiners');
                            }
                        }
                    } else {
                        Toastr::warning('Mời nhập lại đúng mã giám khảo', 'Vòng thi đang ẩn');
                        return redirect('/examiners');
                    }
                } else {
                    Toastr::warning('Không tìm thấy mã giám khảo: ' . $request->get('key'));
                    return redirect('/examiners');
                }
            }
            Toastr::warning('Không tìm thấy mã giám khảo: ' . $request->get('key'));
            return view('examiners.index', compact('round'));
        }
        return view('examiners.index', compact('round'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Examiner $examiner)
    {
        //
    }

    public function edit($key)
    {

        return view('examiners.edit', compact('examiner'));
    }

    public function update(Request $request, $id)
    {
        $examiner = Examiner::find($id);
        $round = $request->get('round') ?? 1;
        if ($examiner) {
            $input = $request->get('input');
            foreach ($input as $k => $d) {
                $examiner->researchs()->wherePivot('round', $round)->updateExistingPivot($k, $d, false);
            }
            foreach ($examiner->researchs()->get() as $r) {
                if ($round == 1 && $r->p1 > 0) $r->update(['p1' => 0]);
                if ($round == 2 && $r->p2 > 0) $r->update(['p2' => 0]);
            }
            Toastr::success("Cập nhật điểm thành công.");
            return redirect('/examiners?key=0' . $round . '-' . $examiner->key);
        }
        // dd($examiner);
    }

    public function config(Request $request)
    {
        if ($request->has('role')) {
            $role = Role::find(7);
            $role->syncPermissions([43, $request->get('role')]);
            Toastr::success("Cập nhật thành công!");
            return back();
        }
    }

    public function configExam(Request $request)
    {
        $data = $request->only('status', 'name');
        $key = $request->only('key', 'round');
        $config = ExaminerConfig::where([['key', $key['key']], ['round', $key['round']]])->first();
        if (is_null($config)) {
            ExaminerConfig::create($request->all());
        } else {
            ExaminerConfig::where([['key', $key['key']], ['round', $key['round']]])->update($data);
        }
        if ($data['status'] == 0) {
            Toastr::success("Khóa điểm thành công!");
        } else {
            Toastr::success("Mở khóa điểm thành công!");
        }
        return redirect('/examiners');
    }

    public function uName(Request $request)
    {
        $groups = Group::pluck('name', 'id');
        if ($request->has('group_id')) {
            $round = $request->get('round');
            $examiners = Examiner::where([['group_id', $request->get('group_id')], ['key', 'like','%'.$round.'%']])->get();
            return view('examiners.update', compact('examiners', 'groups', 'round'));
        } else
            return view('examiners.update', compact('groups'));
    }

    public function updateName(Request $request)
    {
        dd($request->all());
    }
}
