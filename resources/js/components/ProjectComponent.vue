<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <h1>
                        <span class="fl" style="margin-right: 30px;">Project List</span>
                        <span class="fr">
                            <!-- <button class="btn btn-primary">
                                <export-excel
                                :data="json_data"
                                :fields="json_fields"
                                name="projects.xls"
                                >
                                Export
                                </export-excel>
                            </button> -->
                            <router-link :to="{ path: '/add-project' }">
                                <button :v-if="add_project" class="btn btn-primary">Add</button>
                            </router-link>
                        </span>
                    </h1>
                    <div class="card" style="width:100%">
                        <div class="text-center" style="padding: 20px;">
                            <select style="width: 250px;float: left;margin-right: 35px;" v-model="filterValue" class="form-control" @change="getProjectList()">
                                <option value="">Select Manufacturer</option>
                                <option v-for="(item, index) of manufacturesList" :key="index" :value="item">
                                    {{ item }}
                                </option>
                            </select>
                            <input type="text" v-model="searchValue" @keyup="getProjectList()" style="width:250px;" class="form-control" value="" placeholder="Elastic Search"/>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Title</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Active</th>
                                            <th class="border-top-0">Summary</th>
                                            <th class="border-top-0">Complete</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(project, index) in projectList" :key="index">
                                            <td>{{ (index+1) }}</td>
                                            <td>{{ project.title }}</td>
                                            <td>{{ project.description }}</td>
                                            <td>{{ project.is_active ? true : false }}</td>
                                            <td>
                                                <router-link :v-if="view_project" :to="{ path: '/sample/all/'+project.id }">
                                                    <button class="btn btn-primary" >See</button>
                                                </router-link>
                                            </td>
                                            <td>{{ project.description ? true : false }}</td>
                                            <td>
                                                <router-link :v-if="view_project" :to="{ path: '/view-project/'+project.id }">
                                                    <button class="btn btn-primary" >View</button>
                                                </router-link>
                                                <router-link :v-if="edit_project" :to="{ path: '/edit-project/'+project.id }">
                                                    <button class="btn btn-warning" >Edit</button>
                                                </router-link>
                                                <button :v-if="delete_project" class="btn btn-danger" @click="deleteProject(project.id)">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import { Multiselect } from 'vue-multiselect';
import swal from 'sweetalert2';
export default {
    name: 'project',
    components: {
        Multiselect
    },
    data() {
        return {
            manufacturesList: [],
            searchValue: '',
            filterValue: '',
            projectList: [],
            view_project: false,
            add_project: false,
            edit_project: false,
            delete_project: false,
            add_user_to_project: false,
            delete_user_to_project: false
        }
    },
    methods: {
        getManufacturesList() {
            axios.post('/api/projects/manufacturesList').then((res) => {
                this.manufacturesList = res.data.data;
            });
        },
        getProjectList() {
            axios.get('/api/projects?search_value='+this.searchValue+'&filter_value='+this.filterValue).then((res) => {
                this.projectList = res.data.data;
            });
        },
        deleteProject(projectId) {
            new swal({
                title: 'Are you Sure ? You want to delete !',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            }).then((res) => {
                if(res.value){
                    axios.delete('/api/projects/'+projectId).then((res) => {
                        this.getProjectList();
                    });
                }
            });
        }
    },
    created() {
        this.getManufacturesList();
        this.getProjectList();
        axios.get('/api/users/permission/add_project').then((response) => {
            this.add_project = response.data;
        });
        axios.get('/api/users/permission/edit_project').then((response) => {
            this.edit_project = response.data;
        });
        axios.get('/api/users/permission/delete_project').then((response) => {
            this.delete_project = response.data;
        });
        axios.get('/api/users/permission/add_user_to_project').then((response) => {
            this.add_user_to_project = response.data;
        });
        axios.get('/api/users/permission/delete_user_to_project').then((response) => {
            this.delete_user_to_project = response.data;
        });
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
