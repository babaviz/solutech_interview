
<template>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div v-if="auth" class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Dashboard</div>
            <div class="list-group list-group-flush">
                <router-link to="/" class="list-group-item list-group-item-action bg-light">Home</router-link>
                <router-link to="/suppliers" class="list-group-item list-group-item-action bg-light">Suppliers</router-link>
                <router-link to="/products" class="list-group-item list-group-item-action bg-light">Products</router-link>
                <router-link to="/orders" class="list-group-item list-group-item-action bg-light">Orders</router-link>
                <!--<router-link to="/" class="list-group-item list-group-item-action bg-light">Profile</router-link>
                <router-link to="/" class="list-group-item list-group-item-action bg-light">Status</router-link>-->
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav v-if="auth" class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">
                    <i class="fa fa-bars"></i>
                </button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link">{{user}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" v-on:click="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>

<script>

    export default{
        methods:{
            checkAuthError(error){
                if (error.response.status === 401) {
                    sessionStorage.clear();
                    console.log('unauthorized, logging out ...');
                    this.$router.replace('/auth/login');
                }
                //return Promise.reject(error.response);
            },
            logout(){
                sessionStorage.clear();
                this.$router.push('/auth/login');
                window.location.reload(true);
            }
        },
        computed:{
            auth(){
                return sessionStorage.getItem("auth");
            },
            user(){
                let auth = sessionStorage.getItem('auth')?sessionStorage.getItem('auth'):null;
                if(auth){
                    let json=JSON.parse(auth);
                    return json.user.email;
                }
                return "";
            }
        },
        watch:{
            auth:function () {},
            user:function () {}
        }
    }
</script>
