 <!-- Start Single Product -->
 <div class="single-product">
    <form method="post" action="{{route('carts.store')}}">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="hidden" name="quantity" value="1">
     <div class="product-image">
         {{-- <img src="{{asset('uploads/products/'.$product->image)}}" alt="#"> --}}
         <img src="{{ $product->image_url }}" alt="#">
         @if ($product->Sale_Percent)
             <span class="sale-tag">{{ $product->Sale_Percent }}%</span>
         @endif
         @if ($product->new)
             <span class="new-tag">new</span>
         @endif
         <div class="button">
             <button href="" type="submit" class="btn"> Add to
                 Cart</button>
         </div>
     </div>
     <div class="product-info">
         <span class="category">{{ $product->category->name ?? null  }}</span>
         <h4 class="title">
             <a href="{{ route('products.show', $product->slug) }}">{{ $product->name  }}</a>
         </h4>
         <ul class="review">
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star"></i></li>
             <li><span>4.0 Review(s)</span></li>
         </ul>
         <div class="price">
             <span>{{Currency::format($product->price) }}</span>
             @if ($product->compare_price)
                 <span class="discount-price">{{Currency::format($product->compare_price )}}</span>
             @endif
         </div>
     </div>
    </form>
 </div>
 <!-- End Single Product -->
