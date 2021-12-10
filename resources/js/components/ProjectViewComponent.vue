<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="row">

                        <div class="col-lg-12 col-xlg-12 col-md-12" style="text-align:right">
                            <button class="btn btn-primary" @click="exportSample()">
                                Export
                            </button><br><br>
                        </div>

                        <div class="col-lg-3 col-xlg-4 col-md-6" v-for="(item, index) in sampleList" :key="index">
                            <div class="card">
                                <div class="card-body">
                                    <router-link :to="{ path: '/view-sample/'+item.id }">
                                        <h5 class="text-center addsample text-dark"><br>{{ item.title }}</h5>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xlg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-center addsample" @click="addSample()">+ <br> Add Sample</h5>
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
    export default{
        name: 'view',
        data() {
            return {
                sampleList: [],
                project_id: this.$route.params.id,
                json_fields: {
                    'Sample Title': 'title',
                    'Description': 'description',
                    'Manufacturer': 'manufacturer',
                    'Model no': 'model_no',
                    'Finish': 'finish',
                    'Client': 'client',
                    'Client Rep': 'client_rep',
                    'Architech': 'architech',
                    'Service Consult': 'service_consult',
                    'ESD': 'esd',
                    'BCA': 'bca',
                    'Sample Url': 'sample_url',
                    'overall_status': 'overall_status',
                    'Comments': 'comments',
                },
                json_data: [

                ],
            }
        },
        methods: {
            exportSample() {
                window.open(
                    'http://18.118.37.62/projectExport?type=project&id='+this.$route.params.id,
                    '_blank'
                );
            },
            getSamples() {
                axios.get('/api/samples').then((res) => {
                    this.sampleList = res.data.data;
                    this.json_data = res.data.data;
                });
            },
            addSample() {
                let data = {
                    project_id: this.project_id
                }
                axios.post('/api/samples', data).then((res) => {
                    this.getSamples();
                });
            },
        },
        created() {
            this.getSamples();
        }
    }
</script>
<style scoped>
    .addsample{
        cursor: pointer;
    }
</style>

