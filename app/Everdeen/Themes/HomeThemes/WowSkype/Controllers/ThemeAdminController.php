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

class ThemeAdminController extends AdminController
{
    public function updateOptions(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'default_map_marker_id' => 'required|exists:map_markers,id',
//        ]);

        $rdrResponse = redirect(addExtraUrl('admin/themes/wow_skype/options', adminUrl('extra')));

//        if ($validator->fails()) {
//            return $rdrResponse->withErrors($validator);
//        }

//        $options = getOption('theme_example', []);
//        $options['default_map_marker_id'] = $request->input('default_map_marker_id');
//        setOption('theme_example', $options, 'theme:h:example');

        return $rdrResponse;
    }

    public function options(Request $request)
    {
        $options = getOption('theme_wow_skype', []);

        return $request->getTheme()->resolveExtraView(
            'home_themes.wow_skype.admin.options',
            trans('wow_skype_theme.page_options_title'),
            trans('wow_skype_theme.page_options_desc')
        );
    }
}