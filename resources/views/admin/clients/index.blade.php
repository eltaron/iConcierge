@extends('admin.layouts.app')
@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Members</h6>
                </nav>
                @include('admin.includes.navbar')
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 px-3">
                        {{-- <div class="card-header pb-0">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Add Member
								</button>
              </div> --}}
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="example" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="text-center">Email</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $i => $user)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('img/team-2.jpg') }}"
                                                                class="avatar avatar-sm me-3" alt="user1" />
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $user->username }}
                                                                @if ($user->phone)
                                                                    <br>
                                                                    <span class="text-secondary text-xs font-weight-bold">
                                                                        {{ $user->phone }}
                                                                    </span>
                                                                @endif

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $user->email }}
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-{{ $user->subscription ? 'primary' : 'secondary' }}">{{ $user->subscription ? $user->subscription->type . '<br>' . $user->subscription->end_at : 'not subscribed' }}</span>
                                                </td>
                                                <td>
                                                    <button style="padding: 0.6rem 1.2rem;"
                                                        onclick="document.getElementById('username').value='{{ $user->username }}'; document.getElementById('id').value='{{ $user->id }}';  document.getElementById('phone').value='{{ $user->phone }}'; document.getElementById('email').value='{{ $user->email }}';"
                                                        class="btn text-secondary font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#edit">
                                                        <i class="fa fa-solid fa-pen"></i>
                                                    </button>

                                                    <button style="padding: 0.6rem 1.2rem;"
                                                        onclick="item_id2.value={{ $user->id }}"
                                                        class="btn text-danger font-weight-bold text-xs"
                                                        data-bs-toggle="modal" data-bs-target="#delete">
                                                        <i class="fa fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Action</th>
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
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adding Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="" class="form-label">First Name</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control" id="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Type</label>
                <select class="form-select" aria-label="Default select example">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">image</label>
                <input type="file" class="form-control" id="">
              </div>
              <button type="submit" class="btn btn-primary">Add</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </form>
          </div>

        </div>
      </div>
    </div> --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/clients/edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="mb-3">
                            <label for="" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">image</label>
                            <input type="file" class="form-control" id="">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/clients/delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="item_id2">
                        <div class="mb-3">
                            <p> Are you sure to delete this client ? </p>
                        </div>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
