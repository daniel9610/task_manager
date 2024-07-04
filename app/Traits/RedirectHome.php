<?php
namespace App\Traits;

use App\Models\Task;
use Illuminate\Http\Request;

trait RedirectHome {
    public function redirectToHome(Request $request)
    {
        if($request->has('search')){
            $search = $request->search;
            $tasks = Task::where('user_id', auth()->id())
            ->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }else{
            $search = '';
            $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }

        $data = [
            'tasks' => $tasks,
            'search' => $search,
        ];
        return $data;
    }
}