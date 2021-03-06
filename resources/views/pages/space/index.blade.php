@extends('layouts.app')

@section('content')
<div class="container">
    <x-space></x-space>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- SEARCH -->
            <div class="my-auto">
                <form class="d-flex active-cyan-3 active-cyan-4 mb-4" action="/space" method="get">
                    <input name="cari" class="form-control me-2" type="search" placeholder="Cari Lokasi" aria-label="Cari">
                    <!-- <button class="btn btn-primary" type="submit">Search</button> -->
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><span class="fas fa-search"></span></button>
                    </span>
                </form>
            </div>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @foreach ($spaces as $space)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $space->title }}
                        @if (Auth::user()->email == 'admin_adminipbyourmaps@gmail.com')
                        <form action="{{ route('space.destroy', $space->id) }}" method="post">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger float-right" onclick="return confirm('Hapus Lokasi?');">Delete</button>
                            <a href="{{ route('space.edit', $space->id) }}" class="btn btn-sm btn-info float-right text-white">Edit</a>
                        </form>
                        @endif
                        @if ($space->user_id == Auth::user()->id)
                        <form action="{{ route('space.destroy', $space->id) }}" method="post">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger float-right" onclick="return confirm('Hapus Lokasi?');">Delete</button>
                            <a href="{{ route('space.edit', $space->id) }}" class="btn btn-sm btn-info float-right text-white">Edit</a>
                        </form>
                        @endif
                    </h5>
                    <h6 class="card-subtitle">{{ $space->address }} </h6>
                    <p class="card-text">{{ $space->description }} </p>
                    <a href="#" onclick="openDirection({{ $space->latitude }}, {{ $space->longitude }}, {{ $space->id }})" class="card-link">Direction</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        {{ $spaces->links() }}
    </div>
</div>
@endsection