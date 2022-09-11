<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;


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

        $user_id=Auth::user()->id;

                    $records = DB::table('tasks')
                    ->select(
                            'tasks.id as id',
                            'tasks.title as title',
                            'tasks.description as description',
                            'tasks.status as status',
                            'tasks.type_of_task as  type_of_task',
                    
                    )
                    ->where('tasks.user_id',$user_id)
                    ->orderBy('tasks.created_at','desc')->paginate(5);


        return view('home')->with('records',$records);
    }
}
