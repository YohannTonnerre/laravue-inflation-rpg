<template>
    <div>
        <h1>Dashboard</h1>
        <button @click.prevent="logout">Logout</button>
        <router-link to="/new-item">Add new Item</router-link>
        <input placeholder="Chercher par nom" type="text" v-model="filter">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>mode</th>
                    <th>price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in filteredList" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.mode }}</td>
                    <td>{{ item.price }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'EditItem', params: { id: item.id }}" class="btn btn-success">Modifier</router-link> -->
                            <button class="btn btn-danger" @click="deleteItem(item.id)">Supprimer</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {

    data() {
        return {
            items:[],
            filter: '',
            item: ''
        }
    },
    methods: {
        logout(){
            axios.post('/api/logout').then(()=>{
                this.$router.push({ name: 'Home'})
            })
        },
        deleteItem(id){
            axios.delete(`/api/item/delete/${id}`)
            .then(response => {
                let i = this.items.map(data => data.id).indexOf(id);
                this.items.splice(i, 1)
            });
        }
    },
    computed: {
        filteredList(){
            return this.items.filter((item) => {
                return item.name.toLowerCase().includes(this.filter.toLowerCase());
            })
        },

    },
    mounted() {
        axios.get('/api/items').then(response => {
            this.items = response.data;
        });
    },
}
</script>

<style>

</style>