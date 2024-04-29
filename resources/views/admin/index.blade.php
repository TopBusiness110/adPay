@extends('admin/layouts/master')
@section('title')
    الصفحة الرئيسية | لوحة التحكم
@endsection
@section('page_name')
    الرئـيسية
@endsection
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header justify-content-center">
                <h2 style="font-weight: bold; padding-top: 1rem">احصائيات بيانية</h2>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400" height="150"></canvas>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 style="font-weight: bold; padding-top: 1rem">احصائيات عامة</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0"> جميع المستخدمين</p>
                                    <p class="text-white mb-0">{{$users=\App\Models\AppUser::count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-users text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0"> عدد التجار</p>
                                    <p class="text-white mb-0">{{$users=\App\Models\AppUser::whereType('vendor')->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-users text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0"> عدد العملاء</p>
                                    <p class="text-white mb-0">{{$users=\App\Models\AppUser::whereType('user')->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-users text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0"> عدد العملاء</p>
                                    <p class="text-white mb-0">{{$users=\App\Models\AppUser::whereType('user')->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-users text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">جميع المنتجات</p>
                                    <p class="text-white mb-0">{{$views=\App\Models\Product::count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-boxes text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">المنتجات المفعلة</p>
                                    <p class="text-white mb-0">{{$views=\App\Models\Product::whereStatus(1)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-boxes text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">المنتجات الغير مفعلة</p>
                                    <p class="text-white mb-0">{{$views=\App\Models\Product::whereStatus(0)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-boxes text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">منتجات ذات خصم</p>
                                    <p class="text-white mb-0">{{$views=\App\Models\Product::where('discount','>',0)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-boxes text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-warning img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">الاعلانات</p>
                                    <p class="text-white mb-0">{{$subscriptions=\App\Models\Ad::paymentSuccess()->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-tv text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-warning img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">الاعلانات المفعلة</p>
                                    <p class="text-white mb-0">{{$subscriptions=\App\Models\Ad::PaymentSuccess()->whereStatus(1)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-tv text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-warning img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">الاعلانات الحالية</p>
                                    <p class="text-white mb-0">{{$subscriptions=\App\Models\Ad::PaymentSuccess()->whereComplete(0)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-tv text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-warning img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">الاعلانات المكتملة</p>
                                    <p class="text-white mb-0">{{$subscriptions=\App\Models\Ad::PaymentSuccess()->Completed()->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-tv text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-success img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">جميع عمليات الدفع</p>
                                    <p class="text-white mb-0">{{$payments=\App\Models\Payment::count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-dollar-sign text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-success img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">عمليات الدفع (فيزا)</p>
                                    <p class="text-white mb-0">{{$payments=\App\Models\Payment::whereType('card')->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-dollar-sign text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-success img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">عمليات الدفع (محفظة)</p>
                                    <p class="text-white mb-0">{{$payments=\App\Models\Payment::whereType('wallet')->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-dollar-sign text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-success img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"></h2>
                                    <p class="text-white mb-0">عمليات الدفع المكتملة</p>
                                    <p class="text-white mb-0">{{$payments=\App\Models\Payment::whereStatus(1)->count()}}</p>
                                </div>
                                <div class="mr-auto">
                                    <i class="fa fa-dollar-sign text-white fs-30 ml-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@php
$orders = \App\Models\Order::count();
@endphp

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let x1 = parseInt({{$users}});
        let x2 = parseInt({{$views}});
        let x3 = parseInt({{$subscriptions}});
        let x4 = parseInt({{$payments}});
        let x5 = parseInt({{$orders}});
        console.log(x1, x2, x3, x4,x5);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['جميع المستخدمين', 'المنتجات', 'الاعلانات', ' عمليات الدفع', 'الطلبات'],
                datasets: [{
                    label: 'العدد',
                    data: [x1, x2, x3, x4,x5],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
