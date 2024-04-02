@extends('admin.layouts.app')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    @include('admin.includes.message')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        </nav>
        @include('admin.includes.navbar')
      </div>
    </nav>
     <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#key">
                        Add key / Value
                </button>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_details->details as $datail)
            <tr>
                <td>{{$datail->key}}</td>
                <td>{{$datail->value}}</td>
                <td>
                    <button style="padding: 0.6rem 1.2rem;" onclick="item_key.value=`{{$datail->key}}`; item_value.value=`{{$datail->value}}`;item_id.value={{$datail->id}}"  class="btn text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#edit">
                        <i class="fa fa-solid fa-pen"></i>
                    </button>
                    <button style="padding: 0.6rem 1.2rem;" onclick="item_id2.value={{$datail->id}}" class="btn text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#delete">
                        <i class="fa fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>Key</th>
                <th>Value</th>
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
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit service</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/details/edit')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_id" id="item_id">
                <div class="mb-3">
                    <label for="" class="form-label">Key</label>
                    <input name="key" type="text" id="item_key" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Value</label>
                    <textarea id="item_value" name="value" class="form-control" ></textarea>
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
            <form action="{{url('admin/services/details/delete')}}" method="post" >
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
<div class="modal fade" id="key" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adding Key</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/details/add')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="{{$service_id}}">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">key</label>
                    <input type="text" name="key" class="form-control" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">value</label>
                    <textarea id="" name="value" class="form-control" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div>
{{-- <div class="modal fade" id="value" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adding value</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{url('admin/services/details/add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">value</label>
                    <textarea id="" name="value" class="form-control" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
      </div>
    </div>
  </div>
</div> --}}
@endsection
