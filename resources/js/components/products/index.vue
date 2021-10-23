<template>
    <div class="container">
        <h2 class="text-center">Products List</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add Product</router-link>
            </div>
        </div>
        <div class="row">
            <select v-model="select" style="margin-bottom:10px" @change="deletePro">
                <option value="">Select</option>
                <option value="">Delete All</option>
            </select>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th width="12%">

                            <input type="checkbox" @click="select_all_via_check_box" v-model="all_select">

                            <span> {{ all_select == true ? 'Uncheck All' : "Select All" }} </span>
                        </th>

                        <th>Sl</th>
                        <th>Name</th>
                        <th width="30%">Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, key) of products">
                        <td width="12%"><input type="checkbox" v-model="deleteItems" :value="`${product.id}`"></td>
                        <td>{{ key+1 }}</td>
                        <td>{{ product.name }}</td>
                        <td width="30%">{{ product.description }}</td>
                        <td>{{ product.price }}</td>
                        <td>
                            <img :src="`img/profile/${product.photo}`" alt="" width="100" height="100">
                        </td>

                        <td>
                            <router-link class="btn btn-success btn-sm" :to="{ name: 'ProductEdit', params: { productId: product.id }}">Edit</router-link>
                            <button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: {},
                deleteItems:[],
                select:'',
                all_select:false

            }
        },
        created() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                this.axios.get('api/products/')
                    .then(response => {
                        //console.log(response)
                       this.products = response.data;
                    });
            },
            select_all_via_check_box(){
                if(this.all_select == false){
                    this.all_select = true
                    this.products.forEach(product => {
                        this.deleteItems.push(product.id)
                    });
                }else{
                    this.all_select = false
                    this.deleteItems = []
                }
            },
            deletePro() {
                axios.post('api/deleteProduct/'+this.deleteItems)
                    .then((response) => {

                        this.getProducts()
                        this.deleteItems = []
                        this.all_select == true ?
                            this.all_select = false : this.all_select = true;
                    })
            },
            deleteProduct(productId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.axios.delete(`api/products/${productId}`)
                            .then(response => {
                                let i = this.products.map(data => data.id).indexOf(productId);
                                this.products.splice(i, 1)
                            });

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        }
    }
</script>
