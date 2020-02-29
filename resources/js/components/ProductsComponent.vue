<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="products">
        </notification-component>
        <h2 class="text-uppercase">Products</h2>
        <div class="container">
        <products-table :products="products" :show-supplier="true"></products-table>
        </div>
    </div>
</template>

<script>
    import NotificationComponent from "./NotificationComponent";
    import ProductsTable from "./utils/ProductsTable";
    export default {
        name: "ProductsComponent",
        components: {ProductsTable, NotificationComponent},
        data(){
          return{
              products:[],
              loading:true,
              showError:false,
              errorMsg:""
          }
        },
        mounted() {
            axios.get('/api/products')
                .then((response)=>{
                    this.products=response.data.products;
                })
                .catch((error)=>{
                    console.log(error);
                    this.errorMsg="Oops! something went wrong";
                    this.showError=true;
                    this.$parent.checkAuthError(error);
                })
                .finally(()=>{
                    this.loading=false;
                });
        }
    }
</script>

<style scoped>

</style>
