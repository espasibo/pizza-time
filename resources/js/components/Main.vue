<template>
    <div>
        <div class="header">
            <h2 class="logo">Pizza-Falafelizza!</h2>
            <div class="buttons">
                <currency />
                <user />
            </div>
        </div>
        <div class="heat">
            <div class="solid">
                <menu-grid v-if="page === 'menu'" />
                <order-list v-else-if="page === 'order-list'" />
                <order-form v-else-if="page === 'order-form'" />
            </div>
            <cart />
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Menu from './heat/Menu'
    import OrderList from './heat/OrderList'
    import OrderForm from './heat/OrderForm'
    import Cart from './heat/Cart'
    import Currency from './head/Currency'
    import User from './head/User'
    export default {
        name: "Main",
        components: {
            'currency': Currency,
            'user': User,
            'menu-grid': Menu,
            'order-list': OrderList,
            'order-form': OrderForm,
            'cart': Cart
        },
        computed: {
            ...mapState({
                page: state => state.page.page,
                cart: state => state.cart.cart
            })
        }
    }
</script>

<style scoped>

    .header {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 2;
        background-color: #ffffff;
        border-bottom: 1px solid;
    }
    .logo {
        display: inline-block;
    }
    .buttons {
        float: right;
        padding-right: 50px;
        padding-top: 20px;
        display: inline-block;
    }
    .solid {
        width: 69%;
        display: inline-block;
    }
    .heat {
        padding-top: 50px;
    }
</style>