@extends('layouts.app')


@section('content')


<div class="row">
    @include('home.item', ['name'=>'Thống kê', 'label' => 'Đề tài', 'link'=>'researchs/export', 'image'=>'print.png', 'role'=>'research-report'])
    @include('home.item', ['name'=>'Thống kê', 'label' => 'Đơn vị thi', 'link'=>'reports/dvdt', 'image'=>'print.png', 'role'=>'dvdt-report'])
    @include('home.item', ['name'=>'Thống kê', 'label' => 'Lĩnh vực', 'link'=>'reports/field', 'image'=>'print.png', 'role'=>'field-report'])
    @include('home.item', ['name'=>'Danh sách', 'label' => 'Thẻ dự thi', 'link'=>'reports/TheDT', 'image'=>'print.png', 'i'=>1, 'role'=>'province-report'])
    @include('home.item', ['name'=>'Phiếu', 'label' => 'Xác nhận TT', 'link'=>'reports/TTDT', 'image'=>'print.png', 'i'=>1, 'role'=>'province-report'])
    @include('home.item', ['name'=>'Danh sách', 'label' => 'Phiếu chấm', 'link'=>'reports/examiner', 'image'=>'print.png', 'i'=>1, 'role'=>'examiner-setup'])
    @include('home.item', ['name'=>'Danh sách', 'label' => 'Đạt giải', 'link'=>'reports/medal', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Thống kê KQ', 'label' => 'Nhóm LV', 'link'=>'reports/medal-group', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Thống kê KQ', 'label' => 'ĐV dự thi', 'link'=>'reports/medal-dvdt', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Chứng nhận', 'label' => 'Học sinh', 'link'=>'reports/certificate', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Chứng nhận', 'label' => 'Giáo viên', 'link'=>'reports/certificateGV', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Giấy khen CĐ', 'label' => 'Giáo viên', 'link'=>'reports/BCH', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Bằng khen', 'label' => 'Bộ trưởng', 'link'=>'reports/BK', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Bằng khen', 'label' => 'TW Đoàn', 'link'=>'reports/TWD', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Bằng khen', 'label' => 'VIFOTEC', 'link'=>'reports/Vifotec', 'image'=>'print.png', 'i'=>0, 'role'=>'medal-report'])
    @include('home.item', ['name'=>'Chứng nhận', 'label' => 'HS tham gia', 'link'=>'reports/certificate-TG', 'image'=>'print.png', 'i'=>0, 'role'=>'research-report'])
    @include('home.item', ['name'=>'Chứng nhận', 'label' => 'GV tham gia', 'link'=>'reports/certificateGV-TG', 'image'=>'print.png', 'i'=>0, 'role'=>'research-report'])
</div>

@endsection