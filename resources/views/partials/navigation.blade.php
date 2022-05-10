<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>


            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                    <div class="dropdown">
                        <li id="nav-bar-about" {{ Request::route()->getName() == 'about_us' ? 'class = active' : ''}}><a
                                    href="{{ route('about_us') }}">About Us</a></li>
                    </div>

                    <div class="dropdown">

                        <li id="nav-bar-home" {{ Request::route()->getName() == 'home' ? 'class = active' : ''}}><a
                                    href="{{ route('home') }}">Home</a></li>
                    </div>

                    <div class="dropdown">
                        <li id="nav-bar-products" {{ Request::route()->getName() == 'products' ? 'class = active' : ''}}>
                            <a
                                    href="{{ route('products', ['cat' => 'all']) }}">Products</a>
                        </li>
                        <div class="dropdown-content">
                            @foreach($category_product as $cat)
                                <a href='{{route('products', ['cat' => $cat->id])}}'>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>


                    <div class="dropdown">
                        <li id="nav-bar-raw" {{ Request::route()->getName() == 'raw_materials' ? 'class = active' : ''}}>
                            <a
                                    href="{{ route('raw_materials', ['cat' => 'all']) }}">Raw Material</a></li>

                        <div class="dropdown-content">
                            @foreach($category_raw as $cat)
                                <a href='{{route('raw_materials', ['cat' => $cat->id])}}'>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="dropdown">
                        <li id="nav-bar-crop" {{ Request::route()->getName() == 'crops' ? 'class = active' : ''}}><a
                                    href="{{ route('crops', ['cat' => 'all']) }}">Crop Info</a></li>

                        <div class="dropdown-content">
                            @foreach($category_crop as $cat)
                                <a href='{{route('crops', ['cat' => $cat->id])}}'>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>

                    </div>

                    <div class="dropdown">

                        <li id="nav-bar-career" {{ Request::route()->getName() == 'career' ? 'class = active' : ''}}><a
                                    href="{{ route('career') }}">Career</a></li>

                    </div>

                    <div class="dropdown">
                        <li id="nav-bar-contact" {{ Request::route()->getName() == 'contact_us' ? 'class = active' : ''}}>
                            <a
                                    href="{{ route('contact_us') }}">Contact US</a></li>

                    </div>


                </ul>
                <div style="padding: 10px; text-align: right">
                    <form class="form-inline" action="{{ route('product.search') }}">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button class="btn btn-default"><span class="fa fa-search"></span></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
