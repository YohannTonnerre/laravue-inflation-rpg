<template>
    <h1>Home</h1>
    <input placeholder="Chercher par nom" type="text" v-model="filter">
    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Drops from</th>
                <th>Calculate</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in filteredList" :key="item.id">
                <td>
                    <div class="item-container">
                        <p class="mode">{{item.mode}} Mode</p>
                        <div class="photo-container">
                            <img :src="'/upload/item/'+item.photo" alt="">
                            <div>
                                <p>{{item.name}}</p>
                                <p>{{item.stats}}</p>
                            </div>
                        </div>
                    </div>
                </td>
                <td>{{ item.price }}</td>
                <td>
                     <img :src="'/upload/mob/'+item.dropFromImg" alt="">
                    {{ item.dropFromLvl }}
                </td>
                <td >
                    <router-link v-if="item.dropChance != NULL" :to="{name: 'ShowItem', params: { id: item.id }}">
                        Calculate Drop rate
                    </router-link>
                    <p v-else>#</p>
                </td>

                
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            item:'',
            filter: ''
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
