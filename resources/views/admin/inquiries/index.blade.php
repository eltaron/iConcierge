@extends('admin.layouts.app')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Inquiries</h6>
                </nav>
                @include('admin.includes.navbar')
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0"></div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="row justify-content-between p-2">
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="form-outline" data-mdb-input-init>
                                            <input type="search" id="form1" class="form-control"
                                                placeholder="Search For Inquiry" />
                                        </div>
                                        <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex" style="padding-left: 30px">
                                <a href="" class="col-2 mx-1 btn btn-primary">All (20)<i
                                        class="mx-1 fa fa-solid fa-paper-plane"></i></a>
                                <a href="" class="col-2 mx-1 btn btn-primary">New (20)<i
                                        class="mx-1 fa fa-solid fa-paper-plane"></i></a>
                                <a href="" class="col-2 mx-1 btn btn-primary">On Going (20)
                                    <i class="mx-1 fa fa-solid fa-paper-plane"></i></a>
                                <a href="" class="col-2 mx-1 btn btn-primary">Done (20) <i
                                        class="mx-1 fa fa-solid fa-paper-plane"></i></a>
                            </div>
                            @foreach ($inquires as $item)
                                <div class="row mt-4" style="border: 1px soild black">

                                    <div class="col-12" style="padding-left: 30px; padding-right: 30px">
                                        <h4><i class="fa fa-solid fa-circle"></i> Inquiry about </h4>
                                        {{-- <h6>{{$item->last_messages ? $item->last_messages->content : ''}}</h6> --}}
                                        <span
                                            class="nav-link-text ms-1">{{ $item->last_messages ? $item->last_messages->content : '' }}</span>

                                        <div class="data d-flex justify-content-between align-items-lg-center">
                                            <span class="nav-link-text ms-1">
                                                @if ($item->user && $item->user->cover)
                                                    <img style="width:28px;height:28px; border-radius: 50%"
                                                        src="{{ $item->user->cover }}" alt="" />
                                                @endif
                                                {{ $item->user ? $item->user->username : $item->name }}
                                            </span>
                                            <div class="links">
                                                <a href="{{ url('admin/chats') }}" class="btn">open inquiry</a>
                                                <button href="" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">accept</button>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <hr />
                            @endforeach
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Accept</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">price</label>
                    <input type="text" name="price" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">description</label>
                    <input type="text" name="description" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" multiple>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
