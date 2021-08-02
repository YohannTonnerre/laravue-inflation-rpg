<template>
    <div class="auth-container">
        <form @submit.prevent="updateItem" enctype="multipart/form-data">
            <p v-for="error in errors" :key="error">
                {{error}}
            </p>
            <div class="form-group">
                <label for="name">Choose a name</label>
                <input 
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="name"
                    v-model="item.name"
                    value="item.name">
            </div>
            <div class="form-group">
                <label for="mode">Choose a mode</label>
                <select name="mode" id="mode" v-model="item.mode">
                    <option value="Normal">Normal</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stats">Choose stats</label>
                <input 
                    id="stats"
                    type="text"
                    class="form-control"
                    placeholder="stats"
                    v-model="item.stats">
            </div>
            <div class="form-group">
                <label for="price">Choose a price</label>
                <input 
                    id="price"
                    type="text"
                    class="form-control"
                    placeholder="price"
                    v-model="item.price">
            </div>
            <div class="form-group">
                <label for="dropFrom">Choose a lvl</label>
                <input 
                    id="dropFrom"
                    type="text"
                    class="form-control"
                    placeholder="dropFrom"
                    v-model="item.dropFromLvl">
            </div>
            <img :src="'/upload/'+item.photo" alt="">
            <div class="form-group">
                <label for="photo">Choisis une photo</label>
                <input 
                    id="photo"
                    type="file"
                    class="form-control"
                    placeholder="photo"
                    v-on:change="changeImg">
            </div>

            <div class="form-group">
                <label for="dropChance">Choose a drop chance</label>
                <input 
                    id="dropChance"
                    type="text"
                    class="form-control"
                    placeholder="dropChance"
                    v-model="item.dropChance">
            </div>

            <div class="form-group">
                <label for="maxLuck">Max Luck</label>
                <input 
                    id="maxLuck"
                    type="text"
                    class="form-control"
                    placeholder="maxLuck"
                    v-model="item.maxLuck">
            </div>
            
            <input type="submit" value="Creer le produit" class="btn btn-primary"/>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{

                
                item:{
                    

                },
                errors:[]
            }
            
        },
        
        methods: {
            changeImg(e){
                this.item.photo = e.target.files[0];
                console.log(this.item.photo);
            },
            updateItem(){
                let data = new FormData();
                console.log(this.item.dropChance);
                data.append('name', this.item.name);
                data.append('mode', this.item.mode);
                data.append('stats', this.item.stats);
                data.append('price', this.item.price);
                data.append('dropFromLvl', this.item.dropFromLvl);
                data.append('photo', this.item.photo);
                data.append('dropChance', this.item.dropChance.replace(/[%]/g,''));
                data.append('maxLuck', this.item.maxLuck);
                axios.post(`/api/item/update/${this.$route.params.id}`, data).then(()=>{
                    this.$router.push({name: 'Dashboard'});
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        },
        created(){
            axios.get(`/api/item/edit/${this.$route.params.id}`).then((res)=>{
                this.item = res.data
            })
        }
    }
</script>