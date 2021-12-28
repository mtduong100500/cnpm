@php
$titles = ['Ảnh đại diện:', 'Tóm tắt đề tài:', 'Phụ lục I:', 'Phụ lục II:'];
$notes = [
'(.png, .jpg) Đính kèm ảnh có kích thước 4x6 theo đúng thứ tự học sinh, giáo viên ở trên.',
'(.pdf) Theo mẫu Đề cương nghiên cứu kèm theo Phiếu học sinh 1A, không quá 15 trang đánh máy (kể cả phụ lục, tài liệu tham khảo) khổ A4 (lề trái 3cm, lề phải 2cm, lề trên 2cm, lề dưới 2cm; cách dòng đơn), kiểu chữ Times New Roman, cỡ chữ 14, báo cáo không ghi tên đơn vị, tên học sinh, tên người bảo trợ, tên người hướng dẫn khoa học).',
'(.pdf) Mỗi đơn vị dự thi lập 01 bản đăng ký dự thi (gồm bản giấy dấu đỏ và file mềm) có đầy đủ thông tin chính xác của giáo viên hướng dẫn và học sinh tham gia dự thi, kèm ảnh chân dung (ảnh màu, cỡ 4x6cm) được chụp trong thời gian không quá 06 tháng, có chữ ký và đóng dấu của thủ trưởng đơn vị dự thi. Bản giấy dấu đỏ gửi về Bộ GDĐT (qua Vụ Giáo dục Trung học) trước ngày 31/01/2021 (theo dấu bưu điện).',
'(.pdf) Phiếu học sinh (Phiếu 1A); Phiếu phê duyệt dự án (Phiếu 1B); Phiếu người bảo trợ (Phiếu 1); Đề cương nghiên cứu (theo mẫu hướng dẫn kèm theo Phiếu học sinh 1A); Phiếu xác nhận của cơ quan nghiên cứu (nếu có); Phiếu xác nhận của nhà khoa học chuyên ngành (nếu có); Phiếu đánh giá rủi ro (nếu có); Phiếu dự án tiếp tục (nếu có); Phiếu tham gia của con người (nếu có); Phiếu cho phép thông tin (nếu có); Phiếu nghiên cứu động vật có xương sống (nếu có); Phiếu đánh giá rủi ro chất nguy hiểm (nếu có); Phiếu sử dụng mô người và động vật (nếu có);'];
$status = ['Chưa xét duyệt', 'Đạt', 'Chưa đạt']
@endphp

<div class="">
    <div class="float-left text-justify">
        <strong>{{$titles[$type]}}</strong>
        <i>{{$notes[$type]}}</i>
    </div>
    @can('file-create')
    <div class="float-right">
        @if ($type==2)
        <a class="btn btn-primary" href="{{ asset('uploads/Phu luc I.pdf') }}"> Xem phụ lục 1</a>
        @elseif ($type==3)
        <a class="btn btn-primary" href="{{ asset('uploads/Phu luc II.pdf') }}"> Xem phụ lục 2</a>
        @endif
        <a class="btn btn-success" href="{{ route('files.create', ['id'=>$id, 'type'=>$type  ]) }}"> Tải lên</a>
    </div>
    @endcan
</div>
<div class="table-responsive mt-2">
    <table class="table table-bordered table-hover mb-0">
        @foreach ($files as $key=> $file)
        @if ($file->type == $type)
        <tr>
            <td class="align-middle" style="width: 100px">{{ $key+1 }}</td>
            <td class="align-middle">{{ substr($file->filename, 11) }}</td>
            <td class="align-middle" style="width: 170px">
                @if ($file->status==0)
                <div class="badge badge-primary">{{ $status[$file->status] }}</div>
                @elseif ($file->status ==1)
                <div class="badge badge-success">{{ $status[$file->status] }}</div>
                @else ($file->status ==2)
                <div class="badge badge-danger">{{ $status[$file->status] }}</div> <i>{{$file->comment}}</i>
                
                @endif
            </td>

            <td style="width: 180px">
                <form action="{{ route('files.destroy',$file->id) }}" method="POST" class="mb-0 btn-group">
                    @can('file-edit')
                    @if($type)
                    <a class="btn btn-warning" target="_blank" href="{{ route('files.edit',['file'=>$file->id, 'id'=>$id]) }}">Phê duyệt</a>
                    @endif
                    @endcan
                    <a class="btn btn-info" href="{{ route('files.show',$file->id) }}">Xem</a>
                    @csrf
                    @method('DELETE')
                    @can('file-delete')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endif
        @endforeach
    </table>
</div>