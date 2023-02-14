@extends('layouts.master')

@section('title', 'Admin | ' . config('app.name', 'Default'))

@section('styles')
    <link href="{{ asset('css/pages/admin/admin_show_style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 align-self-center">
                <img src="{{ asset('images/uploads/styles') . '/' . $style -> media }}" class="rounded img-thumbnail" alt="Style {{ $style -> id }}">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $style -> title }}</h5>
                        <p class="card-text">{{ $style -> description }}</p>
                        @if($style -> pays_count > 0)
                            <p class="card-text mb-1">{{ $style -> pays_count . __(' Boughts This Style') }}</p>
                        @else
                        <p class="card-text mb-1">{{ '0' . __(' Bought This Style') }}</p>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        Posted At: {{ $style -> created_at }}
                        <h3>Total Ratings: {{$style -> style_rate}}</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 code mb-5">
                    <h5 class="lead">HTML Code: </h5>
                    <pre class="code_container mt-3">{{ $style -> html_code }}</pre>
                </div>
                <div class="col-md-12 code mb-5">
                    <h5 class="lead">CSS Code: </h5>
                    <pre class="code_container mt-3">{{ $style -> css_code }}</pre>
                </div>
                <div class="col-md-12 code mb-5">
                    <h5 class="lead">JavaScript Code: </h5>
                    <pre class="code_container mt-3">{{ $style -> js_code }}</pre>
                </div>
            </div>
        </div>
        <div class="text-center alert alert-success" id="deleted_msg" style="display: none;">
            {{ __('messages.Style Deleted!!') }}
        </div>
        <a href="{{ route('admin.get.all.style') }}" class="btn btn-secondary" id="deleted_btn" style="display: none;">
            {{ __('All Styles') }}
        </a>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#delete-style', function (e) {
            e.preventDefault();

            let styleId = $(this).attr('style-id');

            $.ajax({
                type: 'post',
                url: "{{ route('admin.delete.style') }}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'style_id': styleId,
                    'exist': true,
                },
                beforeSend: function(){
                    $('#delete-style').html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                    $('#delete-style').prop('disabled', true);
                    $('#delete-style').css('cursor', 'not-allowed');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#deleted_msg').fadeIn();
                        $('#deleted_btn').fadeIn();
                        $('.all-style').fadeOut().remove();
                    }
                }, error: function (reject) {}
            });
        });
    </script>
@endsection