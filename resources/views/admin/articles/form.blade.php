<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            <label for="title">Tên truyện</label>
            <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
            @if ($errors->has('title'))
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description"
                      class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $article->description) }}</textarea>
            @if ($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="genres">Thể loại</label>
            <div class="row">
                @foreach($genres as $genre)
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                   {{ in_array($genre->id, old('genres', $selectedGenres)) ? 'checked' : '' }} class="form-check-input">
                            <label class="form-check-label">{{ $genre->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="genres">Tác giả</label>
            <div class="row">
                @foreach($authors as $author)
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                                   {{ in_array($author->id, old('authors', $selectedAuthors)) ? 'checked' : '' }} class="form-check-input">
                            <label class="form-check-label">{{ $author->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="cover_image">Ảnh bìa</label>
            <div class="m-5">
                <img id="preview_image" src="{{ old('cover_image_url', $article->cover_image) }}"
                     alt="{{ old('title', $article->title) }}" width="200px">

            </div>
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                       aria-controls="tab1" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                       aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="form-group mt-4">
                        <input type="text" class="form-control"
                               placeholder="https://example.com/image.jpg"
                               id="cover_image_url_preview"
                               name="cover_image_url_preview"
                               value="{{ old('cover_image_url_preview', $article->cover_image) }}">
                        <input type="hidden" name="cover_image_url"
                               value="{{ old('cover_image_url', $article->cover_image) }}">
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="form-group mt-4">
                        <input type="file" class="form-control-file" name="cover_image" accept="image/*">
                    </div>
                </div>
            </div>
            @if ($errors->has('cover_image'))
                <div class="invalid-feedback">{{ $errors->first('cover_image') }}</div>
            @endif
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>

@section('ArticleScripts')
    <script>
        $(document).ready(function () {
            previewImage();
        });

        function previewImage() {
            let imgPreview = document.querySelector('#preview_image');
            let coverImageUrl = document.querySelector('input[name="cover_image_url"]');

            $('input[name="cover_image"]').on('change', function (event) {
                if (event.target.files && event.target.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        if (imgPreview) {
                            imgPreview.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });

            $('#cover_image_url_preview').on('input', debounce(function () {
                if (imgPreview) {
                    let url = $(this).val();
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (data, textStatus, jqXHR) {
                            imgPreview.src = coverImageUrl.value = url;
                            console.log(imgPreview.src);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 404) {
                                let defaultImage = '/images/articles/default.jpg';
                                imgPreview.src = coverImageUrl.value = defaultImage;
                            } else {
                                console.log('Lỗi:', errorThrown);
                            }
                        }
                    });
                }
            }, 250));
        }
    </script>
@endsection
