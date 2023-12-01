<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    private UserService $userService;

    /**
     * @param UserService $userService
     *
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login() : View
    {
        return view('user.login', [
            'title' => 'login'
        ]);

    }

    public function doLogin(Request $request) : Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if(empty($user) || empty($password))
        {
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'User Or Password Is Requered'
            ]);

        }

        if($this->userService->login($user, $password))
        {
            $request->session()->put("user", $user);
            return redirect("/");
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User Or Password Is Wrong'
        ]);

    }

    public function logOut(Request $request) : RedirectResponse
    {
        $request->session()->forget('user');
        return redirect("/");
    }
}
