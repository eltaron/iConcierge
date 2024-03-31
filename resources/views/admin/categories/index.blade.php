@extends('admin.layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Categories</h6>
        </nav>
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
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created at</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($categories as $category)
                        <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <img style="width: 100px; border-radius:10%" src="{{asset('img/y.png')}}" alt="">
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$category->title}}l</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"> {{ $category->created_at->format('Y-m-d') }}</span>
                        </td>
                        <td class="text-center">
                          <a href="" class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
                            <i class="fa fa-solid fa-pen"></i>
                          </a>
                          <a href="" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
                            <i class="fa fa-solid fa-trash"></i>
                          </a>
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
        <form action="categories/save" method="post" enctype="multipart/form-data">
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
        <form action="categories/update" method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="" class="form-label">Name</label>
						<input name="title" type="text" class="form-control" id="">
					</div>
					<div class="mb-3">
						<label for="" class="form-label">image</label>
						<input name="img" type="file" class="form-control" id="">
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
        <form action="" method="post" >
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
