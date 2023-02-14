<?php

namespace App\Http\Controllers\Styles;

use App\Events\WebVisitors;
use App\Http\Controllers\Controller;
use App\Http\Requests\StyleRequest;
use App\Models\PayStatus;
use Illuminate\Http\Request;
use App\Models\Style;
use App\Models\StyleRating;
use App\Models\User;
use App\Models\Visitors;
use App\Traits\StyleTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App;

class StyleController extends Controller
{
    use StyleTrait;
    
    public function showStyle($style_id){
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));
        
        $user_id = Auth::id();
        // $style = Style::find($style_id);
        $style = Style::select('*') -> where([
            'id' => $style_id,
            'request_status' => 1
        ]) -> with(['styleRating' => function($q){
            $q -> select('style_id', 'rating') -> where('user_id', Auth::id());
        }]) -> with(['payStatus' => function($q){
            $q -> select('style_id', 'status') -> where('user_id', Auth::id());
        }]) -> get();
        
        if ($style -> count() == 0) {
            return redirect('/home');
        }
        else {
            if ($style[0] -> free_status == 0 || $style[0] -> styleRating -> count() > 0) {
                $stylePayStatus = true;
                return view('styles.show_style') -> with([
                    'style' => $style,
                    'user_id' => $user_id,
                    'stylePayStatus' => $stylePayStatus
                ]);;
            }
            else {
                $stylePayStatus = false;
                return view('styles.show_style') -> with([
                    'style' => $style,
                    'user_id' => $user_id,
                    'stylePayStatus' => $stylePayStatus
                ]);;
            }
        }
    }

    public function getCreateStylePage(){
        $visitors = Visitors::first();
        event(new WebVisitors($visitors));
        
        return view('styles.create_style');
    }

    public function createStyle(StyleRequest $request){
        $file_name = $this->saveImage($request -> file('image'), 'images/uploads/styles');
        $style = Style::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'media' => $file_name,
            'html_code' => $request -> html_code,
            'css_code' => $request -> css_code,
            'js_code' => $request -> js_code,
            'user_id' => Auth::id(),
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

    public function rateStyle(Request $request){
        $checkIfRate = StyleRating::select([
            'id',
            'rating',
        ]) -> where([
            ['user_id', Auth::id()],
            ['style_id', $request -> style_id]
        ]) -> get();
        $mainStyleUpdateRate = Style::find($request -> style_id);
            
        if (count($checkIfRate) > 0){
            // If User Rated This Style Before
            $update_rate = StyleRating::where('user_id', Auth::id()) -> where('style_id', $request -> style_id) -> first();
            $update_rate -> rating = $request -> style_rate;
            $update_rate -> save();

            $previousRate = (($mainStyleUpdateRate -> style_rate * 2) - ($checkIfRate[0]['rating'] / 2));
            $finalRate = ($previousRate + ($request -> style_rate / 2)) / 2;
            $mainStyleUpdateRate -> style_rate = $finalRate;
            $mainStyleUpdateRate -> save();

            return response()->json([
                'status' => true,
                'msg' => 'Rate Updated',
            ]);
        }

        // If User Didn't Rated This Style Before
        $rateStyle = StyleRating::create([
            'style_id' => $request -> style_id,
            'user_id' => Auth::id(),
            'rating' => $request -> style_rate
        ]);

        if(!$rateStyle){
            return response()->json([
                'status' => false,
                'msg' => 'Something Wrong',
            ]);
        }
        $finalRate = (($request -> style_rate / 2) + $mainStyleUpdateRate -> style_rate) / 2;
        $mainStyleUpdateRate -> style_rate = $finalRate;
        $mainStyleUpdateRate -> save();
        return response()->json([
            'status' => true,
            'msg' => 'Rating',
        ]);
    }

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
                }]) -> OrderBy('created_at', 'desc') -> get(); // return collection
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
                }]) -> OrderBy('style_rate', 'desc') -> paginate(PAGINATION_COUNT); // return collection
            }
            $total_resutls = $styles -> count();

            if ($total_resutls > 0){
                $output = '';
                // $paginate = '';
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
                                    <div class="flip-card hvr-grow-shadow">
                                        <div class="face front front-' . $style -> id . '">
                                            <a href="' . route("show.style", $style -> id) . '" style="text-decoration: none;">
                                                <div class="card text-center">
                                                    <img src="' . asset("images/uploads/styles") . "/" . $style -> media . '" class="card-img-top" alt="' . $style -> title . ' Image...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">' . $style -> title . '</h5>
                                                        <div class="btn btn-info show-details-btn d-flex justify-content-center align-items-center" style-id="' . $style->id . '"><i class="fa fa-info"></i></div>
                                                        ' . (($checkAuth && $style -> payStatus -> count() === 0 && $style -> free_status === 1 && $style -> user_id != $user_id) ? '<a href="#" style-id="' . $style -> id . '" class="buy-style-' . $style -> id . ' buy-style btn btn-secondary">' . __("pages/home.Buy 0.99$") . '</a>' : false) . '
                                                        ' . (($style -> free_status === 0) ? '<div class="btn btn-secondary">' . __("pages/home.Free") . '</div>' : false) . '
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        <h3>' . __("pages/home.Total Rates:") . $style -> style_rate . '</h3>
                                                    </div>
                                                    ' . (($checkAuth) ? '<!-- Button trigger modal for rating --><button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#ratingModal' . $style -> id . '">' . __("pages/home.Rate") . ' <i class="fa fa-star" style="color: rgb(255, 174, 0);"></i></button>' : false) . '
                                                </div>
                                            </a>
                                        </div>
                                        <div class="face back back-' . $style -> id . '">
                                            <div class="card text-center" style="width: 100%; height:100%">
                                                <div class="card-header">
                                                    <div class="hide-details-btn" style-id="' . $style -> id . '"><i class="fa fa-times-circle-o"></i></div>
                                                    <h5 class="lead details-t">' . __("pages/home.Details:") . ' </h5>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <span class="title">' . __("pages/home.Title:") . ' <span class="inner-title">' . $style -> title . '</span></span>
                                                    </h5>
                                                    <div class="card-text">
                                                        <div class="lead description-t">' . __("pages/home.Description:") . ' </div>
                                                        <span class="description">
                                                            ' . Str::words($style -> description, 30, ' <a href="' . route("show.style", $style -> id) . '">' . __("pages/home.Read More...") . '</a>') . '
                                                        </span>
                                                    </div>
                                                    ' . (($checkAuth) ? ($style -> user_id == $user_id ? ('<h3 class="lead card-text text-muted m-3">' . __("pages/home.Posted By You") . '</h3>') : ($style -> user_id == 0 ? '<h3 class="lead card-text text-muted m-3">' . __("pages/home.Posted By Admin") . ' </h3>' : false)) : false) . '
                                                    ' . (($checkAuth) ? (($style -> payStatus -> count() === 0 && $style -> free_status === 1 && $style -> user_id != $user_id) ? ('<a href="#" style-id="' . $style -> id . '" class="buy-style-' . $style->id . ' buy-style btn btn-secondary">' . __("pages/home.Buy 0.99$") . '</a>') : false) : false) . '
                                                    ' . (($style -> free_status === 0) ? ('<div class="btn btn-secondary">' . __("pages/home.Free") . '</div>') : false) . '
                                                    ' . (($style -> pays_count > 0) ? ('<p class="card-text mb-1">' . $style -> pays_count . __("pages/home. Bought This Style") . '</p>') : false) . '
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <span class="footer-titles">' . __("pages/home.Posted At:") . '</span> ' . $style -> created_at . '
                                                    <h4><span class="footer-titles">'. __("pages/home.Total Rates:") . '</span> ' . $style -> style_rate . '</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Rating Modal -->
                                    <div class="modal fade" id="ratingModal' . $style->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">' . __("pages/home.Rate This Style") . '</h5>
                                                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="rate-container">
                                                        <h2>' . __("pages/home.Total Rates:") . $style -> style_rate . '</h2>
                                                        <div class="skills">
                                                            <h3 class="name text-center">' . __("pages/home.Your Rate:") .
                                                            ($style -> styleRating -> count() > 0 ? $styleFinalRate : false) . '
                                                            </h3>
                                                            <div class="rating ' . (App::isLocale("ar") ? "rating-ar" : "rating-en") . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="10" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="9" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="8" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="7" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="6" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="5" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="4" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="3" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="2" class="style-rate" style-id="' . $style -> id . '">
                                                                <input type="radio" name="style_rate_' . $style -> id . '" value="1" class="style-rate" style-id="' . $style -> id . '">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                }
                // $paginate = ' ' . $styles -> links() . ' ';
                // dd($styles -> links());
                // return $styles -> links();
            }
            else {
                $output = '<div class="alert alert-secondary text-center no-data-msg">No Data Found!!</div>';
            }
            $data = array([
                'styles_data' => $output,
                'total_results' => $total_resutls,
                'show_message' => $showMessage,
                // 'paginate' => $paginate,
            ]);
            echo json_encode($data);
        }
    }

    // public function buyStyle($style_id){
    //     // return $style_id;
    //     dd($style_id);
    //     // $buy_style = PayStatus::create([
    //     //     'style_id' => $style_id,
    //     //     'user_id' => Auth::id(),
    //     //     'status' => '1'
    //     // ]);

    //     // if($buy_style){
    //     //     return true;
    //     // }
    // }
    public function buyStyle(Request $request){
        $update_style = Style::find($request -> id);
        $update_wallet = User::find($update_style -> user_id);
        $update_wallet -> wallet += 0.49;
        $update_wallet -> save();
        $update_style -> pays_count += 1;
        $update_style -> save();
        $buy_style = PayStatus::create([
            'style_id' => $request -> id,
            'user_id' => Auth::id(),
            'status' => '1'
        ]);
        if(!$buy_style || !$update_style)
            return response()->json([
                'status' => false,
                'msg' => 'Something Wrong!!',
            ]);
        return response()->json([
            'status' => true,
            'msg' => 'Paied Successfuly!!'
        ]);
    }
}
