@extends('admin.layouts.app')
@push("style")
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
@endpush
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
            <h6 class="font-weight-bolder mb-0">Chat</h6>
          </nav>
          @include('admin.includes.navbar')
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="details d-flex align-items-center my-4 px-2 justify-content-between">
          <div class="d-flex align-items-center">
            <div class="">
              <img style="width: 20px" src="{{asset('img/g.png')}}" alt="" />
            </div>
            <div class="name mx-3">
              <h6>Joe adel</h6>
              <p class="my-0">Online</p>
            </div>
          </div>
          <div>
            <i class="fa fa-solid fa-caret-down"></i>
          </div>
        </div>
        <div class="me">
          <div class="main first teacher">
            <div class="containerr">
              <div class="chat-messages">
                <div class="content">
                  <div class="name">
                    <img style="width: 20px" src="{{asset('img/g.png')}}" alt="" />
                  </div>
                  <div class="msg">
                    <p>
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                      Tempore eius vitae tempora adipisci ut soluta beatae,
                      voluptates placeat incidunt, dicta delectus. Accusamus
                      quia eveniet error sunt. Tempora necessitatibus explicabo
                      illum?
                    </p>
                  </div>
                </div>
                <div class="content two " style="direction:rtl;" >
              <div class="name">
                <img src="images/profile-2092113_960_720.png" alt="" />
              </div>
              <div class="msg reply">
                <p>you can  go there </p>
              </div>
            </div>

              </div>
              <form class="field chat-input-form">
                <input
                  id="input-message"
                  class="input-message chat-input"
                  type="text"
                  placeholder="type your message   ..."
                />
                <button type="submit" id="send-text" class="icon send text">
                  <i class="fa fa-solid fa-paper-plane"></i>
                </button>

                <button type="" id="send-text" class="icon send text">
                  <i class="fa fa-solid fa-paperclip"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
