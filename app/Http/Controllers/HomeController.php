<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\RedirectHome;

class HomeController extends Controller
{
    use RedirectHome;
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
    public function index(Request $request)
    {
        $data = $this->redirectToHome($request);
        $tasks = $data['tasks'];
        $search = $data['search'];
        if(auth()->user()->role == 'admin'){
            $users = User::where('name', '!=', null)->paginate(5);
            return view('home', compact('tasks', 'search', 'users'));
        }
        return view('home', compact('tasks', 'search'));
    }
}
