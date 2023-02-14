@extends('layouts.master')

@section('title', 'Admin | ' . config('app.name', 'Default'))

@section('styles')
    <link href="{{ asset('css/pages/admin/admin_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="main-title text-center">Dashboard</div>
        <h3 class="admin-title text-center">
            Welcome, {{ auth()->guard('admin')->user()->name }}...
        </h3>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="dash-card">
                    <div class="dash-card-title text-center">
                        <div>Total Visitors</div>
                        <div><i class="fa fa-line-chart"></i></div>
                    </div>
                    <div class="dash-card-body text-center">
                        <div class="value">
                            {{ $countVisitors[0] -> total_visitors }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="dash-card">
                    <div class="dash-card-title text-center">
                        <div>Total Users</div>
                        <div><i class="fa fa-users"></i></div>
                    </div>
                    <div class="dash-card-body text-center">
                        <div class="value">
                            {{ $countUsers }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="dash-card">
                    <div class="dash-card-title text-center">
                        <div>Total Styles</div>
                        <div><i class="fa fa-files-o"></i></div>
                    </div>
                    <div class="dash-card-body text-center">
                        <div class="value">
                            {{ $countStyles }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="dash-card">
                    <div class="dash-card-title text-center">
                        <div>Total Requests</div>
                        <div><i class="fa fa-paper-plane"></i></div>
                    </div>
                    <div class="dash-card-body text-center">
                        <div class="value">
                            {{ $countRequests }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="dash-card">
                    <div class="dash-card-title text-center">
                        <div>Total Pays</div>
                        <div><i class="fa fa-money"></i></div>
                    </div>
                    <div class="dash-card-body text-center">
                        <div class="value">
                            {{ $countPays }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
