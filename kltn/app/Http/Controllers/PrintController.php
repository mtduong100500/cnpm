<?php

namespace App\Http\Controllers;

use App\Models\Examiner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function examiner(Request $request)
    {
        $round = $request->get('round') ?? 1;
        $examiner = Examiner::find($request->get('id'));
        $examiner->researchs = $examiner->researchs()->wherePivot('round', $round)->orderBy('key', 'ASC')->get();
        return view('print.examiner.index', compact('examiner', 'round'));
    }
    public function printExaminer(Request $request)
    {
        $round = $request->get('round') ?? 1;
        $examiner = Examiner::find($request->get('id'));
        $examiner->researchs = $examiner->researchs()->wherePivot('round', $round)->orderBy('key', 'ASC')->get();
        return view('print.examiner.print', compact('examiner', 'round'));
    }

    public function examiners(Request $request)
    {
        $round = $request->get('round') ?? 1;
        if ($request->has('id')) {
            $id = $request->get('id');
            $examiners = Examiner::where('group_id', $id)->get();
            foreach ($examiners as $examiner) {
                $examiner->researchs = $examiner->researchs()->wherePivot('round', $round)->orderBy('key', 'ASC')->get();
            }
            // dd($examiners);
            return view('print.examiners.index', compact('examiners', 'round', 'id'));
        } else {
            Toastr::warning('Không tìm thấy nội dung!');
            return back();
        }
    }

    function printExaminers(Request $request)
    {
        $round = $request->get('round') ?? 1;
        if ($request->has('id')) {
            $id = $request->get('id');
            $examiners = Examiner::where('group_id', $id)->get();
            foreach ($examiners as $examiner) {
                $examiner->researchs = $examiner->researchs()->wherePivot('round', $round)->orderBy('key', 'ASC')->get();
            }
            // dd($examiners);
            return view('print.examiners.print', compact('examiners', 'round', 'id'));
        } else {
            Toastr::warning('Không tìm thấy nội dung!');
            return back();
        }
    }
}
