<template>
    <div>
        <p>{{item.name}}</p>
        <input v-model="luckAmount" type="text">

        <p>chance to drop: {{dropChanceCalcul}}% </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            item:  {},
            luckArray: [0,2000,25000,300000,500000,1000000],
            dropArray:[],
            luckAmount: '1',
            dropChance: '0'
        }
    },

    computed: {
        dropChanceCalcul: function(){
            if(this.luckAmount <= this.luckArray[1]){

                let b = parseFloat(this.dropArray[0], 10);
                let d = parseFloat(this.dropArray[1],10);
                let c = parseFloat(this.luckArray[1],10);
                let e = parseFloat(this.luckAmount,10);

                this.dropChance = (b+d)/c*e;

                console.log(b);
                console.log(d);
                console.log(c);
                console.log(e);
                
                return this.dropChance;
            }
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
    created() {
        
    },
}
</script>

<style>

</style>