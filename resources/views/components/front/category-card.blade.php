
    <!-- Start Single Category -->
    <div class="single-category">
        <h3 class="heading">{{$category->name}}</h3>
        <ul>
            @foreach ($category->child()->get() as $child )

            <li><a href="product-grids.html">{{$category->name}}</a></li>

            @endforeach

        </ul>
        <div class="images">
            <img src="{{$category->image_url}}" width="120px" height="120px"  alt="#">
        </div>
    </div>
    <!-- End Single Category -->
