<header class="header navbar-fixed-top" style="background-color: #fff;">
    <!-- Navbar -->
    <nav class="navbar navbar-awhite" role="navigation">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container js_nav-item">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="logo logo-blog">
                    <a class="logo-wrap" href="{{route('index')}}">
                        <img class="logo-img logo-img-main" src="{{asset('assets_site/img/logo_136x37.png')}}" alt="Imooby Logo">
                        <img class="logo-img logo-img-active" src="{{asset('assets_site/img/logo_136x37.png')}}" alt="Imooby Logo">
                    </a>
                    <a href="{{ route('blog.index') }}"><div class="blog">BLOG</div></a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav navbar-nav-right">
                    <li>
                        {{Form::open(['route' => 'blog.searchPost', 'method' => 'GET'])}}
                        <div class="row row-search">
                        <div class="cm col-sm-8">
                            <input type="text" name="q" class="form-control" placeholder="Procurar postagens">
                            </div>
                            <div class="cm col-sm-4">
                                <input type="submit" class="btn btn-success btn-block btn-lg" value="BUSCAR" style="height: 50px;font-size: 0.90em;border-radius:0">
                            </div>
                        </div>
                        {{ Form::close() }}
                    </li>
                        <li>
                        <div class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle text-muted nav-item-child nav-item-hover">Categorias <b
                                            class="caret"></b></a>
                                <ul class="dropdown-menu" style="border-radius: 0px;">
                                    @foreach(App\Models\Blog\Category::getAll() as $category)
                                    <li><a href="{{ $category->url() }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->


        </div>
    </nav>
    <!-- Navbar -->
</header>