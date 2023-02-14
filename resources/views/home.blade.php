@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container justify-content-center">
        <div id="live-search" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" id="search-input" placeholder="{{ __('pages/home.Search For Styles...') }}" />
                </div>
            </div>
        </div>
        <div class="alert alert-secondary text-center mt-5 total_results">{{ __('pages/home.Total Results: ') }}<span id="total_results"></div>
        @if(isset($styles) && $styles -> count() > 0 )
            <div class="row search-result">
                @foreach ($styles as $style)
                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="flip-card hvr-grow-shadow">
                            <div class="face front front-{{$style->id}}">
                                <a href="{{ route('show.style', $style -> id) }}" style="text-decoration: none;">
                                    <div class="card text-center">
                                        <img src="{{ asset('images/uploads/styles') . '/' . $style -> media }}" class="card-img-top" alt="{{ $style -> title }} Image...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $style -> title }}</h5>
                                            <div class="btn btn-info show-details-btn d-flex justify-content-center align-items-center" style-id="{{ $style->id }}"><i class="fa fa-info"></i></div>
                                            @auth
                                                @if ($style -> payStatus -> count() === 0 && $style -> free_status === 1 && $style -> user_id != $user_id)
                                                    <a href="#" style-id="{{$style -> id}}" class="buy-style-{{ $style->id }} buy-style btn btn-secondary">{{ __('pages/home.Buy 0.99$') }}</a>
                                                @endif
                                            @endauth
                                            @if($style -> free_status === 0)
                                                <div class="btn btn-secondary">{{ __('pages/home.Free') }}</div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-muted">
                                            <h3>{{ __('pages/home.Total Rates:') }} {{$style -> style_rate}}</h3>
                                        </div>
                                        @auth
                                            <!-- Button trigger modal for rating -->
                                            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#ratingModal{{$style->id}}">
                                                {{ __('pages/home.Rate') }} <i class="fa fa-star" style="color: rgb(255, 174, 0);"></i>
                                            </button>
                                        @endauth
                                    </div>
                                </a>
                            </div>
                            <div class="face back back-{{$style->id}}">
                                <div class="card text-center" style="width: 100%; height:100%">
                                    <div class="card-header">
                                        <div class="hide-details-btn" style-id="{{ $style->id }}"><i class="fa fa-times-circle-o"></i></div>
                                        <h5 class="lead details-t">{{ __('pages/home.Details:') }} </h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="title">{{ __('pages/home.Title:') }} <span class="inner-title">{{ $style -> title }}</span></span>
                                        </h5>
                                        <div class="card-text">
                                            <div class="lead description-t">{{ __('pages/home.Description:') }} </div>
                                            <span class="description">
                                                {{-- {!! Str::words($style -> description, 30, ' <a href="' . route("show.style", $style -> id) . '">Read More...</a>') !!} --}}
                                                {!! Str::words($style -> description, 30, ' <a href="' . route("show.style", $style -> id)  . '">' . __("pages/home.Read More...") . '</a>') !!}
                                            </span>
                                        </div>
                                        @auth
                                        @if ($style -> user_id == $user_id)
                                            <h3 class="lead card-text text-muted m-3">{{ __('pages/home.Posted By You') }}</h3>
                                        @elseif($style -> user_id == 0)
                                            <h3 class="lead card-text text-muted m-3">{{ __('pages/home.Posted By Admin') }}</h3>
                                        @endif
                                            @if ($style -> payStatus -> count() === 0 && $style -> free_status === 1 && $style -> user_id != $user_id)
                                                <a href="#" style-id="{{$style -> id}}" class="buy-style-{{ $style->id }} buy-style btn btn-secondary">{{ __('pages/home.Buy 0.99$') }}</a>
                                            @endif
                                        @endauth
                                        @if($style -> free_status === 0)
                                            <div class="btn btn-secondary">{{ __('pages/home.Free') }}</div>
                                        @endif
                                        @if($style -> pays_count > 0)
                                            <p class="card-text mb-1">{{ $style -> pays_count . __('pages/home. Bought This Style') }}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer text-muted">
                                        <span class="footer-titles">{{ __('pages/home.Posted At:') }}</span> {{ $style -> created_at }}
                                        <h4><span class="footer-titles">{{ __('pages/home.Total Rates:') }}</span> {{$style -> style_rate}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rating Modal -->
                        <div class="modal fade" id="ratingModal{{$style->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('pages/home.Rate This Style') }}</h5>
                                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="rate-container">
                                            <h2>{{ __('pages/home.Total Rates:') }} {{$style -> style_rate}}</h2>
                                            <div class="skills">
                                                <h3 class="name text-center">{{ __('pages/home.Your Rate:') }}
                                                    @forelse ($style -> styleRating as $ratio)
                                                        <span id="your-rate-{{$style -> id}}">{{ $ratio -> rating / 2}}</span>
                                                    @empty
                                                        <span id="your-rate-{{$style -> id}}">{{ __('pages/home.Not Rated Yet!!') }}</span>
                                                    @endforelse
                                                </h3>
                                                <div class="rating {{(App::isLocale('ar') ? 'rating-ar' : 'rating-en')}}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="10" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="9" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="8" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="7" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="6" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="5" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="4" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="3" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="2" class="style-rate" style-id="{{ $style -> id }}">
                                                    <input type="radio" name="style_rate_{{$style -> id}}" value="1" class="style-rate" style-id="{{ $style -> id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center alert">
                {{ __('messages.There is no styles!!') }}
            </div>
        @endif
        <div class="row">
            <div class="col-8">
                <div class="text-center fixed-bottom alert alert-success" id="success_msg" style="display: none;">
                    {{ __('messages.Your Request Will Send To Website Admin.. It Will Be Accepted Soon If Everything Correct.. Thank You!!') }}
                </div>
                <div class="text-center fixed-bottom alert alert-success" id="paied_msg" style="display: none;">
                    {{ __('messages.Paied Successfuly!! You Can Copy The Code Now..') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="search-paginate col-12 d-flex justify-content-center pt-4 mt-5">
            {{ $styles -> links() }}
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.includes.footer')
@endsection
@section('scripts')
    <script src="{{ asset('js/pages/home.js') }}"></script>
    <script>
        $(document).on('change', '.style-rate', function (e) {
            e.preventDefault();
            let styleRate = $(this).val();
            let styleId = $(this).attr('style-id');

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

        $(document).on('click', '.buy-style', function (e){
            e.preventDefault();
            let styleId = $(this).attr('style-id');
            
            $.ajax({
                type: 'post',
                url: '{{route("buy.style")}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': styleId
                },
                beforeSend: function(){
                    $('.buy-style-' + styleId).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    $('.buy-style-' + styleId).prop('disabled', true);
                    $('.buy-style-' + styleId).css('cursor', 'not-allowed');
                },
                success: function(data){
                    if (data.status == true) {
                        $('#paied_msg').fadeIn().fadeOut(8000);
                        $('#buy-style-' + styleId).fadeOut().remove();
                    }
                },
                error: function (reject){}
            });
        });

        $(document).ready(function(){
            // fetchCustomerData();
            function fetchCustomerData(search = '') {
                $.ajax({
                    url: "{{ route('live.search.styles') }}",
                    method: 'post',
                    data: {
                        '_token': "{{csrf_token()}}",
                        'search': search
                    },
                    dataType: 'json',
                    beforeSend: function(){
                        $('#total_results').html('Please Wait...<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    },
                    success: function(data){
                        $('.search-result').html(data[0].styles_data);
                        if(data[0].show_message == true){
                            $('.total_results').fadeIn();
                            $('.pagination').hide();
                        } else {
                            $('.total_results').fadeOut();
                            $('.pagination').show();
                        }
                        $('#total_results').text(data[0].total_results);
                    },
                });
            }
            $(document).on('keyup', '#search-input', function(){
                let search = $(this).val();
                fetchCustomerData(search);
            });
        });
    </script>
@stop