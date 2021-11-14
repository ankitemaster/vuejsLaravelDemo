<template>
    <div class="page-wrapper">
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Profile page</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <!-- <div class="d-md-flex">
                        <ol class="breadcrumb ms-auto">
                            <li><a href="#" @click="redirectToDashboard" class="fw-normal">Dashboard</a></li>
                        </ol>
                        <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                            to Pro</a>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xlg-3 col-md-12">
                    <div class="white-box">
                        <div class="user-bg"> <img width="100%" alt="user" src="plugins/images/large/img1.jpg">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <a href="javascript:void(0)"><img :src="user.avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'"
                                            class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white mt-2">{{ user.name }}</h4>
                                    <h5 class="text-white mt-2">{{ user.email }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="user-btm-box mt-5 d-md-flex">
                            <div class="col-md-4 col-sm-4 text-center">
                                <h1>258</h1>
                            </div>
                            <div class="col-md-4 col-sm-4 text-center">
                                <h1>125</h1>
                            </div>
                            <div class="col-md-4 col-sm-4 text-center">
                                <h1>556</h1>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-8 col-xlg-9 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="form-horizontal form-material" action="#" @submit.prevent="updateProfile">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Full Name</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input name="name" type="text" v-model="user.name" placeholder="Johnathan Doe"
                                            class="form-control p-0 border-0"> </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="example-email" class="col-md-12 p-0">Email</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input name="email" type="email" v-model="user.email" placeholder="johnathan@admin.com"
                                            class="form-control p-0 border-0"
                                            id="example-email" readonly>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="example-email" class="col-md-12 p-0">Profile Image</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input @change="upload_avatar" name="profile" type="file" placeholder="johnathan@admin.com"
                                            class="form-control p-0 border-0"
                                            id="example-email">
                                            <div class="avatar img-fluid img-circle" style="margin-top:10px">
                                                <img :src="user.avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
                                            </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Password</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="password" value="password" class="form-control p-0 border-0">
                                    </div>
                                </div> -->
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Phone No</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input v-model="user.mobile" name="mobile" type="text" placeholder="123 456 7890"
                                            class="form-control p-0 border-0">
                                    </div>
                                </div>
                                <!-- <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Message</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <textarea rows="5" class="form-control p-0 border-0"></textarea>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group mb-4">
                                    <label class="col-sm-12">Select Country</label>

                                    <div class="col-sm-12 border-bottom">
                                        <select class="form-select shadow-none p-0 border-0 form-control-line">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                id:JSON.parse(localStorage.getItem('user')).id,
                name: '',
                email: '',
                password: '',
                avatar: '',
                mobile: '',
                profile: ''
            }
        }
    },
    methods: {
        redirectToDashboard() {
            this.$router.push({name:'dashboard'});
        },
        updateProfile(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("name", this.user.name);
            formData.append("mobile", this.user.mobile);
            formData.append("profile", this.user.profile);
            formData.append("_method", "put");
            axios.post('/api/users/'+this.user.id,formData).then((res)=>{
                localStorage.setItem('user', JSON.stringify(res.data.data[0]));
                this.getProfile();
                window.location.reload();
            });
        },
        getProfile() {
            axios.get('/api/users/'+this.user.id).then(res=>{
                this.user.name = res.data.data[0].name;
                this.user.email = res.data.data[0].email;
                this.user.avatar = res.data.data[0].profile;
                this.user.mobile = res.data.data[0].mobile;
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
        }
    },
    created() {
        this.getProfile();
    }
}
</script>

