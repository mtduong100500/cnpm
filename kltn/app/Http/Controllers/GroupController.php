<?php

namespace App\Http\Controllers;

use App\Models\Examiner;
use DB;
use Auth;
use App\Models\Field;
use App\Models\Group;
use App\Models\Research;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:group-delete', ['only' => ['destroy']]);
        $this->middleware('permission:examiner-setup|examiner-point', ['only' => ['setup']]);
    }

    public function index(Request $request)
    {
        $param = $request->all();
        $type = $request->get('type') ?? 0;
        if (Auth::user()->role == 5) {
            $groups = Group::where('user_id', Auth::user()->id);
        } else {
            $groups = Group::orderBy('key', 'asc');
        }
        $groups = $groups->filter($param)->paginate(20);
        // $groups =  Group::filter($param)->paginate(10);
        return view('groups.index', compact('groups', 'type'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create()
    {
        $exFields = DB::table('group_field')->pluck('field_id', 'field_id');
        $fields = Field::whereNotIn('id', $exFields)->pluck('name', 'id');
        $users = User::where('role', 5)->pluck('name', 'id')->all();
        return view('groups.create', compact('users', 'fields'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'key' => 'required',
            'name' => 'required',
            'user_id' => 'required'
        ]);
        $data = $request->only('key', 'name', 'user_id');
        $group = Group::create($data);
        if ($request->has('suffer')) {
            $researchs = Research::whereIn('field_id', $request->fields)->orderBy('field_id', 'ASC')->get()->toArray();
            $i = 1;
            shuffle($researchs);
            foreach ($researchs as $research) {
                Research::find($research['id'])->update(['key' => ($request->key . '.' . ($i < 10 ? ('0' . $i) : $i)), 'group_id' => $group->id]);
                $i++;
            }
        }
        $group->fields()->sync($request->fields);
        Toastr::success("Tạo nhóm thành công.");
        return redirect()->route('groups.index')
            ->with('success', 'Tạo nhóm thành công.');
    }

    public function show(Group $group)
    {
        $fields = $group->fields->pluck('id', 'id');
        $researchs = Research::whereIn('field_id', $fields)->orderBy('key', 'ASC')->paginate(10);
        $param = ['group_id' => $group->id];
        return view('groups.show', compact('group', 'param', 'researchs'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit(Group $group)
    {
        $exFields = DB::table('group_field')->whereNotIn('field_id', $group['fields']->pluck('id', 'id'))->pluck('field_id', 'field_id');
        $group['fields'] = $group->fields()->pluck('id', 'id')->all();
        $fields = Field::whereNotIn('id', $exFields)->pluck('name', 'id')->all();
        $users = User::whereIn('role', [5, 7])->pluck('name', 'id')->all();
        return view('groups.edit', compact('group', 'users', 'fields'));
    }

    public function update(Request $request, Group $group)
    {
        request()->validate([
            'key' => 'required',
            'name' => 'required',
            'user_id' => 'required'
        ]);
        $data = $request->only('key', 'name', 'user_id');
        $group->update($data);
        if ($request->has('suffer')) {
            $researchs = Research::whereIn('field_id', $request->fields)->orderBy('field_id', 'ASC')->get()->toArray();
            $i = 1;
            shuffle($researchs);
            foreach ($researchs as $research) {
                Research::find($research['id'])->update(['key' => ($request->key . '.' . ($i < 10 ? ('0' . $i) : $i)), 'group_id' => $group->id]);
                $i++;
            }
        }
        $group->fields()->sync($request->fields);
        Toastr::success("Cập nhật nhóm thành công.");
        return redirect('/groups?type=2')
            ->with('success', 'Cập nhật nhóm thành công.');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        $group->fields()->detach();
        return redirect()->route('groups.index')
            ->with('success', 'Xóa nhóm thành công.');
    }

    public function setup(Request $request, $id)
    {
        $char = range('A', 'Z');
        $group = Group::find($id);
        $round = $request->get('round') ?? 1;
        $researchs = Research::where('group_id', $id)->orderBy('field_id', 'ASC')->get();

        $examiners = Examiner::where('group_id', $id)->orderBy('key', 'ASC')->get();

        if ($request->has('download')) {
            $param = $request->only('round', 'examiner_id');
            // $param['group_id']=$id;
            return Excel::download(new ReportExport(3, $param), 'DSGK_' . $group->key . '.xlsx');
        }

        if ($request->has('examiner_total')) {
            $examiner_total = $request->get('examiner_total');
            $total = ceil(count($researchs) * 5 / $examiner_total);
            if ($examiner_total >= 5) {
                $examiners = Examiner::where('group_id', $id)->orderBy('key', 'ASC')->get();
                $group['examiner_total'] = $examiner_total;
                $group->update();
                if (count($examiners) < $examiner_total) {
                    for ($i = count($examiners); $i < $examiner_total; $i++) {
                        Examiner::create([
                            'key' => $group->key . '-' . $char[$i],
                            'group_id' => $id
                        ]);
                    }
                }
                if (count($examiners) > $examiner_total) {
                    for ($i = $examiner_total; $i < count($examiners); $i++) {
                        $examiners[$i]->delete();
                    }
                }

                $examiners = Examiner::where('group_id', $id)->orderBy('key', 'ASC')->get();
                $es = $examiners->pluck('id')->all();
                $es_c = [];
                foreach ($researchs as $research) {
                    $research->update(['p1' => 0, 'p2' => 0, 'point' => 0, 'medal_id' => 0]);
                    $research->examiners()->wherePivot('round', $round)->detach();
                    // dd($es);
                    $t = array_count_values($es_c);
                    foreach ($t as $k => $i) {
                        if ($i >= $total) {
                            $pos = array_search($k, $es);
                            if (gettype($pos) == "integer" && $pos >= 0 && count($es) > 5) unset($es[$pos]);
                        }
                    }
                    shuffle($es);
                    $es_c = array_merge($es_c, array_slice($es, 0, 5));
                    foreach (array_slice($es, 0, 5) as $e) {
                        $research->examiners()->attach($e, [
                            'examiner_id' => $e,
                            'round' => $round
                        ]);
                    }
                }
                return view('groups.setup', compact('group', 'round', 'examiners'));
            } else {
                Toastr::error("Số lượng giám khảo phải không đủ ( >=5 ).");
                return view('groups.setup', compact('group', 'round'));
            }
        }
        return view('groups.setup', compact('group', 'round', 'examiners'));
    }
}
