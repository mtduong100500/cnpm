<form action="{{ route('researchs.index') }}" method="GET" class="remove-empty-values">
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Tìm kiếm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group required">
                                <strong>Tên đề tài:</strong>
                                {!! Form::text('name', '', array('placeholder' => 'Nhập tên đề tài - Tiếng Việt','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Lĩnh vực (Tiếng Việt):</strong>
                                {!! Form::select('field_id', $fields, 0, array( 'placeholder' => 'Chọn lĩnh vực...', 'class' => 'form-control', 'id' => 'fieldVi')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Tỉnh/Thành phố:</strong>
                                {!! Form::select('province_id', $provinces??[], '', array('placeholder'=>'Chọn tỉnh','class' => 'form-control', 'id'=>'provinceID', (($user->role??1)>2)?'disabled':'')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Đơn vị dự thi:</strong>
                                {!! Form::select('user_id', $users??[], 0, array( 'placeholder' => 'Chọn đơn vị dự thi...', 'class' => 'form-control', (($user->role??1)>2)?'disabled':'')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Nhóm lĩnh vực:</strong>
                                {!! Form::select('group_id', $groups??[], 0, array('placeholder' => 'Chọn nhóm lĩnh vực...', 'class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Giải:</strong>
                                {!! Form::select('medal_id', $medals??[], 0, array('placeholder' => 'Chọn giải...', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.remove-empty-values').submit(function() {
            $(this).find(':input').filter(function() {
                return !this.value;
            }).attr('disabled', 'disabled');
            return true; // make sure that the form is still submitted
        });
    });
</script>