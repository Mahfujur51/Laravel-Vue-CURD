<template>

    <div class="container">
<!--        <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--            <div class="collapse navbar-collapse">-->
<!--                <div class="navbar-nav">-->
<!--                    <router-link :to="{ name: 'ProductIndex' }"  class="nav-item nav-link">Products</router-link>-->
<!--                </div>-->
<!--            </div>-->
<!--        </nav>-->


        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{name:'welcome'}">Navbar</router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link class="nav-link active" aria-current="page" :to="{ name: 'ProductIndex' }">Products</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name:'AboutUs'}">About Us</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>

<script>
    export default {}
</script>
