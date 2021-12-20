<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" @submit.prevent="addProject" action="#">
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label text-md-right text-center">
                                                <h3>{{ $route.params.id ? 'Edit' : 'Add' }} Project</h3>
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>
                                            <div class="col-md-8">
                                                <input id="title" v-model="project.title" type="text" class="form-control" name="title" required autocomplete="title" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Description</label>
                                            <div class="col-md-8">
                                                <textarea name="description" class="form-control" v-model="project.description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="active" class="col-md-4 col-form-label text-md-right">Active</label>
                                            <div class="col-md-8">
                                                <input id="is_active" v-model="project.is_active" type="checkbox" name="is_active" required autocomplete="is_active" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-if="false">
                                            <label for="complete" class="col-md-4 col-form-label text-md-right">Complete</label>
                                            <div class="col-md-8">
                                                <input id="is_complete" v-model="project.is_complete" type="checkbox" name="is_complete" required autocomplete="is_complete" autofocus>
                                            </div>
                                        </div>
                                        <div :v-if="add_user_to_project" class="form-group row">
                                            <label for="role" class="col-md-4 col-form-label text-md-right">User</label>
                                            <div class="col-md-8">
                                                  <multiselect :multiple="true" v-model="project.project_users" :options="users" placeholder="Select users" label="name" track-by="name"></multiselect>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $route.params.id ? 'Update' : 'Add' }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect';
export default {
    data() {
        return {
            users: [],
            project: {
                id: this.$route.params.id,
                title: '',
                description: '',
                is_active: false,
                is_complete: false,
                start_date: '',
                end_date: '',
                project_users: [],
                add_user_to_project: false,
                delete_user_to_project: false,
            }
        }
    },
    components: {
        Multiselect
    },
    methods: {
        getUsers() {
            axios.get('/api/users').then((response) => {
                this.users = response.data.data;
            });
        },
        addProject() {
            if(this.project.id) {
                axios.put('/api/projects/'+this.project.id, this.project).then((response) => {
                    this.$router.push({name:'project'});
                });
            } else {
                axios.post('/api/projects', this.project).then((response) => {
                    this.$router.push({name:'project'});
                });
            }
        },
        getProjectDetail() {
            axios.get('/api/projects/'+this.project.id).then((response) => {
                this.project.title = response.data.data[0].title;
                this.project.description = response.data.data[0].description;
                this.project.is_active = response.data.data[0].is_active;
                this.project.is_complete = response.data.data[0].is_complete;
                this.project.project_users = response.data.data[0].project_users;
            });
        }
    },
    created() {
        this.getUsers();
        if(this.project.id){
            this.getProjectDetail();
        }
        this.add_user_to_project = this.can('add_user_to_project');
        this.delete_user_to_project = this.can('delete_user_to_project');
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
#user_avatar{
    display: none;
}
.img-circle{
    border-radius: 50%;
}
</style>
