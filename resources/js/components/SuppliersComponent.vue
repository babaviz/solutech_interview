<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="suppliers">
        </notification-component>
        <h2>Suppliers</h2>
        <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>NAME</th>
                <th>PRODUCTS</th>
                </thead>
                <tbody>
                <tr v-for="(supplier,index) in suppliers">
                    <td>{{(index+1)}} &raquo;</td>
                    <td>
                        <span class="link-span">
                            <router-link :to="`/supplier/`+supplier.id" >{{supplier.name}}</router-link>
                        </span>
                    </td>
                    <td>
                        <span class="link-span">
                            <router-link :to="`/supplier/`+supplier.id" >{{supplier.prod_count}}</router-link>
                        </span>
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
        name: "SuppliersComponent",
        components: {NotificationComponent},
        data(){
          return{
              suppliers:[],
              loading:true,
              showError:false,
              errorMsg:""
          }
        },
        mounted() {
            axios.get('/api/suppliers')
                .then((response)=>{
                    this.suppliers=response.data.suppliers;
                })
                .catch((error)=>{
                    console.log(error);
                    this.errorMsg="Oops! something went wrong";
                    this.showError=true;
                })
                .finally(()=>{
                    this.loading=false;
                });
        }
    }
</script>

<style scoped>
    .link-span{
        width: 100%;
        text-align: center;
    }
</style>
