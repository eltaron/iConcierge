@extends('admin.layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Articles</h6>
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
									Add Article
								</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">image</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">title</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">user</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">content</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created at</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($articles as $i => $item)
                        <tr>
                            <td><p class="text-center text-xs font-weight-bold mb-0">{{$i + 1}}</p></td>
                        <td >
                            @if ($item->detail)
                                <img style="border-radius:10%" width="100" height="100" src="{{$item->detail->image}}" alt="">
                            @endif

                        </td>
                        <td>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ \Illuminate\Support\Str::limit($item->title, 10) }}</h6>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$item->user->username}}</h6>
                          </div>
                        </td>
                        <td>
                            @if ($item->detail)
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ \Illuminate\Support\Str::limit($item->detail->content, 40) }}</h6>
                            </div>
                            @endif


                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"> {{ $item->created_at->format('Y-m-d') }}</span>
                        </td>
                        <td class="text-center">
                          <button onclick='item_id.value={{$item->id}} ; a.value=`{{ $item->title }}`; content.value=`{{ addslashes($item->detail->content) }}`' class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
                            <i class="fa fa-solid fa-pen"></i>
                          </button>

                          <button onclick="item_id2.value={{$item->id}}"  class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adding articles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/articles/save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">title</label>
                    <input type="text" name="title" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">content</label>
                    <textarea name="content" class="form-control" id=""></textarea>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit articles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/articles/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">title</label>
                    <input type="text" name="title" class="form-control" id="a">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">content</label>
                    <textarea name="content" class="form-control" id="content"></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">image</label>
                    <input name="image" type="file" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="id" id="item_id">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete article</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/articles/delete')}}" method="post" >
                @csrf
                <input type="hidden" name="id" id="item_id2">
                <div class="mb-3">
                    <p> Are you sure to delete this article ? </p>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
