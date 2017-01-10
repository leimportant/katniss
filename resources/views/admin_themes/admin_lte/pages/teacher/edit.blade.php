@extends('admin_themes.admin_lte.master.admin')
@section('page_title', trans('pages.admin_teachers_title'))
@section('page_description', trans('pages.admin_teachers_desc'))
@section('page_breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ adminUrl() }}"><i class="fa fa-home"></i> {{ trans('pages.admin_dashboard_title') }}</a></li>
    <li><a href="{{ adminUrl('teachers') }}">{{ trans('pages.admin_teachers_title') }}</a></li>
    <li><a href="#">{{ trans('form.action_edit') }}</a></li>
</ol>
@endsection
@section('lib_styles')
    <link rel="stylesheet" href="{{ _kExternalLink('select2-css') }}">
    <link rel="stylesheet" href="{{ libraryAsset('bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ libraryAsset('iCheck/square/blue.css') }}">
@endsection
@section('lib_scripts')
    <script src="{{ _kExternalLink('select2-js') }}"></script>
    <script src="{{ libraryAsset('bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ libraryAsset('bootstrap-datepicker/locales/bootstrap-datepicker.'.$site_locale.'.min.js') }}"></script>
    <script src="{{ libraryAsset('iCheck/icheck.min.js') }}"></script>
@endsection
@section('extended_scripts')
    <script>
        $(function () {
            $('.date-picker').datepicker({
                format: '{{ $date_js_format }}',
                language: '{{ $site_locale }}',
                enableOnReadonly : false
            });
            $('.select2').select2();
            $('[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            x_modal_put($('a.approve'), '{{ trans('form.action_approve') }}', '{{ trans('label.wanna_approve', ['name' => '']) }}');
            x_modal_put($('a.reject'), '{{ trans('form.action_reject') }}', '{{ trans('label.wanna_reject', ['name' => '']) }}');
            x_modal_delete($('a.delete'), '{{ trans('form.action_delete') }}', '{{ trans('label.wanna_delete', ['name' => '']) }}');
        });
    </script>
@endsection
@section('page_content')
    <form method="post" action="{{ adminUrl('teachers/{id}', ['id' => $teacher->user_id]) }}">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="row">
            <div class="col-xs-12">
                <div class="margin-bottom">
                    <a class="btn btn-warning delete" href="{{ addRdrUrl(addErrorUrl(adminUrl('teachers/{id}', ['id'=> $teacher->user_id])), $redirect_url) }}">
                        {{ trans('form.action_delete') }}
                    </a>
                    @if(!$teacher->isApproved)
                        <a class="btn btn-success approve" href="{{ addRdrUrl(addErrorUrl(adminUrl('teachers/{id}', ['id'=> $teacher->user_id]) . '?approve=1')) }}">
                            {{ trans('form.action_approve') }}
                        </a>
                    @else
                        <a class="btn btn-danger reject" href="{{ addRdrUrl(addErrorUrl(adminUrl('teachers/{id}', ['id'=> $teacher->user_id]) . '?reject=1')) }}">
                            {{ trans('form.action_reject') }}
                        </a>
                    @endif
                    <a class="btn btn-primary pull-right" href="{{ addRdrUrl(adminUrl('teachers/create'), $redirect_url) }}">
                        {{ trans('form.action_add') }} {{ trans_choice('label.teacher_lc', 1) }}
                    </a>
                </div>
                <h4 class="box-title">{{ trans('form.action_edit') }} {{ trans_choice('label.teacher_lc', 1) }}</h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#user-information" data-toggle="tab">
                                {{ trans('label.user_information') }}
                            </a>
                        </li>
                        <li>
                            <a href="#teacher-information" data-toggle="tab">
                                {{ trans('label.teacher_information') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user-information">
                            <div class="form-group">
                                <label class="control-label required" for="inputDisplayName">{{ trans('label.display_name') }}</label>
                                <input class="form-control" id="inputDisplayName" name="display_name" maxlength="255" placeholder="{{ trans('label.display_name') }}"
                                       type="text" required value="{{ $user->display_name }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label required" for="inputEmail">{{ trans('label.email') }}</label>
                                <input class="form-control" id="inputEmail" name="email" maxlength="255" placeholder="{{ trans('label.email') }}"
                                       type="email" required value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label required" for="inputName">{{ trans('label.user_name') }}</label>
                                <input class="form-control" id="inputName" name="name" maxlength="255" placeholder="{{ trans('label.user_name') }}"
                                       type="text" required value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="inputPassword">{{ trans('label.password') }}</label>
                                <input class="form-control" id="inputPassword" name="password" placeholder="{{ trans('label.password') }}"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label for="inputBirthday" class="control-label required">{{ trans('label.birthday') }} ({{ $date_js_format }})</label>
                                <input type="text" placeholder="{{ trans('label.birthday') }}" value="{{ $user->birthday }}"
                                       class="form-control date-picker" name="date_of_birth" id="inputBirthday" required>
                            </div>
                            <div class="form-group">
                                <label for="inputGender" class="control-label required">{{ trans('label.gender') }}</label>
                                <select id="inputGender" class="form-control" name="gender" required>
                                    <option value="">
                                        - {{ trans('form.action_select') }} {{ trans('label.gender') }} -
                                    </option>
                                    @foreach(allGenders() as $gender)
                                        <option value="{{ $gender }}"{{ $gender == $user->gender ? ' selected' : '' }}>
                                            {{ trans('label.gender_'.$gender) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputPhoneCode" class="control-label required">{{ trans('label.calling_code') }}</label>
                                        <select id="inputPhoneCode" name="phone_code" class="form-control select2" style="width: 100%" required
                                                data-placeholder="- {{ trans('form.action_select') }} {{ trans('label.calling_code_lc') }} -">
                                            <option value="">
                                                - {{ trans('form.action_select') }} {{ trans('label.calling_code') }} -
                                            </option>
                                            {{ callingCodesAsOptions($user->phone_code) }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="inputPhoneNumber" class="control-label required">{{ trans('label.phone') }}</label>
                                        <input id="inputPhoneNumber" type="tel" class="form-control" placeholder="{{ trans('label.phone') }}"
                                               name="phone_number" required value="{{ $user->phone_number }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="control-label">{{ trans('label.address') }}</label>
                                <input type="text" placeholder="{{ trans('label.address') }}" value="{{ $user->address }}"
                                       class="form-control" id="inputAddress" name="address">
                            </div>
                            <div class="form-group">
                                <label for="inputCity" class="control-label required">{{ trans('label.city') }}</label>
                                <input type="text" placeholder="{{ trans('label.city') }}" value="{{ $user->city }}"
                                       class="form-control" id="inputCity" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="inputCountry" class="control-label required">{{ trans('label.country') }}</label>
                                <select id="inputCountry" class="form-control select2" name="country" style="width: 100%;" required
                                        data-placeholder="- {{ trans('form.action_select') }} {{ trans('label.country') }} -">
                                    <option value="">
                                        - {{ trans('form.action_select') }} {{ trans('label.country') }} -
                                    </option>
                                    {!! countriesAsOptions($user->settings->country) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputNationality" class="control-label required">{{ trans('label.nationality') }}</label>
                                <select id="inputNationality" class="form-control select2" name="nationality" style="width: 100%;" required
                                        data-placeholder="- {{ trans('form.action_select') }} {{ trans('label.nationality') }} -">
                                    <option value="">
                                        - {{ trans('form.action_select') }} {{ trans('label.nationality') }} -
                                    </option>
                                    {!! countriesAsOptions($user->nationality) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputSkypeId" class="control-label">Skype ID</label>
                                <input type="text" placeholder="Skype ID" value="{{ $user->skype_id }}"
                                       class="form-control" id="inputSkypeId" name="skype_id">
                            </div>
                            <div class="form-group">
                                <label for="inputFacebook" class="control-label">Facebook URL</label>
                                <input type="text" placeholder="{{ trans('label.address') }}" value="{{ $user->facebook }}"
                                       class="form-control" id="inputFacebook" name="facebook">
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="teacher-information">
                            <div class="form-group">
                                <label for="inputTopics" class="control-label required">{{ trans_choice('label.topic', 2) }}</label>
                                <select class="form-control select2" id="inputTopics" name="topics[]" required multiple style="width: 100%;"
                                        data-placeholder="- {{ trans('form.action_select') }} {{ trans_choice('label.topic_lc', 2) }} -">
                                    <option value="">
                                        - {{ trans('form.action_select') }} {{ trans_choice('label.topic_lc', 2) }} -
                                    </option>
                                    @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}"{{ in_array($topic->id, $teacher_topic_ids) ? ' selected' : '' }}>
                                            {{ $topic->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputVideoIntroduceUrl" class="control-label">{{ trans('label.self_introduction_video') }}</label>
                                <input type="text" placeholder="Youtube URL" value="{{ $teacher->video_introduce_url }}"
                                       class="form-control" id="inputVideoIntroduceUrl" name="video_introduce_url">
                            </div>
                            <div class="form-group">
                                <label for="inputVideoTeachingUrl" class="control-label">{{ trans('label.teaching_video') }}</label>
                                <input type="text" placeholder="Youtube URL" value="{{ $teacher->video_teaching_url }}"
                                       class="form-control" id="inputVideoTeachingUrl" name="video_teaching_url">
                            </div>
                            <div class="form-group">
                                <label for="inputAboutMe" class="control-label">{{ trans('label.about_me') }}</label>
                                <textarea rows="6" class="form-control" id="inputAboutMe" name="about_me" minlength="200"
                                          placeholder="{{ trans('label.about_me') }}">{{ $teacher->about_me }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputTeachingExperience" class="control-label">{{ trans('label.teaching_experience') }}</label>
                                <textarea rows="6" class="form-control" id="inputTeachingExperience" name="experience" minlength="100"
                                          placeholder="{{ trans('label.teaching_experience') }}">{{ $teacher->experience }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputTeachingMethodology" class="control-label">{{ trans('label.teaching_methodology') }}</label>
                                <textarea rows="6" class="form-control" id="inputTeachingMethodology" name="methodology" minlength="100"
                                          placeholder="{{ trans('label.teaching_methodology') }}">{{ $teacher->methodology }}</textarea>
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
                <div class="margin-bottom">
                    <button class="btn btn-primary" type="submit">{{ trans('form.action_save') }}</button>
                    <div class="pull-right">
                        <button class="btn btn-default" type="reset">{{ trans('form.action_reset') }}</button>
                        <a role="button" class="btn btn-warning"
                           href="{{ $redirect_url }}">
                            {{ trans('form.action_cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection