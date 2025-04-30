<?php

namespace Citadel\Controllers;

use App\Http\Controllers\Controller;
use Citadel\Components\Control\Button;
use Citadel\Components\Form\TextInput;
use Citadel\Components\HeaderText;
use Citadel\Components\Layout\Card;
use Citadel\Components\Layout\Form;
use Citadel\Components\Page;
use Citadel\Events\FormSubmitEvent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, AuthorizesRequests, ValidatesRequests;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // return view('citadel-template::auth.login', [
        //     'page_title' => "Login"
        // ]);
        return Page::make('login-page', "Login")
            ->alt0()
            ->class("min-vh-100")
            ->schema([
                Form::make('login')
                    ->style('place-self: center')
                    ->class("col-12 col-md-5 py-5")
                    ->schema([
                        Card::make('container')
                            ->class('p-4 card smooth-shadow-md')
                            ->schema([
                                HeaderText::make("Login " . config('app.name'))
                                    ->class('text-center text-white'),
                                TextInput::make('email', "Username or Email")
                                    ->placeholder("Email address here"),
                                TextInput::make('password', "Password")
                                    ->placeholder("**********")
                                    ->password(),
                                Button::make('sign-in', "Sign In")
                                    ->color('primary')
                                    ->onClick(
                                        FormSubmitEvent::form('login')
                                            ->to(route('login'))
                                            ->default()
                                    )
                            ])
                    ])
            ])
            ->render();
    }
}
