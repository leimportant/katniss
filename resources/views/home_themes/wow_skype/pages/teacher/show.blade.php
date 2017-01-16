@extends('home_themes.wow_skype.master.master')
@section('lib_styles')
    <link rel="stylesheet" href="{{ libraryAsset('fancybox/jquery.fancybox.css') }}">
@endsection
@section('lib_scripts')
    <script src="{{ libraryAsset('fancybox/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ libraryAsset('fancybox/helpers/jquery.fancybox-media.js') }}"></script>
@endsection
@section('extended_scripts')
    <script>
        $(function() {
            $('a.teacher-video').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',
                helpers: {
                    overlay: {
                        locked: false
                    },
                    media : {}
                }
            });
        });
    </script>
@endsection
@section('main_content')
    <div id="page-teacher">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <img class="width-120 thumbnail padding-none border-master border-2x margin-bottom-15"
                             src="{{ $teacher->userProfile->url_avatar_thumb }}"
                             alt="{{ $teacher->userProfile->display_name }}">
                    </div>
                    <div class="col-md-9">
                        <h4 class="margin-top-none margin-bottom-5 color-master uppercase">
                            <strong>{{ $teacher->userProfile->display_name }}</strong>
                        </h4>
                        <div class="color-slave">
                            {{ allCountry($teacher->userProfile->nationality, 'name') }}
                        </div>
                        <div class="master-slave-bar margin-bottom-10 margin-top-5 width-150 clearfix">
                            <div class="bar pull-left"></div>
                            <div class="bar pull-right"></div>
                        </div>
                        @if($has_rates)
                            <div class="color-star biggest bold-600">
                                <span>{{ toFormattedNumber($average_rate) }}</span>
                            </div>
                            <div class="color-star">
                                <?php $star_split = intval($average_rate) != $average_rate; ?>
                                @if($star_split)
                                    @for($i = 1; $i <= intval($average_rate); ++$i)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                        <i class="fa fa-star-half-o"></i>
                                    @for($i = intval($average_rate) + 2; $i <= $max_rate; ++$i)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @else
                                    @for($i = 1; $i <= $max_rate; ++$i)
                                        <i class="fa {{ $i <= $average_rate ? 'fa-star' : 'fa-star-o' }}"></i>
                                    @endfor
                                @endif
                            </div>
                        @endif
                        <p>
                            @if(!empty($teacher->video_teaching_url))
                                <a target="_blank" role="button" class="btn btn-primary teacher-video margin-top-10" href="{{ $teacher->video_teaching_url }}">
                                    <i class="fa fa-play-circle"></i> {{ trans('label.teaching_video') }}
                                </a>
                                &nbsp;
                            @endif
                            @if(!empty($teacher->video_introduce_url))
                                <a target="_blank" role="button" class="btn btn-primary teacher-video margin-top-10" href="{{ $teacher->video_introduce_url }}">
                                    <i class="fa fa-play-circle"></i> {{ trans('label.self_introduction_video') }}
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
                <hr class="border-master">
                <div class="row">
                    <div class="col-md-3">
                        <label class="color-master">{{ trans('label.about_me') }}</label>
                    </div>
                    <div class="col-md-9">
                        <p>
                            {{ trans('label.gender_' . $teacher->userProfile->gender) }},
                            {{ $teacher->userProfile->age }} {{ trans_choice('label.year_old', $teacher->userProfile->age) }}.
                        </p>
                        <p>
                            {{ trans('label.living_in') }}
                            {{ $teacher->userProfile->city }}, {{ allCountry($teacher->userProfile->settings->country, 'name') }}.
                        </p>
                    </div>
                </div>
                <hr class="margin-top-10 border-master">
                <div class="row">
                    <div class="col-md-3">
                        <label class="color-master">{{ trans('label.self_introduction') }}</label>
                    </div>
                    <div class="col-md-9">
                        {!! $teacher->html_about_me !!}
                    </div>
                </div>
                <hr class="margin-top-10 border-master">
                <div class="row">
                    <div class="col-md-3">
                        <label class="color-master">{{ trans_choice('label.topic', 2) }}</label>
                    </div>
                    <div class="col-md-9">
                        @foreach($teacher->topics as $topic)
                            <span class="sausage-item sausage-item-primary"><strong>{{ $topic->name }}</strong></span>
                        @endforeach
                    </div>
                </div>
                <hr class="margin-top-10 border-master">
                <div class="row">
                    <div class="col-md-3">
                        <label class="color-master">{{ trans('label.teaching_experience') }}</label>
                    </div>
                    <div class="col-md-9">
                        {!! $teacher->html_experience !!}
                    </div>
                </div>
                <hr class="margin-top-10 border-master">
                <div class="row">
                    <div class="col-md-3">
                        <label class="color-master">{{ trans('label.teaching_methodology') }}</label>
                    </div>
                    <div class="col-md-9">
                        {!! $teacher->html_methodology !!}
                    </div>
                </div>
                @if($teacher->userProfile->educations->count() > 0)
                    <hr class="margin-top-10 border-master">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="color-master">{{ trans('label.education_history') }}</label>
                        </div>
                        <div class="col-md-9">
                            <div class="media-list">
                                @foreach($teacher->userProfile->educations as $education)
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="big text-success"><strong>{{ $education->field }}</strong></div>
                                            <div class="color-darker bold-700">
                                                <span class="color-lighter">{{ trans('label.at_lc') }}</span> {{ $education->school }}
                                                {!! $education->renderDuration('<span class="color-lighter">' . trans('label.from_lc') . '</span>', '<span class="color-lighter">' . trans('label.to_lc') . '</span>') !!}
                                            </div>
                                            @if(!empty($education->description))
                                                <div class="margin-top-5">{{ $education->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if($teacher->userProfile->works->count() > 0)
                    <hr class="border-master">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="color-master">{{ trans('label.work_history') }}</label>
                        </div>
                        <div class="col-md-9">
                            <div class="media-list">
                                @foreach($teacher->userProfile->works as $work)
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="big text-success"><strong>{{ $work->position }}</strong></div>
                                            <div class="color-darker bold-700">
                                                <span class="color-lighter">{{ trans('label.at_lc') }}</span> {{ $work->company }}
                                                {!! $work->renderDuration('<span class="color-lighter">' . trans('label.from_lc') . '</span>', '<span class="color-lighter">' . trans('label.to_lc') . '</span>') !!}
                                            </div>
                                            @if(!empty($work->description))
                                                <div class="margin-top-5">{{ $work->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if($has_rates)
                    <hr class="border-master">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box-120 biggest box-circle bg-master box-center align-center color-white bold-700">
                                <span class="margin-top--10">{{ toFormattedNumber($average_rate) }}</span>
                            </div>
                            <p class="margin-top-10 text-center color-slave bold-700 big">
                                {{ trans('label.rate_by') }}
                                <span class="no-wrap">{{ $count_rating_students }} {{ trans_choice('label.student_lc', $count_rating_students) }}</span>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <div class="row padding-top-15 padding-bottom-15">
                                @foreach($rates_for_teacher as $name => $rate)
                                    <div class="col-xs-4">
                                        <p>
                                            <label class="label bg-star">{{ toFormattedNumber($rate) }}</label>
                                            <span class="color-master margin-top-5 bold-600">{{ trans('label.teacher_' . $name . '_rate') }}</span>
                                        </p>
                                        <p class="color-star">
                                            <?php $star_split = intval($rate) != $rate; ?>
                                            @if($star_split)
                                                @for($i = 1; $i <= intval($rate); ++$i)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                <i class="fa fa-star-half-o"></i>
                                                @for($i = intval($rate) + 2; $i <= $max_rate; ++$i)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                            @else
                                                @for($i = 1; $i <= $max_rate; ++$i)
                                                    <i class="fa {{ $i <= $rate ? 'fa-star' : 'fa-star-o' }}"></i>
                                                @endfor
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div>
                            <i class="fa fa-user"></i> &nbsp;
                            @if($teacher->teaching_status == \Katniss\Everdeen\Models\Teacher::TEACHING_STATUS_AVAILABLE)
                                <strong class="color-slave">{{ trans('label.status_teaching_available') }}</strong><br>
                            @elseif($teacher->teaching_status == \Katniss\Everdeen\Models\Teacher::TEACHING_STATUS_FULL_SCHEDULE)
                                <strong class="text-danger">{{ trans('label.status_full_schedule') }}</strong><br>
                            @endif
                        </div>
                        @if(!$is_auth)
                            <a role="button" class="btn btn-primary btn-block uppercase bold-700 margin-top-10"
                               href="{{ homeUrl('student/sign-up') }}?teacher_id={{ $teacher->user_id }}">
                                {{ trans('form.action_register_class') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="margin-top-none margin-bottom-15">{{ trans('label.need_help') }}</h4>
                        <p>Skype: <a href="skype:{{ $skype_id }}?chat" class="greenColor">{{ $skype_id }} ({{ $skype_name }})</a></p>
                        <p>Hotline: <a>{{ $hot_line }}</a></p>
                        <p class="margin-bottom-none">Email: <a href="mail:{{ $email }}" class="greenColor">{{ $email }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection