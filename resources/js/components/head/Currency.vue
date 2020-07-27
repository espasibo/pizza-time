<template>
    <div class="currency">
        <select v-model="selected" class="symbol" v-if="list">
            <option v-for="val in list" :key="val.slug" :value="val">{{ val.symbol }}</option>
        </select>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapState, mapActions } from 'vuex'
    export default {
        name: "Currency",
        methods: {
            ...mapActions({
                setCur: 'setCur'
            }),
            async getList() {
                const data = await axios.get('/api/currency/list')
                this.list = data.data
                this.selected = data.data[0]
            }
        },
        mounted() {
            this.getList()
        },
        data() {
            return {
                list: []
            }
        },
        computed: {
            ...mapState({
                cur: state => state.currency.cur
            }),
            selected: {
                get() {
                    return this.cur
                },
                set(value) {
                    this.setCur(value)
                }
            }
        }
    }
</script>

<style scoped>
    .currency {
        display: inline-block;
        padding-right: 20px;
    }
    .symbol {
        font-size: 18px;
    }
</style>