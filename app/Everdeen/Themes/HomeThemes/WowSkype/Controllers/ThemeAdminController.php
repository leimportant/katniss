<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Tuan Linh
 * Date: 2016-12-13
 * Time: 17:27
 */

namespace Katniss\Everdeen\Themes\HomeThemes\WowSkype\Controllers;


use Illuminate\Support\Facades\Validator;
use Katniss\Everdeen\Http\Controllers\Admin\AdminController;
use Katniss\Everdeen\Http\Request;
use Katniss\Everdeen\Themes\Plugins\GoogleMapsMarkers\Repositories\MapMarkerRepository;
use Katniss\Everdeen\Utils\AppConfig;

class ThemeAdminController extends AdminController
{
    public function updateOptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_keywords' => 'sometimes|max:1000',
            'home_email' => 'sometimes|max:255',
            'home_hot_line' => 'sometimes|max:255',
            'ts_skype_id' => 'sometimes|max:255',
            'ts_skype_name' => 'sometimes|max:255',
            'ts_email' => 'sometimes|max:255',
            'ts_hot_line' => 'sometimes|max:255',
            'social_facebook' => 'sometimes|url',
            'social_facebook_sf' => 'sometimes|in:1',
            'social_facebook_sb' => 'sometimes|in:1',
            'social_twitter' => 'sometimes|url',
            'social_twitter_sf' => 'sometimes|in:1',
            'social_twitter_sb' => 'sometimes|in:1',
            'social_instagram' => 'sometimes|url',
            'social_instagram_sf' => 'sometimes|in:1',
            'social_instagram_sb' => 'sometimes|in:1',
            'social_gplus' => 'sometimes|url',
            'social_gplus_sf' => 'sometimes|in:1',
            'social_gplus_sb' => 'sometimes|in:1',
            'social_youtube' => 'sometimes|url',
            'social_youtube_sf' => 'sometimes|in:1',
            'social_youtube_sb' => 'sometimes|in:1',
            'social_skype' => 'sometimes|max:255',
            'social_skype_sf' => 'sometimes|in:1',
            'social_skype_sb' => 'sometimes|in:1',
            'knowledge_cover_image' => 'required|url',
            'knowledge_default_article_image' => 'required|url',
        ]);

        $rdrResponse = redirect(addExtraUrl('admin/themes/wow_skype/options', adminUrl('extra')));

        if ($validator->fails()) {
            return $rdrResponse->withErrors($validator);
        }

        $validateRequest = $this->validateMultipleLocaleInputs($request, [
            'home_name' => 'required|max:255',
            'home_description' => 'required|max:255',
        ]);

        if ($validateRequest->isFailed()) {
            return $rdrResponse->withErrors($validateRequest->getFailed());
        }

        $localizedData = $validateRequest->getLocalizedInputs();

        homeTheme()->options(array_merge([
            'site_keywords' => $request->input('site_keywords'),
            'home_email' => $request->input('home_email'),
            'home_hot_line' => $request->input('home_hot_line'),
            'ts_skype_id' => $request->input('ts_skype_id'),
            'ts_skype_name' => $request->input('ts_skype_name'),
            'ts_email' => $request->input('ts_email'),
            'ts_hot_line' => $request->input('ts_hot_line'),

            'social_facebook' => $request->input('social_facebook'),
            'social_facebook_sf' => $request->input('social_facebook_sf'),
            'social_facebook_sb' => $request->input('social_facebook_sb'),
            'social_twitter' => $request->input('social_twitter'),
            'social_twitter_sf' => $request->input('social_twitter_sf'),
            'social_twitter_sb' => $request->input('social_twitter_sb'),
            'social_instagram' => $request->input('social_instagram'),
            'social_instagram_sf' => $request->input('social_instagram_sf'),
            'social_instagram_sb' => $request->input('social_instagram_sb'),
            'social_gplus' => $request->input('social_gplus'),
            'social_gplus_sf' => $request->input('social_gplus_sf'),
            'social_gplus_sb' => $request->input('social_gplus_sb'),
            'social_youtube' => $request->input('social_youtube'),
            'social_youtube_sf' => $request->input('social_youtube_sf'),
            'social_youtube_sb' => $request->input('social_youtube_sb'),
            'social_skype' => $request->input('social_skype'),
            'social_skype_sf' => $request->input('social_skype_sf'),
            'social_skype_sb' => $request->input('social_skype_sb'),

            'knowledge_cover_image' => $request->input('knowledge_cover_image'),
            'knowledge_default_article_image' => $request->input('knowledge_default_article_image'),
        ], [AppConfig::KEY_LOCALE_INPUT => $localizedData]));

        return $rdrResponse;
    }

    public function options(Request $request)
    {
        $homeTheme = homeTheme();

        return $request->getTheme()->resolveExtraView(
            'home_themes.wow_skype.admin.options',
            trans('wow_skype_theme.page_options_title'),
            trans('wow_skype_theme.page_options_desc'),
            [
                'home_theme' => $homeTheme,
                'site_keywords' => $homeTheme->options('site_keywords', ''),
                'home_email' => $homeTheme->options('home_email', ''),
                'home_hot_line' => $homeTheme->options('home_hot_line', ''),
                'ts_skype_id' => $homeTheme->options('ts_skype_id', ''),
                'ts_skype_name' => $homeTheme->options('ts_skype_name', ''),
                'ts_email' => $homeTheme->options('ts_email', ''),
                'ts_hot_line' => $homeTheme->options('ts_hot_line', ''),
                'social_facebook' => $homeTheme->options('social_facebook', ''),
                'social_facebook_sf' => $homeTheme->options('social_facebook_sf', ''),
                'social_facebook_sb' => $homeTheme->options('social_facebook_sb', ''),
                'social_twitter' => $homeTheme->options('social_twitter', ''),
                'social_twitter_sf' => $homeTheme->options('social_twitter_sf', ''),
                'social_twitter_sb' => $homeTheme->options('social_twitter_sb', ''),
                'social_instagram' => $homeTheme->options('social_instagram', ''),
                'social_instagram_sf' => $homeTheme->options('social_instagram_sf', ''),
                'social_instagram_sb' => $homeTheme->options('social_instagram_sb', ''),
                'social_gplus' => $homeTheme->options('social_gplus', ''),
                'social_gplus_sf' => $homeTheme->options('social_gplus_sf', ''),
                'social_gplus_sb' => $homeTheme->options('social_gplus_sb', ''),
                'social_youtube' => $homeTheme->options('social_youtube', ''),
                'social_youtube_sf' => $homeTheme->options('social_youtube_sf', ''),
                'social_youtube_sb' => $homeTheme->options('social_youtube_sb', ''),
                'social_skype' => $homeTheme->options('social_skype', ''),
                'social_skype_sf' => $homeTheme->options('social_skype_sf', ''),
                'social_skype_sb' => $homeTheme->options('social_skype_sb', ''),
                'knowledge_cover_image' => $homeTheme->options('knowledge_cover_image', ''),
                'knowledge_default_article_image' => $homeTheme->options('knowledge_default_article_image', ''),
            ]
        );
    }
}