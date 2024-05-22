<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            <label for="number">Thứ tự chương</label>
            <input type="number" name="number" id="number" value="{{ old('number', $chapter->number) }}"
                   class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}">
            @if ($errors->has('number'))
                <div class="invalid-feedback">{{ $errors->first('number') }}</div>
            @endif
        </div>
        <div class="form-group required">
            <label for="title">Tên chương</label>
            <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}"
                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
            @if ($errors->has('title'))
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="form-group required">
            <label for="content">Nội dung</label>
            <textarea name="content" id="content"
                      class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ old('content', $chapter->content) }}</textarea>
            @if ($errors->has('content'))
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
            @endif
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
@section('ArticleScripts')
    <script !src="">
        $('#content').summernote({
            placeholder: 'Nhập nội dung của chương',
            height: 500,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            codemirror: {
                theme: 'monokai'
            },
            callbacks: {
                onImageUpload: function (files) {
                    // Get the first file (assuming you don't allow multiple file uploads)
                    var file = files[0];

                    // Create FormData object and append the file
                    var formData = new FormData();
                    formData.append('image', file);

                    // Make an AJAX request to the Imgur API
                    $.ajax({
                        url: 'https://api.imgur.com/3/image',
                        type: 'POST',
                        headers: {
                            Authorization: 'Client-ID ' + '23d58aa188f6abe',
                            Accept: 'application/json'
                        },
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // On success, insert the image URL into the summernote editor
                            if (response.data && response.data.link) {
                                $('#content').summernote('insertImage', response.data.link);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            // Handle any errors here
                            console.error('Error uploading image: ' + textStatus, errorThrown);
                        }
                    });
                }
            }
        });
    </script>
@endsection
