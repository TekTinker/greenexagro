@extends('templates.base')
@section('base')

    <div>
        <!-- Slider -->
        <div class="slider-area slider-image">
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                @include('partials.alert')
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div style="margin: 30px; font-family: Raleway, sans-serif;">
                                <p style="margin-top: 20px; margin-bottom: 20px; text-align: justify;font-size: medium">

                                    Greenex Agro Chemicals belongs to the fertilizers sector of India and was
                                    incorporated
                                    in 2014.
                                    It forms an important private sector fertilizer industry in India.
                                    <br><br>
                                    The company’s manufacturing plant is situated at village Shahajatpur in Maharashtra
                                    Fertilizers have helped in increasing the agricultural produce of the country, for
                                    they
                                    have elements which increase the growth of the crops.
                                    <br><br>
                                    Greenex Agro Chemicals has a major role to play in boosting not only the performance
                                    of
                                    India’s agricultural sector but also the economy as well....
                                    <a href="{{ route('about_us') }}">Read more</a>


                                </p>
                                <br>
                                <br>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <div>
                                    <div class="panel panel-info"
                                         style="margin: 30px; font-family: Raleway, sans-serif;">
                                        <div class="panel-heading">News</div>
                                        <div class="panel-body">
                                            <ul>
                                                @foreach($news as $event)
                                                    <li style="font-size: medium; color: #2a6496">
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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div style="margin: 30px; font-family: Raleway, sans-serif;">
                                <h5 class="sidebar-title" style="margin-bottom: 5px">Our Values</h5>
                                <ul style="text-align: justify;font-size: medium;margin: 20px">
                                    <li>People</li>
                                    <li>Customer Success</li>
                                    <li>Operational Excellence</li>
                                    <li>Citizenship and Stewardship</li>
                                    <li>Innovation</li>
                                    <li>Ethics and Integrity</li>
                                </ul>

                                <h5 class="sidebar-title" style="margin-bottom: 5px; margin-top: 45px">Our Mission</h5>
                                <p style="margin-top: 20px; margin-bottom: 20px; text-align: justify;font-size: medium">
                                    To contribute to the success of our customers and employees by investing in the best
                                    people and technology and offering the best products to enhance the return on
                                    investment for our customers and shareholders.

                                </p>

                                <h5 class="sidebar-title" style="margin-bottom: 5px; margin-top: 45px">Our Vision</h5>
                                <p style="margin-top: 20px; margin-bottom: 20px; text-align: justify;font-size: medium">
                                    To be the first-in-class agriculture distribution organization, and provide
                                    agronomic solutions to customers in all major agricultural regions.

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop