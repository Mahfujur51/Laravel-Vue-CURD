<template>
    <div class="container">
        <h2 class="text-center">Create product</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductIndex' }" class="btn btn-primary btn-sm float-right mb-2">Back</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form >
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control" v-model="form.description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" v-model="form.price" name="price">
                    </div>

                    <div class="form-group ">
                        <label>Avatar</label>

                            <input type="file" @change='uploadPhoto' name="photo" class="form-control">

                    </div>
                    <img class="profile-user-img img-fluid img-circle" :src="getPhoto()"  width="100px" height="100px">

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" @click="createProduct()">Create</button>
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
        methods: {
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

            createProduct() {
                // console.log(this.form)
                this.axios.post('/api/products',this.form)
                    .then(response => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Product Uploaded Successfully!!!'
                                }),
                                this.$router.push({ name: 'ProductIndex' })
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
