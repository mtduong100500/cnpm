<div>
    <div class="float-left">
        @can('topic-report')
        <a class="btn btn-warning" href="#"> Xuất báo cáo</a>
        @endcan
    </div>
    <div class="float-right">
    </div>
</div>

<div class="table-responsive">
<table class="table table-bordered table-hover">
        <tr>
            <th>STT</th>
            <th>Tên đề tài</th>
            <th>Bộ môn</th>
            <th>Số lượng SV</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th width="200px">Thao tác</th>
        </tr>
        
        @foreach ($topics as $key => $topic)
        <tr>
            <td class="align-middle">{{ ++$i }}</td>
            <td class="align-middle">{{ $topic->name }}</td>
            <td class="align-middle">{{ $topic->department }}</td>
            <td class="align-middle">{{ $topic->number_student }}</td>
            <td class="align-middle">{{ $topic->note }}</td>
            <td class="align-middle">
                @if($topic->status == '0')                
                    <div class="badge badge-danger">Đã đủ SV</div>                
                @else
                    <div class="badge badge-success">Có thể đăng ký</div>                
                @endif
            </td>
            <td class="align-middle">
                <a class="btn btn-info" href="{{ route('topics.show', $topic) }}">Xem</a>
                @can('topic-edit')
                <a class="btn btn-primary" href="{{ route('topics.edit', $topic->id) }}">Sửa</a>
                @endcan

                @can('topic-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['topics.destroy', $topic->id],'style'=>'display:inline'])!!}
                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">XÓA ĐỀ TÀI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id='contentRS'></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                @can('topic-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['topics.destroy', $topic->id??0],'style'=>'display:inline', 'id'=>'deleteRS'])!!}
                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endcan
            </div>
        </div>
    </div>
</div>
{!! $topics->links() !!}

<script>
    $(document).ready(function() {
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('rsid')
            $('#deleteRS').attr('action', document.location.origin + '/researchs/' + id)
            $('#contentRS').text('Bạn có chắc muốn xóa đề tài ' + id + ' không?')
        })
    })
</script>