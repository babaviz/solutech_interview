<template>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <th>#</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>QUANTITY</th>
            <th v-if="showSupplier">SUPPLIER</th>
            </thead>
            <tbody>
            <tr v-for="(product,index) in products">
                <td>{{(index+1)}} &raquo;</td>
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{product.quantity}}</td>
                <td v-if="showSupplier">
                    <span v-if="product.supplier">
                        <router-link :to="`/supplier/`+product.supplier.id" >{{product.supplier.name}}</router-link>
                    </span>
                    <span v-else>&nbsp;</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ProductsTable",
        props:{
            products:{type:Array},
            showSupplier:{type:Boolean,default:true}
        }
    }
</script>

<style scoped>

</style>
