<template>
    <div>
        <type-block v-for="type in types" :key="type.slug" :name="type.name" :items="menu[type.slug]" />
    </div>
</template>

<script>
    import axios from 'axios'
    import TypeBlock from './blocks/TypeBlock'
    export default {
        name: "Menu",
        components: {
            'type-block': TypeBlock
        },
        mounted() {

            this.$on('menu-ready', () => {
                this.getTypes()
            })
            this.getMenu()
        },
        methods: {
            async getMenu() {

                const data = await axios.get('/api/products/menu')
                this.menu = data.data
                this.$emit('menu-ready')
            },
            async getTypes() {

                const data = await axios.get('/api/products/types')
                this.types = data.data
            }
        },
        data() {
            return {
                menu: {},
                types: []
            }
        }
    }
</script>

<style scoped>

</style>