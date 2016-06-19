<!DOCTYPE html>
<html lang="zh">
@include('dashboard.partials.head')

<body class="install" data-page="install">
    <div class="text-center">
        <img class="logo" height="80" src="/images/hifone-logo.png" alt="Hifone">
        <h4>{{ trans('install.title') }}</h4>
        <br>
    </div>
    <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2">
        <div class="steps">
            <div class="step active">
                {{ trans('install.env_check') }}
                <span></span>
            </div>
            <div class="step">
                {{ trans('install.env_setup') }}
                <span></span>
            </div>
            <div class="step">
                {{ trans('install.config_setup') }}
                <span></span>
            </div>
            <div class="step">
                {{ trans("install.admin_account") }}
                <span></span>
            </div>
            <div class="step">
                {{ trans("install.complete_install") }}
                <span></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <form class="form-horizontal" name="SetupForm" method="POST" id="install-form" role="form">
            <div class="steup block-0">
                <table class="bordered verifiers">
                <thead>
                    <tr>
                        <th></th>
                        <th>Requirement</th>
                        <th>Pass?</th>
                    </tr>
                </thead>
                <tbody>
                    {!! $env_check !!}
                </tbody>
                </table>
                <hr>
                <div class="form-group text-center">
                    <span @if(!$root_verifier->verify()) disabled="disabled"  class="btn btn-default" @else class="wizard-next btn btn-success" @endif data-current-block="0" data-next-block="1" data-loading-text="<i class='fa fa-spinner'></i>">
                        {{ trans('install.next_step') }}
                    </span>
                </div>
            </div>
            <div class="step block-1 hidden">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('install.cache_driver') }}</label>
                        <select name="env[cache_driver]" class="form-control" required>
                            <option disabled>{{ trans('install.cache_driver') }}</option>
                            @foreach($cache_drivers as $driver => $driverName)
                            <option value="{{ $driver }}" {{ Input::old('env.cache_driver') == $driver ? "selected" : null }}>{{ $driverName }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('env.cache_driver'))
                        <span class="text-danger">{{ $errors->first('env.cache_driver') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans('install.session_driver') }}</label>
                        <select name="env[session_driver]" class="form-control" required>
                            <option disabled>{{ trans('install.session_driver') }}</option>
                            @foreach($cache_drivers as $driver => $driverName)
                            <option value="{{ $driver }}" {{ Input::old('env.session_driver') == $driver ? "selected" : null }}>{{ $driverName }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('env.session_driver'))
                        <span class="text-danger">{{ $errors->first('env.session_driver') }}</span>
                        @endif
                    </div>
                </fieldset>
                <hr>
                <div class="form-group text-center">
                    <span class="wizard-next btn btn-info" data-current-block="1" data-next-block="0">
                            {{ trans('install.prev_step') }}
                    </span>
                    <span class="wizard-next btn btn-success" data-current-block="1" data-next-block="2" data-loading-text="<i class='fa fa-spinner'></i>">
                        {{ trans('install.next_step') }}
                    </span>
                </div>
            </div>
            <div class="step block-2 hidden">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('install.site_name') }}</label>
                        <input type="text" name="settings[site_name]" class="form-control" placeholder="{{ trans('install.site_name') }}" value="{{ Input::old('settings.site_name', 'Hifone') }}" required>
                        @if($errors->has('settings.site_name'))
                        <span class="text-danger">{{ $errors->first('settings.site_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans('install.site_domain') }}</label>
                        <input type="text" name="settings[site_domain]" class="form-control" placeholder="{{ trans('install.site_domain') }}" value="{{ Input::old('settings.site_domain', url('/')) }}" required>
                        @if($errors->has('settings.site_domain'))
                        <span class="text-danger">{{ $errors->first('settings.site_domain') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('install.site_locale') }}</label>
                        <select name="settings[site_locale]" class="form-control" required>
                            <option value="">Select Language</option>
                            @foreach($langs as $lang => $name)
                            <option value="{{ $lang }}" @if(Input::old('settings.site_locale') == $lang || $user_language == $lang) selected @endif>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('settings.site_locale'))
                        <span class="text-danger">{{ $errors->first('settings.site_locale') }}</span>
                        @endif
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <span class="wizard-next btn btn-info" data-current-block="2" data-next-block="1">
                            {{ trans('install.prev_step') }}
                        </span>
                        <span class="wizard-next btn btn-success" data-current-block="2" data-next-block="3" data-loading-text="<i class='icon ion-load-c'></i>">
                            {{ trans('install.next_step') }}
                        </span>
                    </div>
                </fieldset>
            </div>
            <div class="step block-3 hidden">
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans("install.username") }}</label>
                        <input type="text" name="user[username]" class="form-control" placeholder="{{ trans('install.username') }}" value="{{ Input::old('user.username', '') }}" required>
                        @if($errors->has('user.username'))
                        <span class="text-danger">{{ $errors->first('user.username') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans("install.email") }}</label>
                        <input type="text" name="user[email]" class="form-control" placeholder="{{ trans('install.email') }}" value="{{ Input::old('user.email', '') }}" required>
                        @if($errors->has('user.email'))
                        <span class="text-danger">{{ $errors->first('user.email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans("install.password") }}</label>
                        <input type="password" name="user[password]" class="form-control password-strength" placeholder="{{ trans('install.password') }}" value="{{ Input::old('user.password', '') }}" required>
                        <div class="strengthify-wrapper"></div>
                        @if($errors->has('user.password'))
                        <span class="text-danger">{{ $errors->first('user.password') }}</span>
                        @endif
                    </div>
                </fieldset>
                <hr >
                <div class="form-group text-center">
                    <span class="wizard-next btn btn-info" data-current-block="3" data-next-block="2">
                        {{ trans('install.prev_step') }}
                    </span>
                    <span class="wizard-next btn btn-success" data-current-block="3" data-next-block="4" data-loading-text="<i class='icon ion-load-c'></i>">
                        {{ trans("install.complete_install") }}
                    </span>
                </div>
            </div>
            <div class="step block-4 hidden">
                <div class="install-success">
                    <i class="ion ion-checkmark-circled"></i>
                    <h3>
                        {{ trans("install.completed") }}
                    </h3>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-default">
                        <span>{{ trans("install.finish_install") }}</span>
                    </a>
                </div>
            </div>
        </form>
    </div>    
</body>
</html>