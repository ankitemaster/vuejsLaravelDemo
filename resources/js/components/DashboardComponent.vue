<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total User</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash"><canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-success">{{ userCount }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Page Views</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash2"><canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-purple">869</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Unique Visitor</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash3"><canvas width="67" height="30"
                                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-info">911</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Products Yearly Sales</h3>
                        <div class="d-md-flex">
                            <ul class="list-inline d-flex ms-auto">
                                <li class="ps-3">
                                    <h5><i class="fa fa-circle me-1 text-info"></i>Mac</h5>
                                </li>
                                <li class="ps-3">
                                    <h5><i class="fa fa-circle me-1 text-inverse"></i>Windows</h5>
                                </li>
                            </ul>
                        </div>
                        <div id="ct-visits" style="height: 405px;">
                            <div class="chartist-tooltip" style="top: -17px; left: -12px;"><span
                                    class="chartist-tooltip-value">6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- RECENT SALES -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="d-md-flex mb-3">
                            <h3 class="box-title mb-0">Users</h3>
                            <div class="col-md-2 col-sm-2 col-xs-2 ms-auto">
                                <b-button v-b-modal="'user-add'">Add User</b-button>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-3">
                                <input @change="getUserList" type="text" v-model="userSearchValue" class="form-select shadow-none row border-top"/>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-3" id="userFilterDiv">
                                <select @change="getUserList" v-model="userFilterValue" class="form-select shadow-none row border-top">
                                    <option value="all">All</option>
                                    <option value="verified">Verified</option>
                                    <option value="notverified">Not Verified</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Name</th>
                                        <th class="border-top-0">Email</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user,index) in users" :key="index">
                                        <td>{{ (index+1) }}</td>
                                        <td class="txt-oflo">{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td class="txt-oflo">{{ user.email_verified_at == null ? 'Not Verified' : 'Verified' }}</td>
                                        <td>
                                            <button @click="getSingleUserData(user.id)" class="btn btn-primary">View</button>
                                            <button @click="deleteUser(user.id)" class="btn btn-danger">Delete</button>

                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td>2</td>
                                        <td class="txt-oflo">Real Homes WP Theme</td>
                                        <td>EXTENDED</td>
                                        <td class="txt-oflo">April 19, 2021</td>
                                        <td><span class="text-info">$1250</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="txt-oflo">Ample Admin</td>
                                        <td>EXTENDED</td>
                                        <td class="txt-oflo">April 19, 2021</td>
                                        <td><span class="text-info">$1250</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="txt-oflo">Medical Pro WP Theme</td>
                                        <td>TAX</td>
                                        <td class="txt-oflo">April 20, 2021</td>
                                        <td><span class="text-danger">-$24</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="txt-oflo">Hosting press html</td>
                                        <td>SALE</td>
                                        <td class="txt-oflo">April 21, 2021</td>
                                        <td><span class="text-success">$24</span></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td class="txt-oflo">Digital Agency PSD</td>
                                        <td>SALE</td>
                                        <td class="txt-oflo">April 23, 2021</td>
                                        <td><span class="text-danger">-$14</span></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td class="txt-oflo">Helping Hands WP Theme</td>
                                        <td>MEMBER</td>
                                        <td class="txt-oflo">April 22, 2021</td>
                                        <td><span class="text-success">$64</span></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-body">
                            <h3 class="box-title mb-0">Recent Comments</h3>
                        </div>
                        <div class="comment-widgets">
                            <div class="d-flex flex-row comment-row p-3 mt-0">
                                <div class="p-2"><img src="/plugins/images/users/varun.jpg" alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text ps-2 ps-md-3 w-100">
                                    <h5 class="font-medium">James Anderson</h5>
                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                    <div class="comment-footer d-md-flex align-items-center">
                                        <span class="badge bg-primary rounded">Pending</span>

                                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row comment-row p-3">
                                <div class="p-2"><img src="/plugins/images/users/genu.jpg" alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text ps-2 ps-md-3 active w-100">
                                    <h5 class="font-medium">Michael Jorden</h5>
                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                    <div class="comment-footer d-md-flex align-items-center">

                                        <span class="badge bg-success rounded">Approved</span>

                                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row comment-row p-3">
                                <div class="p-2"><img src="/plugins/images/users/ritesh.jpg" alt="user" width="50" class="rounded-circle"></div>
                                <div class="comment-text ps-2 ps-md-3 w-100">
                                    <h5 class="font-medium">Johnathan Doeting</h5>
                                    <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                    <div class="comment-footer d-md-flex align-items-center">

                                        <span class="badge rounded bg-danger">Rejected</span>

                                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-heading">
                            <h3 class="box-title mb-0">Chat Listing</h3>
                        </div>
                        <div class="card-body">
                            <ul class="chatonline">
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/varun.jpg" alt="user-img" class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">Varun Dhavan <small
                                                    class="d-block text-success d-block">online</small></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/genu.jpg" alt="user-img" class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">Genelia
                                                Deshmukh <small class="d-block text-warning">Away</small></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">Ritesh
                                                Deshmukh <small class="d-block text-danger">Busy</small></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/arijit.jpg" alt="user-img" class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">Arijit
                                                Sinh <small class="d-block text-muted">Offline</small></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/govinda.jpg" alt="user-img"
                                            class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">Govinda
                                                Star <small class="d-block text-success">online</small></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="call-chat">
                                        <button class="btn btn-success text-white btn-circle btn" type="button">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button class="btn btn-info btn-circle btn" type="button">
                                            <i class="far fa-comments text-white"></i>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                            src="/plugins/images/users/hritik.jpg" alt="user-img" class="img-circle">
                                        <div class="ms-2">
                                            <span class="text-dark">John
                                                Abraham<small class="d-block text-success">online</small></span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <b-modal id="user-add" title="Add User" :hide-footer="true">
            <AddUserComponent :getUserList="getUserList"/>
        </b-modal>

        <b-modal id="user-info" title="User Info">
            <p class="my-4">Name : {{ user.name }}</p>
            <p class="my-4">Email : {{ user.email }}</p>
            <p class="my-4">Status : {{ user.email_verified_at == null ? 'Not Verified' : 'Verified' }}</p>
        </b-modal>
        <select  v-model="roleId">
            <option value="">Select Role</option>
            <option v-for="(role, index) in roleList" :key="index" :value="role.id" >
                {{ role.name }}
            </option>
        </select>
    </div>
</template>
<script>
import AddUserComponent from './AddUserComponent.vue';
export default {
    components: {
        AddUserComponent
    },
    data() {
        return {
            userCount: 0,
            users: [],
            user: {
                id: '',
                name: '',
                email: '',
                email_verified_at: '',
            },
            roleList:[],
            roleId: '',
            userSearchValue: '',
            userFilterValue: 'all'
        }
    },
    methods: {
        getDashboardCount() {
            axios.get('/api/dashboard').then(data=>{
                this.userCount = data.data.data.userCount;
            });
        },
        getUserList() {
            axios.get('/api/users?search='+this.userSearchValue+'&filter='+this.userFilterValue).then(data=> {
                this.users = data.data.data
            });
        },
        getSingleUserData(userId){
            axios.get('/api/users/'+userId).then(res=>{
                this.user.name = res.data.data[0].name;
                this.user.id = res.data.data[0].id;
                this.user.email = res.data.data[0].email;
                this.user.email_verified_at = res.data.data[0].email_verified_at;
                this.$bvModal.show('user-info');
            });
        },
        deleteUser(userId) {
            axios.delete('/api/users/'+userId).then((response)=>{
                this.$toasted.show(response.data.message);
                this.getUserList();
            });
        },
        getRoleList(){
            axios.get('/api/roles').then((res) => {
                this.roleList = res.data.data
            })
        }

    },
    created() {
        this.getDashboardCount();
        this.getUserList();
        this.getRoleList();
    }
}
</script>
<style scoped>
#userFilterDiv {
    margin-left: 20px;
}
</style>

