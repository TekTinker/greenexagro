@extends('templates.base')
@section('base')

    <div>
        <!-- Slider -->
        <div class="slider-area slider-image-career">
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->


    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                @include('partials.alert')
                <div class="col-md-offset-1 col-md-10">
                    <h1 class="sidebar-title" style="margin-top: 50px; margin-bottom: 20px;">Knowledge. Passion.
                        Success</h1>
                    <div style="margin-top: 20px; margin-bottom: 20px; text-align: justify;font-size: larger;font-family: Raleway, sans-serif;">

                        <p>
                            Champion Group thrives on diversity-diverse businesses, diverse locations and
                            diverse people. Yet, stays united by number of common factors. Our people come from
                            different areas and culture but they share the same value. These values unite our
                            people and drive their thoughts, actions and behavior with in the Champion
                            Group.
                        </p>
                        <p>

                            The company takes immense pride in its values and culture. The feeling of
                            belongingness that run far and deep in the Champion family, keep employee engagement
                            consistently high. It is an experience that is truly rare and magical – to work for
                            a company that is global in its reach and presence, and yet proudly Indian to the
                            core.
                        </p>
                        <p>

                            Once you become part of the Champion family and share its commitment and passion,
                            you will not only savour exponential growth but also receive an all rounded
                            exposure.
                        </p>
                        <p>

                            So, if you want to give your career a head start, come and join Champion Agro Ltd
                            and give your career the Champion touch!

                        </p>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-md-offset-1 col-md-10">
                    <h2 style="margin: 20px">Job Openings</h2>
                    <div>
                        <div class="panel panel-info"
                             style="margin: 30px; font-family: Raleway, sans-serif;">
                            <div class="panel-body">
                                <ul>
                                    @foreach($news as $event)
                                        <li style="font-size: larger; color: #2a6496; font-weight: 700">
                                            <a href="{{ route('news.details', ['id' => $event->id]) }}">
                                                {{$event->title}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div style="text-align: center">{!! $news->links() !!}</div>
                            </div>

                        </div>
                    </div>
                    <div style="text-align: center">{!! $news->links() !!}</div>

                </div>
            </div>
        </div>
    </div>

@stop