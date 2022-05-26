<template>
    <div class="container">
        <hr>
        <button class="btn btn-warning text-center" 
        v-on:click.prevent="addProductToCart()">Add to cart</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                
            }
        },
        props:['productId','userId'],
        methods:{
            async addProductToCart(){
                if(this.userId == 0){
                    this.$toastr.e('You need to login to add cart');
                    return;
                }
                let response = await axios.post("/cart",{
                    "product_id" : this.productId
                }); 
                this.$root.$emit('changeincart',response.data.item);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
