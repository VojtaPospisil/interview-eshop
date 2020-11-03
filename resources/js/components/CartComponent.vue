<template>
    <div v-if="!loading && empty" class="wrap cf">
        <div id="empty_basket">
            <h1>Váš košík je prázdný</h1>
        </div>
    </div>

    <div v-else-if="!loading && !empty" class="wrap cf">
        <div class="heading cf">
            <h1>Můj košík</h1>
            <router-link :to="`/`">
                <a href="" class="continue basket">Pokračovat v nákupu</a>
            </router-link>
        </div>


        <div class="cart">
            <ul class="cartWrap">
                <p></p>
    <!--            @if($loop->even)-->
    <!--            <li class="items even">-->
    <!--                @else-->
    <!--            <li class="items odd">-->
    <!--                @endif-->

                <li class="items" v-for="product in cartProducts">
                    <div class="infoWrap">
                        <div class="cartSection">
                            <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
                            <h3>
                                <a href="">
                                    <router-link :to="`/product/${product.productId}`">{{ product.productName }}</router-link>
                                </a>
                            </h3>
                            <div class="number-spinner-sml">
                                <span class="ns-btn-sml">
                                    <a @click="decrease(product.productId, product.productQuantity)" data-dir="dwn"><span class="icon-minus-sml"></span></a>
                                </span>
                                <input @change="changeQuantity(product.productId, $event.target.value)" type="text" class="pl-ns-value" :value="product.productQuantity" min="1" maxlength=6>
                                <span class="ns-btn-sml">
                                    <a @click="increase(product.productId, product.productQuantity)" data-dir="up"><span class="icon-plus-sml"></span></a>
                                </span>
                            </div>
                            <div>
                                <p> x {{ product.productPrice }}</p>
                            </div>
    <!--                        <p class="stockStatus"> In Stock</p>-->
                        </div>

                        <div class="prodTotal cartSection">
                            <p>{{ product.totalProductPrice }}</p>
                        </div>
                        <div class="cartSection removeWrap">
                            <a @click="remove(product.productId)" class="remove_product" :productId="product.id">x</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="promoCode">
            <label for="promo">Have A Promo Code?</label>
            <input type="text" name="promo" placholder="Enter Code" />
            <a href="#" class="btn"></a>
        </div>

        <div class="subtotal cf">
            <ul>
                <li class="totalRow final"><span class="label">Celková cena</span><span id="totalValue" class="value">{{ totalPrice }}</span></li>
                <div class="heading cf">
                    <li class="totalRow">
                        <a v-show="user" href="" @click.prevent="placeOrder()" class="continue">Odeslat objednávku</a>
                        <router-link v-show="!user" :to="`/login`">
                            <a href="#" class="continue">Odeslat objednávku</a>
                        </router-link>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>

    import Form from '../form';
    import axios from "axios";
    import {mapGetters, mapActions} from "vuex";
    window.Form;

    export default {
        data: function () {
            return {
                cartProducts: [],
                loading: true,
                totalPrice: '',
                empty: true
            }
        },
        computed: {
            ...mapGetters("auth", ["user"])
        },

        mounted() {
            if (localStorage.getItem("authToken")) {
                this.getUserData();
            };
            this.loadProducts();
        },

        methods: {
            ...mapActions("auth", ["getUserData"]),

            placeOrder: function() {
                axios.get('/my_projects/interview_project/public/api/placeOrder')
                    .then((response) => {
                        this.$router.push('/orderOverview');
                        Event.$emit('addToCart');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadProducts: function () {
                axios.get('/my_projects/interview_project/public/api/cart')
                    .then((response) => {
                        this.cartProducts = response.data.products;
                        this.totalPrice = response.data.totalPrice;
                        this.loading = false;
                        if (response.data.products.length > 0) {
                            this.empty = false;
                        } else {
                            this.empty = true;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            increase(id, quantity) {
                if (quantity < 1000) {
                    this.productChangeQuantity(id, quantity + 1);
                }
            },

            decrease(id, quantity) {
                if (quantity > 1) {
                    this.productChangeQuantity(id, quantity - 1);
                }
            },

            changeQuantity(id, quantity) {
                if (quantity >= 1 && quantity <= 1000) {
                    this.productChangeQuantity(id, parseInt(quantity));
                } else {
                    this.$forceUpdate();
                }
            },

            productChangeQuantity: function(id, quantity) {
                console.log(quantity);
                let data = new Form({
                    productId: id,
                    quantity: quantity
                });
                axios.post(`/my_projects/interview_project/public/api/changeQuantity`, data)
                    .then((response) => {
                        this.cartProducts = response.data.products;
                        this.totalPrice = response.data.totalPrice;
                        Event.$emit('addToCart');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            remove(id) {
                let data = new Form({
                    productId: id
                });
                axios.post(`/my_projects/interview_project/public/api/removeFromCart`, data)
                    .then((response) => {
                        this.cartProducts = response.data.products;
                        this.totalPrice = response.data.totalPrice;
                        this.cartInfo = true;
                        Event.$emit('addToCart');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
