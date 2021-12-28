<div>
    <div class="float-left">
        @can('research-report')
        <a class="btn btn-warning" href="/researchs/export?{{http_build_query($param??[], '', '&')}}"> Xuất báo cáo</a>
        @endcan
    </div>
    <div class="float-right">
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Mã</th>
            <th width="300px">Tên</th>
            <th>Trạng thái</th>
            <th>Lĩnh vực</th>
            <th>Đơn vị dự thi</th>
            <th>Thao tác</th>
        </tr>
        @foreach ($researchs as $research)
        <tr title="{{ $research->name }}">
            <td class="align-middle">{{ $research->key }}</td>
            <td class="align-middle">
                <k class="text-truncate-2" style="min-width: 200px; max-width: 500px">{{ $research->name }}</k>
            </td>
            <td class="align-middle">
                @include('researchs.items.status')
            </td>
            <td class="align-middle">
                <k class="text-truncate-2" style="min-width: 150px">{{ $fields[$research->field_id]??$research->field->name }}</k>
            </td>
            <td class="align-middle">
                <k class="text-truncate-2" style="min-width: 150px">{{ $users[$research->user_id]??$research->user->name??'Không tìm thấy đơn vị dự thi.' }}</k>
            </td>
            <td class="align-middle">
                <k class="btn-group">
                    <a class="btn btn-info" href="{{ route('researchs.show',$research->id) }}">Xem</a>
                    @can('research-edit')
                    <a class="btn btn-primary" href="{{ route('researchs.edit',$research->id) }}">Sửa</a>
                    @endcan
                    @can('research-delete')
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-rsid="{{$research->id}}" data-toggle="modal" data-target="#delete">Xóa</button>
                    @endcan
                </k>
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
                @can('research-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['researchs.destroy', $research->id??0],'style'=>'display:inline', 'id'=>'deleteRS'])!!}
                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endcan
            </div>
        </div>
    </div>
</div>
{!! $researchs->links() !!}

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