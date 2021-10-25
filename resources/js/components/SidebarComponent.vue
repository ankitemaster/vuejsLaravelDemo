<template>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item pt-2">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" @click="redirectToDashboard" href="#"
                            aria-expanded="false">
                            <i class="far fa-clock" aria-hidden="true"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" @click="redirectToProfile" href="#"
                            aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="hide-menu">Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" @click="redirectToProject" href="#"
                            aria-expanded="false">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span class="hide-menu">Project</span>
                        </a>
                    </li>

                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" @click="redirectToRoleAndPermission" href="#"
                            aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="hide-menu">Role And Permission</span>
                        </a>
                    </li> -->


                    <!-- <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="hide-menu">Basic Table</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="fa fa-font" aria-hidden="true"></i>
                            <span class="hide-menu">Icon</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            <span class="hide-menu">Google Map</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="fa fa-columns" aria-hidden="true"></i>
                            <span class="hide-menu">Blank Page</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <span class="hide-menu">Error 404</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </aside>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        redirectToDashboard() {
            this.$router.push({name:'dashboard'});
        },
        redirectToProfile() {
            this.$router.push({name:'profile'});
        },
        redirectToRoleAndPermission() {
            this.$router.push({name:'role-and-permission'});
        },
        redirectToProject() {
            this.$router.push({name:'project'});
        }
    }
}
</script>

