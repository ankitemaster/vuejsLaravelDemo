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

                        <div class="text-center" style="padding-bottom: 20px;">
                            <select style="width: 250px;float: left;margin-right: 35px;" v-model="filterValue" class="form-control" @change="getSamples()">
                                <option value="" selected>Select Manufacturer</option>
                                <option v-for="(item, index) of manufacturesList" :key="index" :value="item">
                                    {{ item }}
                                </option>
                            </select>

                            <select style="width: 250px;float: left;margin-right: 35px;" v-model="subFilterValue" class="form-control" @change="getSamples()">
                                <option value="" selected>Sub Contractor</option>
                                <option v-for="(item, index) of subContractorsList" :key="index" :value="item">
                                    {{ item }}
                                </option>
                            </select>


                            <input type="text" v-model="searchValue" @keyup="(searchValue.length > 3 || searchValue.length == 0) ? getSamples() : ''" style="width:250px;" class="form-control" value="" placeholder="Elastic Search after 3 words"/>
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
                searchValue: '',
                filterValue: '',
                subFilterValue: '',
                manufacturesList: [],
                subContractorsList: [],
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
            getSubContractorsList() {
                axios.post('/api/projects/subContractorsList').then((res) => {
                    this.subContractorsList = res.data.data;
                });
            },
            getManufacturesList() {
                axios.post('/api/projects/manufacturesList').then((res) => {
                    this.manufacturesList = res.data.data;
                });
            },
            exportSample() {
                window.open(
                    'http://18.118.37.62/projectExport?type=project&id='+this.$route.params.id,
                    '_blank'
                );
            },
            getSamples() {
                axios.get(`/api/samples?id=${this.$route.params.id}&search_value=${this.searchValue}&filter_value=${this.filterValue}&sub_filter_value=${this.subFilterValue}`).then((res) => {
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
            this.getManufacturesList();
            this.getSubContractorsList();
        }
    }
</script>
<style scoped>
    .addsample{
        cursor: pointer;
    }
</style>

