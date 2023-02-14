@extends('layouts.master')

@section('title', 'Admin | ' . config('app.name', 'Default'))

@section('styles')
    <link href="{{ asset('css/pages/admin/admin_show_all.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                <div class="flip-card">
                                    <a href="{{ route('admin.show.style', $style -> id) }}" style="text-decoration: none;">
                                        <div class="face front front-{{$style->id}}">
                                            <div class="card text-center">
                                                <img src="{{ asset('images/uploads/styles') . '/' . $style -> media }}" class="card-img-top img-thumbnail" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $style -> title }}</h5>
                                                    <div class="btn btn-info show-details-btn d-flex justify-content-center align-items-center" style-id="{{ $style->id }}"><i class="fa fa-info"></i></div>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <h3>Total Ratings: {{$style -> style_rate}}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="face back back-{{$style->id}}">
                                        <div class="card text-center" style="width: 100%; height:100%">
                                            <div class="card-header">
                                                <div class="btn btn-danger hide-details-btn d-flex justify-content-center align-items-center" style-id="{{ $style->id }}"><i class="fa fa-times-circle-o"></i></div>
                                                <h5 class="lead details-t">Details: </h5>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <span class="title">Title: <span class="inner-title">{{ $style -> title }}</span></span>
                                                </h5>
                                                <div class="card-text">
                                                    <div class="lead description-t">Description: </div>
                                                    <span class="description">
                                                        {!! Str::words($style -> description, 20, ' <a href="' . route("admin.show.style", $style -> id) . '">Read More...</a>') !!}
                                                    </span>
                                                </div>
                                                @if($style -> user_id == 0)
                                                    <h3 class="lead card-text text-muted mt-3">Posted By You</h3>
                                                @endif
                                                @if($style -> pays_count > 0)
                                                    <p class="card-text mb-1">{{ $style -> pays_count . __(' Bought This Style') }}</p>
                                                @endif
                                            </div>
                                            <div class="card-footer text-muted">
                                                <span class="footer-titles">Posted At:</span> {{ $style -> created_at }}
                                                <h3><span class="footer-titles">Total Rates:</span> {{$style -> style_rate}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-secondary">
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
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center pt-4 mt-5">
            {{ $styles ->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/home.js') }}"></script>
    <script>
        $(document).ready(function(){
            // fetchCustomerData();
            function fetchCustomerData(search = '') {
                $.ajax({
                    url: "{{ route('admin.search.styles') }}",
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