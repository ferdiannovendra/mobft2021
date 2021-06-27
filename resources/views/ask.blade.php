@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                @foreach($status as $stat)
                {{ $stat->status }}
                    @if($stat->status == 'panitia')
                        <ul class="users">
                                @foreach($users as $user)
                                    <li class="user" id="{{ $user->nrp }}">
                                        {{--will show unread count notification--}}
                                        @if($user->unread)
                                            <span class="pending">{{ $user->unread }}</span>
                                        @endif

                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ $user->avatar }}" alt="" class="media-object">
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
                                    <li class="user" id="{{ $user->nrp }}">
                                        {{--will show unread count notification--}}
                                        @if($user->unread)
                                            <span class="pending">{{ $user->unread }}</span>
                                        @endif

                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ $user->avatar }}" alt="" class="media-object">
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
                @endforeach


                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection
