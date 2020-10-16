<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;
use App\Models\Adult;

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
        $user = Auth::user();
        $user_children = $user->children;
        //dd($user_children);

        if($user_children->count() !== 0 ){
            $ids = array();
            foreach($user_children as $user_child){
                array_push($ids, $user_child->id);
            }

            $user_children = Child::with('adults', 'group')->whereIn('id', $ids)->get();

            $account_holder_id = Child::find($ids[0])->getAccountHolder($ids[0])->id;
            $account_holder = Adult::with('account')->where('id', $account_holder_id)->get();

            return view('home')
                ->with('children', $user_children)
                ->with('account_holder', $account_holder);
        }else{

            return view('home');

        }
    }


}
