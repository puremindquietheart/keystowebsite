<style scoped>
    .preview img {
    max-width: 100%;
    max-height: 500px;
    }
</style>

<template>
    <div class="modal fade" id="photoUploadModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-upload"></i> Upload Bike Photos</h5>
                </div>
                <form class="form-horizontal" @submit.prevent="savePhotos" enctype="multipart/form-data">
                
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-3 text-center">
                                        <div class="card">
                                            <div class="preview">
                                                <img v-if="bike_photo_url.first_photo" :src="bike_photo_url.first_photo" />
                                            </div>
                                        </div>
                                        <input type="file" ref="first_photo_ref" style="display:none;" @change="firstPhotoChange">
                                        <br>
                                        <button type="button" class="btn btn-success btn-sm" id="firstPhotoUpload" @click="$refs.first_photo_ref.click()"><i class="fa fa-file-image-o"></i> Select First Photo</button>
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        <div class="card">
                                            <div class="preview">
                                                <img v-if="bike_photo_url.second_photo" :src="bike_photo_url.second_photo" />
                                            </div>
                                        </div>
                                        <br>
                                        <input type="file" ref="second_photo_ref" style="display:none;" @change="secondPhotoChange">
                                        <button type="button" class="btn btn-success btn-sm" id="firstPhotoUpload" @click="$refs.second_photo_ref.click()"><i class="fa fa-file-image-o"></i> Select Second Photo </button>
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        <div class="card">
                                            <div class="preview">
                                                <img v-if="bike_photo_url.third_photo" :src="bike_photo_url.third_photo" />
                                            </div>
                                        </div>
                                        <br>
                                        <input type="file" ref="third_photo_ref" style="display:none;" @change="thirdPhotoChange">
                                        <button type="button" class="btn btn-success btn-sm" id="firstPhotoUpload" @click="$refs.third_photo_ref.click()"><i class="fa fa-file-image-o"></i> Select Third Photo </button>
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        <div class="card">
                                            <div class="preview">
                                                <img v-if="bike_photo_url.fourth_photo" :src="bike_photo_url.fourth_photo" />
                                            </div>
                                        </div>
                                        <br>
                                        <input type="file" ref="fourth_photo_ref" style="display:none;" @change="fourthPhotoChange">
                                        <button type="button" class="btn btn-success btn-sm" id="firstPhotoUpload" @click="$refs.fourth_photo_ref.click()"><i class="fa fa-file-image-o"></i> Select Fourth Photo </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <ckeditor :editor="editor" v-model="bike_upload_photo.bike_description"></ckeditor>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-light btn-md" data-dismiss="modal" @click="closeUploadModal"><i class="fa fa-close"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data() {
        return {
            // ckeditor
            editor: ClassicEditor,
            bike_upload_photo: {
                assigned_bike_id: '',
                bike_description: '',
                photos: []
            },
            bike_photo_url: {
                first_photo: '',
                second_photo: '',
                third_photo: '',
                fourth_photo: '',
            },
            
        }
    },

    methods: {
        showUploadModal(id) {
            $('#photoUploadModal').modal('show');

            fetch('api/keysto-photo/'+id, {
                method: 'get'
            }).then(res => res.json())
            .then(result => {
                if (result.exist === true) {
                    // pass bike data
                    // this.bike_upload_photo.first_photo = result.data.
                    // make bike photo url
                } else if (result.exist === false) {
                    this.bike_upload_photo.assigned_bike_id = id;
                }
            })
            .catch(err => console.log(err));
        },
        
        closeUploadModal() {
            $('#photoUploadModal').on('hidden.bs.modal', () => {
                // photo urls
                this.bike_photo_url.first_photo = '';
                this.bike_photo_url.second_photo = '';
                this.bike_photo_url.third_photo = '';
                this.bike_photo_url.fourth_photo = '';
                // photo data
                this.bike_upload_photo.photos = [];
                // this.bike_upload_photo.photos.first_photo = '';
                // this.bike_upload_photo.photos.second_photo = '';
                // this.bike_upload_photo.photos.third_photo = '';
                // this.bike_upload_photo.photos.fourth_photo = '';
                this.bike_upload_photo.bike_description = '';
                this.bike_upload_photo.assigned_bike_id = '';
            });
        },

        savePhotos() {
            fetch('api/keysto-photo', {
                method: 'post',
                body: JSON.stringify(this.bike_upload_photo),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(res => res.json())
            .then(result => {
                console.log(result);
            })
            .catch(err => console.log(err));
        },

        firstPhotoChange(e) {
            const first_photo_uploaded = e.target.files[0];
            this.bike_photo_url.first_photo = URL.createObjectURL(first_photo_uploaded);
            this.bike_upload_photo.photos.push(first_photo_uploaded);
        },      

        secondPhotoChange(e) {
            const second_photo_uploaded = e.target.files[0];
            this.bike_photo_url.second_photo = URL.createObjectURL(second_photo_uploaded);
            this.bike_upload_photo.photos.push(second_photo_uploaded);
        },

        thirdPhotoChange(e) {
            const third_photo_uploaded = e.target.files[0];
            this.bike_photo_url.third_photo = URL.createObjectURL(third_photo_uploaded);
            this.bike_upload_photo.photos.push(third_photo_uploaded);
        },

        fourthPhotoChange(e) {
            const fourth_photo_uploaded = e.target.files[0];
            this.bike_photo_url.fourth_photo = URL.createObjectURL(fourth_photo_uploaded);
            this.bike_upload_photo.photos.push(fourth_photo_uploaded);
        }
    }
}
</script>
