<x-front-layout title="Order Details">
    <x-slot:breadcrumbs>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Order # {{$order->number}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{route('products.index')}}">
                            Orders
                        </a></li>
                        <li>Order # {{$order->number}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-slot:breadcrumbs>

    <!--====== Checkout Form Steps Part Start ======-->

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <!--The div element for the map -->
                <div id="map" style="height: 80vh"></div>
            </div>
        </div>
    </section>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var map , marker ;
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('a180a4ab8b95e2bf0f7b', {
          cluster: 'ap2',
          //Private channel auth
          channelAuthorization: {
            endpoint: "/broadcasting/auth",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            }
          }
        });

        // var channel = pusher.subscribe('deliveries'); //Public
        var channel = pusher.subscribe('private-deliveries.{{$order->id}}'); //Public
        channel.bind('location-updated', function(data) {
            marker.setPosition({lat:Number(data.lat), lng: Number(data.lng)});
        });
      </script>
    <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        const location = { lat: Number("{{$delivery->lat}}"), lng: Number("{{$delivery->lng}}") };
        // The map, centered at Uluru

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: location,
        });
        // The marker, positioned at Uluru
        marker  = new google.maps.Marker({
            position: location,
            map: map,
        });
        };
        window.initMap = initMap;
    </script>
    {{-- Api Key --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZzoA89QbJeqj91FYC7cuAB8cKcMSLuY0&callback=initMap&v=weekly"
    defer
    ></script>
    <!--====== Checkout Form Steps Part Ends ======-->
</x-front-layout >
