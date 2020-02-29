<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="orders">
        </notification-component>
        <h2>Orders</h2>
        <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>ORDER NUMBER</th>
                <th>DETAILS</th>
                </thead>
                <tbody>
                <tr v-for="(order,index) in orders">
                    <td>{{(index+1)}} &raquo;</td>
                    <td>{{order.order_number}}</td>
                    <td class="text-center">
                        <div class="text-muted text-center text-sm-center">Products({{order.detail}})</div>
                        <router-link :to="`/order/`+order.id">details</router-link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</template>

<script>
    import NotificationComponent from "./NotificationComponent";
    export default {
        name: "OrdersComponent",
        components: {NotificationComponent},
        data(){
          return{
              orders:[],
              loading:true,
              showError:false,
              errorMsg:""
          }
        },
        mounted() {
            axios.get('/api/orders')
                .then((response)=>{
                    this.orders=response.data.orders;
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
    .text-sm-center{
        font-size: 0.6em;
    }
</style>
