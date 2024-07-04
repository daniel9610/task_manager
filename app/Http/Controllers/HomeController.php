<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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
    public function index(Request $request)
    {
        if($request->has('search')){
            $search = $request->search;
            $tasks = Task::where('user_id', auth()->id())
            ->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }else{
            $search = '';
            $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }
        return view('home', compact('tasks', 'search'));
    }
}
