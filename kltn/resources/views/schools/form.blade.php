<div class="card text-dark bg-light border-danger p-3 mb-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Mã trường:</strong>
                {!! Form::text('key', $school->key??'', array('placeholder' => 'Nhập mã trường','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Cấp học:</strong>
                {!! Form::select('level', ['THCS'=>'THCS', 'THPT'=>'THPT', 'Phổ thông'=>'Phổ thông'] , $school->level??-1, array('required', 'placeholder' => 'Chọn cấp học...', 'class' => 'form-control', 'id' => 'fieldVi')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group required">
                <strong>Tỉnh/Thành phố:</strong>
                {!! Form::select('province_id', $provinces??[], $school->province_id??$user->id_ref??'', array('placeholder'=>'Chọn tỉnh','class' => 'form-control', 'required', 'id'=>'provinceID', (($user->role??1)>2)?'disabled':'')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Tên trường:</strong>
                {!! Form::text('name', $school->name??'', array('placeholder' => 'Nhập tên trường','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Tên trường (Tiếng Anh):</strong>
                {!! Form::text('nameEn', $school->nameEn??'', array('placeholder' => 'Nhập tên trường - Tiếng Anh','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
</div>