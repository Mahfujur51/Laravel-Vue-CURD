<template>
    <div class="container">
        <h2 class="text-center">Update Product</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control" v-model="form.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="form.price">
                    </div>
                    <div class="form-group ">
                        <label>Avatar</label>

                        <input type="file" @change='uploadPhoto' name="photo" class="form-control">

                    </div>
                    <img class="profile-user-img img-fluid img-circle" :src="getPhoto()"  width="50px" height="50px">
                    <div class="form-group">
                        <label >Old Photo</label>
                        <img  :src="`img/profile/${form.photo}`" alt=""   height="50" width="50">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" @click="updateProduct()"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
                form: new Form({
                    id:'',
                    name :'',
                    photo:'',
                    price:'',
                    description:''
                })
            }
        },
        mounted() {
            this.editProduct(this.$route.params.productId);
        },
        methods: {
            editProduct(productId) {
                this.axios.get(`api/products/${productId}`)
                    .then((res) => {
                        this.form = res.data;
                    });
            },
            updateProduct() {
                //alert("Ok")
                this.axios.patch(`api/products/${this.$route.params.productId}`, this.form)
                    .then((res) => {
                        this.$router.push({ name: 'ProductIndex' });
                    });
            },
            uploadPhoto(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            },
            getPhoto(){
                let photo = (this.form.photo.length > 100) ? this.form.photo : "img/product/"+ this.form.photo;
                return photo;
            },
        }
    }
</script>
