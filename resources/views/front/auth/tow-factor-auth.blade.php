<x-front-layout >
    <x-slot:breadcrumbs title="2FA">

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Two Factory Auth </h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{route('products.index')}}">
                            Shop
                        </a></li>
                        <li>2FA</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-slot:breadcrumbs>



    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{route('two-factor.enable')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Tow Factor Auth</h3>
                                <p>You Can Enable/Disable 2FA</p>
                            </div>

                            @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="mb-4 font-medium text-sm">
                                Please finish configuring two factor authentication below.
                            </div>
                        @endif

                            @php
                                $user = Auth::user();
                            @endphp
                            <div class="button">
                                @if (!$user->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else

                                    {!! $user->twoFactorQrCodeSvg() !!}
                                    <div>
                                        <h5>Re Code</h5>
                                        <ul>
                                        @foreach ($user->recoveryCodes() as $recoveryCode )

                                            <li>
                                            {!!$recoveryCode!!}
                                            </li>
                                        @endforeach
                                    </ul>
                                    </div>
                                    @method('delete')
                                    <button class="btn" type="submit">Disable</button>

                                @endif
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>
