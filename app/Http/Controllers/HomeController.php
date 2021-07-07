<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user=DB::table('users')
            ->where('email','=',$request->session()->get('email'))
            ->value('id');
        $questions=DB::table('questions')
                ->where('userId','=',$user)
                ->select('title','id','userId')
                ->get()
                ->toArray();
        
        return view('home')->with('questions',$questions);
    }
}
