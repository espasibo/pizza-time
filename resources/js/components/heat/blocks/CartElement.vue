<template>
    <div class="cartelement">
        <span>{{ elem.name }} x{{ elem.quantity }}</span>
        <span>{{ getPrice() }} {{ cur.symbol }}</span>
        <button @click="addToCart(elem)">+</button>
        <button @click="removeFromCart(elem)">-</button>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    export default {
        name: "CartElement",
        props: {
            elem: {
                type: Object,
                required: true
            }
        },
        computed: {
            ...mapState({
                cur: state => state.currency.cur
            })
        },
        methods: {
            ...mapActions({
                addToCart: 'addToCart',
                removeFromCart: 'removeFromCart'
            }),
            getPrice() {

                let price
                let cur = this.cur.slug
                this.elem.prices.some((item) => {
                    if (item.currency === cur) {
                        return price = item.value
                    }
                })
                return price * this.elem.quantity
            }
        }
    }
</script>

<style scoped>
    .cartelement {
        padding-top: 10px;
    }
</style>