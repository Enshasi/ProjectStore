$('.quantity-item').on('change' , function(e){

    $.ajax({
       url:"/cart/"+$(this).data('id'),
       method:'put',
       data:{
        quantity:$(this).val(),
        _token:csrf_token,
       }
    });
});
$('.remove-item').on('click' , function(e){
    const id = $(this).data('id')
    $.ajax({
       url:"/cart/"+id,
       method:'delete',
       data:{
        _token:csrf_token,
       },success:response => {

           $(`#${id}`).remove()
       }

    });
});
$('.add-to-cart').on('click' , function(e){

    $.ajax({
       url:"/cart/",
       method:'post',
       data:{
        product_id:$(this).data('product'),
        quantity:1,
        _token:csrf_token,


    },success:response => {
        window.location.reload()
    }

    });
});
