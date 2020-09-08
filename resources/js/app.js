require('./bootstrap');

$(document).ready(function() {

    $('.basket').on('click', function() {
        $('#productModal').modal();
        $('#productName').text($(this).attr('data-productName'));
        $('#productDescription').text($(this).attr('data-description'));
        $('#productPrice').text($(this).attr('data-price'));
        $('#productId').val($(this).attr('data-productId'));
        $('#quantity').val(1);
        console.log('modal opened');

        // $('#myInput').trigger('focus')
    });

    $('#addToBasket').on('click', function (e) {
        e.preventDefault();
        var productId = $('#productId').val();
        var quantity = $('#quantity').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: 'product/addToBasket',
            method: 'POST',
            data: {
                productId: productId,
                quantity: quantity
            },
            dataType: 'JSON',
            success: function (data) {
                $('#shoppingCartCounter').load(' #shoppingCartCounter');
                $('#productModal').modal('hide');

                console.log(data);
            }
        })

    });

        $('.spinner>.ns-btn>a, .spinner>.ns-btn-sml>a').on('click', function() {
        console.log('spinner');
            var btn = $(this),
                oldValue = btn.closest('.spinner').find('input').val().trim(),
                newVal = 0;

            // console.log($(this).closest('div').attr('class'));

            if (btn.attr('data-dir') === 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            btn.closest('.spinner').find('input').val(newVal);
            var div = $(this).closest('div');

            if (div.attr('class') === 'number-spinner-sml spinner') {
                var productId = div.attr('data-productId');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                console.log(newVal);

                jQuery.ajax({
                    url: 'product/quantityChange',
                    method: 'POST',
                    data: {
                        productId: productId,
                        quantity: newVal
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.success) {
                            console.log (data);
                            $('.pl-ns-value').load(' .pl-ns-value');
                            $('#shoppingCartCounter').load(' #shoppingCartCounter');
                            $('.prodTotal').load(' .prodTotal');
                            $('.totalRow').load(' .totalRow');

                            // $('.wrap').load(' .wrap');
                            // console.log(data);
                            return;
                        }
                        //
                        // location.reload();
                        // return;
                        //
                        // console.log(data);
                    }
                })
            }
        // });

        $('.spinner>input').keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }



            return true;
        });
    });

    // Remove product from shopping cart
    $('.remove_product').on('click', function() {
        var productId = $(this).attr('data-productId');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: 'product/' + productId + '/remove',
            method: 'GET',
            data: {
                productId: productId,
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.success) {
                    $('#shoppingCartCounter').load(' #shoppingCartCounter');
                    $('.wrap').load(' .wrap');
                    console.log(data);
                    return;
                }

                location.reload();
                return;

                console.log(data);
            }
        })
    });


});

