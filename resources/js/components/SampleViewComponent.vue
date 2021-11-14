<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <h3 class="text-center text-dark projectName">{{ projectName }}</h3>
            <form method="POST" @submit.prevent="updateSample" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 col-xlg-6 col-md-12">
                        <div class="row">
                            <div class="form-group row">
                                <h3 class="bg-dark text-white sample-title">Sample Details</h3>
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
                                <h3 class="bg-dark text-white sample-title">Approval</h3>
                                <label for="name" class="col-md-4 col-form-label text-md-right">Client</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.client_sign == null">
                                        <canvas ref="mySignature" id="signature-pad1" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="clientSignatureComment" placeholder="Client Signature Comment" v-model="sampleData.clientSignatureComment" class="form-control"></textarea>
                                    </div>

                                    <div class="clear-btn" v-if="this.client_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('client_sign', $refs.mySignature, 'clientSignatureComment',$refs.clientSignatureComment )" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad1"><span> Clear </span></a> -->
                                        <a v-if="delete_sign" class="btn btn-danger" @click="deleteSignature('client_sign', 'clientSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.client_sign != null">
                                        <img :src="this.client_sign"/>
                                        <textarea placeholder="Client Signature Comment" v-model="sampleData.clientSignatureComment" class="form-control"></textarea>
                                        <a v-if="delete_sign" class="btn btn-danger" @click="deleteSignature('client_sign', 'clientSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Client Rep</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.client_rep_sign == null">
                                        <canvas ref="clientRepoSignature" id="signature-pad2" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="clientRepSignatureComment" placeholder="ClientRep Signature Comment" v-model="sampleData.clientRepSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.client_rep_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('client_rep_sign', $refs.clientRepoSignature, 'clientRepSignatureComment', $refs.clientRepSignatureComment)" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad2"><span> Clear </span></a> -->
                                        <a class="btn btn-danger" @click="deleteSignature('client_rep_sign', 'clientRepSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.client_rep_sign != null">
                                        <img :src="this.client_rep_sign"/>
                                        <textarea placeholder="ClientRep Signature Comment" v-model="sampleData.clientRepSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('client_rep_sign', 'clientRepSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Architect</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.architect_sign == null">
                                        <canvas ref="architectRepoSignature" id="signature-pad3" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="architectSignatureComment" placeholder="Architect Signature Comment" v-model="sampleData.architectSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.architect_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('architect_sign', $refs.architectRepoSignature, 'architectSignatureComment', $refs.architectSignatureComment)" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad3"><span> Clear </span></a> -->
                                        <a class="btn btn-danger" @click="deleteSignature('architect_sign', 'architectSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.architect_sign != null">
                                        <img :src="this.architect_sign"/>
                                        <textarea placeholder="Architect Signature Comment" v-model="sampleData.architectSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('architect_sign', 'architectSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Service Consult</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.service_consult_sign == null">
                                        <canvas ref="serviceRepoSignature" id="signature-pad4" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="serviceRepoSignature" placeholder="Service Consult Signature Comment" v-model="sampleData.serviceRepoSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.service_consult_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('service_consult_sign', $refs.serviceRepoSignature, 'serviceRepoSignature', $refs.serviceRepoSignature)" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad4"><span> Clear </span></a> -->
                                        <a class="btn btn-danger" @click="deleteSignature('service_consult_sign', 'serviceRepoSignature')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.service_consult_sign != 'null'">
                                        <img :src="this.service_consult_sign"/>
                                        <textarea placeholder="ServiceRepo SignatureComment" v-model="sampleData.serviceRepoSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('service_consult_sign', 'serviceRepoSignature')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Structural Consult</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.structural_consult_sign == null">
                                        <canvas ref="structuralRepoSignature" id="signature-pad5" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="structuralRepoSignatureComment" placeholder="StructuralRepo Signature Comment" v-model="sampleData.structuralRepoSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.structural_consult_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('structural_consult_sign', $refs.structuralRepoSignature, 'structuralRepoSignatureComment', $refs.structuralRepoSignatureComment)" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad5"><span> Clear </span></a> -->
                                        <a class="btn btn-danger" @click="deleteSignature('structural_consult_sign', 'structuralRepoSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.structural_consult_sign != null">
                                        <img :src="this.structural_consult_sign"/>
                                        <textarea placeholder="structuralRepoSignatureComment" v-model="sampleData.structuralRepoSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('structural_consult_sign', 'structuralRepoSignatureComment')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">ESD</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.esd_sign == null">
                                        <canvas ref="esdRepoSignature" id="signature-pad6" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="esdRepoSignature" placeholder="EsdRepo Signature Comment" v-model="sampleData.esdRepoSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.esd_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('esd_sign', $refs.esdRepoSignature, 'esdRepoSignature', $refs.esdRepoSignature)" id="save"><span> Save </span></a>
                                        <!-- <button class="btn btn-danger" id="clearsignature-pad6"><span> Clear </span></button> -->
                                        <a class="btn btn-danger" @click="deleteSignature('esd_sign', 'esdRepoSignature')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.esd_sign != null">
                                        <img :src="this.esd_sign"/>
                                        <textarea placeholder="esdRepoSignatureComment" v-model="sampleData.esdRepoSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('esd_sign', 'esdRepoSignature')" ><span> Delete </span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">BCA</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.bca_sign == null">
                                        <canvas ref="bcaRepoSignature" id="signature-pad7" class="signature-pad" width="400" height="200"></canvas>
                                        <textarea ref="bcaRepoSignature" placeholder="CcaRepo Signature Comment" v-model="sampleData.bcaRepoSignatureComment" class="form-control"></textarea>
                                    </div>
                                    <div class="clear-btn" v-if="this.bca_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('bca_sign', $refs.bcaRepoSignature, 'bcaRepoSignature', $refs.bcaRepoSignature)" id="save"><span> Save </span></a>
                                        <!-- <a class="btn btn-danger" id="clearsignature-pad7"><span> Clear </span></a> -->
                                        <a class="btn btn-danger" @click="deleteSignature('bca_sign', 'bcaRepoSignature')" ><span> Delete </span></a>
                                    </div>
                                    <div v-if="this.bca_sign != null">
                                        <img :src="this.bca_sign"/>
                                        <textarea placeholder="bcaRepoSignatureComment" v-model="sampleData.bcaRepoSignatureComment" class="form-control"></textarea>
                                        <a class="btn btn-danger" @click="deleteSignature('bca_sign', 'bcaRepoSignature')" ><span> Delete </span></a>
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
export default {
    name: 'view-sample',
    data() {
        return {
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
            delete_sign: false,
            sampleTypePhotos: [],
            techDataPhotos: [],
        }
    },
    methods: {
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
            this.getSampleDetail();
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

                this.projectName = this.sampleData.project.title;
            });
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
            console.log(this.fileRecordsForUpload);
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
            axios.post('/api/samples/'+this.$route.params.id, formData).then((res) => {
                // window.location.reload()
            });
        },
        initailAllCanvas() {
            if(!this.sampleData.client_sign)
            {
                this.initailSign("signature-pad1");
            }
            if(!this.sampleData.client_rep_sign)
            {
                this.initailSign("signature-pad2");
            }
            if(!this.sampleData.architect_sign)
            {
                this.initailSign("signature-pad3");
            }
            if(!this.sampleData.service_consult_sign)
            {
                this.initailSign("signature-pad4");
            }
            if(!this.sampleData.structural_consult_sign)
            {
                this.initailSign("signature-pad5");
            }
            if(!this.sampleData.esd_sign)
            {
                this.initailSign("signature-pad6");
            }
            if(!this.sampleData.client_sign)
            {
                this.initailSign("signature-pad7");
            }
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
        uploadPadSignature(key, signature, commentKey, commentValue) {
            if(commentValue.value == '') {
                new swal({
                    title: 'Warning',
                    text: 'please add comment first',
                    type: 'warning',
                });
            } else {
                var files = signature.toDataURL('image/png');
                var file = dataURLtoBlob(files);
                file = new File([file], "signature.png", {
                    type: "image/jpeg",
                    lastModified: Date.now()
                });
                let formData = new FormData();
                formData.append('sign', file);
                formData.append('key', key);
                formData.append('commentKey', commentKey);
                formData.append('commentValue', commentValue.value);

                axios.post('/api/samples/signatureUpload/'+this.$route.params.id, formData).then((res) => {
                    window.location.reload();
                });
            }
        },
        deleteSignature(key, commentKey) {
            let formData = new FormData();
            formData.append('key', key);
            formData.append('commentKey', commentKey);
            axios.post('/api/samples/deleteSignature/'+this.$route.params.id, formData).then((res) => {
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
        }
    },
    created() {
        this.getSampleDetail();
        axios.get('/api/users/permission/delete_sign').then((response) => {
            this.delete_sign = response.data;
        });
        setTimeout(() => this.initailAllCanvas() , 2000)
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
