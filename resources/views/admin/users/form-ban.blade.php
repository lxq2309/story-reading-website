<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group required">
            <label for="username">Tên tài khoản</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                   class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" disabled>
            @if ($errors->has('username'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="reason">Lý do ban</label>
            <input type="text" name="reason" id="reason"
                   value="{{ old('reason', $user->banned?->reason) }}"
                   class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}">
            @if ($errors->has('reason'))
                <div class="invalid-feedback">{{ $errors->first('reason') }}</div>
            @endif
        </div>
        @if(is_route('admin.users.create_ban'))
            <div class="form-group">
                <label for="ban_days">Thời hạn (ngày)</label>
                <input type="text" name="ban_days" id="ban_days"
                       value="{{ old('ban_days', null) }}"
                       class="form-control{{ $errors->has('ban_days') ? ' is-invalid' : '' }}">
                @if ($errors->has('ban_days'))
                    <div class="invalid-feedback">{{ $errors->first('ban_days') }}</div>
                @endif
            </div>
        @endif

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
    </div>
</div>
