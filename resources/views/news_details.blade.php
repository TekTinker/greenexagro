@extends('templates.base')
@section('base')

    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                @include('partials.alert')
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div style="margin: 30px; font-family: Raleway, sans-serif;">
                                <h1 class="sidebar-title">{{ $single->title }}</h1>
                                <div style="text-wrap: normal;width: 80%">
                                    {!! htmlspecialchars_decode($single->notification) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop