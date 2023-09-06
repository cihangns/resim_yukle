@extends('layouts.app')


@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Hoşgeldiniz') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    @php
                        $username = Auth::user()->name;
                    @endphp
                {{ __("Merhaba ".$username."!") }}
            </div>
        </div>
    </div>
</div>
@endsection
