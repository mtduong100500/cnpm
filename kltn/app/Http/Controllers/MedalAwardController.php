<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Medal;
use App\Models\Research;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class MedalAwardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:medal-edit', ['only' => ['medalAward']]);
        $this->middleware('permission:medal-report', ['only' => ['exportMedal']]);
    }

    public function medalAward($id, Request $request)
    {
        $group = Group::find($id);
        if ($request->has('round')) {
            $round = $request->get('round');
            $researchs = Research::where('group_id', $id)->orderBy('key', 'ASC')->get();
            foreach ($researchs as $research) {
                if (($round == 1 && $research->p1 <= 0) || ($round == 2 && $research->p2 <= 0)) {
                    $t = 0;
                    $d = 0;
                    $tb = 0;
                    $es = $research->examiners()->wherePivot('round', $round ?? 1)->get();
                    foreach ($es as $e) {
                        if ($e->pivot->comment != 'Hủy' && $e->pivot->point > 0) {
                            $t += $e->pivot->point;
                            $d++;
                        }
                    }
                    if ($d > 0) $tb = round($t / $d, 2);
                    $t = 0;
                    $d = 0;
                    foreach ($es as $e) {
                        if (abs($e->pivot->point - $tb) <= 0.2 * $tb) {
                            $t += $e->pivot->point;
                            $d++;
                            $e->researchs()->wherePivot('round', $round)->updateExistingPivot($research->id, ['comment' => ''], false);
                        } else {
                            $e->researchs()->wherePivot('round', $round)->updateExistingPivot($research->id, ['comment' => 'Hủy'], false);
                        }
                    }
                    if ($d > 0) {
                        if ($round == 1) $research->update(['p1' => round($t / $d, 2)]);
                        if ($round == 2) $research->update(['p2' => round($t / $d, 2)]);
                    }
                }
            }
            return view('medals.point', compact('researchs', 'group', 'round'));
        } else {
            $d = 0;
            $researchs = Research::where('group_id', $id)->orderBy('point', 'DESC')->get();
            foreach ($researchs as $research) {
                if ($research->p1 && $research->p2 && ($research->p1 + $research->p2 != $research->point))
                    $research->update(['point' => ($research->p1 + $research->p2)]);
                if ($research->point > 0) $d++;
            }
            $medals = Medal::orderBy('id', 'ASC')->pluck('name', 'id');
            if ($d < count($researchs)) Toastr::warning("Tồn tại đề tài thiếu điểm!");
            $edit = $request->get('edit') ?? false;
            return view('medals.award', compact('researchs', 'group', 'medals', 'edit'));
        }
    }

    public function pointStatus(Request $request)
    {
        $i = $request->all();
        $research = Research::find($i['research_id']);
        $es = $research->examiners()->wherePivot('round', $i['round'])->get();
        foreach ($es as $e) {
            if ($e->id == $i['examiner_id']) $research->examiners()->wherePivot('round', $i['round'])->updateExistingPivot($e->id, ['comment' => 'Hủy']);
            else  $research->examiners()->wherePivot('round', $i['round'])->updateExistingPivot($e->id, ['comment' => '']);;
        }
        return true;
    }

    public function exportMedal($id, Request $request)
    {
        if ($request->has('all')) {
            $rs = Research::where('group_id', $id)->orderBy('point', "DESC")->get();
            return Excel::download(new ReportExport(4, $rs), 'Danh sach - ' . $id . '.xlsx');
        } else {
            $rs = Research::where([['group_id', $id], ['medal_id', '>', 0]])->orderBy('point', "DESC")->get();
            return Excel::download(new ReportExport(4, $rs), 'Danh sach giai - ' . $id . '.xlsx');
        }
    }
}
