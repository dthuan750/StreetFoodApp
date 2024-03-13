@extends('master.main')

@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="assets/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Order history</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order history</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">
            <div class="contact-wrap">
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Order date</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auth->orders as $item)
                                <tr>
                                    <td scope="row">{{$loop->index + 1}}</td>
                                    <td>
                                        {{$item->created_at->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                        <span>Chưa xác nhận</span>
                                        @elseif($item->status == 1)
                                        <span>Đã xác nhận</span>
                                        @elseif($item->status == 2)
                                        <span>Đã thanh toán</span>
                                        @else
                                        <span>Đã hủy</span>
                                        @endif 
                                    </td>
                                    <td>{{number_format($item->totalPrice)}}</td>
                                    <td>
                                        <a href="{{route('order.detail', $item->id)}}" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>
                    <div class="text-center">
                        <a href="" class="btn btn-primary">Continue shopping</a>
                        @if($carts->count())
                            <a href="{{route('cart.clear')}}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa giỏ hàng không')"><i class="fa fa-trash"></i>Clear All</a>
                            <a href="{{route('order.checkout')}}" class="btn btn-success">Place Order</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@stop()