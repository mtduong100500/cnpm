<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<style>
    .dropzone {
        background: #e3e6ff;
        border-radius: 13px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        border: 2px dotted #1833FF;
        margin-top: 50px;
    }
</style>
@if (!$id)
<div class="alert alert-danger">
    <h3>Bạn không thể tải file!</h3>
</div>
@else
<form action="{{ route('files.store', compact('id', 'type' )) }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
    @csrf
    <div class="text-center">
        <h3>Tải tệp tin</h3>
        <b>Tối đa: 5MB</b>
        <i>(pdf-jpeg-jpg-png)</i>
    </div>
</form>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        maxFiles: 1,
        success: function(file, response) {
            alert(response.message);
            window.location = '/researchs/' + response.id
        }
    };
</script>
@endif