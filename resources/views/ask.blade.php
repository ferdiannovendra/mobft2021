@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                {{ Auth::user()->status }}
                    @if(Auth::user()->status == 'panitia')
                        <ul class="users">
                                @foreach($users as $user)
                                    <li class="user" id="{{ $user->id }}">
                                        {{--will show unread count notification--}}
                                        @if($user->unread)
                                            <span class="pending">{{ $user->unread }}</span>
                                        @endif

                                        <div class="media">
                                            <div class="media-left">
                                                <img src="https://toppng.com/uploads/preview/app-icon-set-login-icon-comments-avatar-icon-11553436380yill0nchdm.png" alt="" class="media-object">
                                            </div>

                                            <div class="media-body">
                                                <p class="name">{{ $user->name }}</p>
                                                <p class="email">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                    @else
                            <ul class="users">
                                @foreach($panitia as $user)
                                    <li class="user" id="{{ $user->id }}">
                                        {{--will show unread count notification--}}
                                        @if($user->unread)
                                            <span class="pending">{{ $user->unread }}</span>
                                        @endif

                                        <div class="media">
                                            <div class="media-left">
                                                <img src="https://toppng.com/uploads/preview/app-icon-set-login-icon-comments-avatar-icon-11553436380yill0nchdm.png" alt="" class="media-object">
                                            </div>

                                            <div class="media-body">
                                                <p class="name">{{ $user->name }}</p>
                                                <p class="email">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                    @endif

                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection
