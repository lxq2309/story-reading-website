<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Mô tả</label>
            <input type="text" name="description" id="description"
                   value="{{ old('description', $menu->description) }}"
                   class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
            @if ($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Link</label>
            <input type="text" name="link" id="link"
                   value="{{ old('link', $menu->link) }}"
                   class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}">
            @if ($errors->has('link'))
                <div class="invalid-feedback">{{ $errors->first('link') }}</div>
            @endif
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
