<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" @submit.prevent="addUser" action="#">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input id="name" v-model="user.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input id="email" v-model="user.email" type="email" class="form-control" name="email" required autocomplete="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input id="password" v-model="user.password"  type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" v-model="user.password_confirmation"  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">Company Name</label>
                                <div class="col-md-8">
                                    <input id="company_name" v-model="user.company_name"  type="text" class="form-control" name="company_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-8">
                                    <multiselect v-model="user.role" :options="roles"></multiselect>
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
            roles: [],
            user: {
                name:'',
                email: '',
                password: '',
                password_confirmation: '',
                role: '',
            }
        }
    },
    components: {
        Multiselect
    },
    props: {
        getUserList: { type: Function },
    },
    methods: {
        getRoles() {
            axios.get('/api/roles').then((response) => {
                let allRoles = [];
                response.data.data.forEach(element => {
                    allRoles.push(element.name);
                });
                this.roles = allRoles;
            });
        },
        addUser() {
            axios.post('/api/users', this.user).then((response) => {
                this.$toasted.show(response.data.message);
                if(response.data.status) {
                    this.getUserList();
                }
                this.$bvModal.hide('user-add');
            });
        }
    },
    created() {
        this.getRoles();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
