/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import Form from './form';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('products-component', require('./components/ProductsComponent.vue').default);
Vue.component('product-detail-component', require('./components/ProductDetailComponent.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);

import Router from './router.js';
import store from './Auth/index.js';
import App from './components/Auth/AppComponent';
import axios from "axios";
import main from './main';

Vue.config.productionTip = false;
axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 422) {
            store.commit("setErrors", error.response.data.errors);
        } else if (error.response.status === 401) {
            store.commit("auth/setUserData", null);
            localStorage.removeItem("authToken");
            router.push({ name: "Login" });
        } else {
            return Promise.reject(error);
        }
    }
);

axios.interceptors.request.use(function(config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem("authToken")}`,
        "Content-Type": "application/json",
        Accept: "application/json"
    };

    return config;
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router: Router,
    store,
    render: h => h(App)
}).$mount("#app");
// });

// window.EventBus = new Vue();

$(document).ready(function() {

    $('.productDetail').click( function(e) {
        e.preventDefault()
    });

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

    // $('#addToBasket').on('click', function (e) {
    //     e.preventDefault();
    //     var productId = $('#productId').val();
    //     var quantity = $('#quantity').val();
    //
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //
    //     jQuery.ajax({
    //         url: 'product/addToBasket',
    //         method: 'POST',
    //         data: {
    //             productId: productId,
    //             quantity: quantity
    //         },
    //         dataType: 'JSON',
    //         success: function (data) {
    //             $('#shoppingCartCounter').load(' #shoppingCartCounter');
    //             // $('#productModal').modal('hide');
    //             // $('body').removeClass('modal-open');
    //             // $('.modal-backdrop').remove();
    //             console.log('modalclose');
    //         }
    //     })
    //
    // });

    // $('.spinner>.ns-btn>a, .spinner>.ns-btn-sml>a').on('click', function() {
    //     console.log('spinner');
    //     var btn = $(this),
    //         oldValue = btn.closest('.spinner').find('input').val().trim(),
    //         newVal = 0;
    //
    //     // console.log($(this).closest('div').attr('class'));
    //
    //     if (btn.attr('data-dir') === 'up') {
    //         newVal = parseInt(oldValue) + 1;
    //     } else {
    //         if (oldValue > 1) {
    //             newVal = parseInt(oldValue) - 1;
    //         } else {
    //             newVal = 1;
    //         }
    //     }
    //     btn.closest('.spinner').find('input').val(newVal);
    //     var div = $(this).closest('div');
    //
    //     if (div.attr('class') === 'number-spinner-sml spinner') {
    //         var productId = div.attr('data-productId');
    //
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         console.log(newVal);
    //
    //         jQuery.ajax({
    //             url: 'product/quantityChange',
    //             method: 'POST',
    //             data: {
    //                 productId: productId,
    //                 quantity: newVal
    //             },
    //             dataType: 'JSON',
    //             success: function (data) {
    //                 if(data.success) {
    //                     console.log (data);
    //                     $('.pl-ns-value').load(' .pl-ns-value');
    //                     $('#shoppingCartCounter').load(' #shoppingCartCounter');
    //                     $('.prodTotal').load(' .prodTotal');
    //                     $('.totalRow').load(' .totalRow');
    //
    //                     // $('.wrap').load(' .wrap');
    //                     // console.log(data);
    //                     return;
    //                 }
    //                 //
    //                 // location.reload();
    //                 // return;
    //                 //
    //                 // console.log(data);
    //             }
    //         })
    //     }
    //     // });
    //
    //     $('.spinner>input').keypress(function(evt) {
    //         evt = (evt) ? evt : window.event;
    //         var charCode = (evt.which) ? evt.which : evt.keyCode;
    //         if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    //             return false;
    //         }
    //
    //
    //
    //         return true;
    //     });
    // });

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

    // slide down okno pro detail nabidky
    $(".orderDetail").click(function(e){
        e.preventDefault();
        $(this).closest(".tableDetail").find('.orderDetailTable').slideToggle("slow");
    });

    $("#dropdownMenuLink").click(function() {
        $(".dropdown-menu").slideToggle("slow");
    });

});
