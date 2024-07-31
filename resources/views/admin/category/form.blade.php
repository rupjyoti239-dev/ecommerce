@extends('admin.master.master')
@section('content')
<div class="right_col" role="main">
  <div class="p-3">
    <a class="text-primary form-control-lg" href="{{ route('admin.category.list') }}"><strong>&larr;</strong></a>
  </div>

  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="">
            @if(isset($category))
            <h2 class="text-center ">Update Category</h2>
            @else
            <h2 class="text-center ">Add New Category</h2>
            @endif

            @if (session('error'))
            <div class="alert alert-danger w-50 mx-auto" role="alert">
              {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success w-50 mx-auto" role="alert">
              {{ session('success') }}
            </div>
            @endif
            <div class="ln_solid"></div>
          </div>
          <div class="x_content">
            <br />
            <form action="{{ route('admin.category.store') }}" method="POST" id="demo-form2" data-parsley-validate
              class="form-horizontal form-label-left" enctype="multipart/form-data">
              @csrf

              @if(isset($category))
                <input type="hidden" name="id" value="{{ $category->id }}">
              @endif

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_name">Category Name <span
                    class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="category_name" name="category_name" class="form-control"
                    value="{{ $category->category_name ?? old('category_slug') }}">
                  <span class="text-danger">
                    @error('category_name')
                    {{ $message }}
                    @enderror
                  </span>

                </div>
              </div>


              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_slug">Category Slug<span
                    class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="category_slug" name="category_slug" class="form-control"
                    value="{{ $category->category_slug ?? old('category_slug') }}">
                  <span class="text-danger">
                    @error('category_slug')
                    {{ $message }}
                    @enderror
                  </span>

                </div>
              </div>



              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_image">Category Image<span
                    class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="file" id="category_image" name="category_image" accept="image/*" class="form-control"
                    value="{{ old('category_image') }}">
                  <span class="text-danger">
                    @error('category_image')
                    {{ $message }}
                    @enderror
                  </span>

                </div>
              </div>







              <div class="item form-group my-5">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection