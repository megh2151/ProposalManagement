@extends('layouts.admin.master')


@section('content')
    <div class="container p-0 ">
        <div class="card card-chat">
            <div class="card-header">
                <div class="row m-0 align-items-center">
                    <div class="col-md-4 pl-0">
                        <form>
                            <input type="text" placeholder="Search..." class="form-control" />
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="{{asset('admin/assets/img/user/u2.jpg')}}" class="rounded-circle" />
                            </div>
                            <div class="col-9 pl-0">
                                <h3 class="title">Leon Battista</h3>
                            </div>
                            <div class="col-1 p-0">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="row mx-0">
                    <div class="col-md-4 chat-users">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <div class="chat chat-user">
                                        <div class="position-relative mr-3">
                                            <img class="rounded-circle chat-profile" src="{{asset('admin/assets/img/user/u1.jpg')}}" alt="Image">
                                            <span class="status away"></span>
                                        </div>
                                        <div class="chat-user-body">
                                            <div class="chat-user-content">
                                                <h5>User one</h5>
                                                <p class="last-msg">Lorem Ipsum is simply dummy text of</p>
                                            </div>
                                            <span class="chat-date">6 May</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <div class="chat chat-user">
                                        <div class="position-relative mr-3">
                                            <img class="rounded-circle chat-profile" src="{{asset('admin/assets/img/user/u2.jpg')}}" alt="Image">
                                            <span class="status active"></span>
                                        </div>
                                        <div class="chat-user-body">
                                            <div class="chat-user-content">
                                                <h5>Leon Battista</h5>
                                                <p class="last-msg">Lorem Ipsum is simply dummy text of</p>
                                            </div>
                                            <span class="chat-date">6 May</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <div class="chat chat-user">
                                        <div class="position-relative mr-3">
                                            <img class="rounded-circle chat-profile" src="{{asset('admin/assets/img/user/u3.jpg')}}" alt="Image">
                                            <span class="status away"></span>
                                        </div>
                                        <div class="chat-user-body">
                                            <div class="chat-user-content">
                                                <h5>User one</h5>
                                                <p class="last-msg">Lorem Ipsum is simply dummy text of</p>
                                            </div>
                                            <span class="chat-date">6 May</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 chat-right-content">
                        <div class="chat-content">
                            <div class="chat chat-message chat-left">
                                <img class="rounded-circle mr-3" src="{{asset('admin/assets/img/user/u2.jpg')}}" alt="Image">
                                <div class="chat-body">
                                    <p class="message">Lorem ipsum dolor sit amet.</p>
                                    <div class="date-time">27-07-2019, 1.03 PM</div>
                                </div>
                            </div>
                            <div class="chat chat-message chat-right">
                                <div class="chat-body">
                                    <p class="message">Consectetur adipisicing elit Odio ex.</p>
                                    <div class="date-time">27-07-2019, 1.03 PM</div>
                                </div>
                                <img class="rounded-circle ml-3" src="{{asset('admin/assets/img/user/u-xl-4.jpg')}}" alt="Image">
                            </div>
                            <div class="chat chat-message chat-left">
                                <img class="rounded-circle mr-3" src="{{asset('admin/assets/img/user/u2.jpg')}}" alt="Image">
                                <div class="chat-body">
                                    <p class="message">Lorem ipsum dolor sit amet.</p>
                                    <div class="date-time">27-07-2019, 1.03 PM</div>
                                </div>
                            </div>
                            <div class="chat chat-message chat-right">
                                <div class="chat-body">
                                    <p class="message">Consectetur adipisicing elit Odio ex.</p>
                                    <div class="date-time">27-07-2019, 1.03 PM</div>
                                </div>
                                <img class="rounded-circle ml-3" src="{{asset('admin/assets/img/user/u-xl-4.jpg')}}" alt="Image">
                            </div>
                        </div>
                        <form class="px-5 pb-3">
                            <input type="text" class="form-control mb-3" placeholder="Type your message here">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection