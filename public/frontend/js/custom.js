$(document).ready(()=>{
    loadCart();loadWishlist();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart() { 
        $.ajax({
            type: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html(response.count);
            }
        });
    }
    function loadWishlist() { 
        $.ajax({
            type: "GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html(response.count);
            }
        });
    }

    $(document).on('click','.remove-cart-item',function (e) { 
        e.preventDefault();
        var prod_id=$(this).closest('.product_data').find('.prod_id').val();
        
        $.ajax({
            type: "POST",
            url: "/remove-cart-item",
            data: {
                'prod_id':prod_id,
            },
            success: function (response) {
                if(response.success==200){
                    $(".cartItems").load(location.href+" .cartItems");
                    // $(e.target).closest('.product_data').remove();
                    // swal.fire(response.status);
                    loadCart();

                }else{
                    swal.fire('error');
                }
            }
        });
    });
    $(document).on('click','.remove-wishlist-item',function (e) { 
        e.preventDefault();
        var prod_id=$(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            type: "POST",
            url: "/remove-wishlist-item",
            data: {
                'prod_id':prod_id,
            },
            success: function (response) {
                if(response.success==200){

                    $(".wishlistItems").load(location.href+" .wishlistItems");
                    swal.fire(response.status);
                    loadWishlist();
                }else{
                    swal.fire('error');
                }
            }
        });
    });

    // $('.plus').click(e=>{
    $(document).on('click','.plus',function (e) {
        e.preventDefault();
        var qty_inc=$(e.target).prev('input').val();
        var max=$(e.target).prev('input').attr('max');
        if(qty_inc<parseInt(max)){
            qty_inc++;
            $(e.target).prev('input').val(qty_inc);
        }
    });
    // $('.moins').click(e=>{
    $(document).on('click','.moins',function (e) {
        e.preventDefault();
        var qty_dec=$(e.target).next('input').val();
        if(qty_dec>1){
            qty_dec--;
            $('.moins').next('input').val(qty_dec);
        }
    })
    $(document).on('click','.changeQty',function (e) { 
        e.preventDefault();
        var prod_id=$(this).closest('.product_data').find('.prod_id').val();
        var prod_qty=$(this).closest('.product_data').find('.qty').val();
        var max=$(this).closest('.product_data').find('.qty').attr('max');
        if(prod_qty<=parseInt(max)){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/update-cart-item",
            data: {
                'prod_id':prod_id,
                'prod_qty':prod_qty
            },
            success: function (response) {
                if(response.success==200){
                    // window.location.reload();
                    $(".cartItems").load(location.href+" .cartItems");
                }else{
                    swal.fire('error');
                }
            }
        });}
    });
    $('.addToWishlistBtn').click(function (e) { 
        e.preventDefault();
        var product_id=$(this).closest('.product_data').find('.prod_id').val();
        
        $.ajax({
            type: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id':product_id
            },
            success: function (response) {
                swal.fire(response.status);
                loadWishlist();
            }
        });
        
    });
    $('.addToCartBtn').click(function(){
        var product_id=$(this).closest('.product_data').find('.prod_id').val();
        var product_qty=$(this).closest('.product_data').find('.qty').val();
        if(!product_qty){
            product_qty=1;
        }
        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                'product_id':product_id,
                'product_qty':product_qty
            },
            success: function (response) {
                swal.fire(response.status);
                loadCart();
            }
        });
    })


    // $('.plus').click(e=>{
    //     e.preventDefault();
    //     var qty=$('.qty').val();
    //     var max=$('.qty').attr('max');
    //     if(qty<max){
    //         qty++;
    //         $('.qty').val(qty);
    //     }
    // });
    // $('.moins').click(e=>{
    //     e.preventDefault();
    //     var qty=$('.qty').val();
    //     if(qty>1){
    //         qty--;
    //         $('.qty').val(qty);
    //     }
    // })
})