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
            return Excel::download(new ReportExport(5, $rs), '[' . $id . ']Thông tin đăng ký dự thi.xlsx');
        } else {
            $us = User::whereIn('role', [3, 6])->get();
            // dd($us);
            foreach ($us as $k => $u) {
                $u->update(['no' => ($k + 1)]);
            }
            $rs = Research::orderBy('user_id', "ASC")->get();
            return Excel::download(new ReportExport(5, $rs), '[All]Thông tin đăng ký dự thi.xlsx');
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
            Toastr::warning('Bạn chưa xếp giải cho nhóm lĩnh vực này.');
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
                return $pdf->download('Chứng nhận.pdf');
            }
            return $pdf->stream('Chứng nhận-' . $user_id . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Chứng nhận.pdf');
            }
            return $pdf->stream('Chứng nhận-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Chứng nhận.pdf');
            }
            return $pdf->stream('Chứng nhận-' . $user_id . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Chứng nhận.pdf');
            }
            return $pdf->stream('Chứng nhận-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
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
        // $teacher_schools = [109=>'Trường THPT Việt Đức',101=>'Trường THPT Cổ Loa',111=>'Trường THPT Chuyên Hà Nội - Amsterdam',113=>'Trường THCS Phan Đình Giót',24=>'Trường THPT Chuyên Hà Giang',14=>'Trường THPT Chuyên Hà Giang',72=>'Trường THPT Chuyên Cao Bằng',81=>'Trường THPT Chuyên Cao Bằng',18=>'Trường THPT Chuyên Tuyên Quang',19=>'Trường THPT Thái Hòa',127=>'Trường THPT Chuyên Lào Cai',128=>'Trường THPT Chuyên Lào Cai',30=>'Trường THPT Lương Thế Vinh',11=>'Trường THPT Chuyên Lê Quý Đôn',42=>'Trường THPT Bình Lư',43=>'Trường THCS  Đoàn Kết',122=>'Trường TH, THCS Quyết Tâm',123=>'Trường THPT Mộc Lỵ',125=>'Trường THPT Chuyên Nguyễn Tất Thành',126=>'Trường THPT Chuyên Nguyễn Tất Thành',90=>'Trường THPT chuyên Hoàng Văn Thụ',57=>'Trường THPT chuyên Hoàng Văn Thụ',99=>'Trường THPT Chuyên Thái Nguyên',100=>'Trường THPT Phú Bình',92=>'Trường THPT Chuyên Chu Văn An',96=>'Trường THPT Chuyên Chu Văn An',130=>'Trường THPT Chuyên Hạ Long',134=>'Trường THPT Hòn Gai',120=>'Trường THPT Ngô Sĩ Liên',119=>'Trường THCS Lê Quý Đôn',33=>'Trường THCS Phú Lộc',32=>'Trường THCS Tiên Du',93=>'Trường THPT Chuyên Vĩnh Phúc',94=>'Trường THCS Vĩnh Yên',63=>'Trường THPT Quế Võ số 1',62=>'Trường THPT Hàn Thuyên',2=>'Trường THPT Nguyễn Văn Cừ',6=>'Trường THPT Tứ Kỳ',87=>'Trường THPT Chuyên Trần Phú',39=>'Trường THPT Ngô Quyền',29=>'Trường THPT Chuyên Hưng Yên',28=>'Trường THPT Phù Cừ',17=>'Trường THPT Chuyên Thái Bình',16=>'Trường THCS Nam Hà',89=>'Trường THPT chuyên Biên Hòa',88=>'Trường THCS Trần Quốc Toản',124=>'Trường THPT Nguyễn Khuyến',121=>'Trường THPT Nam Trực',56=>'Trường THPT Ninh Bình-Bạc Liêu',55=>'Trường THPT Hoa Lư A',49=>'Trường THCS Nguyễn Văn Trỗi',50=>'Trường THPT Chuyên Lam Sơn',52=>'Trường THCS Đặng Thai Mai',54=>'Trường THCS Hòa Hiếu 1',131=>'Trường THPT Phan Đình Phùng',136=>'Trường THPT Chuyên Hà Tĩnh',34=>'Trường THCS và THPT Trung Hóa',36=>'Trường THCS Thị trấn Quy Đạt',112=>'Trường THCS Khe Sanh',133=>'Trường THPT chuyên Lê Quý Đôn',85=>'Trường THPT Chuyên Quốc Học Huế',76=>'Trường THPT Hai Bà Trưng',83=>'Trường THCS Nguyễn Tri Phương',84=>'Trường THCS Nguyễn Tri Phương',103=>'Trường THPT Hoàng Hoa Thám',105=>'Trường THPT Hoàng Hoa Thám',107=>'Trường THPT Lê Quý Đôn',110=>'Trường THPT chuyên Nguyễn Bỉnh Khiêm',146=>'Trường THPT chuyên Lê Khiết',147=>'Trường THPT Võ Nguyên Giáp',27=>'Trường THCS Hoài Châu Bắc',9=>'Trường THCS Tam Quan Bắc',23=>'Trường THPT Nguyễn Huệ',22=>'Trường THPT Trần Phú',13=>'Trường TH, THCS và THPT iSchool Nha Trang',4=>'Trường THPT Lý Tự Trọng',68=>'Trường THPT Nguyễn Trãi',60=>'Trường THPT iSchool Ninh Thuận',3=>'Trường TH, THCS và THPT Lê Quý Đôn',44=>'Trường THPT chuyên Trần Hưng Đạo',75=>'Trường THPT Chuyên Nguyễn Tất Thành',73=>'Trường THPT Chuyên Nguyễn Tất Thành',45=>'Trường THPT chuyên Hùng Vương',86=>'Trường THPT chuyên Hùng Vương',138=>'Trường THCS Tô Hiệu',91=>'Trường TH, THCS và THPT Victory',59=>'Trường THPT Krông Nô',67=>'Trường THPT Đắk Mil',71=>'Trường THCS Nguyễn Du - Đà Lạt',58=>'Trường THPT Chuyên Bảo Lộc',35=>'Trường THPT Chuyên Quang Trung',40=>'Trường THPT Chuyên Quang Trung',80=>'Trường THPT Trần Phú',82=>'Trường THCS Lê Lợi',25=>'Trường THCS Nguyễn Văn Cừ',26=>'Trường THPT chuyên Hùng Vương',98=>'Trường THCS Nguyễn Công Trứ, Trảng Bom',97=>'Trường THPT Thống Nhất A',104=>'Trường THPT Châu Thành',106=>'Trường THPT Trần Văn Quan',141=>'Trường THPT Chuyên Lê Hồng Phong',144=>'Trường THPT Gia Định',143=>'Trường THPT Trần Khai Nguyên',142=>'Trường THCS Quang Trung',47=>'Trường THPT Phạm Thành Trung',48=>'Trường THPT Chuyên Tiền Giang',102=>'Trường THPT Tán Kế',116=>'Trường THPT Nguyễn Đình Chiểu',77=>'Trường Thực hành Sư phạm Trà Vinh',64=>'Trường THCS Phong Phú',114=>'Trường THPT Vĩnh Long',108=>'Trường THPT Chuyên Nguyễn Bỉnh Khiêm',135=>'Trường THPT Lấp Vò 2',132=>'Trường THPT thành phố Cao Lãnh',37=>'Trường THCS Phú Thọ',38=>'Trường THPT chuyên Thoại Ngọc Hầu',78=>'Trường THPT chuyên Huỳnh Mẫn Đạt',74=>'Trường THPT chuyên Huỳnh Mẫn Đạt',66=>'Trường THPT Châu Văn Liêm',69=>'Trường THPT chuyên Lý Tự Trọng',79=>'Trường THPT Chuyên Vị Thanh',115=>'Trường THCS Lương Nghĩa',41=>'Trường THPT Mỹ Hương',118=>'Trường THPT Chuyên Nguyễn Thị Minh Khai',7=>'Trường THPT Trần Văn Bảy',5=>'Trường TH, THCS Tân Thạnh',61=>'Trường THPT Trần Văn Thời',10=>'Trường THPT Chuyên Phan Ngọc Hiển',51=>'Trường PT Vùng cao Việt Bắc',137=>'Trường THPT chuyên KHTN',139=>'Trường THPT chuyên KHTN',21=>'Trường ĐH Sư phạm Hà Nội 2',20=>'Khoa Hóa học - Trường ĐH Khoa học Tự nhiên',53=>'Trường Đại học Công nghệ',140=>'Trường Đại học Vinh',129=>'Trường Đại học Vinh',117=>'Khoa Hóa học - Trường ĐH Sư phạm Hà Nội',95=>'Trường THCS, THPT Nguyễn Tất Thành',65=>'Trường Phổ thông Năng Khiếu - ĐHQG Tp. HCM',70=>'Trường Phổ thông Năng Khiếu - ĐHQG Tp. HCM',145=>'Trường THPT Lâm Nghiệp'];
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
        return Excel::download(new ReportExport(3, $param), '[' . $param['examiner_id'] . '] Phiếu nhập điểm.pdf');
    }

    public function reportMedalGroup()
    {
        $groups = Group::all();
        return Excel::download(new ReportExport(9, $groups), 'Thống kê giải-LV.xlsx');
    }

    public function reportMedalDVDT()
    {
        $user = User::whereIn('role', [3, 6])->get();
        return Excel::download(new ReportExport(10, $user), 'Thống kê giải-DVDT.xlsx');
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
                return $pdf->download('Bằng khen.pdf');
            }
            return $pdf->stream('Bằng khen-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Bằng khen Trung ương đoàn.pdf');
            }
            return $pdf->stream('Bằng khen Trung ương đoàn-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Bằng khen Trung ương đoàn.pdf');
            }
            return $pdf->stream('Bằng khen Trung ương đoàn-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
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
                return $pdf->download('Bằng khen Ban chấp hành CĐ.pdf');
            }
            return $pdf->stream('Bằng khen Ban chấp hành CĐ-' . ($param['medal_id'] ?? 'All') . '.pdf')->header('Content-Type', 'application/pdf');
        }
    }
}
