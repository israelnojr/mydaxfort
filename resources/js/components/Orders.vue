<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-item-center justify-content-between">
                    <h3 class="card-title">Orders Table</h3>

                    <!-- <div class="card-tools float-right">
                        <button class="btn btn-success" @click="createModal" >Add New <i class="fas fa-user-plus fa-fw"></i></button>
                    </div> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Terms</th>
                            <th>Date</th>
                            <!-- <th>Modify</th> -->
                        </tr>
 
                        <tr v-for=" order in orders" :key="order.id" >
                            <td>{{order.id}}</td>
                            <td>{{order.first_name | upText}}</td>
                            <td>{{order.last_name | upText}}</td>
                            <td>{{order.number | upText}}</td>
                            <td>{{order.email}}</td>
                            <td>{{order.country | upText}}</td>
                            <td>{{order.address | upText}}</td>
                            <td>{{order.city | upText}}</td>
                            <td>{{order.terms | upText}}</td>
                            <td>{{order.created_at | myDate}}</td>
                            <!-- <td>
                                <a class="btn btn-info" href="#" @click="editModal(user)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                
                                <button class="btn btn-danger" href="#" @click="deleteUser(user.id)">
                                    <i class="fa fa-trash red"></i>
                                </button>
                            </td> -->
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
                    <form @submit.prevent=" editMode ? updateUser() : createUser() ">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    placeholder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="text" name="email"
                                    placeholder="Email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                     <option value="developer">Developer</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="text" name="password"
                                    placeholder="Password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Add User</button>
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
                orders: {},
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                })
            }
        },
        methods: {
            
            loadOrders(){
                if(this.$gate.isAdmin()){
                    axios.get("/orders").then(({ data })=> (this.orders = data));
                }
            },

            createUser(){
                this.$Progress.start()
                this.form.post('api/user')

                .then(() =>{
                    // Fire.$emit('afterCreated');
                    $('#AddNew').modal('hide')
                    toast.fire({
                    type: 'success',
                    title: 'User Created Successfully'
                    })
                this.$Progress.finish()
                })
                .catch(() =>{

                })
            }
        },
        created(){
            if(this.$gate.isAdmin()){
                this.loadOrders();
                // Fire.$on('afterCreated', () => { this.loadOrders(); })
                setInterval(() => this.loadOrders(), 3000);
            }
        }
    }
</script>


