<template>
    <div class="block">
        <p>Address: {{ order.address }}</p>
        <button @click="toggleOpen()">{{ !open ? 'Show' : 'Hide' }} List</button>
        <div v-if="open">
            <div v-for="(product, index) in order.products_full" :key="index">
                <span>{{ product.name }} x{{ product.quantity }} {{ product.prices[0].value }} {{ order.currency_obj.symbol }}</span>
            </div>
        </div>
        <div>
            <b>Total:</b> <span>{{ order.total }} {{ order.currency_obj.symbol }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderPos",
        props: {
            order: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                open: false
            }
        },
        methods: {
            toggleOpen() {
                this.open = !this.open
            }
        }
    }
</script>

<style scoped>
    .block {
        padding-top: 20px;
    }
</style>