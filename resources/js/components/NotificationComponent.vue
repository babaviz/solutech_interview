<template>
    <div class="text-center">
        <i v-if="loading" class="fa fa-spinner fa-spin fa-5x notification"></i>
        <div class="notification" v-else-if="!loading && showMsg"><h2>{{msg}}</h2></div>
        <div class="notification" v-if="!loading && records.length==0"><h1>Empty! No records</h1></div>
    </div>
</template>

<script>
    export default {
        name: "NotificationComponent",
        props:{
            loading:{default:true,type:Boolean,required:false},
            showMsg:{default: false,type:Boolean,required:false},
            msg:{default:"",type:String,required:false},
            records:{default:[],type:Array,required:true}
        },
        data(){
            return{

            }
        }
    }
</script>

<style scoped>
    .notification{
        margin-top: 10%;
        text-align: center;
        vertical-align: middle;
    }
</style>
