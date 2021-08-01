<template>
    <div>
        <h1>Dashboard</h1>
        <button @click.prevent="logout">Logout</button>
        <router-link to="/new-item">Add new Item</router-link>
    </div>
</template>

<script>
export default {
    methods: {
        logout(){
            axios.post('/api/logout').then(()=>{
                this.$router.push({ name: 'Home'})
            })
        }
    },
}
</script>

<style>

</style>