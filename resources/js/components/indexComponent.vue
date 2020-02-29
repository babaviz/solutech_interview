<template>
    <div>
        <notification-component
            :loading="loading"
            :show-msg="showError"
            :msg="errorMsg"
            :records="summary">
        </notification-component>
        <h2>SUMMARY</h2>
        <div class="container">
        <div class="row">
            <div v-for="data in summary" class="col-md-4 text-center" v-on:click="summaryEvent(data.title)">
                <h5 class="text-muted text-uppercase">{{data.title}}</h5>
                <h3 class="sum-title text-center">{{data.value}}</h3>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    import NotificationComponent from "./NotificationComponent";
    export default {
        name: "indexComponent",
        components: {NotificationComponent},
        data(){
          return{
              summary:[],
              loading:true,
              showError:false,
              errorMsg:""
          }
        },
        mounted() {
            axios.get('/api/summary')
                .then((response)=>{
                    this.summary=response.data.summary;
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
        },
        methods:{
            summaryEvent(title){
                this.$router.push('/'+title);
            }
        }
    }
</script>

<style scoped>
    .sum-title{
        text-align: center;
    }
    .col-md-4{
        border: 0.4px solid #eaeaea;
        padding: 5%;
    }
    .col-md-4:hover{
        background: #EEE;
        cursor:pointer
    }

</style>
