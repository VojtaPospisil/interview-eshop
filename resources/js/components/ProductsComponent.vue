<template>
    <div class="row p-5">
        <div class="col-lg-6 p-5 mb-3 product" v-for="product in products">
            <h2 class="pb-2 productDetail"><router-link :to="`/product/${product.id}`">{{ product.name }}</router-link></h2>
            <p>{{ product.description }}</p>
            <div class="heading cf none_border">
                <p class="price">{{ product.price }}</p>
                <a href="#" @click.prevent="addToCart(product.id)" class="continue basket">Do košíku</a>
            </div>
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
                products: [],
                loading: true
            }
        },

        mounted() {
            this.loadProducts();
        },

        methods: {
            loadProducts: function () {
                axios.get('/my_projects/interview_project/public/api/products')
                    .then((response) => {
                        this.products = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            addToCart(id) {
                let data = new Form({
                    productId: id
                });
                axios.post(`/my_projects/interview_project/public/api/addToCart`, data)
                    .then((response) => {
                        this.products = response.data.data;
                        Event.$emit('addToCart');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>


