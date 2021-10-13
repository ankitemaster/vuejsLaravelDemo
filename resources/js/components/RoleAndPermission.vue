<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Role List <b-button v-b-modal.modal-1>Add Role</b-button> </h1>
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Role Name</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(role, index) in roleList" :key="index">
                                        <td>{{ (index+1) }}</td>
                                        <td>{{ role.name }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteRole(role.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <b-modal id="modal-1" title="Add User" :hide-footer="true">
                                <form method="POST" @submit.prevent="addRole" action="#">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-8">
                                            <input id="name" v-model="role.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </b-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Permission List <b-button v-b-modal.modal-2> Add Permission</b-button> </h1>
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Permission Name</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(permission, index) in permissionList" :key="index">
                                        <td>{{ (index+1) }}</td>
                                        <td>{{ permission.name }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deletePermission(permission.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <b-modal id="modal-2" title="Add User" :hide-footer="true">
                                <form method="POST" @submit.prevent="addPermission" action="#">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-8">
                                            <input id="name" v-model="permission.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </b-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    name: 'role-and-permission',
    data() {
        return {
            role: {
                name:'',
                id: ''
            },
            roleList: [],
            permission: {
                name:'',
                id: ''
            },
            permissionList: []

        }
    },
    methods: {
        getRoleList() {
            axios.get('/api/roles').then((res) => {
                this.roleList = res.data.data;
            });
        },
        deleteRole(roleId) {
            axios.delete('/api/roles/'+roleId).then((res) => {
                this.getRoleList();
            });
        },
        addRole() {
            axios.post('/api/roles', this.role).then((res) => {
                this.$bvModal.hide('modal-1')
                this.getRoleList();
            });
        },
        getpermissionList(){
            axios.get('/api/permissions').then((res)=> {
                this.permissionList = res.data.data;
            })
        },
        deletePermission(permissionId){
            axios.delete('/api/permissions/'+permissionId).then((res)=>{
                 this.getpermissionList();
            })
        },
        addPermission(){
            axios.post('/api/permissions',this.permission).then((res) => {
                 this.getpermissionList();
                 this.$bvModal.hide('modal-2')
            })
        }


    },
    created() {
        this.getRoleList();
        this.getpermissionList();
    }
}
</script>

