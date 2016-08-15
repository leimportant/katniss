<?php

namespace Katniss\Http\Controllers;

use Illuminate\Http\Request;

use Katniss\Http\Requests;
use Katniss\Models\Helpers\AppConfig;
use Katniss\Models\Helpers\AppOptionHelper;

class KatnissController extends Controller
{
    /**
     * @var boolean
     */
    public $isAuth;

    /**
     * @var \Katniss\Models\User
     */
    public $authUser;

    /**
     * @var string
     */
    public $localeCode;

    public function __construct(Request $request)
    {
        AppOptionHelper::load();

        $this->localeCode = currentLocaleCode();
        $this->isAuth = isAuth();
        $this->authUser = authUser();

        if ($this->isAuth) {
            $own_directory = $this->authUser->ownDirectory;
            config(['katniss.disks.' . $own_directory => [
                'driver' => 'local',
                'root' => storage_path('../public/upload/file_manager/users/' . $own_directory),
            ]]);
        }
    }

    protected function htmlInputs(Request $request)
    {
        $tmpHtmlInputs = $request->input(AppConfig::KEY_HTML_INPUTS, '');
        $htmlInputs = [];
        if (!empty($tmpHtmlInputs)) {
            $tmpHtmlInputs = explode(',', $tmpHtmlInputs);
            foreach ($tmpHtmlInputs as $tmpHtmlInput) {
                $tmpHtmlInput = explode('|', $tmpHtmlInput);
                $htmlInputs[$tmpHtmlInput[0]] = empty($tmpHtmlInput[1]) ? AppConfig::DEFAULT_HTML_CLEAN_SETTING : $tmpHtmlInput[1];
            }
        }
        return $htmlInputs;
    }
}
