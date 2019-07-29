<template>
    <div class="container">
        <div class="row mt-5">
            <!-- v-if="$gate.isAdmin()" -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-item-center justify-content-between">
                    <h3 class="card-title">Products Table</h3>

                    <div class="card-tools float-right">
                        <button class="btn btn-success" @click="createModal" >Add New <i class="fas fa-user-plus fa-fw"></i></button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            <!-- <th>Status</th> -->
                            <th>Price</th>
                            <th>Image</th>
                            <th>Registered At</th>
                            <th>Modify</th>
                        </tr>
 
                        <tr v-for=" product in products" :key="product.id" >
                            <td>{{product.id}}</td>
                            <td>{{product.username}}</td>
                            <td>{{product.name | upText}}</td>
                            <td>{{product.short_desc}}</td>
                            <!-- <td>{{product.status}}</td> -->
                            <td>{{product.price}}</td>
                            <td><img class="productImage" :src="getProductImage()"></td>
                            <td>{{product.created_at | myDate}}</td>
                            <td>
                                <a class="btn btn-info" href="#" @click="editModal(product)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                
                                <button class="btn btn-danger" href="#" @click="deleteProduct(product.id)">
                                    <i class="fa fa-trash red"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
 <div>
     <not-found></not-found>
 </div>
<!-- Modal -->
        <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="AddNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editMode"  id="AddNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editMode"  id="AddNewLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateProduct() : createProduct() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="category_id" v-model="form.category_id" id="category_id" @click="loadCategory" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                    <option value="">Select Product Category</option>
                                     <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                </select>
                                <has-error :form="form" field="category_id"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    placeholder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.short_desc" type="text" name="short_desc"
                                    placeholder="Short Description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('short_desc') }">
                                <has-error :form="form" field="short_desc"></has-error></textarea>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.long_desc" type="text" name="long_desc"
                                    placeholder="Long Description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('long_desc') }">
                                <has-error :form="form" field="long_desc"></has-error></textarea>
                            </div>
                
                            <div class="form-group">
                                <input v-model="form.price" type="number" name="price"
                                    placeholder="price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                            </div>

                             <div class="form-group">
                                <input type="file" @change="imgUpload" name="image"
                                    placeholder="image"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('image') }">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
    <!-- /.card-body -->           
</template>

<script>
    export default {
        data(){
            return{
                editMode: false,
                products: {},
                categories: {},
                form: new Form({
                    id:'',
                    category_id:'',
                    name : '',
                    short_desc: '',
                    long_desc: '',
                    price: '',
                    image: ''
                })
            }
        },
        methods: {
            getProductImage(){
                return 'images/product/'+this.form.image;
            },
            updateProduct(){
                this.$Progress.start()
                this.form.put('api/product/'+this.form.id)

                .then(() => {
                    // hide modal
                    $('#AddNew').modal('hide')
                    // show success message
                    swal.fire(
                    'Updated!',
                    'Product details updated successfully',
                    'success'
                    )  
                     this.$Progress.finish()
                })

                .catch(() => {
                   this.$Progress.fail()
                })
            },

            editModal(product){
                this.editMode = true;
                this.form.reset();
                $('#AddNew').modal('show')
                this.form.fill(product);
            },

            createModal(){
                 this.editMode = false;
                this.form.reset();
                $('#AddNew').modal('show')
            },

            deleteProduct(id){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    //send request to the server
                    if (result.value) {
                        this.form.delete('api/product/'+id).then(() => {                     
                            swal.fire(
                            'Deleted!',
                            'Product deleted.',
                            'success'
                            )                     
                        }).catch(()=>{
                            swal("Failed!", "There was something wronge.", "warning");
                        })
                    }
                })
            },

            loadProduct(){
                // if(this.$gate.isAdmin){
                    axios.get("api/product").then(({ data })=> (this.products = data));
                // }
            },

             loadCategory(){
                //  if(this.$gate.isAdmin()){
                    axios.get("api/category").then(({ data })=> (this.categories = data));
                //  }
            },

            imgUpload(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            
            if(file['size'] < 2111775){
                  reader.onloadend = (file) => {
                  this.form.image = reader.result;
                }
                reader.readAsDataURL(file);
              } else{
                swal.fire(
                    'Oops...',
                    'You are uploading a large file',
                    'error'
                    )  
              
              return false;
              }
            },

            createProduct(){
                this.$Progress.start()
                this.form.post('api/product')

                .then(() =>{
                    // Fire.$emit('afterCreated');
                    $('#AddNew').modal('hide')
                    toast.fire({
                    type: 'success',
                    title: 'Product Created Successfully'
                    })
                this.$Progress.finish()
                })
                .catch(() =>{
                     this.$Progress.fail()
                })
            }

        },
            created(){
            // if(this.$gate.isAdmin()){
                this.loadProduct();
                setInterval(() => this.loadProduct(), 3000);
            // }
        }
    }
</script>


