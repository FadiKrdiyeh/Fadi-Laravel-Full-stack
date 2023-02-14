<button class="btn-sitting {{(App::isLocale('ar') ? 'btn-sitting-ar' : 'btn-sitting-en')}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa fa-gear fa-lg hvr-rotate-120"></i></button>

<div class="offcanvas offcanvas-{{(App::isLocale('ar') ? 'end' : 'start')}} py-5" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">{{ __('includes.Sittings') }}</h5>
        <span class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home') }}"><i class="fa fa-home"></i> {{ __('includes.Home') }}</a>
            </li>
            @auth('admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('includes.Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.get.all.style') }}"><i class="fa fa-files-o"></i> {{ __('includes.All Styles') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.requests') }}">
                        <i class="fa fa-paper-plane"></i> {{__(('includes.Requests'))}}
                        @php
                            $count = \App\Models\Style::select('id') -> where('request_status', 0) -> count();
                        @endphp
                        @if ($count > 0)
                            <span class="badge bg-light mx-2" style="color: #222">{{ $count }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.get.create.style') }}"><i class="fa fa-plus-square"></i> {{ __('includes.Create New Style') }}</a>
                </li>
            @endauth

            @auth('web')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('get.create.style') }}"><i class="fa fa-plus-square"></i> {{ __('includes.Create New Style') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('get.wallet') }}"><i class="fa fa-shopping-bag"></i> {{ __('includes.Wallet') }}</a>
                </li>
            @endauth

            <li class="nav-item">
                <a class="nav-link" href="{{ route('get.about.web') }}"><i class="fa fa-question"></i> {{ __('includes.About Website') }}</a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('get.themes') }}"><i class="fa fa-paint-brush"></i> {{ __('includes.Themes') }}</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('get.about.developer') }}"><i class="fa fa-info-circle"></i> {{ __('includes.About Developer') }}</a>
            </li>
        </ul>
    </div>
</div>