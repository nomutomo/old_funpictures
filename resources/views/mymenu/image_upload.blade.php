<div class="container page-header">
    <div class="col-md-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="imagePreview"></div>
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        ファイルを選択<input type="file" style="display:none" class="uploadFile">
                    </span>
                </label>
                <input type="text" class="form-control" readonly="">
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).on('change', ':file', function() {
        var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.parent().parent().next(':text').val(label);
    
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function(){ // set image data as background of div
                input.parent().parent().parent().prev('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
    });
</script>