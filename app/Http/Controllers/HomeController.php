<?php

namespace App\Http\Controllers;

use App\Events\WebVisitors;
use App\Mail\SendEmail;
use App\Models\Style;
use App\Models\User;
use App\Models\Visitors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));

        $user_id = Auth::id();
        $styles = Style::select(
                'id',
                'title',
                'description',
                'media',
                'style_rate',
                'pays_count',
                'free_status',
                'created_at',
                'user_id'
            ) -> where('request_status', 1) -> with(['styleRating' => function($q){
                $q -> select('style_id', 'rating') -> where('user_id', Auth::id());
            }])-> with(['payStatus' => function($q){
                $q -> select('style_id', 'status') -> where('user_id', Auth::id());
            }]) -> OrderBy('created_at', 'desc') -> paginate(PAGINATION_COUNT); // return collection
            // return $styles;
        // return view('home', compact('styles'));
        return view('home') -> with([
            'styles' => $styles,
            'user_id' => $user_id
        ]);
    }

    public function getAboutWebsite (){
        return view('about_website');
    }

    public function getAboutDeveloper(){
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));
        
        $age = Carbon::parse('25-06-2001') -> diff(Carbon::now()) -> y;
        return view('about_developer', compact('age'));
    }

    public function getWallet(){
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));
        
        $user = User::find(Auth::id());
        return view('wallet', compact('user'));
    }

    public function getThemes(){
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));
        
        return view('themes');
    }
}