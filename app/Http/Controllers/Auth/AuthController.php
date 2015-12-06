<?php

namespace Katniss\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Katniss\Models\User;
use Katniss\Http\Controllers\ViewController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Katniss\Models\UserRole;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends ViewController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath;
    protected $loginPath;
    protected $redirectAfterLogout;
    protected $socialRegisterPath;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->redirectPath = homePath('auth/inactive');
        $this->loginPath = homePath('auth/login');
        $this->redirectAfterLogout = homePath();
        $this->socialRegisterPath = homePath('auth/register/social');

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        $this->theme->title(trans('pages.admin_login_title'));
        $this->theme->description(trans('pages.admin_login_desc'));

        return view($this->themePage('auth.login'));
    }

    protected function authenticated(Request $request, User $user)
    {
        return redirect(homeUrl('auth/inactive'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getRegister(Request $request)
    {
        $this->theme->title(trans('pages.page_register_title'));

        return view($this->themePage('auth.register'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $stored_user = $this->create($request->all());
        if ($stored_user) {
            Auth::login($stored_user);
        } else {
            return redirect(homeUrl('auth/register'))
                ->withInput()
                ->withErrors([trans('auth.register_failed_system_error')]);
        }

        return redirect($this->redirectPath);
    }

    public function redirectToProvider(Request $request, $provider)
    {
        if (!config('services.' . $provider)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        if (!config('services.' . $provider)) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $ex) {
            return redirect($this->loginPath)
                ->withErrors([trans('auth.social_failed_get')]);
        }

        if ($authUser = User::fromSocial($socialUser->email, $provider, $socialUser->id)->first()) {
            Auth::login($authUser);
            return redirect($this->redirectPath);
        }

        return redirect(homeUrl('auth/register/social'))
            ->withInput([
                'provider' => $provider,
                'provider_id' => $socialUser->id,
                'url_avatar' => $socialUser->avatar,
                'name' => $socialUser->name,
                'email' => $socialUser->email,
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getSocialRegister(Request $request)
    {
        $selected_roles = $request->has('selected_roles') ? explode(',', $request->input('selected_roles')) : ['teacher'];

        $this->theme->title(trans('pages.page_register_title'));

        return view($this->themePage('auth.register_social'), [
            'selected_roles' => $selected_roles,
            'public_roles' => Role::where('public', true)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSocialRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        $error_rdr = redirect(homeUrl('auth/register/social'))->withInput();

        if ($validator->fails()) {
            $error_rdr->withErrors($validator);
        }

        $stored_user = $this->create($request->all(), true);
        if ($stored_user) {
            Auth::login($stored_user);
        } else {
            return $error_rdr->withErrors([trans('auth.register_failed_system_error')]);
        }

        return redirect($this->redirectPath);
    }

    public function getInactive(Request $request)
    {
        if ($this->auth_user->active) {
            return redirect(redirectUrlAfterLogin($this->auth_user));
        }
        return view($this->themePage('auth.inactive'), ['resend' => false]);
    }

    public function postInactive()
    {
        $data = array();
        $data['id'] = $this->auth_user->id;
        $data['name'] = $this->auth_user->name;
        $data['email'] = $this->auth_user->email;
        $data['password'] = '******';
        $data['activation_code'] = $this->auth_user->activation_code;

        return view($this->themePage('auth.inactive'), ['resend' => true]);
    }

    public function getActivation($id, $activation_code)
    {
        $user = User::findOrFail($id);
        $active = $user->activation_code == $activation_code;
        if ($active) {
            $user->active = true;
            $user->save();
        }

        return view($this->themePage('auth.activate'), [
            'active' => $active,
            'url' => homeUrl('auth/login'),
            'name' => trans('pages.page_login_title')
        ]);
    }
}
