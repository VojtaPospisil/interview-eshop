<template>
    <div class="product-section container">
        <div>
            <div class="product-section-image">
                <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="product" class="active" id="currentImage">
            </div>
            <div class="product-section-images">
                <div class="product-section-thumbnail selected">
                    <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="product">
                </div>
            </div>
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ product.name }}</h1>
            <div class="product-section-price">{{ product.price }}</div>

            <p>{{ product.description }}</p>

            <p>&nbsp;</p>

            <form method="" action="">
                <div class="form-row align-items-center">
                    <input id="productId" type="hidden" value="">
                    <div class="number-spinner spinner">
                <span class="ns-btn">
                    <a @click="decrease()" data-dir="dwn"><span class="icon-minus"></span></a>
                </span>
                        <input v-model="quantity" v-on:change="checkValue()" id="quantity" type="text" class="pl-ns-value" maxlength=4>
                        <span class="ns-btn">
                    <a @click="increase()" data-dir="up"><span class="icon-plus"></span></a>
                </span>
                    </div>
                    <input id="addToBasket" @click="addToCart()" type="button" class="number-submit" value="Koupit">
                </div>
            </form>


<!--            <product-detail-component product_id={{ $product->id }}></product-detail-component>-->
        </div>
    </div>








</template>

<script>
    import Form from "../form";
    window.Form;

    export default {
        props: ['productid'],
        data: function () {
            return {
                product: [],
                quantity: 1,
                id: this.$route.params.id
            }
        },

        mounted() {
            this.loadProduct();
        },

        methods: {
            loadProduct: function() {
                axios.get(`/my_projects/interview_project/public/api/product/${this.$route.params.id}`)
                    .then((response)=>{
                        this.product = response.data.data;
                    }).catch(function (error) {
                    console.log(error);
                });
            },

            checkValue() {
                if (this.quantity <= 0) {
                    this.quantity = 1;
                }

                if (this.quantity > 1000) {
                    this.quantity = 1000;
                }
            },

            increase() {
                if (this.quantity < 1000) {
                    this.quantity ++;
                }
            },

            decrease() {
                if (this.quantity > 1) {
                    this.quantity --;
                }
            },

            addToCart() {
                let data = new Form({
                    productId: this.id,
                    quantity: this.quantity
                });
                axios.post(`/my_projects/interview_project/public/api/addToCart`, data)
                    .then((response) => {
                        this.products = response.data.data;
                        this.cartInfo = true;
                        this.quantity = 1;
                        Event.$emit('addToCart');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
