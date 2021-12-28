<div class="card text-dark bg-light border-danger p-3 mb-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Mã nhóm lĩnh vực:</strong>
                {!! Form::text('key', $group->key??'', array('placeholder' => 'Nhập mã nhóm lĩnh vực','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Tên nhóm lĩnh vực:</strong>
                {!! Form::text('name', $group->name??'', array('placeholder' => 'Nhập tên nhóm lĩnh vực','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Chuyên viên quản lý/Máy chấm:</strong>
                {!! Form::select('user_id', $users , $group->user_id??-1, array('required', 'placeholder' => 'Chọn chuyên viên quản lý/Máy chấm', 'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group required">
                <strong>Chuyên lĩnh vực:</strong>
                {!! Form::select('fields[]', $fields , $group->fields??[], array('multiple','required', 'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
            <button type="submit" class="btn btn-success" name='suffer' value="true">Tạo mã</button>
        </div>
    </div>
</div>