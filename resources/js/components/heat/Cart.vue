<template>
    <div class="cart">
        <h3>Cart</h3>
        <cart-element v-for="element in cart" :key="element.id" :elem="element" />
        <div class="total" v-if="Object.keys(cart).length > 0">
            <span>+ {{ getDeliveryPrice() }} {{ cur.symbol }} Delivery</span>
            <div>
                <b>Total: </b><span>{{ getTotal() }} {{ cur.symbol }} </span><button @click="setPage('order-form')">Place Order</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import axios from 'axios'
    import CartElement from './blocks/CartElement'
    export default {
        name: "Cart",
        components: {
            'cart-element': CartElement
        },
        methods: {
            ...mapActions({
                setPage: 'setPage'
            }),
            async getDelivery() {
                const data = await axios.get('/api/products/service')
                this.delivery = data.data.prices
            },
            getDeliveryPrice() {
                let cur = this.cur.slug
                let price
                this.delivery.some((item) => {
                    if (item.currency === cur) {
                        return price = item.value
                    }
                })
                return price
            },
            getTotal() {
                let total = 0.00
                let cur = this.cur.slug
                let c_cart = this.cart
                Object.keys(this.cart).forEach((key) => {
                    let price = 0
                    c_cart[key].prices.some((item) => {
                        if (item.currency === cur) {
                            return price = parseFloat(item.value) * 100
                        }
                    })
                    total += price * parseInt(c_cart[key].quantity)
                })
                total += parseFloat(this.getDeliveryPrice()) * 100
                return total / 100
            }
        },
        computed: {
            ...mapState({
                cur: state => state.currency.cur,
                cart: state => state.cart.cart
            })
        },
        data() {
            return {
                delivery: [],
                cartReady: false
            }
        },
        mounted() {
            this.getDelivery()
        }
    }
</script>

<style scoped>
    .cart {
        width: 30%;
        display: inline-block;
        vertical-align: top;
    }
    .total {
        padding-top: 10px;
    }
</style>