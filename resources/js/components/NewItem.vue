<template>
    <div class="auth-container">
        <form @submit.prevent="pushProduct" enctype="multipart/form-data">
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
                    v-model="form.name">
            </div>
            <div class="form-group">
                <label for="mode">Choose a mode</label>
                <select name="mode" id="mode" v-model="form.mode">
                    <option value="normal">Normal</option>
                    <option value="hard">Hard</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stats">Choose stats</label>
                <input 
                    id="stats"
                    type="text"
                    class="form-control"
                    placeholder="stats"
                    v-model="form.stats">
            </div>
            <div class="form-group">
                <label for="price">Choose a price</label>
                <input 
                    id="price"
                    type="text"
                    class="form-control"
                    placeholder="price"
                    v-model="form.price">
            </div>
            <div class="form-group">
                <label for="dropFrom">Choose a price</label>
                <input 
                    id="dropFrom"
                    type="text"
                    class="form-control"
                    placeholder="dropFrom"
                    v-model="form.dropFrom">
            </div>
            <div class="form-group">
                <label for="photo">Choisis une photo</label>
                <input 
                    id="photo"
                    type="file"
                    class="form-control"
                    placeholder="photo"
                    v-on:change="changeImg">
            </div>
            
            <input type="submit" value="Creer le produit" class="btn btn-primary"/>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{

                
                form:{
                    name:'',
                    mode:'',
                    stats:'',
                    price:'',
                    photo: '',
                    dropFrom: ''

                },
                errors:[]
            }
            
        },
        
        methods: {
            changeImg(e){
                this.form.photo = e.target.files[0];
                console.log(this.form.photo);
            },
            pushProduct(){
                let data = new FormData();
                data.append('name', this.form.name);
                data.append('mode', this.form.mode);
                data.append('stats', this.form.stats);
                data.append('price', this.form.price);
                data.append('dropFrom', this.form.dropFrom);
                data.append('photo', this.form.photo);
                axios.post('/api/item/add',data).then(()=>{
                    this.$router.push({name: 'Dashboard'});
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>