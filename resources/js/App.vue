<template>
    <div>
        <Header/>
        <Sidebar/>
        <router-view></router-view>
        <Footer/>
    </div>
</template>
<script>
import Header from './components/HeaderComponent.vue';
import Sidebar from './components/SidebarComponent.vue';
import Footer from './components/FooterComponent.vue';
export default {
    name: 'App',
    components: {
        Header,
        Sidebar,
        Footer
    }
}
</script>
<style scoped>

</style>
