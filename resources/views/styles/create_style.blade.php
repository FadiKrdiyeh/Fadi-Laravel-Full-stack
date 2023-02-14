@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/styles/create_style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center mb-5">{{ __('pages/create_style.Create Style') }}</div>
                    <div class="card-body">
                        <form method="post" id="postForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end form-text">{{ __('pages/create_style.Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required placeholder="{{ __('pages/create_style.Enter Title...') }}" />
                                    {{-- @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="title_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end form-text">{{ __('pages/create_style.Description') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required placeholder="{{ __('pages/create_style.Enter Description...') }}"></textarea>
                                    {{-- @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="description_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end form-text">{{ __('pages/create_style.Image') }}</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                                    {{-- @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="image_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="html_code" class="col-md-4 col-form-label text-md-end form-text">{{ __('HTML Code') }}</label>
                                <div class="col-md-6">
                                    <textarea id="html_code" class="form-control @error('html_code') is-invalid @enderror" name="html_code" required placeholder="{{ __('pages/create_style.Enter HTML Code...') }}"></textarea>
                                    {{-- @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="html_code_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="css_code" class="col-md-4 col-form-label text-md-end form-text">{{ __('CSS Code') }}</label>
                                <div class="col-md-6">
                                    <textarea id="css_code" class="form-control @error('css_code') is-invalid @enderror" name="css_code" required placeholder="{{ __('pages/create_style.Enter CSS Code...') }}"></textarea>
                                    {{-- @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="css_code_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="js_code" class="col-md-4 col-form-label text-md-end form-text">{{ __('Javascript Code') }}</label>
                                <div class="col-md-6">
                                    <textarea id="js_code" class="form-control @error('js_code') is-invalid @enderror" name="js_code" required placeholder="{{ __('pages/create_style.Enter JS Code...') }}"></textarea>
                                    {{-- @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <small id="js_code_error" class="form-text text-danger error_message"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{-- <div class="col-md-4 offset-md-4 text-center"> --}}
                                <div class="col-12 text-center">
                                    {{-- <input id="submit" type="submit" class="form-control" name="submit" value="Post" /> --}}
                                    <button type="submit" class="create-style btn btn-custom" id="create_style">
                                        {{ __('pages/create_style.Send Request') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center fixed-bottom alert alert-success" id="success_msg" style="display: none;">
            {{ __('messages.Your Request Will Send To Website Admin.. It Will Be Accepted Soon If Everything Correct.. Thank You!!') }}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#create_style', function (e) {
            e.preventDefault();
            $('.error_message').text('');
            var formData = new FormData($('#postForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('create.style')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $('.create-style').html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    $('.create-style').prop('disabled', true);
                    $('.create-style').css('cursor', 'not-allowed');
                },
                success: function (data) {
                    $('#title').val('');
                    $('#description').val('');
                    $('#html_code').val('');
                    $('#css_code').val('');
                    $('#js_code').val('');
                    $('#image').val('');
                    $('.create-style').text('Create Style');
                    $('.create-style').prop('disabled', false);
                    $('.create-style').css('cursor', 'pointer');
                    if (data.status == true) {
                        $('#success_msg').fadeIn().fadeOut(3000);
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                    $('.create-style').text('Create Style');
                    $('.create-style').prop('disabled', false);
                    $('.create-style').css('cursor', 'pointer');
                }
            });
        });
    </script>
@stop