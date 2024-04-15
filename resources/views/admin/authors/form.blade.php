<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Mô tả</label>
            <input type="text" name="description" id="description"
                   value="{{ old('description', $author->description) }}"
                   class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
            @if ($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            @endif
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
