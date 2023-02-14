@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/styles/show_style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 align-self-center">
                <img src="{{ asset('images/uploads/styles') . '/' . $style[0] -> media }}" class="rounded img-thumbnail" alt="Style {{ $style[0] -> id }}">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $style[0] -> title }}</h5>
                        <p class="card-text">{{ $style[0] -> description }}</p>
                        @if ($style[0] -> user_id == $user_id)
                            <h3 class="lead card-text mb-3">{{ __('pages/home.Posted By You') }}</h3>
                        @elseif($style[0] -> user_id == 0)
                            <h3 class="lead card-text mb-3">{{ __('pages/home.Posted By Admin') }}</h3>
                        @endif
                        @if ($style[0] -> payStatus -> count() === 0 && $style[0] -> free_status === 1)
                            <a href="#" id="buy-style" style-id="{{$style[0] -> id}}" class="btn btn-secondary">{{ __('pages/home.Buy 0.99$') }}</a>
                        @endif
                        @if($style[0] -> free_status === 0)
                            <div class="btn btn-secondary">{{ __('pages/home.Free') }}</div>
                        @endif
                        @if($style[0] -> pays_count > 0)
                            <p class="card-text mb-1">{{ $style[0] -> pays_count . __('pages/home. Bought This Style') }}</p>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        {{ __('pages/home.Posted At:') }} {{ $style[0] -> created_at }}
                        <h3>{{ __('pages/home.Total Rates:') }} {{$style[0] -> style_rate}}</h3>
                    </div>

                    <!-- Button trigger modal for rating -->
                    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#ratingModal{{$style[0]->id}}">
                        {{ __('pages/home.Rate') }} <i class="fa fa-star" style="color: rgb(255, 174, 0);"></i>
                    </button>
                    <!-- Rating Modal -->
                    <div class="modal fade" id="ratingModal{{$style[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('pages/home.Rate This Style') }}</h5>
                                    <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </div>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="rate-container">
                                        <h2 class="total-ratings">{{ __('pages/home.Total Rates:') }} {{$style[0] -> style_rate}}</h2>
                                        <div class="skills">
                                            <h3 class="name">{{ __('pages/home.Your Rate:') }}
                                                @forelse ($style[0] -> styleRating as $ratio)
                                                    <span id="your-rate-{{$style[0] -> id}}">{{ $ratio -> rating / 2}}</span>
                                                @empty
                                                {{ __('pages/home.Not Rated Yet!!') }}
                                                @endforelse
                                            </h3>
                                            <div class="rating {{(App::isLocale('ar') ? 'rating-ar' : 'rating-en')}}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="10" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="9" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="8" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="7" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="6" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="5" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="4" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="3" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="2" class="style-rate" style-id="{{ $style[0] -> id }}">
                                                <input type="radio" name="style_rate_{{$style[0] -> id}}" value="1" class="style-rate" style-id="{{ $style[0] -> id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($stylePayStatus == true)
                <div class="row mt-5">
                    <div class="col-lg-12 code mb-5">
                        <h5 class="lead text-center">HTML Code</h5>
                        <pre class="code_container mt-3">{{ $style[0] -> html_code }}</pre>
                    </div>
                    <div class="col-lg-12 code mb-5">
                        <h5 class="lead text-center">CSS Code</h5>
                        <pre class="code_container mt-3">{{ $style[0] -> css_code }}</pre>
                    </div>
                    <div class="col-lg-12 code mb-5">
                        <h5 class="lead text-center">JavaScript Code</h5>
                        <pre class="code_container mt-3">{{ $style[0] -> js_code }}</pre>
                    </div>
                </div>
            @else
                <div class="alert alert-secondary text-center mt-5">{{ __("pages/home.Can't Show style code until pay...") }}</div>
            @endif
            <div class="text-center fixed-bottom alert alert-success" id="success_msg" style="display: none;">
                {{ __('messages.Paied Successfuly!! You Can Copy The Code Now..') }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#buy-style', function (e){
            e.preventDefault();
            let styleId = $(this).attr('style-id');
            // console.log(styleId);
            $.ajax({
                type: 'post',
                url: '{{route("buy.style")}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': styleId
                },
                success: function(data){
                    if (data.status == true) {
                        $('#success_msg').fadeIn().fadeOut(3000);
                        $('#buy-style').fadeOut().remove();
                    }
                },
                error: function (reject){}
            });
        });

        $(document).on('change', '.style-rate', function (e) {
            e.preventDefault();
            let styleRate = $(this).val();
            let styleId = $(this).attr('style-id');
            console.log(styleRate);

            $.ajax({
                type: 'get',
                url: '{{route("rate.styles")}}',
                data: {
                    'style_rate': styleRate,
                    'style_id': styleId,
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#your-rate-' + styleId).text(styleRate / 2);
                    }
                }, error: function (reject) {}
            });
        });
    </script>
@endsection