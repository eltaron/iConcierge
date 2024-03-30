@extends('admin.layouts.app')
@section('content')
    <main
      class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg"
    >
      <!-- Navbar -->
      <nav
        class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
        id="navbarBlur"
        navbar-scroll="true"
      >
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0">Activities</h6>
          </nav>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card mb-4 px-3">
              <div class="card-header pb-0">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Add Activity
								</button>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table
                    id="example"
                    class="table table-striped"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>category</th>
                        <th style="text-align: left">Price</th>
                        <th>status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img
                                src="{{asset('img/y.png')}}"
                                class="avatar avatar-sm me-3"
                                alt="user1"
                              />
                            </div>
                            <div
                              class="d-flex flex-column justify-content-center"
                            >
                              <h6 class="mb-0 text-sm">Yacht S60</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            class="d-flex flex-column justify-content-center"
                          >
                            <h6 class="mb-0 text-sm">Yacht Rental</h6>
                          </div>
                        </td>
                        <td style="text-align: left" class="align-middle">
                          <span class="text-secondary text-xs font-weight-bold"
                            >1000$</span
                          >
                        </td>
                        <td class="align-middle text-sm">
                          <span class="badge badge-sm bg-gradient-secondary"
                            >Unavailable</span
                          >
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
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img
                                src="{{asset('img/y.png')}}"
                                class="avatar avatar-sm me-3"
                                alt="user1"
                              />
                            </div>
                            <div
                              class="d-flex flex-column justify-content-center"
                            >
                              <h6 class="mb-0 text-sm"> Yacht S60</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            class="d-flex flex-column justify-content-center"
                          >
                            <h6 class="mb-0 text-sm">Yacht Rental</h6>
                          </div>
                        </td>
                        <td style="text-align: left" class="align-middle">
                          <span class="text-secondary text-xs font-weight-bold"
                            >1000$</span
                          >
                        </td>
                        <td class="align-middle text-sm">
                          <span class="badge badge-sm bg-gradient-success"
                            >Available</span
                          >
                        </td>
                        <td class="text-center align-middle">
													<a href="" class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
														<i class="fa fa-solid fa-pen"></i>
													</a>
													<a href="" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
														<i class="fa fa-solid fa-trash"></i>
													</a>
												</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>category</th>
                        <th style="text-align: left">Price</th>
                        <th>status</th>
                        <th></th>
                      </tr>
                    </tfoot>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adding Activity</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
							<div class="mb-3">
                <label for="" class="form-label">image</label>
                <input type="file" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label"> Name</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Price</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <select class="form-select" aria-label="Default select example">
                  <option value="1">Available</option>
                  <option value="2">Unavailable</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Add</button>
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
        <form action="" method="post" enctype="multipart/form-data">
							<div class="mb-3">
                <label for="" class="form-label">image</label>
                <input type="file" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label"> Name</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Price</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <select class="form-select" aria-label="Default select example">
                  <option value="1">Available</option>
                  <option value="2">Unavailable</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Edit</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Activity</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" >
					<div class="mb-3">
						<p> Are you sure to delete this Activity ? </p>
					</div>
					<button type="submit" class="btn btn-danger ">Delete</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

				</form>
      </div>

    </div>
  </div>
</div>
@endsection
