@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/admin/admin_login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mb-4 text-center">{{ __('auth.Admin Login') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.login') }}" method="post">
                        {!! csrf_field() !!}
                            @if(\Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ \Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        {{ \Session::forget('success') }}
                        @if(\Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ \Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required" />
                            @if ($errors->has('email'))
                                <span class="help-block font-red-mint">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required" />
                            @if ($errors->has('password'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-custom btn-block mt-3">Log in</button>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
