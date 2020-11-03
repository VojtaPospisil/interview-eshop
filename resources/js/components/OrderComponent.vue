<template>
    <div class="wrap cf">
    <div class="heading cf">
        <h1>Přehled objednávky {{ order.created_at }}</h1>
    </div>


    <div class="cart">
        <ul class="cartWrap">
            <p></p>
            <li class="items" v-for="product in order.product_order">
                <div class="infoWrap">
                    <div class="cartSection">
                        <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                        <h3>
                            <a href="">
                                <router-link :to="`/product/${product.id}`">{{ product.name }}</router-link>
                            </a>
                        </h3>
                    </div>
                    <div>
                        <p>{{ product.quantity }} Ks</p>
                    </div>
                    <div class="prodTotal cartSection">
                        <p>{{ product.products_price }}</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="subtotal cf">
        <ul>
            <li class="totalRow final"><span class="label">Celková cena</span><span id="totalValue" class="value">{{ order.total_price }}</span></li>
            <div class="heading cf">
            </div>
        </ul>
    </div>
</div>
</template>

<script>

    import Form from '../form';
    import axios from "axios";
    window.Form;

    export default {
        data: function () {
            return {
                order: []
            }
        },

        mounted() {
            this.placeOrder();
        },

        methods: {
            placeOrder: function () {
                axios.get('/my_projects/interview_project/public/api/orderOverview')
                    .then((response) => {
                        this.order = response.data.order;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
