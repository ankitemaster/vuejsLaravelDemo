<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <h3 class="text-center text-dark projectName">Project Name: {{ projectName }}</h3>
            <form method="POST" @submit.prevent="updateSample" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 col-xlg-6 col-md-12">
                        <div class="row">
                            <div class="form-group row">
                                <h3 class="bg-dark text-white sample-title">Sample Details</h3>

                                <div class="row">
                                    <button style="float:left; width: 150px;" @click="changeSampleStatus('In Progress')" class="btn btn-primary">In Progress</button> &nbsp;&nbsp;
                                    <button style="float:left; width: 150px;" @click="changeSampleStatus('Approved')" class="btn btn-success">Approved</button> &nbsp;&nbsp;
                                    <button style="float:left; width: 150px;" @click="changeSampleStatus('Rejected')" class="btn btn-danger">Rejected</button> &nbsp;&nbsp;
                                    <router-link :v-if="edit_project" :to="{ path: '/sample/logs/'+$route.params.id }">
                                        <button class="btn btn-warning" >See Activity Logs</button>
                                    </router-link>
                                    &nbsp;&nbsp;
                                    <span v-bind:style="{ background: (status == 'Approved' ? 'green' : (status == 'Rejected' ? 'red' : 'orange')) }" style="float: right; color: white;width: 92px;padding-top: 16px;text-align:center;" class="label label-default">{{ status }}</span>
                                </div>
                                <br>
                                <br>

                                <span style="margin-top:20px;"></span>

                                <label for="name" class="col-md-4 col-form-label text-md-right">Sample No.</label>
                                <div class="col-md-8">
                                    <input id="sample_no" v-model="sampleData.sample_no" type="text" class="form-control" name="sample_no" required autocomplete="sample_no" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Date Submitted</label>
                                <div class="col-md-8">
                                    <input id="created_at" v-model="sampleData.created_at" type="date" class="form-control" name="created_at" required autocomplete="created_at" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Sub Contractor</label>
                                <div class="col-md-8">
                                    <input id="subcontractor" v-model="sampleData.subcontractor" type="text" class="form-control" name="subcontractor" required autocomplete="subcontractor" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Sample Title</label>
                                <div class="col-md-8">
                                    <input id="title" v-model="sampleData.title" type="text" class="form-control" name="title" required autocomplete="title" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" v-model="sampleData.description" name="description" required autocomplete="description" autofocus>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Manufacturer</label>
                                <div class="col-md-8">
                                    <input id="manufacturer" v-model="sampleData.manufacturer" type="text" class="form-control" name="manufacturer" required autocomplete="manufacturer" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Model No.</label>
                                <div class="col-md-8">
                                    <input id="model_no" v-model="sampleData.model_no" type="text" class="form-control" name="model_no" required autocomplete="model_no" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="finish" class="col-md-4 col-form-label text-md-right">Finish</label>
                                <div class="col-md-8">
                                    <input id="finish" v-model="sampleData.finish" type="text" class="form-control" name="finish" required autocomplete="finish" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location_used" class="col-md-4 col-form-label text-md-right">Location Used</label>
                                <div class="col-md-8">
                                    <input id="location_used" v-model="sampleData.location_used" type="text" class="form-control" name="location_used" required autocomplete="location_used" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Specification And/OR Schedule Reference</label>
                                <div class="col-md-8">
                                    <input id="specification" v-model="sampleData.specification" type="text" class="form-control" name="specification" required autocomplete="specification" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Is This Any Alternative Product ?</label>
                                <div class="col-md-8">
                                    Yes <input type="radio" name="is_alt_product" v-model="sampleData.is_alt_product" value="1"/>
                                    No <input type="radio" name="is_alt_product" v-model="sampleData.is_alt_product" value="0"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Sample Type</label>
                                <div class="col-md-8">
                                    Physical <input type="radio" name="sample_type" v-model="sampleData.sample_type" value="0"/>
                                    Photo <input v-b-modal.modal-1 type="radio" name="sample_type" v-model="sampleData.sample_type" value="1"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Tech Data Period</label>
                                <div class="col-md-8">
                                    Yes <input v-b-modal.modal-2 type="radio" name="data_period" v-model="sampleData.data_period" value="1"/>
                                    No <input type="radio" name="data_period" v-model="sampleData.data_period" value="0"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Warranty Period</label>
                                <div class="col-md-8">
                                    <input id="warrenty_period" v-model="sampleData.warrenty_period" type="text" class="form-control" name="warrenty_period" required autocomplete="warrenty_period" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-md-4 col-form-label text-md-right">SubCintractor Sample Confirmation</label>
                                <div class="col-md-8">
                                    <label>This proposed sample is in accordance with contract specifications and/or schedules and satisfies all requirments under the subcontractor.</label>
                                </div>
                            </div>
                            <input id="fileUpload" @change="onPhotochange" type="file" class="sample_type_photo"  name="sample_type_photo" />
                            <input id="techDataFile" @change="ontechDataFileChange" type="file" class="tech_data_photo"  name="tech_data_photo" />
                            <b-modal ref="model1" @show="changeUploadUrl('sample_type')" @hide="refreshFileSelector" hide-footer id="modal-1" title="Upload File">
                                <VueFileAgent
                                        ref="vueFileAgent"
                                        :theme="'list'"
                                        :multiple="true"
                                        :deletable="true"
                                        :meta="true"
                                        :accept="'image/*,.pdf'"
                                        :maxSize="'10MB'"
                                        :maxFiles="14"
                                        :helpText="'Choose images or pdf'"
                                        :errorText="{
                                            type: 'Invalid file type. Only images or pdf Allowed',
                                            size: 'Files should not exceed 10MB in size',
                                        }"
                                    @select="filesSelected($event)"
                                    @beforedelete="onBeforeDelete($event)"
                                    @delete="fileDeleted($event)"
                                    v-model="fileRecords"
                                ></VueFileAgent>
                                <br>
                                <button class="btn btn-primary" :disabled="!fileRecordsForUpload.length" @click="uploadFiles()">
                                    Upload {{ fileRecordsForUpload.length }} files
                                </button>
                                <div class="avatar img-fluid img-circle text-center" style="margin-top:10px">
                                    <img v-if="fileRecordsForUpload.length == 0 && sampleTypePhotos.length == 0" :src="avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
                                    <div class="frame" v-for="(item, index) of sampleTypePhotos" :key="index">
                                        <button @click="deleteSampleTypePhoto(item)" class='button'>X</button>
                                        <iframe id='x' :src="item" class='content iframeClass'  frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </b-modal>

                            <b-modal ref="model2" @show="changeUploadUrl('tech_data')" @hide="refreshFileSelector" id="modal-2" title="Upload File">

                                <VueFileAgent
                                        ref="vueFileAgent"
                                        :theme="'list'"
                                        :multiple="true"
                                        :deletable="true"
                                        :meta="true"
                                        :accept="'image/*,.pdf'"
                                        :maxSize="'10MB'"
                                        :maxFiles="14"
                                        :helpText="'Choose images or pdf'"
                                        :errorText="{
                                            type: 'Invalid file type. Only images or pdf Allowed',
                                            size: 'Files should not exceed 10MB in size',
                                        }"
                                    @select="filesSelected($event)"
                                    @beforedelete="onBeforeDelete($event)"
                                    @delete="fileDeleted($event)"
                                    v-model="fileRecords"
                                ></VueFileAgent>
                                <br>
                                <button class="btn btn-primary" :disabled="!fileRecordsForUpload.length" @click="uploadFiles()">
                                    Upload {{ fileRecordsForUpload.length }} files
                                </button>
                                <div class="avatar img-fluid img-circle text-center" style="margin-top:10px">
                                    <img v-if="fileRecordsForUpload.length == 0 && techDataPhotos.length == 0" :src="avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
                                    <div class="frame" v-for="(item, index) of techDataPhotos" :key="index">
                                        <button @click="deleteTechDataPhoto(item)" class='button'>X</button>
                                        <iframe id='x' :src="item" class='content iframeClass'  frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </b-modal>

                            <!--- signature add more fields --->
                            <br>
                            <div v-if="add_dynamic_signature_to_sample">
                                <div class="form-group row" v-for="(input,k) in inputs" :key="k">
                                    <label for="specification" class="col-md-4 col-form-label text-md-right">Label Name</label>
                                    <div class="col-md-8">
                                        <input v-model="input.label_name" type="text" name="label_name" class="form-control" required/>
                                    </div><br><br>
                                    <label for="specification" class="col-md-4 col-form-label text-md-right">Select User</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select required class="form-control" style="width:80%" name="user" v-model="input.user_id" >
                                                    <option :value="user.id" v-for="(user, index) in users" :key="index">
                                                        {{ user.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <span>
                                                    <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">Remove</i> <br>
                                                    <i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1">Add fields</i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-xlg-6 col-md-12">
                        <div class="row">

                            <div class="form-group row">
                                <h3 :style="'background: '+overAllStatusColor" class="text-white sample-title">{{ overAllStatus }}</h3>
                            </div>

                            <div class="form-group row" v-for="(input,k) in inputs" :key="k">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ input.label_name }}</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="input.signature == ''">
                                        <canvas :ref="'signature'+k" :id="'signature-pad'+k" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div v-if="input.signature != ''">
                                        <img :src="input.signature"/>
                                    </div>
                                    <div v-if="input.signature != '' && update_sign">
                                        <textarea :placeholder="input.label_name +' Comment'" v-model="input.comment" class="form-control"></textarea><br>
                                        <select class="form-control" v-model="input.status">
                                            <option value="0">Signed</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Cancelled</option>
                                        </select><br>
                                        <a style="float:right;" class="btn btn-primary" @click="changeStatus(k)" ><span> Update Status </span></a>
                                    </div>
                                    <div class="clear-btn">
                                        <a style="float:left;" v-if="input.signature != '' && delete_sign" class="btn btn-danger" @click="deleteSignature(k)" ><span> Delete Signature </span></a>
                                        <a style="float:right;" v-if="input.signature == ''" class="btn btn-primary" @click="uploadPadSignature(k)" ><span> Save Signature</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import dataURLtoBlob from 'blueimp-canvas-to-blob';
