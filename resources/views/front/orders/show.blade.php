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


    <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        const location = { lat: {{$delivery->lat}}, lng: {{$delivery->lng}} };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: location,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });
        }

        window.initMap = initMap;
    </script>
    {{-- Api Key --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBeJUUirsqPWyLbO1pmw2Ivfm9huik01g&callback=initMap&v=weekly"
defer
></script>
    <!--====== Checkout Form Steps Part Ends ======-->
</x-front-layout >
