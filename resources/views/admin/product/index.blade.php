@extends('master.admin')
@section('title','Product manager')
@section('main')
  <form class="form-inline" method="POST" class="form-inline" role="form">
    <div class="form-group">
      <label for=""></label>
      <input type="text" name="" id="" class="form-control" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{route('product.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add new</a>
  </form>

  <br>

  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $model)
        <tr>
          <td>{{$loop->index + 1}}</td>
          <td>{{$model->name}}</td>
          <td>{{$model->cat->name}}</td>
          <td>{{$model->price}} <span class="label label-success">{{$model->sale_price}}</span></td>
          <td>{{$model->status == 0 ? 'Hidden' : 'Publish'}}</td>
          <td><img src="uploads/product/{{$model->image}}" width="10%"></td>
          <td class="text-right">
            <form action="{{route('product.destroy', $model->id)}}" method="post">
                @csrf @method('DELETE')
                <a href="{{route('product.edit', $model->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete?')"><i class="fa fa-trash"></i></a>
            </form>
            
          </td>
        </tr>
      @endforeach
      
    </tbody>
  </table>
@stop()