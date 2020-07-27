<template>
    <div class="holder">
        <a href="#" @click="setPage('menu')"><- Back to menu</a>
        <div v-if="user_set">
            <h2>Welcome, {{ user.name }} {{ user.surname }}!</h2>
            <order-pos v-for="(order, index) in orders" :key="index" :order="order" />
        </div>
        <div v-if="empty">
            <h2>Please place an order first!</h2>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import axios from 'axios'
    import OrderPos from './blocks/OrderPos'
    export default {
        name: "OrderList",
        components: {
            'order-pos': OrderPos
        },
        data() {
            return {
                user: {},
                orders: [],
                user_set: false,
                empty: false
            }
        },
        methods: {
            ...mapActions({
                setPage: 'setPage'
            }),
            async getUser() {
                let error = false, user = {}
                await axios.get('/api/orders/user').then( (data) => {
                    user = data.data
                }).catch( () => {
                    error = true
                })
                this.user = user
                this.empty = error
                if (Object.keys(this.user).length > 0) {
                    this.user_set = true
                    this.$emit('user-ready')
                }
            },
            async getOrders() {
                const data = await axios.get('/api/orders/list')
                this.orders = data.data
            }
        },
        mounted() {

            this.$on('user-ready', () => {
                this.getOrders()
            })
            this.getUser()
        }
    }
</script>

<style scoped>
    .holder {
        padding-top: 20px;
        padding-left: 20px;
    }
</style>