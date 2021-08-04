<template>
    <div class="auth-container">
        <form @submit.prevent="pushProduct" enctype="multipart/form-data">
            <p v-for="error in errors" :key="error">
                {{error}}
            </p>
            <div class="form-group">
                <label for="item name">Choose an item name</label>
                <input 
                    id="item name"
                    type="text"
                    class="form-control"
                    placeholder="item name"
                    v-model="form.name">
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
            <div class="form-group">
                <label for="mode">Choose a mode</label>
                <select name="mode" id="mode" v-model="form.mode">
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
                <label for="dropFrom">Choose a lvl</label>
                <input 
                    id="dropFrom"
                    type="text"
                    class="form-control"
                    placeholder="dropFrom"
                    v-model="form.dropFromLvl">
            </div>
            <div class="form-group">
                <label for="dropFromImg">Choisis une photo pour le mob</label>
                <input 
                    id="dropFromImg"
                    type="file"
                    class="form-control"
                    placeholder="dropFromImg"
                    v-on:change="changeImgDrop">
            </div>
            
            <div class="form-group">
                <label for="dropChance">Drop chance</label>
                <input 
                    id="dropChance"
                    type="text"
                    class="form-control"
                    placeholder="dropChance"
                    v-model="form.dropChance">
            </div>

            <div class="form-group">
                <label for="maxLuck">Max Luck</label>
                <input 
                    id="maxLuck"
                    type="text"
                    class="form-control"
                    placeholder="maxLuck"
                    v-model="form.maxLuck">
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
                    dropFromLvl: '',
                    dropFromImg: '',
                    dropChance: '',
                    maxLuck: '',

                },
                errors:[]
            }
            
        },
        
        methods: {
            changeImg(e){
                this.form.photo = e.target.files[0];
                console.log(this.form.photo);
            },
            changeImgDrop(e){
                this.form.dropFromImg = e.target.files[0];
                console.log(this.form.dropFromImg);
            },
            pushProduct(){
                let data = new FormData();
                this.form.dropChance.replace(/[%.]/g,'');
                data.append('name', this.form.name);
                data.append('photo', this.form.photo);
                data.append('mode', this.form.mode);
                data.append('stats', this.form.stats);
                data.append('price', this.form.price);
                data.append('dropFromLvl', this.form.dropFromLvl);
                data.append('dropFromImg', this.form.dropFromImg);
                data.append('dropChance', this.form.dropChance.replace(/[%]/g,''));
                data.append('maxLuck', this.form.maxLuck);
                axios.post('/api/item/add',data).then(()=>{
                    this.$router.push({name: 'Dashboard'});
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>