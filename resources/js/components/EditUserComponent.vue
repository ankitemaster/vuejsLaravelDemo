<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" method="POST" @submit.prevent="editUser" action="#">
                                        <div class="form-group row text-center">
                                            <div class="col-md-12 border-bottom p-0">
                                                <input ref="file" @change="upload_avatar" name="profile" type="file" class="form-control p-0 border-0" id="user_avatar">
                                                <div class="avatar img-fluid img-circle" style="margin-top:10px">
                                                    <img @click="$refs.file.click()" :src="user.avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                            <div class="col-md-8">
                                                <input id="name" v-model="user.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-8">
                                                <input id="email" v-model="user.email" type="email" class="form-control" name="email" required autocomplete="email" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                                            <div class="col-md-8">
                                                <multiselect v-model="user.role" :options="roles"></multiselect>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
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
                                        </div> -->
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
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
            roles: [],
            user: {
                id: this.$route.params.id,
                name: '',
                email: '',
                email_verified_at: '',
                avatar: '',
                profile: '',
                role: '',
            }
        }
    },
    components: {
        Multiselect
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
        upload_avatar(e) {
            let file = e.target.files[0];
            this.user.profile = file;
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.user.avatar = reader.result;
            }
            reader.readAsDataURL(file);
        },
        editUser() {
            var formData = new FormData();
            formData.append("name", this.user.name);
            formData.append("mobile", this.user.mobile);
            formData.append("profile", this.user.profile);
            formData.append("role", this.user.role);
            formData.append("_method", "put");
            axios.post('/api/users/'+this.$route.params.id, formData).then((response) => {
                getSingleUserData();
            })
        },
        getSingleUserData() {
            axios.get('/api/users/'+this.$route.params.id).then((response) => {
                this.user.name = response.data.data[0].name;
                this.user.email = response.data.data[0].email;
                this.user.avatar = response.data.data[0].profile;
                this.user.role = response.data.data[0].roles[0].name;
                this.user.profile = '';
            });
        }
    },
    created() {
        this.getSingleUserData();
        this.getRoles();
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
