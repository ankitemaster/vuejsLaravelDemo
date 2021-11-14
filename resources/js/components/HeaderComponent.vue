<template>
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand text-center text-dark" href="#" @click="redirectToDashboard">
                    <!-- <b class="logo-icon">
                        <img src="/plugins/images/logo-icon.png" alt="homepage" />
                    </b>
                    <span class="logo-text">
                        <img src="/plugins/images/logo-text.png" alt="homepage" />
                    </span> -->
                    {{ this.username }}
                </a>
                <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                    href="javascript:void(0)"><i class="ti-menu ti-close"></i>
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <span class="text-white ms-auto">{{  }}</span>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class=" in">
                        <!-- <form role="search" class="app-search d-none d-md-block me-3">
                            <input type="text" placeholder="Search..." class="form-control mt-0">
                            <a href="" class="active">
                                <i class="fa fa-search"></i>
                            </a>
                        </form> -->
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" role="button" aria-expanded="false" href="#">
                            <img :src="user.profile || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" alt="user-img" width="36"
                                class="img-circle">
                                <span class="text-white font-medium">
                                    {{ user.name }}
                                </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#" @click="logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <b-form ref="logoutform" id="logout-form" action="/logout" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="csrf">
        </b-form>
    </header>
</template>
<script>
export default {
    data() {
        return {
            username : JSON.parse(localStorage.getItem('user')).name,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user: JSON.parse(localStorage.getItem('user'))
        }
    },
    created() {

    },
    methods: {
        redirectToDashboard() {
            this.$router.push({name:'dashboard'});
        },
        logout() {
            this.$refs.logoutform.submit()
        }
    }
}
</script>

