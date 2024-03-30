@extends('admin.layouts.app')
@push("style")
    <style>
      :root {
        --first_color: #59af5c;
        --first_bg_color: #cccccc;
        --second_bg_color: #231f1f;
        --third_bg_color: #dddddd;
        --folow: #bc4037;
        --icons_color: #000000;
        --delete_account: #ff0007;
        --p_color: #707070;

        --colorone: #0881a3;
        --colortwo: #ece7e1;
        --colorthree: #fde9df;
        --colorfour: #ffd6a4;
        --marquee-width: 80vw;
        --marquee-height: 20vh;
        /* --marquee-elements: 12; */ /* defined with JavaScript */
        --marquee-elements-displayed: 9;
        --marquee-element-width: calc(
          var(--marquee-width) / var(--marquee-elements-displayed)
        );
        --marquee-animation-duration: calc(var(--marquee-elements) * 1s);
        /* --font: "Noto Kufi Arabic", sans-serif; */
      }
      *,
      body {
        padding: 0;
        margin: 0;
      }
      body {
        overflow-x: hidden;
        caret-color: var(--first_color);
        background-color: var(--colorthree);
      }
      body::-webkit-scrollbar,
      .mainbg::-webkit-scrollbar {
        background-color: transparent;
        width: 10px;
      }

      body::-webkit-scrollbar-thumb,
      .mainbg::-webkit-scrollbar-thumb {
        background: var(--colorone);
        border-radius: 30px;
      }
      ul {
        margin: 0;
        padding: 0;
      }
      ul li {
        list-style-type: none;
      }
      * {
        box-sizing: border-box;
      }
      a {
        text-decoration: none;
      }

      /* header  */
      .header {
        margin-top: 30px;
        margin-bottom: 30px;
      }
      .header .header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
      }
      .header .header-top .logo {
        flex-basis: 20%;
      }
      .header .header-top .logo img {
        width: 96%;
        cursor: pointer;
      }
      .header .header-top .links {
        flex-basis: calc(60%);
      }
      .header .header-top .links ul {
        display: flex;
        width: 100%;
        justify-content: space-between;
      }
      .header .header-top ul a {
        color: var(--colorone);
        transition: 0.2s;
        font-size: 26px;
        position: relative;
      }

      .header .header-top ul a:hover {
        color: var(--colorfour);
      }
      .header .header-top ul a:hover::after {
        width: 100%;
      }
      .header .header-top ul a::after {
        position: absolute;
        content: "";
        width: 0%;
        left: 0;
        bottom: -5px;
        background-color: var(--colorone);
        height: 3px;
        transition: 0.3s;
      }

      .dropdown {
        display: none;
      }
      .dropdown-menu {
        background-color: var(--colorthree);
      }
      .dropdown .btn {
        background-color: var(--colorfour);
      }
      .dropdown .btn i {
        color: var(--colortwo);
      }
      .header .header-top .links i {
        display: none;
      }
      .logo:hover {
        transform: rotate(360deg);
      }
      @media (max-width: 768px) {
        .header .container {
          max-width: 600px;
        }
        .header .header-top {
          gap: 0;
        }
        .header .header-top .logo {
          flex-basis: 100%;
          order: 3;
          text-align: center;
        }
        .header .header-top .logo img {
          width: 55%;
        }

        .header .header-top .links ul {
          display: none;
        }
        .dropdown {
          display: inline-flex;
        }
      }
      .menubar {
        display: flex !important;
        flex-direction: column;
        height: 80vh;
        padding: 30px 19px;
        background-color: var(--colorfour);
        position: absolute;
        z-index: 22;
        transition: 0.3s;
        border-radius: 18px;
        max-width: 91% !important;
      }
      .menubar li a {
        color: #000;
        display: block;
        text-decoration: none;
        text-transform: uppercase;
      }

      .main-title {
        text-transform: uppercase;
        margin: 0 auto 80px;
        border: 2px solid black;
        padding: 10px 20px;
        font-size: 30px;
        width: fit-content;
        position: relative;
        z-index: 1;
        transition: 0.3s;
        color: var(--colorone);
      }
      .main-title::before,
      .main-title::after {
        content: "";
        width: 12px;
        height: 12px;
        background-color: var(--colorone);
        position: absolute;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
      }
      .main-title::before {
        left: -30px;
      }
      .main-title::after {
        right: -30px;
      }
      .main-title:hover::before {
        z-index: -1;
        animation: left-move 0.5s linear forwards;
      }
      .main-title:hover::after {
        z-index: -1;
        animation: right-move 0.5s linear forwards;
      }
      .main-title:hover {
        color: var(--colorthree);
        border: 2px solid white;
        transition-delay: 0.5s;
      }
      /* -------------------------------------------------------- */
      .containerr {
        background-color: #2f5060;
        padding: 0 !important;
        position: relative;
        border-radius: 14px;
      }

      .main img {
        width: 50px;
        border-radius: 50%;
        margin: 10px;
      }

      .content {
        display: flex;
        align-items: center;
      }

      .msg {
        background-color: var(--primary);
        border-radius: 14px;
        padding: 10px;
        margin-left: 10px;
        margin-top: 10px;
        width: fit-content;
        color: #f0f2f5;
        width: 60%;
      }
      * {
        box-sizing: border-box;
      }
      .reply {
        color: black;
        background-color: #ffffff !important;
        margin-left: 10px;
      }
      .reply p {
        direction: ltr;
      }
      .input-message {
        width: 100%;
        height: 100%;
        border: none;
        outline: none;
        padding: 0.5em 1em;
        border-radius: 50px;
        color: #0084ff;
        background: white;
        transition: all ease 0.5s;
      }
      .field {
        width: 100%;
        height: 4em;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5em;
        padding: 0.25em 0.5em;
        border-top: 1px solid rgb(177, 168, 168);
        transition: all ease 0.5s;
        position: static;
        bottom: 0;
        margin-top: 15px;
      }
      .icon.send.text {
        min-width: 32px;
        display: flex;
        align-items: center;
        color: #fff;
        background: var(--primary);
        padding: 12px;
        border-radius: 50%;
        overflow: hidden;
        justify-content: center;
      }
      .msg img {
        width: 90%;
        border-radius: 5px;
      }
      p {
        direction: rtl;
      }
    </style>
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
