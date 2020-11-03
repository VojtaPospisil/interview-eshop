<template>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <router-link class="navbar-brand" to="/">Vue Frontpage</router-link>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                </div>
                <div>
                    <div class="heading cf none_border">
                        <router-link :to="`/shoppingCart`">
                            <a href="" class="continue">Nákupní košík
                                <img class="pl-1" id="shoping_cart" :src="'/my_projects/interview_project/public/images/icons/cart.svg'">
                                <span id="shoppingCartCounter">
                                    {{ totalItems }}
                                </span>
                            </a>
                        </router-link>
                    </div>
                </div>
                <div class="links heading cf none_border">
                    <div v-show="user" class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="pl-1" :src="'/my_projects/interview_project/public/images/icons/person.svg'">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <router-link :to="`/myOrders`">
                                <a class="dropdown-item" href="">Moje objednávky</a>
                            </router-link>
                            <a class="dropdown-item"  href="" @click.prevent="logout()">Odhlásit</a>
                        </div>
                    </div>

                    <div v-show="!user">
                        <router-link :to="`/login`">
                            <a href="">Login</a>
                        </router-link>
                        <router-link :to="`/register`">
                            <a href="">Register</a>
                        </router-link>
                    </div>
                </div>
            </nav>
        </header>

        <main role="main" class="container">
            <router-view />
        </main>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    import axios from "axios";

    export default {
        data: function () {
            return {
                totalItems: ''
            }
        },
        computed: {
            ...mapGetters("auth", ["user"])
        },
        mounted() {
            Event.$on('addToCart', () => {
                this.loadCartInfo();
            });

            if (localStorage.getItem("authToken")) {
                this.getUserData();
            }
            this.loadCartInfo();
        },
        methods: {
            ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),
            logout() {
                this.sendLogoutRequest();
                this.$router.push("/");
            },
            loadCartInfo: function () {
                console.log('cartItems');
                axios.get('/my_projects/interview_project/public/api/cartInfo')
                    .then((response) => {
                        this.totalItems = response.data.totalItems;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    };
</script>

<style>
    body > div > .container {
        padding: 60px 15px 0;
    }
</style>
