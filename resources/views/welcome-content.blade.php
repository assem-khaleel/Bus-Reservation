@extends('front-layout')
@section('welcome-content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                @if ( session('Status') )
                    <p>{{ session('Status') }}</p>
                @else
                    <p>Welcome to Bus ticket system</p>
                @endif
            </div>
        </div>
    </div>
@endsection