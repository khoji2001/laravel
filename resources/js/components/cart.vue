<template>
    <li class="nav-item">  
    <a href="/checkout" class="btn btn-warning btn-sm">Cart {{itemcount}}</a>
    </li>
</template>

<script>
    export default {
        data(){
            return {
                itemcount:"",
            }
        }, 
        mounted() {
            this.$root.$on('changeincart',(item)=>{
                this.itemcount = item;
            })
        },
        methods:{
            async get_item_load(){
                let response = await axios.post("/cart");
                this.itemcount = response.data.item
            }
        },
        created(){
            this.get_item_load();
        }
    }
</script>
