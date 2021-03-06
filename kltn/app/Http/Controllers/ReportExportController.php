<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ReportExport;
use App\Models\Field;
use App\Models\Group;
use App\Models\Medal;
use App\Models\Research;
use App\Models\School;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;

class ReportExportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:report', ['only' => ['report']]);
        $this->middleware('permission:field-report', ['only' => ['reportField']]);
        $this->middleware('permission:dvdt-report', ['only' => ['reportDVDT']]);
        $this->middleware('permission:point-report', ['only' => ['reportExaminer']]);
        $this->middleware('permission:province-report', ['only' => ['reportTheDT', 'pdfTheDT', 'reportTTDT', 'exportTTDT']]);
        $this->middleware('permission:medal-report', ['only' => ['exportMedal', 'exportPoint', 'reportCertificate', 'exportCertificate', 'reportJoin', 'exportJoin']]);
    }

    public function index()
    {
        return view('reports.index');
    }

    public function reportTheDT()
    {
        $fields = Field::pluck('name', 'id')->all();
        $users = User::where('role', 3)->pluck('name', 'id')->all();
        $groups = Group::pluck('name', 'id')->all();
        return view('reports.reportTheDT', compact('users', 'fields', 'groups'));
    }

    public function reportDVDT(Request $request)
    {
        $param = $request->all();
        return Excel::download(new ReportExport(1, $param), 'Thong_ke_Don_vi_du_thi(Du an - Hoc sinh).xlsx');
    }

    public function reportField(Request $request)
    {
        $param = $request->all();
        return Excel::download(new ReportExport(2, $param), 'Thong_ke_Linh_vuc(' . date('Y-m-d H\gi\ps') . ').xlsx');
    }

    public function reportTTDT()
    {
        $users = User::where('role', 3)->pluck('name', 'id')->all();
        return view('reports.reportTTDT', compact('users'));
    }

    public function exportTTDT(Request $request)
    {
        // dd($request->all());
        if ($request->has('user_id')) {
            $id = $request->get('user_id');
            $rs = Research::where('user_id', $id)->orderBy('id', "ASC")->get();
            return Excel::download(new ReportExport(5, $rs), '[' . $id . ']Th??ng tin ????ng k?? d??? thi.xlsx');
        } else {
            $us = User::whereIn('role', [3, 6])->get();
            // dd($us);
            foreach ($us as $k => $u) {
                $u->update(['no' => ($k + 1)]);
            }
            $rs = Research::orderBy('user_id', "ASC")->get();
            return Excel::download(new ReportExport(5, $rs), '[All]Th??ng tin ????ng k?? d??? thi.xlsx');
        }
    }

    public function pdfTheDT(Request $request)
    {
        $param = [];

        if ($request->get('user_id')) {
            $param['user_id'] = $request->get('user_id');
        }
        if ($request->get('field_id')) {
            $param['field_id'] = $request->get('field_id');
        }
        if ($request->get('group_id')) {
            $param['group_id'] = $request->get('group_id');
        }
        $researchs = Research::filter($param)->orderBy('user_id', 'ASC')->get();
        // dd($request->all(),$param);
        // $researchs->orderBy('id', 'ASC')->skip(0)->take(1)->get();
        view()->share('researchs', $researchs);
        $pdf = PDF::loadView('reports.pdfTheDT');
        if ($request->has('download')) {
            return $pdf->download('Danh sach the du thi.pdf');
        }
        return $pdf->stream('Danh sach the du thi.pdf')->header('Content-Type', 'application/pdf');
        // return view('reports.pdfTheDT', compact('researchs'));
    }

    public function reportMedal()
    {
        $groups = Group::pluck('name', 'id')->all();
        $medals = Medal::pluck('name', 'id')->all();
        return view('reports.reportMedal', compact('groups', 'medals'));
    }

    public function reportExaminer()
    {
        $groups = Group::pluck('name', 'id')->all();
        return view('reports.reportExaminer', compact('groups'));
    }

    public function exportMedal(Request $request)
    {
        $rs = Research::where('medal_id', '>', 0);
        $param = [];
        if ($request->get('group_id')) {
            $param['group_id'] = $request->get('group_id');
        }
        if ($request->get('medal_id')) {
            $param['medal_id'] = $request->get('medal_id');
        }
        if (count($param)) {
            $rs = $rs->filter($param);
        }
        $rs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->get();
        // $rs = Research::orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if (count($rs)) {
            return Excel::download(new ReportExport(4, $rs), 'Danh sach giai.xlsx');
        } else {
            Toastr::warning('B???n ch??a x???p gi???i cho nh??m l??nh v???c n??y.');
            return redirect('/reports/medal');
        }
    }

    public function exportPoint(Request $request)
    {
        $id = $request->get('group_id');
        $round = $request->get('round');
        $rs = Research::where('group_id', $id)->orderBy('key', 'ASC')->get();
        $g = Group::where('id', $id)->get('name');
        return Excel::download(new ReportExport(6, ['rs' => $rs, 'name' => $g[0]->name, 'round' => $round ?? 1]), '[' . $round . '] ' . $g[0]->name . '.xlsx');
    }

    public function reportCertificateTG()
    {
        $groups = Group::pluck('name', 'id')->all();
        $users = User::whereIn('role', [3, 6])->pluck('name', 'id')->all();
        // $rs = Research::where('medal_id', '>', 0)->get();
        // dd($arr);
        return view('reports.reportCertificateTG', compact('groups', 'users'));
    }

    public function exportCertificateTG(Request $request)
    {
        $param = $request->all();
        $researchs = Research::filter($param)->orderBy('user_id', 'ASC')->orderBy('field_id', 'ASC')->get();
        // dd($rs);
        $user_id = $request->get('user_id');
        // $researchs = $rs->orderBy('user_id', "ASC")->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.certificateTG.content', compact('researchs', 'group_id'));
            } else {
                // $medal = Medal::find($param['medal_id']);
                return view('print.certificateTG.print', compact('researchs', 'user_id'));
            }
        } else {
            view()->share('data', compact('researchs', 'user_id'));
            $pdf = PDF::loadView('reports.pdfCertificateTG');
            if ($request->has('download')) {
                return $pdf->download('Ch???ng nh???n.pdf');
            }
            return $pdf->stream('Ch???ng nh???n-' . $user_id . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }

    public function reportCertificateGVTG()
    {
        $users = User::whereIn('role', [3, 6])->pluck('name', 'id')->all();
        return view('reports.reportCertificateGVTG', compact('users'));
    }

    public function exportCertificateGVTG(Request $request)
    {
        $param = $request->all();
        $researchs = Research::filter($param)->orderBy('user_id', 'ASC')->orderBy('field_id', 'ASC')->get();
        // $param = [];
        // if ($request->get('group_id')) {
        //     $param['group_id'] = $request->get('group_id');
        // }
        // if ($request->get('medal_id')) {
        //     $param['medal_id'] = $request->get('medal_id');
        // }
        // if (count($param)) {
        //     $rs = $rs->filter($param);
        // }
        // $researchs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.certificateGVTG.content', compact('researchs'));
            } else {
                $medal = Medal::find($param['medal_id']);
                return view('print.certificateGVTG.print', compact('researchs', 'medal'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfCertificateGVTG');
            if ($request->has('download')) {
                return $pdf->download('Ch???ng nh???n.pdf');
            }
            return $pdf->stream('Ch???ng nh???n-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }
    public function reportCertificate()
    {
        $groups = Group::pluck('name', 'id')->all();
        $medals = Medal::pluck('name', 'id')->all();
        $rs = Research::where('medal_id', '>', 0)->get();
        $users = [];
        foreach ($rs as $r) {
            $users[$r->user->no] = $r->user->name;
        }
        // dd($arr);
        return view('reports.reportCertificate', compact('groups', 'medals', 'users'));
    }

    public function exportCertificate(Request $request)
    {
        $rs = Research::whereIn('medal_id', [1, 2, 3, 4]);
        $user_id = $request->get('user_id');
        $researchs = $rs->orderBy('user_id', "ASC")->orderBy('medal_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.certificate.content', compact('researchs', 'group_id'));
            } else {
                // $medal = Medal::find($param['medal_id']);
                return view('print.certificate.print', compact('researchs', 'user_id'));
            }
        } else {
            view()->share('data', compact('researchs', 'user_id'));
            $pdf = PDF::loadView('reports.pdfCertificate');
            if ($request->has('download')) {
                return $pdf->download('Ch???ng nh???n.pdf');
            }
            return $pdf->stream('Ch???ng nh???n-' . $user_id . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }

    public function reportCertificateGV()
    {
        $medals = Medal::pluck('name', 'id')->all();
        return view('reports.reportCertificateGV', compact('medals'));
    }

    public function exportCertificateGV(Request $request)
    {
        $rs = Research::whereIn('medal_id', [1, 2, 3, 4]);
        $param = [];
        if ($request->get('group_id')) {
            $param['group_id'] = $request->get('group_id');
        }
        // if ($request->get('medal_id')) {
        //     $param['medal_id'] = $request->get('medal_id');
        // }
        // if (count($param)) {
        //     $rs = $rs->filter($param);
        // }
        $researchs = $rs->orderBy('user_id', "ASC")->orderBy('medal_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.certificateGV.content', compact('researchs'));
            } else {
                // $medal = Medal::find($param['medal_id']);
                // return view('print.certificateGV.print', compact('researchs', 'medal'));
                return view('print.certificateGV.print', compact('researchs'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfCertificateGV');
            if ($request->has('download')) {
                return $pdf->download('Ch???ng nh???n.pdf');
            }
            return $pdf->stream('Ch???ng nh???n-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }

    public function reportJoin(Request $request)
    {
        $cs = [];
        $certificates = DB::table('certificates')->where('type', 0)->get(['key', 'status', 'filename']);
        foreach ($certificates as $c) {
            $cs[$c->key] = ['s' => $c->status, 'f' => $c->filename];
        }
        if ($request->has('id')) {
            $users = User::where('id', $request->get('id'))->withCount('researchs');
            return view('reports.reportJoin', compact('users', 'cs'));
        } else {
            $users = User::whereIn('role', ['6', '3'])->withCount('researchs')->paginate(20);
            return view('reports.reportJoin', compact('users', 'cs'))
                ->with('i', (request()->input('page', 1) - 1) * 20);
        }
    }

    public function exportJoin(Request $request)
    {
        // $teacher_schools = [109=>'Tr?????ng THPT Vi???t ?????c',101=>'Tr?????ng THPT C??? Loa',111=>'Tr?????ng THPT Chuy??n H?? N???i - Amsterdam',113=>'Tr?????ng THCS Phan ????nh Gi??t',24=>'Tr?????ng THPT Chuy??n H?? Giang',14=>'Tr?????ng THPT Chuy??n H?? Giang',72=>'Tr?????ng THPT Chuy??n Cao B???ng',81=>'Tr?????ng THPT Chuy??n Cao B???ng',18=>'Tr?????ng THPT Chuy??n Tuy??n Quang',19=>'Tr?????ng THPT Th??i H??a',127=>'Tr?????ng THPT Chuy??n L??o Cai',128=>'Tr?????ng THPT Chuy??n L??o Cai',30=>'Tr?????ng THPT L????ng Th??? Vinh',11=>'Tr?????ng THPT Chuy??n L?? Qu?? ????n',42=>'Tr?????ng THPT B??nh L??',43=>'Tr?????ng THCS  ??o??n K???t',122=>'Tr?????ng TH, THCS Quy???t T??m',123=>'Tr?????ng THPT M???c L???',125=>'Tr?????ng THPT Chuy??n Nguy???n T???t Th??nh',126=>'Tr?????ng THPT Chuy??n Nguy???n T???t Th??nh',90=>'Tr?????ng THPT chuy??n Ho??ng V??n Th???',57=>'Tr?????ng THPT chuy??n Ho??ng V??n Th???',99=>'Tr?????ng THPT Chuy??n Th??i Nguy??n',100=>'Tr?????ng THPT Ph?? B??nh',92=>'Tr?????ng THPT Chuy??n Chu V??n An',96=>'Tr?????ng THPT Chuy??n Chu V??n An',130=>'Tr?????ng THPT Chuy??n H??? Long',134=>'Tr?????ng THPT H??n Gai',120=>'Tr?????ng THPT Ng?? S?? Li??n',119=>'Tr?????ng THCS L?? Qu?? ????n',33=>'Tr?????ng THCS Ph?? L???c',32=>'Tr?????ng THCS Ti??n Du',93=>'Tr?????ng THPT Chuy??n V??nh Ph??c',94=>'Tr?????ng THCS V??nh Y??n',63=>'Tr?????ng THPT Qu??? V?? s??? 1',62=>'Tr?????ng THPT Ha??n Thuy??n',2=>'Tr?????ng THPT Nguy???n V??n C???',6=>'Tr?????ng THPT T??? K???',87=>'Tr?????ng THPT Chuy??n Tr???n Ph??',39=>'Tr?????ng THPT Ng?? Quy???n',29=>'Tr?????ng THPT Chuy??n H??ng Y??n',28=>'Tr?????ng THPT Ph?? C???',17=>'Tr?????ng THPT Chuy??n Th??i B??nh',16=>'Tr?????ng THCS Nam H??',89=>'Tr?????ng THPT chuy??n Bi??n H??a',88=>'Tr?????ng THCS Tr???n Qu???c To???n',124=>'Tr?????ng THPT Nguy???n Khuy???n',121=>'Tr?????ng THPT Nam Tr???c',56=>'Tr?????ng THPT Ninh B??nh-B???c Li??u',55=>'Tr?????ng THPT Hoa L?? A',49=>'Tr?????ng THCS Nguy???n V??n Tr???i',50=>'Tr?????ng THPT Chuy??n Lam S??n',52=>'Tr?????ng THCS ?????ng Thai Mai',54=>'Tr?????ng THCS H??a Hi???u 1',131=>'Tr?????ng THPT Phan ????nh Ph??ng',136=>'Tr?????ng THPT Chuy??n H?? T??nh',34=>'Tr?????ng THCS v?? THPT Trung H??a',36=>'Tr?????ng THCS Th??? tr???n Quy ?????t',112=>'Tr?????ng THCS Khe Sanh',133=>'Tr?????ng THPT chuy??n L?? Qu?? ????n',85=>'Tr?????ng THPT Chuy??n Qu???c H???c Hu???',76=>'Tr?????ng THPT Hai B?? Tr??ng',83=>'Tr?????ng THCS Nguy???n Tri Ph????ng',84=>'Tr?????ng THCS Nguy???n Tri Ph????ng',103=>'Tr?????ng THPT Ho??ng Hoa Th??m',105=>'Tr?????ng THPT Ho??ng Hoa Th??m',107=>'Tr?????ng THPT L?? Qu?? ????n',110=>'Tr?????ng THPT chuy??n Nguy???n B???nh Khi??m',146=>'Tr?????ng THPT chuy??n L?? Khi???t',147=>'Tr?????ng THPT V?? Nguy??n Gi??p',27=>'Tr?????ng THCS Hoa??i Ch??u B???c',9=>'Tr?????ng THCS Tam Quan B???c',23=>'Tr?????ng THPT Nguy???n Hu???',22=>'Tr?????ng THPT Tr???n Ph??',13=>'Tr?????ng TH, THCS v?? THPT iSchool Nha Trang',4=>'Tr?????ng THPT L?? T??? Tr???ng',68=>'Tr?????ng THPT Nguy???n Tr??i',60=>'Tr?????ng THPT iSchool Ninh Thu???n',3=>'Tr?????ng TH, THCS v?? THPT L?? Qu?? ????n',44=>'Tr?????ng THPT chuy??n Tr???n H??ng ?????o',75=>'Tr?????ng THPT Chuy??n Nguy???n T???t Th??nh',73=>'Tr?????ng THPT Chuy??n Nguy???n T???t Th??nh',45=>'Tr?????ng THPT chuy??n H??ng V????ng',86=>'Tr?????ng THPT chuy??n H??ng V????ng',138=>'Tr?????ng THCS T?? Hi???u',91=>'Tr?????ng TH, THCS v?? THPT Victory',59=>'Tr?????ng THPT Kr??ng N??',67=>'Tr?????ng THPT ?????k Mil',71=>'Tr?????ng THCS Nguy???n Du - ???? L???t',58=>'Tr?????ng THPT Chuy??n B???o L???c',35=>'Tr?????ng THPT Chuy??n Quang Trung',40=>'Tr?????ng THPT Chuy??n Quang Trung',80=>'Tr?????ng THPT Tr???n Ph??',82=>'Tr?????ng THCS L?? L???i',25=>'Tr?????ng THCS Nguy???n V??n C???',26=>'Tr?????ng THPT chuy??n H??ng V????ng',98=>'Tr?????ng THCS Nguy???n C??ng Tr???, Tr???ng Bom',97=>'Tr?????ng THPT Th???ng Nh???t A',104=>'Tr?????ng THPT Ch??u Th??nh',106=>'Tr?????ng THPT Tr???n V??n Quan',141=>'Tr?????ng THPT Chuy??n L?? H???ng Phong',144=>'Tr?????ng THPT Gia ?????nh',143=>'Tr?????ng THPT Tr???n Khai Nguy??n',142=>'Tr?????ng THCS Quang Trung',47=>'Tr?????ng THPT Ph???m Th??nh Trung',48=>'Tr?????ng THPT Chuy??n Ti???n Giang',102=>'Tr?????ng THPT T??n K???',116=>'Tr?????ng THPT Nguy???n ????nh Chi???u',77=>'Tr?????ng Th???c h??nh S?? ph???m Tr?? Vinh',64=>'Tr?????ng THCS Phong Ph??',114=>'Tr?????ng THPT V??nh Long',108=>'Tr?????ng THPT Chuy??n Nguy???n B???nh Khi??m',135=>'Tr?????ng THPT L???p V?? 2',132=>'Tr?????ng THPT th??nh ph??? Cao L??nh',37=>'Tr?????ng THCS Ph?? Th???',38=>'Tr?????ng THPT chuy??n Tho???i Ng???c H???u',78=>'Tr?????ng THPT chuy??n Hu???nh M???n ?????t',74=>'Tr?????ng THPT chuy??n Hu???nh M???n ?????t',66=>'Tr?????ng THPT Ch??u V??n Li??m',69=>'Tr?????ng THPT chuy??n L?? T??? Tr???ng',79=>'Tr?????ng THPT Chuy??n V??? Thanh',115=>'Tr?????ng THCS L????ng Ngh??a',41=>'Tr?????ng THPT M??? H????ng',118=>'Tr?????ng THPT Chuy??n Nguy???n Th??? Minh Khai',7=>'Tr?????ng THPT Tr???n V??n B???y',5=>'Tr?????ng TH, THCS T??n Th???nh',61=>'Tr?????ng THPT Tr???n V??n Th???i',10=>'Tr?????ng THPT Chuy??n Phan Ng???c Hi???n',51=>'Tr?????ng PT V??ng cao Vi???t B???c',137=>'Tr?????ng THPT chuy??n KHTN',139=>'Tr?????ng THPT chuy??n KHTN',21=>'Tr?????ng ??H S?? ph???m H?? N???i 2',20=>'Khoa H??a h???c - Tr?????ng ??H Khoa h???c T??? nhi??n',53=>'Tr?????ng ?????i h???c C??ng ngh???',140=>'Tr?????ng ?????i h???c Vinh',129=>'Tr?????ng ?????i h???c Vinh',117=>'Khoa H??a h???c - Tr?????ng ??H S?? ph???m H?? N???i',95=>'Tr?????ng THCS, THPT Nguy???n T???t Th??nh',65=>'Tr?????ng Ph??? th??ng N??ng Khi???u - ??HQG Tp. HCM',70=>'Tr?????ng Ph??? th??ng N??ng Khi???u - ??HQG Tp. HCM',145=>'Tr?????ng THPT L??m Nghi???p'];
        // $rs = Research::orderBy('id', 'ASC')->get();
        // // dd($rs);
        // foreach ($rs as $r){
        //     // dd($r);
        //     $data = explode(',', $r->teacher);
        //     $data[1] = $teacher_schools[$r->id];
        //     $data = implode(',',$data);
        //     // dd($data, $r);
        //     $r->update(['teacher'=>$data]);
        // }
        $rs = Research::orderBy('user_id', 'ASC')->orderBy('key', 'ASC')->get();
        if ($request->has('teacher'))
            return Excel::download(new ReportExport(8, $rs), 'DSGV.xlsx');
        return Excel::download(new ReportExport(7, $rs), 'DSHS.xlsx');
    }

    public function exportExaminer(Request $request)
    {
        $param = $request->only('round', 'examiner_id');
        return Excel::download(new ReportExport(3, $param), '[' . $param['examiner_id'] . '] Phi???u nh???p ??i???m.pdf');
    }

    public function reportMedalGroup()
    {
        $groups = Group::all();
        return Excel::download(new ReportExport(9, $groups), 'Th???ng k?? gi???i-LV.xlsx');
    }

    public function reportMedalDVDT()
    {
        $user = User::whereIn('role', [3, 6])->get();
        return Excel::download(new ReportExport(10, $user), 'Th???ng k?? gi???i-DVDT.xlsx');
    }


    public function reportBK()
    {
        $medals = Medal::whereIn('id', [1, 2, 3])->pluck('name', 'id');
        return view('reports.reportBK', compact('medals'));
    }

    public function exportBK(Request $request)
    {
        $rs = Research::where('medal_id', '>', 0);
        $param = [];
        // if ($request->get('group_id')) {
        //     $param['group_id'] = $request->get('group_id');
        // }
        if ($request->get('medal_id')) {
            $param['medal_id'] = $request->get('medal_id');
        }
        if (count($param)) {
            $rs = $rs->filter($param);
        }
        $researchs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.BK.content', compact('researchs'));
            } else {
                $medal = Medal::find($param['medal_id']);
                return view('print.BK.print', compact('researchs', 'medal'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfBK');
            if ($request->has('download')) {
                return $pdf->download('B???ng khen.pdf');
            }
            return $pdf->stream('B???ng khen-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }

    public function reportTWD()
    {
        $medals = Medal::whereIn('id', [4])->pluck('name', 'id');
        return view('reports.reportTWD', compact('medals'));
    }

    public function exportTWD(Request $request)
    {
        $rs = Research::where('medal_id', '>', 0);
        $param = [];
        // if ($request->get('group_id')) {
        //     $param['group_id'] = $request->get('group_id');
        // }
        if ($request->get('medal_id')) {
            $param['medal_id'] = $request->get('medal_id');
        }
        if (count($param)) {
            $rs = $rs->filter($param);
        }
        $researchs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.TWD.content', compact('researchs'));
            } else {
                $medal = Medal::find($param['medal_id']);
                return view('print.TWD.print', compact('researchs', 'medal'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfTWD');
            if ($request->has('download')) {
                return $pdf->download('B???ng khen Trung ????ng ??o??n.pdf');
            }
            return $pdf->stream('B???ng khen Trung ????ng ??o??n-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }
    public function reportVifotec()
    {
        $medals = Medal::whereIn('id', [5])->pluck('name', 'id');
        return view('reports.reportVifotec', compact('medals'));
    }

    public function exportVifotec(Request $request)
    {
        $rs = Research::where('medal_id', '>', 0);
        $param = [];
        // if ($request->get('group_id')) {
        //     $param['group_id'] = $request->get('group_id');
        // }
        if ($request->get('medal_id')) {
            $param['medal_id'] = $request->get('medal_id');
        }
        if (count($param)) {
            $rs = $rs->filter($param);
        }
        $researchs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.Vifotec.content', compact('researchs'));
            } else {
                $medal = Medal::find($param['medal_id']);
                return view('print.Vifotec.print', compact('researchs', 'medal'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfVifotec');
            if ($request->has('download')) {
                return $pdf->download('B???ng khen Trung ????ng ??o??n.pdf');
            }
            return $pdf->stream('B???ng khen Trung ????ng ??o??n-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }

    public function reportBCH()
    {
        $medals = Medal::whereIn('id', [1, 2, 3])->pluck('name', 'id');
        return view('reports.reportBCH', compact('medals'));
    }

    public function exportBCH(Request $request)
    {
        $rs = Research::where('medal_id', '>', 0);
        $param = [];
        // if ($request->get('group_id')) {
        //     $param['group_id'] = $request->get('group_id');
        // }
        if ($request->get('medal_id')) {
            $param['medal_id'] = $request->get('medal_id');
        }
        if (count($param)) {
            $rs = $rs->filter($param);
        }
        $researchs = $rs->orderBy('medal_id', "ASC")->orderBy('group_id', "ASC")->orderBy('point', 'DESC')->get();
        if ($request->has('print')) {
            $print = $request->get('print');
            if ($print == 1) {
                return view('print.BCH.content', compact('researchs'));
            } else {
                $medal = Medal::find($param['medal_id']);
                return view('print.BCH.print', compact('researchs', 'medal'));
            }
        } else {
            view()->share('researchs', $researchs);
            $pdf = PDF::loadView('reports.pdfBCH');
            if ($request->has('download')) {
                return $pdf->download('B???ng khen Ban ch???p h??nh C??.pdf');
            }
            return $pdf->stream('B???ng khen Ban ch???p h??nh C??-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }
}
