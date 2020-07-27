<template>
    <div class="user">
        <a href="#" class="orderlist" @click="setPage('order-list')">Order History</a>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    export default {
        name: "User",
        methods: {
            ...mapActions({
                setPage: 'setPage'
            })
        }
    }
</script>

<style scoped>
    .user {
        padding-right: 20px;
        display: inline-block;
        height: 100%;
    }
    .orderlist {
        height: 100%;
    }
</style>