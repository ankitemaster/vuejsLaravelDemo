<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>
                                <span class="fl">Project List</span>
                                <span class="fr">
                                    <router-link :to="{ path: '/add-project' }">
                                        <button :v-if="add_project" class="btn btn-primary">Add</button>
                                    </router-link>
                                </span>
                            </h1>
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Title</th>
                                        <th class="border-top-0">Description</th>
                                        <th class="border-top-0">Active</th>
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
                                        <td>{{ project.description ? true : false }}</td>
                                        <td>
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
</template>
<script>
import { Multiselect } from 'vue-multiselect';
export default {
    name: 'project',
    components: {
        Multiselect
    },
    data() {
        return {
            projectList: [],
            add_project: false,
            edit_project: false,
            delete_project: false,
            add_user_to_project: false,
            delete_user_to_project: false,
        }
    },
    methods: {
        getProjectList() {
            axios.get('/api/projects').then((res) => {
                this.projectList = res.data.data;
            });
        },
        deleteProject(projectId) {
            axios.delete('/api/projects/'+projectId).then((res) => {
                this.getProjectList();
            });
        }
    },
    created() {
        this.getProjectList();
        this.add_project = this.can('add_project');
        this.edit_project = this.can('edit_project');
        this.delete_project = this.can('delete_project');
        this.add_user_to_project = this.can('add_user_to_project');
        this.delete_user_to_project = this.can('delete_user_to_project');
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
