<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-item-center justify-content-between">
                    <h3 class="card-title">HeroHeader Table</h3>

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
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <!-- <th>Image</th> -->
                            <th>Registered At</th>
                            <th>Modify</th>
                        </tr>
 
                        <tr v-for=" hero in heros" :key="hero.id" >
                            <td>{{hero.id}}</td>
                            <td>{{hero.username}}</td>
                            <td>{{hero.title | upText}}</td>
                            <td>{{hero.short_desc}}</td>
                            <td>{{hero.status}}</td>
                            <!-- <td><img src="images/hero/{{hero.image}}"></td> -->
                            <td>{{hero.created_at | myDate}}</td>
                            <td>
                                <a class="btn btn-info" href="#" @click="editModal(hero)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                
                                <button class="btn btn-danger" href="#" @click="deleteHeroHeader(hero.id)">
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
                        <h5 class="modal-title" v-show="editMode"  id="AddNewLabel">Edit HeroHeader</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" editMode ? updateHeroHeader() : createHeroHeader() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="category_id" v-model="form.category_id" id="category_id" @click="loadCategory" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                    <option value="">Select Hero Category</option>
                                     <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                </select>
                                <has-error :form="form" field="category_id"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.title" type="text" name="title"
                                    placeholder="Title"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.short_desc" type="text" name="short_desc"
                                    placeholder="Short Description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('short_desc') }">
                                <has-error :form="form" field="short_desc"></has-error></textarea>
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
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Add Hero</button>
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
                heros: {},
                categories: {},
                form: new Form({
                    id:'',
                    category_id:'',
                    title : '',
                    short_desc: '',
                    image: ''
                })
            }
        },
        methods: {
            updateHeroHeader(){
                this.$Progress.start()
                this.form.put('api/hero/'+this.form.id)

                .then(() => {
                    // hide modal
                    $('#AddNew').modal('hide')
                    // show success message
                    swal.fire(
                    'Updated!',
                    'HeroHeader details updated successfully',
                    'success'
                    )  
                     this.$Progress.finish()
                })

                .catch(() => {
                   this.$Progress.fail()
                })

                // alert('Edit data')
            },

            editModal(hero){
                this.editMode = true;
                this.form.reset();
                $('#AddNew').modal('show')
                this.form.fill(hero);
            },

            createModal(){
                 this.editMode = false;
                this.form.reset();
                $('#AddNew').modal('show')
            },

            deleteHeroHeader(id){
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
                        this.form.delete('api/hero/'+id).then(() => {                     
                            swal.fire(
                            'Deleted!',
                            'HeroHeader deleted.',
                            'success'
                            )                     
                        }).catch(()=>{
                            swal("Failed!", "There was something wronge.", "warning");
                        })
                    }
                })
            },

            loadHeroHeader(){
                if(this.$gate.isAdmin()){
                    axios.get("api/hero").then(({ data })=> (this.heros = data));
                }
            },

             loadCategory(){
                if(this.$gate.isAdmin()){
                    axios.get("api/category").then(({ data })=> (this.categories = data));
                }
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

            createHeroHeader(){
                this.$Progress.start()
                this.form.post('api/hero')

                .then(() =>{
                    // Fire.$emit('afterCreated');
                    $('#AddNew').modal('hide')
                    toast.fire({
                    type: 'success',
                    title: 'HeroHeader Created Successfully'
                    })
                this.$Progress.finish()
                })
                .catch(() =>{
                     this.$Progress.fail()
                })
            }

        },
            created(){
            if(this.$gate.isAdmin()){
                this.loadHeroHeader();
                // Fire.$on('afterCreated', () => { this.loadUsers(); })
                setInterval(() => this.loadHeroHeader(), 3000);
            }
        }
    }
</script>


