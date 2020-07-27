<template>
    <div class="holder">
        <a href="#" @click="setPage('menu')"><- Back to menu</a>
        <h2>Fill out the form please!</h2>
        <div class="form">
            <div v-if="!user">
                <div class="row">
                    <label class="textlabel" for="name">Name</label>
                    <input class="textinput" type="text" placeholder="Name" id="name" v-model="name">
                </div>
                <div class="row">
                    <label class="textlabel" for="surname">Surname</label>
                    <input class="textinput" type="text" placeholder="Surname" id="surname" v-model="surname">
                </div>
                <div class="row">
                    <label class="textlabel" for="email">Email</label>
                    <input class="textinput" type="email" placeholder="Email" id="email" v-model="email">
                </div>
                <div class="row">
                    <label class="textlabel" for="password">Password</label>
                    <input class="textinput" type="password" placeholder="Password" id="password" v-model="password">
                </div>
            </div>
            <div class="row">
                <label class="textlabel" for="address">Address</label>
                <input class="textinput" type="text" placeholder="Address" id="address" v-model="address">
            </div>
            <div v-if="ready" class="row">
                <button @click="submit()">Submit</button>
            </div>
            <b v-if="error">We're sorry, there has been an error</b>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import axios from 'axios'
    export default {
        name: "OrderForm",
        data() {

            return {
                name: '',
                surname: '',
                email: '',
                password: '',
                address: '',
                error: false,
                user: 0
            }
        },
        computed: {
            ...mapState({
                cart: state => state.cart.cart,
                cur: state => state.currency.cur
            }),

            ready() {
                let vals, self = this, ready = true

                if (!this.user) {
                    vals = ['name', 'surname', 'email', 'password', 'address']
                } else {
                    vals = ['address']
                }

                vals.some((value) => {
                    if (self[value].length === 0) {
                        return ready = false
                    }
                })
                if (Object.keys(this.cart).length === 0) {
                    ready = false
                }
                return ready
            }
        },
        methods: {
            ...mapActions({
                setPage: 'setPage',
                emptyCart: 'emptyCart'
            }),
            async submit() {

                let products = [], c_cart = this.cart, currency = this.cur.slug

                Object.keys(this.cart).forEach((key) => {

                    for (let i = 0; i < c_cart[key].quantity; i++) {
                        products.push(parseInt(key))
                    }
                })

                await axios.post('/api/orders/save', {
                    name: this.name,
                    surname: this.surname,
                    email: this.email,
                    password: this.password,
                    address: this.address,
                    currency: currency,
                    products: products
                }).then( () => {

                    this.emptyCart()
                    this.setPage('order-list')
                }).catch( () => {

                    this.error = true
                })
            },

            getUser() {

                let cookie = decodeURIComponent(document.cookie),
                    user_id, split

                cookie.split(';').some((value) => {
                    split = value.split('=')
                    if (split[0].trim(' ') === 'user_id') {
                        return user_id = split[1]
                    }
                })

                return user_id
            }
        },
        mounted() {
            console.log('started')
            this.user = this.getUser()
            console.log(this.user)
        }
    }
</script>

<style scoped>
    .row {
        padding-top: 20px;
    }
    .textinput {
        padding-left: 15px;
        float: right;
    }
    .textlabel {
        width: 50px;
    }
    .form {
        width: 50%;
        padding-left: 20px;
    }
    .holder {
        padding-top: 20px;
    }
</style>