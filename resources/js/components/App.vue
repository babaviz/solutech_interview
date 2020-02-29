// App.vue

<template>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
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

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
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
                            <a class="nav-link">user@email.com</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logout</a>
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
    }
</script>
