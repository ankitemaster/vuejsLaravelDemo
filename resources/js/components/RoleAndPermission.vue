<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>
                                <span class="fl">Role List</span>
                                <span v-if="role_create" class="fr"><b-button v-b-modal.modal-1>Add Role</b-button></span>
                            </h1>
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Role Name</th>
                                        <th class="border-top-0">Permissions</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(role, index) in roleList" :key="index">
                                        <td>{{ (index+1) }}</td>
                                        <td>{{ role.name }}</td>
                                        <td>
                                            <span v-for="(rolePermission, index) in role.permissions" :key="index">
                                                {{ rolePermission.name + "," }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteRole(role.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <b-modal id="modal-1" title="Add Role" :hide-footer="true">
                                <form method="POST" @submit.prevent="addRole" action="#">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-8">
                                            <input id="name" v-model="role.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Permission</label>
                                        <div class="col-md-8">
                                            <multiselect :multiple="true" v-model="role.permissions" :options="options"></multiselect>
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
                            <h1>
                                <span class="fl">Permission List</span>
                                <span class="fr"><b-button v-b-modal.modal-2>Add Permission</b-button></span>
                            </h1>
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Permission Name</th>
                                        <th class="border-top-0">Roles</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(permission, index) in permissionList" :key="index">
                                        <td>{{ (index+1) }}</td>
                                        <td>{{ permission.name }}</td>
                                        <td>
                                            <span v-for="(role, index) in permission.roles" :key="index">
                                                {{ role.name + "," }}
                                            </span>
                                        </td>
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
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Role</label>
                                        <div class="col-md-8">
                                            <multiselect :multiple="true" v-model="permission.roles" :options="rolesOptions"></multiselect>
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
import { Multiselect } from 'vue-multiselect';
export default {
    name: 'role-and-permission',
    components: {
        Multiselect
    },
    data() {
        return {
            role_create: false,
            options: [],
            rolesOptions: [],
            role: {
                name:'',
                id: '',
                permissions: []
            },
            roleList: [],
            permission: {
                name:'',
                id: '',
                roles: []
            },
            permissionList: []

        }
    },
    methods: {
        getRoleList() {
            axios.get('/api/roles').then((res) => {
                this.roleList = res.data.data;
                let rolesListArray = [];
                this.roleList.forEach((element) => {
                    rolesListArray.push(element.name);
                });
                this.rolesOptions = rolesListArray;
            });
        },
        deleteRole(roleId) {
            axios.delete('/api/roles/'+roleId).then((res) => {
                this.getRoleList();
            });
        },
        addRole() {
            axios.post('/api/roles', this.role).then((res) => {
                this.$toasted.show(res.data.message);
                if(res.data.status) {
                    this.$bvModal.hide('modal-1')
                    this.getRoleList();
                }
            });
        },
        getpermissionList(){
            axios.get('/api/permissions').then((res)=> {
                this.permissionList = res.data.data;
                let permissionsArray = [];
                this.permissionList.forEach(element => {
                    permissionsArray.push(element.name);
                });
                this.options = permissionsArray;
            });
        },
        deletePermission(permissionId){
            axios.delete('/api/permissions/'+permissionId).then((res)=>{
                 this.getpermissionList();
            })
        },
        addPermission(){
            axios.post('/api/permissions',this.permission).then((res) => {
                this.$toasted.show(res.data.message);
                if(res.data.status) {
                    this.$bvModal.hide('modal-2')
                    this.getpermissionList();
                }
            })
        }
    },
    created() {
        this.role_create = this.can('role_create');
        this.getRoleList();
        this.getpermissionList();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.fl {
    float: left;
}
.fr {
    float: right;
}
</style>
