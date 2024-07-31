@extends('admin.master.master')
@section('content')

<!-- page content -->
<div class="right_col" role="main">





  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Category List</h3>
      </div>

      @if (session('success'))
      <div style="position: absolute; left: 500px; top: 70px; text-align: center" class="alert  alert-success w-50 "
        role="alert">
        {{ session('success') }}
      </div>
      @endif
      @if (session('error'))
      <div style="position: absolute; left: 500px; top: 70px; text-align: center" class="alert alert-danger w-50 "
        role="alert">
        {{ session('error') }}
      </div>
      @endif

      <div class="title_right">
        <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
          <a href="{{ route('admin.category.form') }}" class="btn btn-primary">Add New</a>
        </div>
      </div>


    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">

          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-buttons" class="table  table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Sl No</th>
                        <th>Category name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $item)
                      <tr>
                        <td>
                          {{ $loop->iteration }}
                        </td>
                        <td>
                          {{ $item->category_name }}
                        </td>
                        <td>
                          {{ $item->category_slug }}
                        </td>
                        <td>
                          <img src="{{ asset('backend_images/'.$item->category_image) }}" alt="" class="image-fluid"
                            height="100">
                        </td>
                        <td>
                          @if($item->status == 1)
                          <span class="label label-success">Active</span>
                          @else
                          <span class="label label-danger">Inactive</span>
                          @endif
                        </td>
                        <td>
                          @if ($item->status == 1)
                          <a href="{{ route('admin.category.status',['id'=>$item->id]) }}"
                            class="btn btn-sm btn-warning">Disable</a>
                          @else
                          <a href="{{ route('admin.category.status',['id'=>$item->id]) }}"
                            class="btn btn-sm btn-primary">Enable</a>
                          @endif
                          <a href="{{ route('admin.category.form',['id'=>$item->id]) }}">Edit</a>
                          <a href="{{ route('admin.category.delete',['id'=>$item->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
<!-- /page content -->
@endsection