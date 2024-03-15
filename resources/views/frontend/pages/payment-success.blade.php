@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                                                                                                                                                                    BREADCRUMB START
                                                                                                                                                                ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Order</h1>
                    <ul>
                        {{-- <li><a href="index.html">home</a></li>
                        <li><a href="javascript:;">payment</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                                                                                                                                        BREADCRUMB END
                                                                                                                                                                    ==============================-->


    <!--============================
                                                                                                                                                                        PAYMENT PAGE START
                                                                                                                                                                    ==============================-->
    <section class="fp__payment_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <div class="mb-6">
                        <i class="fas fa-check"
                            style="
                            font-size: 70px;
                            background: green;
                            padding: 20px;
                            border-radius: 50%;
                            color: #fff;
                            ">
                        </i>
                    </div>
                    <h4 class="mt-4">Order Placed Successfully!</h4>
                    <a href="{{ route('dashboard') }}" class="common_btn mt-4">Go to dashboard</a>
                </div>
            </div>
        </div>
    </section>

    <!--============================
                                                                                                                                                                        PAYMENT PAGE END
                                                                                                                                                                    ==============================-->
@endsection
