
<div class="cart-items ml-3" style="margin-right:20px !important">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-heart"></i>
        <span class="total-items">{{$items->count()}} </span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <ul class="shopping-list">
           @foreach ($items as  $item)

            <li>
                <a href="" data-id="{{$item->id}}" class="remove remove-item" title="Remove this item"><i
                        class="lni lni-close remove-item" ></i></a>
                {{-- <a class="remove-item " data-id="{{$item->id}}" href="javascript:void(0)"><i class="lni lni-close"></i></a> --}}


                <div class="cart-img-head">
                    <a class="cart-img" href="{{route('products.show',$item->product->slug)}}"><img
                            src="{{asset($item->product->image_url)}}" alt="#"></a>
                </div>

                <div class="content">
                    <h4><a href="{{route('products.show',$item->product->slug)}}">
                            {{$item->product->name}}</a></h4>
                    <p class="quantity"><span class="amount">{{Currency::format($item->product->price)}}</span></p>
                </div>
            </li>

            @endforeach
        </ul>

    </div>
    <!--/ End Shopping Item -->
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
    const csrf_token = "{{csrf_token()}}";

    (function($){

        $('.remove-item').on('click', function(e){
            let id = $(this).data('id');
            $.ajax({
            url:"/wishlist/" + id,
            method:"post",
            data: {
                _token: csrf_token
            }
            ,success: response =>{
                $(`#${id}`).remove();
                $( window ).load();
            }

        });
        });
    })(jQuery);
</script>
@endpush
