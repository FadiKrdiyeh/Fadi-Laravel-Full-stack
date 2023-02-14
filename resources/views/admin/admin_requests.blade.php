@extends('layouts.master')

@section('title', 'Admin | ' . config('app.name', 'Default'))

@section('styles')
    <link href="{{ asset('css/pages/admin/admin_requests.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container justify-content-center">
                @if(isset($styles) && $styles -> count() > 0 )
                    <div class="row">
                        @foreach ($styles as $style)
                            <div class="col-lg-4 col-md-6 my-3 style-{{ $style -> id }}">
                                <div class="flip-card">
                                    <a href="{{ route('admin.show.style', $style -> id) }}" style="text-decoration: none;">
                                        <div class="face front front-{{$style->id}}">
                                            <div class="card text-center">
                                                <span style="width: 100%">
                                                    <img src="{{ asset('images/uploads/styles') . '/' . $style -> media }}" class="card-img-top" alt="..." />
                                                </span>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $style -> title }}</h5>
                                                    <div class="btn btn-info show-details-btn d-flex justify-content-center align-items-center" style-id="{{ $style->id }}"><i class="fa fa-info"></i></div>
                                                    <p class="card-text mb-5 d-flex align-items-center justify-content-center">
                                                        <label for="check-{{$style -> id}}" class="form-check-label form-text">Free? </label>
                                                        <input type="checkbox" id="check-{{$style -> id}}" class="form-check-input paied" value="0" />
                                                    </p>
                                                    <a href="#" id="accept-{{ $style -> id }}" style-id="{{$style->id}}" class="accept-request btn btn-success"><i class="fa fa-check"></i>  Accept</a>
                                                    <a href="#" id="delete-{{ $style -> id }}" style-id="{{$style->id}}" class="delete-request btn btn-danger offset-1"><i class="fa fa-remove"></i>  Delete</a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="face back back-{{$style->id}}">
                                        <div class="card text-center">
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
                                            </div>
                                            <div class="card-footer text-muted">
                                                <span class="footer-titles">Posted At:</span> {{ $style -> created_at }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center alert alert-secondary">There is no requests!!</div>
                    @endif
                    <div class="text-center fixed-bottom alert alert-success" id="success_msg" style="display: none;">Style Accepted!!</div>
                    <div class="text-center fixed-bottom alert alert-success" id="deleted_msg" style="display: none;">Style Deleted!!</div>
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
        $(document).on('click', '.accept-request', function (e) {
            e.preventDefault();

            let styleId = $(this).attr('style-id');
            let checkFree = $('#check-' + styleId);
            let isFree = 1;
            if(checkFree.prop('checked') == true)
                isFree = 0;
            // console.log(checkFree.prop('checked'));

            $.ajax({
                type: 'post',
                url: "{{ route('admin.accept.style') }}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'style_id': styleId,
                    'is_free': isFree
                },
                beforeSend: function(){
                    $('#accept-' + styleId).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    $('#accept-' + styleId).prop('disabled', true);
                    $('#accept-' + styleId).css('cursor', 'not-allowed');
                    $('#delete-' + styleId).prop('disabled', true);
                    $('#delete-' + styleId).css('cursor', 'not-allowed');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').fadeIn().fadeOut(6000);
                        $('.style-' + styleId).fadeOut().remove();
                    }
                }, error: function (reject) {}
            });
        });

        $(document).on('click', '.delete-request', function (e) {
            e.preventDefault();

            // let search_for = $(this).val();
            let styleId = $(this).attr('style-id');

            $.ajax({
                type: 'post',
                url: "{{ route('admin.delete.style') }}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'style_id': styleId,
                    'exist': false,
                },
                beforeSend: function(){
                    $('#delete-' + styleId).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    $('#delete-' + styleId).prop('disabled', true);
                    $('#delete-' + styleId).css('cursor', 'not-allowed');
                    $('#accept-' + styleId).css('cursor', 'not-allowed');
                    $('#accept-' + styleId).prop('disabled', true);
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#deleted_msg').fadeIn().fadeOut(6000);
                        $('.style-' + styleId).fadeOut().remove();
                    }
                }, error: function (reject) {
                    // $.each(response.errors, function (key, val) {
                    //     $("#" + key + "_error").text(val[0]);
                    // });
                }
            });
        });
    </script>
@endsection






{{-- @section('content')
    <div class="container">
        @if(isset($styles) && $styles -> count() > 0 )
            <div class="row">
                @foreach ($styles as $style)
                    <div class="col-md-4 style-{{ $style->id }}">
                        <a href="{{ route('admin.show.style', $style -> id) }}" style="text-decoration: none;">
                            <div class="card text-center">
                                <img src="{{ asset('images/uploads/styles') . '/' . $style -> media }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $style -> title }}</h5>
                                    <p class="card-text">{{ $style -> description }}</p>
                                    <p class="card-text">
                                        <label for="check-{{$style -> id}}">Free? </label>
                                        <input type="checkbox" id="check-{{$style -> id}}" class="paied" value="0" />
                                    </p>
                                    <a href="#" id="accept-{{ $style -> id }}" style-id="{{$style->id}}" class="accept-request btn btn-success"><i class="fa fa-check"></i>  {{ __('Accept') }}</a>
                                    <a href="#" id="delete-{{ $style -> id }}" style-id="{{$style->id}}" class="delete-request btn btn-danger offset-1"><i class="fa fa-remove"></i>  {{ __('Delete') }}</a>
                                </div>
                                <a href="#" id="" style-id="{{$style->id}}" class="btn btn-danger offset-1"><i class="fa fa-remove"></i>  {{ __('Delete') }}</a>
                                <div class="card-footer text-muted">
                                    Posted At: {{ $style -> created_at }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center alert alert-secondary">
                {{ __('messages.There is no requests!!') }}
            </div>
        @endif
        <div class="text-center fixed-bottom alert alert-success" id="success_msg" style="display: none;">
            {{ __('messages.Style Accepted!!') }}
        </div>

        <div class="text-center fixed-bottom alert alert-success" id="deleted_msg" style="display: none;">
            {{ __('messages.Style Deleted!!') }}
        </div>
    </div>
@endsection --}}