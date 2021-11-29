<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <h1>
                        <span class="fl">Samples Data</span>
                    </h1>
                    <div class="card" style="width:100%">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <tr>
                                        <th>Sample Title</th>
                                        <th>Description</th>
                                        <th>Manufacturer</th>
                                        <th>Model No</th>
                                        <th v-for="(item3, index3) of dynamicFields" :key="index3">{{ item3 }}</th>
                                        <th>Finish<th>
                                        <th>Manufacturer<th>
                                        <!-- <th>Sample Url</th> -->
                                        <th>Overall Status</th>
                                        <th>Comments</th>
                                    </tr>
                                    <tr v-for="(item, index) of samples" :key="index">
                                        <td>{{ item.title }}</td>
                                        <td>{{ item.description }}</td>
                                        <td>{{ item.manufacturer }}</td>
                                        <td>{{ item.model_no }}</td>

                                        <td v-for="(item1, index1) of item.dynamic_fields" :key="index1" v-bind:style=" item1 == 'Approved' ? 'background: green;' : item1 == 'Rejected' ? 'background: red;' :  'background: none;' ">{{ item1 }}</td>
                                        <td>{{ item.finish }}</td>
                                        <td>{{ item.manufacturer }}</td>
                                        <!-- <td>{{ item.sample_url }}</td> -->
                                        <td>{{ item.overall_status }}</td>
                                        <td>{{ item.comments }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Multiselect } from 'vue-multiselect';
export default {
    name: 'project',
    components: {
        Multiselect
    },
    data() {
        return {
            samples: [],
            projectName : '',
            dynamicFields: []
        }
    },
    methods: {
        getSampleList() {
            axios.get('/api/seeSampleStatus/'+this.$route.params.id).then((res) => {
                this.samples = res.data.data.samples
                this.projectName = res.data.data.projectName;
                this.dynamicFields = res.data.data.dynamicFields
                console.log(this.samples)
            });
        }
    },
    created() {
        this.getSampleList();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.fl {
    float: left;
}
.fr {
    float: right;
}
</style>
