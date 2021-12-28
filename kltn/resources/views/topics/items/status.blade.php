@php
$status = ['Thiếu tệp đính kèm', 'Chờ phê duyệt', 'Đạt', 'Chưa đạt', 'Đóng'];
@endphp
@if($research->status == 0)
<div class="badge badge-danger">{{ $status[$research->status] }}</div>
@elseif ($research->status == 1)
<div class="badge badge-warning">{{ $status[$research->status] }}</div>
@elseif ($research->status == 3)
<div class="badge badge-danger">{{ $status[$research->status] }}</div>
@elseif ($research->status == 2)
<div class="badge badge-success">{{ $status[$research->status] }}</div>
@else
<div class="badge badge-info disable">{{ $status[$research->status] }}</div>
@endif