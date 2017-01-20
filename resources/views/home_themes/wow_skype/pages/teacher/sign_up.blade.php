@extends('home_themes.wow_skype.master.simple')
@section('lib_styles')
    <link rel="stylesheet" href="{{ _kExternalLink('select2-css') }}">
@endsection
@section('extended_styles')
    <style>
        .select2-dropdown {
            min-width: 261px;
            margin-left: 2px;
        }
        .select2-dropdown.select2-dropdown--below {
            margin-top: 3px;
        }
        .select2-dropdown.select2-dropdown--above {
            margin-top: -3px;
        }
        .select2-hidden-accessible {
            height: 0;
        }
        .select2-container--default .select2-selection--single {
            border: none;
            background-color: #eee;
        }
    </style>
@endsection
@section('lib_scripts')
    <script src="{{ _kExternalLink('select2-js') }}"></script>
@endsection
@section('extended_scripts')
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endsection
@section('main_content')
    <div id="page-teacher-sign-up">
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <div class="content">
                    @include('home_themes.wow_skype.pages.teacher.sign_up_' . $site_locale)
                    @if(!empty($skype_id))
                        <p>Skype: <a href="skype:{{ $skype_id }}?chat">{{ $skype_id }} {{ empty($skype_name) ? '(' . $skype_name . ')' : '' }}</a></p>
                    @endif
                    @if(!empty($hot_line))
                        <p>{{ trans('label.hot_line_short') }}: <a>{{ $hot_line }}</a></p>
                    @endif
                    @if(!empty($email))
                        <p>{{ trans('label.email_short') }}: <a href="mail:{{ $email }}">{{ $email }}</a></p>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-5">
                <div class="panel panel-default margin-top-20">
                    <div class="panel-heading">
                        <h4 class="margin-none">{{ trans('label.application_form') }}</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            {{ csrf_field() }}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group has-feedback">
                                <input class="form-control" id="inputDisplayName" type="text" placeholder="{{ trans('label.full_name') }}" name="display_name" required value="{{ old('display_name') }}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" type="text" placeholder="Skype ID" name="skype_id" required value="{{ old('skype_id') }}">
                                <span class="glyphicon glyphicon-globe form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon padding-none">
                                        <div style="width: 82px">
                                            <label for="inputPhoneCode" class="sr-only">{{ trans('label.calling_code') }}</label>
                                            <select id="inputPhoneCode" name="phone_code" class="form-control select2" data-placeholder="{{ trans('form.action_select') }} {{ trans('label.calling_code_lc') }}" style="width: 100%">
                                                {{ callingCodesAsOptions(old('phone_code', 'VN')) }}
                                            </select>
                                        </div>
                                    </span>
                                    <input type="tel" class="form-control" placeholder="{{ trans('label.phone') }}" name="phone_number" required value="{{ old('phone_number') }}">
                                </div>
                                <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" id="email" type="email" placeholder="{{ trans('label.email') }}" name="email" required value="{{ old('email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input class="form-control" type="password" id="password" placeholder="{{ trans('label.password') }}" name="password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('form.action_sign_up') }}</button>
                        </form>
                        <p class="margin-top-15">{{ trans('label.already_member') }} <a href="{{ homeUrl('auth/login') }}">{{ trans('form.action_login') }}</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection