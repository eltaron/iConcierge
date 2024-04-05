@extends('admin.layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Notifications</h6>
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
							{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Add Category
								</button> --}}
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">user</th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">type</th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">content</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">model</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created at</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($notifications as $item)
                        <tr>
                            <td><p class="text-center text-xs font-weight-bold mb-0">{{$item->id}}</p></td>
                            <td >
                                <p class="text-center text-xs font-weight-bold mb-0">{{$item->user->username}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <p class="text-center text-xs font-weight-bold mb-0">{{$item->type}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <p class="text-center text-xs font-weight-bold mb-0">{{$item->content}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <p class="text-center text-xs font-weight-bold mb-0">{{$item->model}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                          <p class="text-center text-xs font-weight-bold mb-0"> {{ $item->created_at->format('Y-m-d') }}</p>
                        </td>
                            <td class="text-center">
                            <button onclick="item_id2.value={{$item->id}}" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
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
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/notifications/delete')}}" method="post" >
                @csrf
                <input type="hidden" name="id" id="item_id2">
                <div class="mb-3">
                    <p> Are you sure to delete this notification ? </p>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
  </main>



@endsection
