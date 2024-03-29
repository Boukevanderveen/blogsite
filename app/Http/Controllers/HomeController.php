<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Project;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home', ['dataDisplay' => 'none']);
    }

    public function adminIndex()
    {
        $user = auth::User();
        if( $user->isAdmin)
        {
            return view('admin.index');
        }
        else
        {
            abort(403);

        }
    }
}
