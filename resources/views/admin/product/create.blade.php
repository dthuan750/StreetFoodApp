@extends('master.admin')
@section('title','Create new a product')
@section('main')
  
  <div class="row">
    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="col-md-7">
        <div class="form-group">
          <label for="">Product name</label>
          <input type="text" name="name" class="form-control" name="" id="" placeholder="Input field">
        </div>

        <div class="form-group">
          <label for="">Product description</label>
          <textarea name="description" class="form-control description" placeholder="Product content"></textarea>
        </div>

        <div class="form-group">
          <label for="">Product other image</label>
          <input type="file" name="other_image[]" class="form-control" multiple onchange="showOtherImage(this)">
          <hr>
          <div class="row" id="show_other_img">
            
          </div>
        </div>

      </div>
      <div class="col-md-5">

        <div class="form-group">
          <label for="">Product category</label>

          <select name="category_id" class="form-control">
            <option value="">Choice One---</option>
            @foreach($cats as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">Product price</label>
          <input type="text" name="price" class="form-control" name="" id="" placeholder="Input field">
        </div>

        <div class="form-group">
          <label for="">Product sale price</label>
          <input type="text" name="sale_price" class="form-control" name="" id="" placeholder="Input field">
        </div>

        <div class="form-group">
          <label for="">Product status</label>

          <div class="radio">
            <label>
              <input type="radio" name="status" value="1">
              Publish
            </label>
          </div>

          <div class="radio">
            <label>
              <input type="radio" name="status" value="0">
              Hidden
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="">Product image</label>
          <input type="file" name="image" class="form-control" onchange="showImage(this)">
          <img id="show_img" src="" alt="" width="100%">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
    </div>
    </form>
  </div>

@stop()

@section('css')
  <link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()

@section('js')
  <script src="ad_assets/plugins/summernote/summernote.min.js"></script>
  <script>
      $('.description').summernote({
        height: 250
      }); 

      function showImage(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#show_img').attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
        }
      }

      function showOtherImage(input) {
        if (input.files && input.files.length) {
          var _html = "";
          for(let i = 0; i < input.files.length; i++){
            var file = input.files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
              _html += `<div class="thumbnail col-md-3">
                          <img src="${e.target.result}" alt="" width="100%">
                        </div>` ;

              $('#show_other_img').html(_html);
            };
            console.log(_html);
            reader.readAsDataURL(input.files[0]);
          }
        }
      }
  </script>
@stop()