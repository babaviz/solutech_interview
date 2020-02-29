<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="products">
        </notification-component>
        <div v-if="order">
            <h2 class="text-muted">ORDER <span class="text-info">#{{order.order_number}}</span></h2>
            <br>
            <div class="container">
            <h3 class="text-center text-uppercase">Order Details</h3>
                <products-table :products="products"></products-table>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductsTable from "./utils/ProductsTable";
    export default {
        name: "OrderComponent",
        components: {ProductsTable},
        data() {
            return {
                order: null,
                products: [],
                loading: true,
                showError: false,
                errorMsg: ""
            }
        },
        mounted() {
            axios.get(`/api/order/${this.$route.params.id}`)
                .then((response) => {
                    this.order=response.data.order;
                    if(this.order){
                        this.products = response.data.order.products;
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
