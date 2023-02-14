<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StyleRequest;
use App\Models\PayStatus;
use App\Models\Style;
use App\Models\StyleRating;
use App\Models\User;
use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\StyleTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use StyleTrait;

    public function __construct()
    {
        $this->middleware('auth:admin') -> except(['getLogin', 'adminLogin']);
        // $this->middleware('auth:admin');
    }

    public function getDashboard(){
        $countVisitors = Visitors::select('total_visitors') -> get();
        $countUsers = User::select('id') -> count();
        $countStyles = Style::select('id') -> count();
        $countRequests = Style::select('id') -> where('request_status', 0) -> count();
        $countPays = PayStatus::select('id') -> count();

        return view('admin.admin_dashboard') -> with([
            'countVisitors' => $countVisitors,
            'countUsers' => $countUsers,
            'countStyles' => $countStyles,
            'countRequests' => $countRequests,
            'countPays' => $countPays
        ]);
    }

    public function getRequests(){
        $styles = Style::select(
            'id',
            'title',
            'description',
            'html_code',
            'css_code',
            'js_code',
            'media',
            'created_at',
            'request_status',
        ) -> where('request_status', 0) ->paginate(PAGINATION_COUNT);
        return view('admin.admin_requests', compact('styles'));
    }

    public function getAllStyles(){
        $styles = Style::select(
            'id',
            'title',
            'description',
            'html_code',
            'css_code',
            'js_code',
            'media',
            'pays_count',
            'style_rate',
            'created_at',
            'request_status',
        ) -> where('request_status', 1) -> OrderBy('created_at', 'desc') -> paginate(PAGINATION_COUNT);
        return view('admin.admin_show_all', compact('styles'));
    }

    // public function searchStyles(Request $request){
    //     $request -> validate([
    //         'search' => 'required'
    //     ]);
    //     $styles = Style::select(
    //         'id',
    //         'title',
    //         'description',
    //         'media',
    //         'style_rate',
    //         'created_at'
    //     ) -> where('title', 'like', "%" . $request -> search . "%") ->OrderBy('created_at', 'desc') -> paginate(PAGINATION_COUNT);
    //     return view('admin.admin_show_all', compact('styles'));
    // }

    public function searchStyles(Request $request) {
        $showMessage = true;
        $checkAuth = false;
        if (Auth::check()){
            $checkAuth = true;
        }
        $user_id = Auth::id();
        if($request -> ajax()) {
            $query = $request -> search;
            if($query != ''){
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
                ) -> where('request_status', 1) -> where('title', 'LIKE', '%' . $query . '%') -> with(['styleRating' => function($q){
                    $q -> select('style_id', 'rating') -> where('user_id', Auth::id());
                }])-> with(['payStatus' => function($q){
                    $q -> select('style_id', 'status') -> where('user_id', Auth::id());
                }]) -> OrderBy('created_at', 'desc') -> get();
            }
            else {
                $showMessage = false;
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
                }]) -> with(['payStatus' => function($q){
                    $q -> select('style_id', 'status') -> where('user_id', Auth::id());
                }]) -> OrderBy('style_rate', 'desc') -> paginate(PAGINATION_COUNT);
            }
            $total_resutls = $styles -> count();

            if ($total_resutls > 0){
                $output = '';
                foreach($styles as $style){
                    $styleFinalRate = '';
                    if($style -> styleRating -> count() > 0){
                        foreach ($style -> styleRating as $ratio) {
                            $styleFinalRate = '<span id="your-rate-' . $style -> id . '">' . $ratio -> rating / 2 . '</span>';
                        }
                    }
                    else {
                        $styleFinalRate = '<span id="your-rate-' . $style -> id . '">' . __("pages/home.Not Rated Yet!!") . '</span>';
                    }
                    $output .= '<div class="col-lg-4 col-md-6 my-3">
                                    <div class="flip-card">
                                        <a href="' . route('admin.show.style', $style -> id) . '" style="text-decoration: none;">
                                            <div class="face front front-' . $style->id . '">
                                                <div class="card text-center">
                                                    <img src="' . asset('images/uploads/styles') . '/' . $style -> media . '" class="card-img-top img-thumbnail" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">' . $style -> title . '</h5>
                                                        <div class="btn btn-info show-details-btn d-flex justify-content-center align-items-center" style-id="' . $style -> id . '"><i class="fa fa-info"></i></div>
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        <h3>Total Ratings: ' . $style -> style_rate . '</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="face back back-' . $style -> id . '">
                                            <div class="card text-center" style="width: 100%; height:100%">
                                                <div class="card-header">
                                                    <div class="btn btn-danger hide-details-btn d-flex justify-content-center align-items-center" style-id="' . $style -> id . '"><i class="fa fa-times-circle-o"></i></div>
                                                    <h5 class="lead details-t">Details: </h5>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <span class="title">Title: <span class="inner-title">' . $style -> title . '</span></span>
                                                    </h5>
                                                    <div class="card-text">
                                                        <div class="lead description-t">Description: </div>
                                                        <span class="description">
                                                            ' . Str::words($style -> description, 20, ' <a href="' . route("admin.show.style", $style -> id) . '">Read More...</a>') . '
                                                        </span>
                                                    </div>' .
                                                    ($style -> user_id == 0 ? '<h3 class="lead card-text text-muted mt-3">Posted By You</h3>' : false) .
                                                    ($style -> pays_count > 0 ? '<p class="card-text mb-1">' . $style -> pays_count . 'Bought This Style</p>' : false) . '
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <span class="footer-titles">Posted At:</span> ' . $style -> created_at . '
                                                    <h3><span class="footer-titles">Total Rates:</span> ' . $style -> style_rate . '</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                }
            }
            else {
                $output = '<div class="alert alert-secondary text-center no-data-msg">No Data Found!!</div>';
            }
            $data = array([
                'styles_data' => $output,
                'total_results' => $total_resutls,
                'show_message' => $showMessage,
            ]);
            echo json_encode($data);
        }
    }

    public function getLogin(){
        return view('admin.admin_login');
    }

    public function adminLogin(Request $request){
        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(Auth::guard('admin') -> attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->intended(route('admin.dashboard'));
            // return 'success';
        }
        return back()->withInput($request->only('email'));
        // return 'failed';
    }
    
    public function showStyle($style_id){
        $style = Style::find($style_id);  // search in given table id only
        if (!$style)
            return redirect()->back();
        
        return view('admin.admin_show_style', compact('style'));
    }

    public function acceptStyle(Request $request){
        $style = Style::find($request -> style_id);

        if(!$style)
            return response()->json([
                'status' => false,
                'msg' => 'Style Not Found!!',
            ]);

        // $style -> update('request_status', 1);
        $style -> request_status = 1;
        // dd($request -> is_free);
        // return response($request -> is_free);
        if($request -> is_free == 0)
            $style -> free_status = 0;
            // return 0;
        // return 1;
        $style -> save();
        return response()->json([
            'status' => true,
            'msg' => 'Accepted Successfuly!!',
        ]);
    }

    public function deleteStyle(Request $request){
        $style = Style::find($request -> style_id);
        $imagePath = public_path('images/uploads/styles/' . $style -> media);
        if($request -> exist == true){
            $relatedFromStyleRating = StyleRating::where('style_id', $request -> style_id)->delete();
            $relatedFromPayStatus = PayStatus::where('style_id', $request -> style_id)->delete();
        }
        if(!$style)
            return response()->json([
                'status' => false,
                'msg' => 'Style Not Found!!',
            ]);
            
        if(File::exists($imagePath)){
            File::delete($imagePath);
        }

        $style -> delete();
        return response()->json([
            'status' => true,
            'msg' => 'Accepted Successfuly!!',
        ]);
    }

    public function getCreateStyle(){
        return view('admin.admin_create_style');
    }

    public function createStyle(StyleRequest $request){
        $file_name = $this->saveImage($request -> file('image'), 'images/uploads/styles');
        $style = Style::create([
            'title' => $request -> title,
            'description' => $request -> content,
            'media' => $file_name,
            'html_code' => $request -> html_code,
            'css_code' => $request -> css_code,
            'js_code' => $request -> js_code,
            'request_status' => 1,
            'user_id' => 0,
        ]);

        if($style)
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully',
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'Save Failed',
            ]);
    }
}