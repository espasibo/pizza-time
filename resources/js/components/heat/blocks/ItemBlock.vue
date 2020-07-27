<template>
    <div class="menuitem">
        <img :src="item.img" class="image">
        <h4>{{ item.name }}</h4>
        <p class="descr">{{ item.description }}</p>
        <span v-if="cur">{{ getPrice() }} {{ cur.symbol }}</span>
        <button @click="addToCart(item)">+</button>
        <button @click="removeFromCart(item)">-</button>
        <span v-if="cart[item.id]"> x{{ cart[item.id].quantity }}</span>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    export default {
        name: "ItemBlock",
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        methods: {
            ...mapActions({
                addToCart: 'addToCart',
                removeFromCart: 'removeFromCart'
            }),
            getPrice() {
                let price
                let cur = this.cur.slug
                this.item.prices.some((item) => {
                    if (item.currency === cur) {
                        return price = item.value
                    }
                })
                return price
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
                inCart: false
            }
        }
    }
</script>

<style scoped>
    .menuitem {
        display: inline-block;
        width: 30%;
        padding-left: 20px;
        vertical-align: top;
    }
    .descr {
        padding-top: 10px;
    }
    .image {
        padding-bottom: 20px;
        height: 200px;
    }

</style>