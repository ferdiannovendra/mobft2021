@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    @foreach($data as $dat)
                    <br>
                    Nama Lengkap : {{ $dat->name }}
                    <br>
                    NRP : {{ $dat->nrp }}
                    <br>
                    Divisi : {{ $dat->divisi }}
                    <br>
                    Email : {{ $dat->email }}
                    <br>
                    Status : {{ $dat->status }}
                    <hr>
                    @if ($dat->divisi=="MAPING")
                    Kelompok Alpha : {{ $dat->alpha }}
                    <br>
                    Kelompok Beta : {{ $dat->beta }}
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
