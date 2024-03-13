@extends('master.admin')

@section('title','Chi tiết đơn hàng')

@section('main')
    @if($order->status != 2)
        @if($order->status != 3)
            <a href="{{route('order.update',$order->id)}}?status=2" class="btn btn-danger" onclick="return confirm('Xác nhận đã giao')">Đã giao hàng</a>
            <a href="{{route('order.update',$order->id)}}?status=3" class="btn btn-warning" onclick="return confirm('Xác nhận hủy')">Hủy</a>
        @else
            <a href="{{route('order.update',$order->id)}}?status=3" class="btn btn-warning" onclick="return confirm('Xác nhận hủy')">Hủy</a>
        @endif
    @endif
    <div class="row">
        <div class="col-md-6">
            <h3>Thông tin khách hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <td>{{$auth->name}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$auth->phone}}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{$auth->address}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Thông tin giao hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <td>{{$order->name}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$order->phone}}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{$order->address}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <h3>Thông tin sản phẩm</h3>

    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $item)
                <tr>
                    <td scope="row">{{$loop->index + 1}}</td>
                    <td><img src="uploads/product/{{$item->product->image}}" width="40"></td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format($item->price)}}</td>
                    <td>{{number_format($item->price * $item->quantity)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop()