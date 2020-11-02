@extends('layouts.app')

@section('content')
    <div class="container">
        <x-space></x-space>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Space') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('This is space list page.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
