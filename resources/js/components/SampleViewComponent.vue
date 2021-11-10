<template>
    <div class="page-wrapper">
        <div class="container-fluid">
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
                                <label for="specification" class="col-md-4 col-form-label text-md-right">Warrenty Period</label>
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
                            <b-modal id="modal-1" title="Upload File">
                                <button class="btn btn-success text-white photo" style="width:100%" type="button" @click="addPhoto()">Select File</button>
                                <div class="avatar img-fluid img-circle text-center" style="margin-top:10px">
                                    <img :src="avatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
                                </div>
                            </b-modal>
                            <b-modal id="modal-2" title="Upload File">
                                <button class="btn btn-success text-white photo" style="width:100%" type="button" @click="addTechPhoto()">Select File</button>
                                <div class="avatar img-fluid img-circle text-center" style="margin-top:10px">
                                    <img :src="techavatar || 'https://png.pngitem.com/pimgs/s/64-646593_thamali-k-i-s-user-default-image-jpg.png'" class="thumb-lg img-circle"/>
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
                                    </div>
                                    <div class="clear-btn" v-if="this.client_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('client_sign', $refs.mySignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad1"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.client_sign != null">
                                        <img :src="this.client_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Client Rep</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.client_rep_sign == null">
                                        <canvas ref="clientRepoSignature" id="signature-pad2" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.client_rep_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('client_rep_sign', $refs.clientRepoSignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad2"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.client_rep_sign != null">
                                        <img :src="this.client_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Architect</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.architect_sign == null">
                                        <canvas ref="architectRepoSignature" id="signature-pad3" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.architect_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('architect_sign', $refs.architectRepoSignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad3"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.architect_sign != null">
                                        <img :src="this.architect_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Service Consult</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.service_consult_sign == null">
                                        <canvas ref="serviceRepoSignature" id="signature-pad4" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.service_consult_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('service_consult_sign', $refs.serviceRepoSignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad4"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.service_consult_sign != 'null'">
                                        <img :src="this.service_consult_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Structural Consult</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.structural_consult_sign == null">
                                        <canvas ref="structuralRepoSignature" id="signature-pad5" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.structural_consult_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('structural_consult_sign', $refs.structuralRepoSignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad5"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.structural_consult_sign != null">
                                        <img :src="this.structural_consult_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">ESD</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.esd_sign == null">
                                        <canvas ref="esdRepoSignature" id="signature-pad6" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.esd_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('esd_sign', $refs.esdRepoSignature)" id="save"><span> Save </span></a>
                                        <button class="btn btn-danger" id="clearsignature-pad6"><span> Clear </span></button>
                                    </div>
                                    <div v-if="this.esd_sign != null">
                                        <img :src="this.esd_sign"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">BCA</label>
                                <div class="col-md-8">
                                    <div class="wrapper" v-if="this.bca_sign == null">
                                        <canvas ref="bcaRepoSignature" id="signature-pad7" class="signature-pad" width="400" height="200"></canvas>
                                    </div>
                                    <div class="clear-btn" v-if="this.bca_sign == null">
                                        <a class="btn btn-success" @click="uploadPadSignature('bca_sign', $refs.bcaRepoSignature)" id="save"><span> Save </span></a>
                                        <a class="btn btn-danger" id="clearsignature-pad7"><span> Clear </span></a>
                                    </div>
                                    <div v-if="this.bca_sign != null">
                                        <img :src="this.bca_sign"/>
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
export default {
    name: 'view-sample',
    data() {
        return {
            sampleData: {},
            client_sign: null,
            client_rep_sign: null,
            architect_sign: null,
            service_consult_sign: null,
            structural_consult_sign: null,
            esd_sign: null,
            bca_sign: null,
            sample_type_photo: null,
            tech_data_photo: null,
            avatar:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6VkVrykv609kj3hwVZHvkxDsy0EqGR19_lA&usqp=CAU',
            techavatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6VkVrykv609kj3hwVZHvkxDsy0EqGR19_lA&usqp=CAU'
        }
    },
    methods: {
        getSampleDetail() {
            axios.get('/api/samples/'+this.$route.params.id).then((res) =>{
                this.sampleData = res.data.data;
                this.sampleData.created_at = moment(this.sampleData.created_at).format('YYYY-MM-DD');

                if(this.sampleData.sample_type_photo) {
                    if(this.sampleData.sample_type_photo.includes('.pdf')) {
                        this.avatar = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";
                    } else {
                        this.avatar = this.sampleData.sample_type_photo;
                    }
                }
                if(this.sampleData.tech_data_photo) {
                    if(this.sampleData.tech_data_photo.includes('.pdf')) {
                        this.techavatar = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";
                    } else {
                        this.techavatar = this.sampleData.tech_data_photo;
                    }
                }

                this.client_sign = this.sampleData.client_sign;
                this.client_rep_sign = this.sampleData.client_rep_sign;
                this.architect_sign = this.sampleData.architect_sign
                this.service_consult_sign = this.sampleData.service_consult_sign
                this.structural_consult_sign = this.sampleData.structural_consult_sign
                this.esd_sign = this.sampleData.esd_sign
                this.bca_sign = this.sampleData.bca_sign

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
            this.sample_type_photo = file;
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
            this.tech_data_photo = file;
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
            formData.append('sample_type_photo1', this.sample_type_photo);
            formData.append('tech_data_photo1', this.tech_data_photo);
            formData.append('_method', 'put');
            _.each(this.sampleData, (value, key) => {
                formData.append(key, value)
            });
            axios.post('/api/samples/'+this.$route.params.id, formData).then((res) => {
                window.location.reload()
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
        uploadPadSignature(key, signature) {
            var files = signature.toDataURL('image/png');
            var file = dataURLtoBlob(files);
            file = new File([file], "signature.png", {
                type: "image/jpeg",
                lastModified: Date.now()
            });
            let formData = new FormData();
            formData.append('sign', file);
            formData.append('key', key);
            axios.post('/api/samples/signatureUpload/'+this.$route.params.id, formData).then((res) => {

            });
        }
    },
    created() {
        this.getSampleDetail();
        setTimeout(() => this.initailAllCanvas() , 2000)
    },

}
</script>

<style scoped>
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
</style>
