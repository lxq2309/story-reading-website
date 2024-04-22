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
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
