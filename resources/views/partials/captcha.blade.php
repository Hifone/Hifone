<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="verifycode" style="width: 200px;margin-right: 20px;" placeholder="{{ trans('hifone.captcha.captcha') }}">
        <span class="input-group-captcha">
            <a href="#" class="captcha-image-box"><img src="{{ $captcha }}"  title="{{ trans('hifone.captcha.refresh') }}" /></a>
        </span>
    </div>
</div>