import swal from 'sweetalert2';
import Multiselect from 'vue-multiselect';
export default {
    name: 'view-sample',
    data() {
        return {
            status: '',
            overAllStatusColor: 'orange',
            overAllStatus: 'Pending',
            signatureStatus: [
                'signed',
                'approved',
                'cancelled'
            ],
            projectName: '',
            fileRecords: [],
            uploadUrl: 'http://18.223.248.192/api/samples/sampleTypePhotoUpload/'+this.$route.params.id,
            uploadHeaders: { 'X-Test-Header': 'vue-file-agent', 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            fileRecordsForUpload: [], // maintain an upload queue
            sampleData: {},
            client_sign: null,
            client_rep_sign: null,
            architect_sign: null,
            service_consult_sign: null,
            structural_consult_sign: null,
            esd_sign: null,
            bca_sign: null,
            avatar:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6VkVrykv609kj3hwVZHvkxDsy0EqGR19_lA&usqp=CAU',
            techavatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6VkVrykv609kj3hwVZHvkxDsy0EqGR19_lA&usqp=CAU',
            sampleTypePhotos: [],
            techDataPhotos: [],
            users: [],
            inputs: [],
            update_sign: false,
            add_dynamic_signature_to_sample: false,
            delete_sign: false,
        }
    },
    components: {
        Multiselect
    },
    methods: {
        getPermission() {
            axios.get('/api/users/permission/update_sign').then((response) => {
                this.update_sign = response.data;
            });
            axios.get('/api/users/permission/add_dynamic_signature_to_sample').then((response) => {
                this.add_dynamic_signature_to_sample = response.data;
            });
            axios.get('/api/users/permission/delete_sign').then((response) => {
                this.delete_sign = response.data;
            });
        },
        add () {
            this.inputs.push({
                label_name: '',
                user_id: '',
                signature: '',
                comment: '',
                status: 0
            })
        },
        remove (index) {
            this.inputs.splice(index, 1)
        },
        removeItemOnce(arr, value) {
            var index = arr.indexOf(value);
            if (index > -1) {
                arr.splice(index, 1);
            }
            return arr;
        },
        deleteSampleTypePhoto(url) {
            let name = url.substring(url.lastIndexOf('/') + 1);
            this.sampleTypePhotos = this.removeItemOnce(this.sampleTypePhotos, url);
            let formData = new FormData();
            formData.append('name', name);
            axios.post('/api/samples/deleteSampleTypePhotoUpload/'+this.$route.params.id, formData).then((response) => {

            });
        },
        deleteTechDataPhoto(url) {
            let name = url.substring(url.lastIndexOf('/') + 1);
            this.techDataPhotos = this.removeItemOnce(this.techDataPhotos, url);
            let formData = new FormData();
            formData.append('name', name);
            axios.post('/api/samples/deleteTechDataPhotoUpload/'+this.$route.params.id, formData).then((response) => {

            });
        },
        uploadFiles: function () {
            this.$refs.vueFileAgent.upload(this.uploadUrl, this.uploadHeaders, this.fileRecordsForUpload);
            this.fileRecordsForUpload = [];
            this.fileRecords = [];
            setTimeout(() => this.getSampleDetail(), 1000);
        },
        deleteUploadedFile: function (fileRecord) {
            this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
        },
        filesSelected: function (fileRecordsNewlySelected) {
            var validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error);
            this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords);
        },
        onBeforeDelete: function (fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                this.fileRecordsForUpload.splice(i, 1);
                var k = this.fileRecords.indexOf(fileRecord);
                if (k !== -1) this.fileRecords.splice(k, 1);
            } else {
                if (confirm('Are you sure you want to delete?')) {
                    this.$refs.vueFileAgent.deleteFileRecord(fileRecord); // will trigger 'delete' event
                }
            }
        },
        fileDeleted: function (fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            if (i !== -1) {
                this.fileRecordsForUpload.splice(i, 1);
            } else {
                this.deleteUploadedFile(fileRecord);
            }
        },
        handleFilesValidated(result, files) {
            console.log('Validation result: ' + result);
        },
        handleFilesChanged(files) {
            console.log('Selected files: ');
            console.table(files);
        },
        getSampleDetail() {
            axios.get('/api/samples/'+this.$route.params.id).then((res) =>{
                this.sampleData = res.data.data;
                this.sampleData.created_at = moment(this.sampleData.created_at).format('YYYY-MM-DD');
                this.sampleTypePhotos = [];
                if(this.sampleData.sample_type_photo.length == 0) {
                    this.sampleTypePhotos = [];
                } else {
                    this.sampleTypePhotos = this.sampleData.sample_type_photo;
                }
                this.techDataPhotos = [];
                if(this.sampleData.tech_data_photo.length == 0) {
                    this.techDataPhotos = [];
                } else {
                    this.techDataPhotos = this.sampleData.tech_data_photo;
                }
                this.client_sign = this.sampleData.client_sign;
                this.client_rep_sign = this.sampleData.client_rep_sign;
                this.architect_sign = this.sampleData.architect_sign
                this.service_consult_sign = this.sampleData.service_consult_sign
                this.structural_consult_sign = this.sampleData.structural_consult_sign
                this.esd_sign = this.sampleData.esd_sign
                this.bca_sign = this.sampleData.bca_sign
                this.sampleData.subcontractor = JSON.parse(localStorage.getItem('user')).name;

                this.status = this.sampleData.status;

                this.projectName = this.sampleData.project.title;

                let sampleDateSignatureValues = this.sampleData.signatureValues;
                if(sampleDateSignatureValues == "[]") {
                    sampleDateSignatureValues = [];
                }
                delete this.sampleData.signatureValues;
                this.inputs = [];
                if(sampleDateSignatureValues.length == 0) {
                    this.overAllStatus = 'Pending';
                    this.overAllStatusColor = 'orange';
                    this.inputs.push(
                        {
                            label_name: '',
                            user_id: '',
                            signature: '',
                            comment: '',
                            status: 0
                        }
                    );
                } else {
                    this.inputs = sampleDateSignatureValues;
                    let sampleCheck = sampleDateSignatureValues.map((element) => {
                        return parseInt(element.status);
                    });
                    if(this.allEqual(sampleCheck)) {
                        if(sampleCheck[0] == 1) {
                            this.overAllStatusColor = 'green';
                            this.overAllStatus = 'Approved';
                        } else if(sampleCheck[0] == 2) {
                            this.overAllStatusColor = 'red';
                            this.overAllStatus = 'All Rejected';
                        }
                    }
                }
                setTimeout(() => this.initailAllCanvas() , 2000);
            });
        },
        allEqual(arr) {
            return new Set(arr).size == 1;
        },
        addPhoto() {
            document.getElementById("fileUpload").click();
        },
        addTechPhoto() {
            document.getElementById("techDataFile").click();
        },
        onPhotochange(e) {
            let file = e.target.files[0];
            this.sampleData.sample_type_photo = file;
            if((file.type).includes("image")) {
                let reader = new FileReader();
                reader.onloadend = (file) => {
                    this.avatar = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                this.avatar = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";
            }
        },
        ontechDataFileChange(e) {
            let file = e.target.files[0];
            this.sampleData = file;
            if((file.type).includes("image")) {
                let reader = new FileReader();
                reader.onloadend = (file) => {
                    this.techavatar = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                this.techavatar = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";
            }
        },
        updateSample() {
            let formData = new FormData();
            formData.append('_method', 'put');
            _.each(this.sampleData, (value, key) => {
                if(key == "sample_type_photo") {
                    if(this.fileRecordsForUpload.length > 0)
                    {
                       formData.append('sample_type_photo', this.fileRecordsForUpload);
                    }
                    // if(document.getElementById('fileUpload').value != "") {
                    //     formData.append(key, value)
                    // }
                } else if(key == "tech_data_photo") {
                    // if(document.getElementById('techDataFile').value != "") {
                    //     formData.append(key, value)
                    // }
                } else {
                    formData.append(key, value)
                }
            });
            formData.append('signatureValues', JSON.stringify(this.inputs));
            axios.post('/api/samples/'+this.$route.params.id, formData).then((res) => {
                window.location.reload()
            });
        },
        initailAllCanvas() {
            this.inputs.forEach((element, i) => {
                if(document.getElementById("signature-pad"+i))
                this.initailSign("signature-pad"+i);
            });
        },
        initailSign(id) {
            var canvas = document.getElementById(id);
            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }
            window.onresize = resizeCanvas;
            resizeCanvas();
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(250,250,250)'
            });

            // document.getElementById(id+"clear").addEventListener('click', function(){
            //     signaturePad.clear();
            // })
        },
        uploadPadSignature(k) {
            // if(commentValue.value == '') {
            //     new swal({
            //         title: 'Warning',
            //         text: 'please add comment first',
            //         type: 'warning',
            //     });
            // } else {
                var files = this.$refs['signature'+k][0].toDataURL('image/png');
                var file = dataURLtoBlob(files);
                file = new File([file], "signature.png", {
                    type: "image/jpeg",
                    lastModified: Date.now()
                });
                let formData = new FormData();
                formData.append('sign', file);
                formData.append('key', k);
                // formData.append('commentValue', this.$refs['comment'+k][0].value);
                console.log(formData);
                axios.post('/api/samples/signatureUpload/'+this.$route.params.id, formData).then((res) => {
                    window.location.reload();
                });
            // }
        },
        deleteSignature(key) {
            let formData = new FormData();
            formData.append('key', key);
            axios.post('/api/samples/deleteSignature/'+this.$route.params.id, formData).then((res) => {
                window.location.reload();
            });
        },
        changeStatus(key) {
            let formData = new FormData();
            formData.append('key', key);
            formData.append('comment', this.inputs[key].comment);
            formData.append('status', this.inputs[key].status)
            axios.post('/api/samples/updateSignature/'+this.$route.params.id, formData).then((res) => {
                window.location.reload();
            });
        },
        refreshFileSelector() {
            this.fileRecordsForUpload = [];
            this.fileRecords = [];
        },
        changeUploadUrl(type) {
            if(type == 'sample_type') {
                this.uploadUrl = 'http://18.223.248.192/api/samples/sampleTypePhotoUpload/'+this.$route.params.id;
            } else {
                this.uploadUrl ='http://18.223.248.192/api/samples/techDataPhotoUpload/'+this.$route.params.id;
            }
        },
        getUserList() {
            axios.get('/api/users').then(response=> {
                this.users = response.data.data
            });
        },
        changeSampleStatus(status) {
            let formData = new FormData();
            formData.append('status', status);
            axios.post('/api/samples/changeSampleStatus/'+this.$route.params.id, formData).then((res) => {
                window.location.reload();
            });
        }
    },
    created() {
        this.getSampleDetail();
        this.getUserList();
        this.getPermission();
    }
}
</script>

<style scoped>
.projectName {
    font-size: 20px;
    margin-bottom: 16px;
}
.frame {
  height: auto;
  width: auto;
  padding: 20px;
  border: 1px solid black;
  position: relative;
}
.button {
  position: absolute;
  top: 5px;
  right: 20px;
  height: 25px;
  width: 25px;
  background-color: red;
  color: white;
}
.content {
  display: block;
}
.hide {
  display: none;
}
.sample-title{
    padding: 10px;
}
.thumb-lg {
    width: 100%;
    height: auto;
}
#fileUpload {
    display: none;
}
#techDataFile {
    display: none;
}
.iframeClass {
    width: 100%;
    height: 400px;
    margin-top: 20px;
}
</style>
