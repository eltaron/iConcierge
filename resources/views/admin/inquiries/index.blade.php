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
                        <input type="search" id="form1" class="form-control" placeholder="Search For Inquiry"/>
                      </div>
                      <button
                        type="submit"
                        class="btn btn-primary"
                        data-mdb-ripple-init
                      >
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>

                  <div class="col-3 d-flex">
                    <div class="col">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                      >
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="col mx-2">
                      <select
                        class="form-select"
                        aria-label="Default select example"
                      >
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row d-flex" style="padding-left: 30px">
                  <a href="" class="col-2 mx-1 btn btn-primary"
                    >All (20)<i class="mx-1 fa fa-solid fa-paper-plane"></i
                  ></a>
                  <a href="" class="col-2 mx-1 btn btn-primary"
                    >New (20)<i class="mx-1 fa fa-solid fa-paper-plane"></i
                  ></a>
                  <a href="" class="col-2 mx-1 btn btn-primary"
                    >On Going (20)
                    <i class="mx-1 fa fa-solid fa-paper-plane"></i
                  ></a>
                  <a href="" class="col-2 mx-1 btn btn-primary"
                    >Done (20) <i class="mx-1 fa fa-solid fa-paper-plane"></i
                  ></a>
                </div>
                @foreach ($inquires as $item)
                <div class="row mt-4" style="border: 1px soild black">

                    <div
                        class="col-12"
                        style="padding-left: 30px; padding-right: 30px"
                        >
                        <h4><i class="fa fa-solid fa-circle"></i> Inquiry about {{$item->service->title}}</h4>
                        {{-- <h6>{{$item->last_messages ? $item->last_messages->content : ''}}</h6> --}}
                        <span class="nav-link-text ms-1"
                        >{{$item->last_messages ? $item->last_messages->content : ''}}</span
                        >

                        <div
                        class="data d-flex justify-content-between align-items-lg-center"
                            >
                        <span class="nav-link-text ms-1"
                            >
                            @if($item->user && $item->user->cover)
                            <img
                            style="width:28px;height:28px; border-radius: 50%"
                            src="{{$item->user->cover}}"
                            alt=""
                            />
                            @endif
                            {{$item->user ? $item->user->username : $item->name}}</span
                        >
                        <div class="links">
                            <a href="{{url('admin/chats')}}" class="btn">open inquiry</a>
                            <a href="" class="btn">accept</a>
                        </div>
                        </div>

                    </div>


                </div><hr />@endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
