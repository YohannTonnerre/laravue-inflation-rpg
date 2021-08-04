<template>
    <div>
        <img :src="`/upload/mob/${item.dropFromImg}`" alt="">
        <img :src="`/upload/item/${item.photo}`" alt="">
        <p>{{item.name}}</p>
        <input v-model="luckAmount" type="text">

        <p>chance to drop: <span v-if="luckAmount != ''">{{dropChanceCalcul}}% </span></p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            item:  {},
            luckArray: [0,2000,25000,300000,500000,1000000],
            dropArray:[],
            luckAmount: '0',
            dropChance: '0'
        }
    },

    computed: {
        dropChanceCalcul: function(){
            if(this.luckAmount >= this.luckArray[6] && this.luckAmount <= this.luckArray[5]){
                let b = parseFloat(this.dropArray[5]);
                let d = parseFloat(this.dropArray[6]);
                let c = parseFloat(this.luckArray[6]);
                let e = parseFloat(this.luckAmount);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount <= this.luckArray[1]){
                let b = parseFloat(this.dropArray[0]);
                let d = parseFloat(this.dropArray[1]);
                let c = parseFloat(this.luckArray[1]);
                let e = parseFloat(this.luckAmount,);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount > this.luckArray[1] && this.luckAmount <= this.luckArray[2]){
              
                let b = parseFloat(this.dropArray[1]);
                let d = parseFloat(this.dropArray[2]);
                let c = parseFloat(this.luckArray[2]);
                let e = parseFloat(this.luckAmount);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount > this.luckArray[2] && this.luckAmount <= this.luckArray[3]){
                let b = parseFloat(this.dropArray[2]);
                let d = parseFloat(this.dropArray[3]);
                let c = parseFloat(this.luckArray[3]);
                let e = parseFloat(this.luckAmount);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount > this.luckArray[3] && this.luckAmount <= this.luckArray[4]){
                let b = parseFloat(this.dropArray[3]);
                let d = parseFloat(this.dropArray[4]);
                let c = parseFloat(this.luckArray[4]);
                let e = parseFloat(this.luckAmount);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount > this.luckArray[4] && this.luckAmount <= this.luckArray[5]){
                let b = parseFloat(this.dropArray[4]);
                let d = parseFloat(this.dropArray[5]);
                let c = parseFloat(this.luckArray[5]);
                let e = parseFloat(this.luckAmount);
                return this.calculStat(b,c,d,e);
            }
            if(this.luckAmount > this.luckArray[5]){
                return this.dropArray[5];
            }
            
        }
    },
    methods: {
        calculStat(b,c,d,e){
            return this.dropChance = Number(b+e*((d-b)/c)).toPrecision(5);
        }
    },

    mounted() {
        axios.get(`/api/item/show/${this.$route.params.name}`).then((res)=>{
            this.item = res.data;
            this.luckArray.push(this.item.maxLuck);
            let itemDrop = this.item.dropChance.substring(1, this.item.dropChance.length-1);
            let test = itemDrop.split(',');
            for(let i = 0; i< test.length; i++){
                this.dropArray.push(test[i]);
            }
            
            for(let i = 0; i<this.luckArray.length; i++){
                console.log(this.luckArray[i] + ' ' + this.dropArray[i]);
            }
        })
        
    },
}
</script>

<style>

</style>