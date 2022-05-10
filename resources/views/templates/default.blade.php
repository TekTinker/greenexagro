@extends('templates.base')
@section('base')


    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                @include('partials.alert')
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

@stop