<!-- Giáo viên -->
<div class="card text-dark bg-light border-success p-3 mb-3">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Giáo viên hướng dẫn:</strong>
                {!! Form::text('teacher_'.$No, $teacher[0]??'', array( 'required', 'placeholder' => 'Nhập tên giáo viên hướng dẫn','class' => 'form-control', 'id' => 'teacher_name')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group required">
                <strong>Đơn vị công tác:</strong>
                {!! Form::text('teacherSchool_'.$No, $teacher[1]??'', array( 'required', 'placeholder' => 'Nhập đơn vị công tác','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
</div>