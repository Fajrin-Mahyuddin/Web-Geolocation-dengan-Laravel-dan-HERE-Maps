<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @stack('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <script>
        window.hereApiKey = "{{env('HERE_API_KEY')}}"
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                // localCoord = position.coords;
                // objLocalCoord = {
                //     lat: localCoord.latitude,
                //     lng: localCoord.longitude
                // }

                objLocalCoord = {
                    lat: -3.5424461,
                    lng: 118.9678788
                }

                // Initialize the platform object:
                let platform = new H.service.Platform({
                    'apikey': window.hereApiKey
                });

                // Obtain the default map types from the platform object
                let defaultLayers = platform.createDefaultLayers();

                // Instantiate (and display) a map object:
                let map = new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                        zoom: 10,
                        center: objLocalCoord,
                        pixelRatio: window.devicePixelRatio || 1
                    });

                    window.addEventListener('resize', () => { map.getViewPort().resize() } );

                    let ui = H.ui.UI.createDefault(map, defaultLayers);
                    let mapEvents = new H.mapevents.MapEvents(map);
                    let behavior = new H.mapevents.Behavior(mapEvents);

                    function addDragableMarker(map, behavior) {
                        let inputLatitude = document.getElementById('lat');
                        let inputLongitude = document.getElementById('lng');

                        if(inputLatitude.value !== '' && inputLongitude.value !== '') {
                            objLocalCoord = {
                                lat: inputLatitude.value,
                                lng: inputLongitude.value
                            }
                        };
                        let marker = new H.map.Marker(objLocalCoord, {
                            volatility: true
                        });

                        marker.draggable = true;
                        map.addObject(marker);

                        map.addEventListener('dragstart', function(e) {
                            let target = e.target,
                                pointer = e.currentPointer;
                            if(target instanceof H.map.Marker) {
                                let targetPosition = map.geoToScreen(target.getGeometry());
                                target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
                                behavior.disable();
                            }
                        }, false);

                        map.addEventListener('drag', function(e) {
                            let target = e.target,
                                pointer = e.currentPointer;
                            if(target instanceof H.map.Marker) {
                                target.setGeometry(
                                    map.screenToGeo(
                                        pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y
                                    )
                                );
                            }
                        }, false);

                        map.addEventListener('dragend', function(e) {
                            let target = e.target;
                            if(target instanceof H.map.Marker) {
                                let resultCoord = map.screenToGeo(
                                    e.currentPointer.viewportX,
                                    e.currentPointer.viewportY
                                )
                                inputLatitude.value = resultCoord.lat;
                                inputLongitude.value = resultCoord.lng;
                            }
                        }, false);

                    }

                    if(window.action === 'submit') {
                        addDragableMarker(map, behavior);
                    }
            })
        } else {
            console.log("gagal !");
        }
    </script>
    @stack('script')
</body>
</html>
