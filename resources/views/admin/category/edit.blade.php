@extends('master.admin')
@section('title','Edit a category')
@section('main')
  
  <div class="row">
    <div class="col-md-4">

      <form action="" method="POST" role="form">


        <div class="form-group">
          <label for="">Category name</label>
          <input type="text" class="form-control" name="" id="" placeholder="Input field">
        </div>

        <div class="form-group">
          <label for="">Category status</label>

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

        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
      </form>

    </div>
  </div>

@stop()