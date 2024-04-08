@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Categories</h6>
        </nav>
        @include('admin.includes.navbar')
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Add Category
								</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
                <table class="table align-items-center mb-0" id="example">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">category</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created at</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($categories as $i => $category)
                        <tr>
                            <td><p class="text-center text-xs font-weight-bold mb-0">{{$i + 1}}</p></td>
                        <td >
                              <img style="border-radius:10%" width="100" height="100" src="{{$category->image}}" alt="">
                          <b class=" ms-2">{{$category->title}}</b>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"> {{ $category->created_at->format('Y-m-d') }}</span>
                        </td>
                        <td class="text-center">
                          <button onclick="item_title.value=`{{$category->title}}`;item_id.value={{$category->id}}"  class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
                            <i class="fa fa-solid fa-pen"></i>
                          </button>
                          <button onclick="item_id2.value={{$category->id}}" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
                            <i class="fa fa-solid fa-trash"></i>
                          </button>
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
  </main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adding Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/categories/save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="title" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">image</label>
                    <input name="image" type="file" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/categories/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="item_id">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input name="title" type="text" id="item_title" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">image</label>
                    <input name="image" type="file" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/categories/destory')}}" method="post" >
                @csrf
                <input type="hidden" name="id" id="item_id2">
                <div class="mb-3">
                    <p> Are you sure to delete this category ? </p>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
