<template>
    <div>
        <h3>{{ name }}</h3>
        <item-block v-for="(item, index) in items" :key="index" :item="item" />
    </div>
</template>

<script>
    import ItemBlock from './ItemBlock'
    export default {
        name: "TypeBlock",
        components: {
            'item-block': ItemBlock
        },
        props: {
            name: {
                type: String,
                required: true
            },
            items: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>