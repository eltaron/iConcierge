@extends('admin.layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">services</h6>
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
									Add service
								</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">service</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">category</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($services as $i => $service)
                        <tr>
                            <td><p class="text-center text-xs font-weight-bold mb-0">{{$i + 1}}</p></td>
                        <td >
                            @if ($service->image)
                            <img style="border-radius:10%" width="100" height="100" src="{{$service->image->url}}" alt="">
                            @endif
                          <b class=" ms-2">{{$service->title}}</b>
                        </td>
                        <td><p class=" text-xs font-weight-bold mb-0">{{$service->category->title}}</p></td>

                        <td class="align-middle text-center text-sm">
                            {{ $service->time_ago }} <br>
                          <span class="badge badge-sm bg-gradient-success"> {{ $service->created_at->format('Y-m-d') }}</span>
                        </td>
                    </td>
                    <td class="text-center">
                      <a href="{{ url('admin/services/' . $service->id) }}" >
                        <button  style="padding: 0.6rem 1.2rem;"   class="btn text-secondary font-weight-bold text-xs" >
                            <i class="fa fa-solid fa-eye"></i>
                        </button>
                    </a>
                      <button style="padding: 0.6rem 1.2rem;" onclick="item_title.value={{$service->title}};item_id.value={{$service->id}}"  class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
                        <i class="fa fa-solid fa-pen"></i>
                      </button>
                      <button style="padding: 0.6rem 1.2rem;" onclick="item_id2.value={{$service->id}}" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adding service</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">title</label>
                    <input type="text" name="title" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea name="description" class="form-control" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Map location</label>
                    <textarea name="map" class="form-control" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">price</label>
                    <input name="price" type="number" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">images</label>
                    <input name="images[]" type="file" multiple class="form-control" id="">
                </div>
                <div class="mb-3">
                    <input name="popular" type="radio" value="1">
                    <label for="" class="form-label">make it popular</label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">category</label>
                    <select name="category" class="form-control" id="">
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit service</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="item_id">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input name="title" type="text" id="item_title" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea name="description" class="form-control" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Map location</label>
                    <textarea name="map" class="form-control" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">price</label>
                    <input name="price" type="number"  class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">images</label>
                    <input name="images[]" type="file" multiple class="form-control" id="">
                </div>
                <div class="mb-3">
                    <input name="popular" type="radio" value="1">
                    <label for="" class="form-label">make it popular</label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">category</label>
                    <select name="category" class="form-control" id="">
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete service</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/destory')}}" method="post" >
                @csrf
                <input type="hidden" name="id" id="item_id2">
                <div class="mb-3">
                    <p> Are you sure to delete this service ? </p>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
