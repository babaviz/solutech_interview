<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="products">
        </notification-component>
        <div v-if="supplier">
            <h2 class="text-muted">SUPPLIER: <span class="text-info">{{supplier.name}}</span></h2>
            <br>
            <div class="container">
            <h3 class="text-center text-uppercase">Products</h3>
                <products-table :show-supplier="false" :products="products"></products-table>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductsTable from "./utils/ProductsTable";
    export default {
        name: "SupplierComponent",
        components: {ProductsTable},
        data() {
            return {
                supplier: null,
                products: [],
                loading: true,
                showError: false,
                errorMsg: ""
            }
        },
        mounted() {
            axios.get(`/api/supplier/${this.$route.params.id}`)
                .then((response) => {
                    this.supplier=response.data.supplier;
                    if(this.supplier){
                        this.products = response.data.supplier.products;
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.errorMsg = "Oops! something went wrong";
                    this.showError = true;
                    this.$parent.checkAuthError(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
</script>

<style scoped>

</style>
