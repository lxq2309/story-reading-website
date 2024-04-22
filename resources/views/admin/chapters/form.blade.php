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
