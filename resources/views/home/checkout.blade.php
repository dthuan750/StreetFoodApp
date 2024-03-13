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
                            <h2 class="title">Order checkout</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order checkout</li>
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
                    <div class="row">
                        <div class="col-md-4">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input class="form-control" name="name" value="{{$auth->name}}" type="text" placeholder="Your Name *" required>
                                    @error('name')
                                        <small class="help-block">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input class="form-control" name="email" value="{{$auth->email}}" type="email" placeholder="Your Email *" required>
                                    @error('email')
                                        <small class="help-block">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input class="form-control" name="phone" value="{{$auth->phone}}" type="text" placeholder="Your Phone *" required>
                                    @error('phone')
                                        <small class="help-block">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input class="form-control" name="address" value="{{$auth->address}}" type="text" placeholder="Your address *" required>
                                    @error('address')
                                        <small class="help-block">{{$message}}</small>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit">Create account</button>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts as $item)
                                        <tr>
                                            <td scope="row">{{$loop->index + 1}}</td>
                                            <td>
                                                <img src="uploads/product/{{$item->prod->image}}" width="40">
                                            </td>
                                            <td>{{$item->prod->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>
                                                {{$item->quantity}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@stop()