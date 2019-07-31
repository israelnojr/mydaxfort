<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-item-center justify-content-between">
                    <h3 class="card-title">Users Table</h3>

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
                            <th>Name</th>
                           <th>User Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Modify</th>
                        </tr>
 
                        <tr v-for=" category in categories" :key="category.id" >
                            <td>{{category.id}}</td>
                            <td>{{category.name | upText}}</td>
                            <td>{{category.username | upText}}</td>
                            <td>{{category.slug}}</td>
                            <td>{{category.desc}}</td>
                            <td>{{category.status}}</td>
                            <td>{{category.created_at | myDate}}</td>
                            <td>
                                <a class="btn btn-info" href="#" @click="editModal(category)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                
                                <button class="btn btn-danger" href="#" @click="deleteCategory(category.id)">
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
 <div  v-if="!$gate.isAdmin()">
     <not-found></not-found>
 </div>
<!-- Modal -->
        <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="AddNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editMode"  id="AddNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editMode"  id="AddNewLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateCategory() : createCategory() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    placeholder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.desc" type="text" name="desc"
                                    placeholder="Description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('desc') }">
                                <has-error :form="form" field="desc"></has-error></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Add Category</button>
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
                categories: {},
                form: new Form({
                    id:'',
                    name : '',
                    desc: '',
                })
            }
        },
        methods: {
            updateCategory(){
                this.$Progress.start()
                this.form.put('api/category/'+this.form.id)

                .then(() => {
                    // hide modal
                    $('#AddNew').modal('hide')
                    // show success message
                    swal.fire(
                    'Updated!',
                    'Category details updated successfully',
                    'success'
                    )  
                     this.$Progress.finish()
                     location.reload();
                })

                .catch(() => {
                   this.$Progress.fail()
                })

                // alert('Edit data')
            },

            editModal(category){
                this.editMode = true;
                this.form.reset();
                $('#AddNew').modal('show')
                this.form.fill(category);
            },

            createModal(){
                 this.editMode = false;
                this.form.reset();
                $('#AddNew').modal('show')
            },

            deleteCategory(id){
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
                        this.form.delete('api/category/'+id).then(() => {                     
                            swal.fire(
                            'Deleted!',
                            'category deleted.',
                            'success'
                            )    
                        location.reload();                 
                        }).catch(()=>{
                            swal("Failed!", "There was something wronge.", "warning");
                        })
                    }
                })
            },

            loadCategory(){
                if(this.$gate.isAdmin()){
                    axios.get("api/category").then(({ data })=> (this.categories = data));
                }
            },

            createCategory(){
                this.$Progress.start()
                this.form.post('api/category')

                .then(() =>{
                    // Fire.$emit('afterCreated');
                    $('#AddNew').modal('hide')
                    toast.fire({
                    type: 'success',
                    title: 'Category Created Successfully'
                    })
                this.$Progress.finish()
                location.reload();
                })
                .catch(() =>{
                     this.$Progress.fail()
                })
            }
        },
        created(){
            if(this.$gate.isAdmin()){
                this.loadCategory();
                // Fire.$on('afterCreated', () => { this.loadUsers(); })
                // setInterval(() => this.loadCategory(), 3000);
            }
        }
    }
</script>


