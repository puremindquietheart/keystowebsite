<template>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-transparent border-success">
                <h4 class="card-title">Add New Product</h4>
                <div class="alert alert-success" v-if="success.status">
                    <span>{{ success.message }}</span>
                </div>
            </div>
            <form class="forms-horizontal" @submit.prevent="confirmNewBike">
                <div class="card-body">
                    <div class="form-group">
                        <label>Bike Name</label>
                        <div class="alert alert-warning" v-if="required.bike_name">
                            <span>{{ message.bike_name }}</span>
                        </div>
                        <input type="text" class="form-control" v-model="photo_details.input_photo_bike_name" placeholder="Input Bike Name" autocomplete="off">
                        
                    </div>
                    <div class="form-group">
                        <label>Bike Description</label>
                        <div class="alert alert-warning" v-if="required.bike_description">
                            <span>{{ message.bike_description }}</span>
                        </div>
                        <ckeditor :editor="editor" v-model="photo_details.input_photo_bike_description"></ckeditor>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="alert alert-warning" v-if="required.bike_image">
                            <span>{{ message.bike_image }}</span>
                        </div>
                        <input type="file" class="form-control" @change="uploadedPhotoDetails" ref="fileInputName" placeholder="Upload Bike Image">
                    </div>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <button type="submit" class="btn btn-success mr-2"><i class="mdi mdi-cloud-download"></i>Upload</button>
                </div>
            </form>
        </div>       
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        data() {
            return {
                photo_details: {
                    input_photo_bike_name: '',
                    input_photo_bike_description: '',
                    input_photo_name: '',
                    image_size: ''
                },
                message: {
                    bike_name: '',
                    bike_description: '',
                    bike_image: ''
                },
                required: {
                    bike_name: false,
                    bike_description: false,
                    bike_image: false
                },
                success: {
                    status: false,
                    message: ''
                },
                editor: ClassicEditor
            }
        },
        methods: {
            uploadedPhotoDetails(event) {
                this.photo_details.input_photo_name = event.target.files[0].name;
                this.photo_details.image_size = event.target.files[0].size / 1000000;
            },
            confirmNewBike() {
                this.axios
                    .post('api/keysto-admin', this.photo_details)
                    .then((response) => {
                        const input = this.$refs.fileInputName;
                        
                        if (response.status == 200) {
                            input.type = 'text';
                            input.type = 'file';
                            // photo details empty
                            this.photo_details.input_photo_bike_name = '';
                            this.photo_details.input_photo_bike_description = '';
                            this.photo_details.input_photo_name = '';
                            this.photo_details.image_size = '';
                            // message empty
                            this.message.bike_name = '';
                            this.message.bike_description = '';
                            this.message.bike_image = '';
                            // required status
                            this.required.bike_name = false;
                            this.required.bike_description = false;
                            this.required.bike_image = false;
                            // success message
                            this.success.status = true;
                            this.success.message = 'New Image was Uploaded Successfully!';
                            // success message fade out
                            setTimeout(() => {
                                this.success.message = '';
                                this.success.status = false;
                            }, 5000);
                        }
                    })
                    .catch((errors) => {
                        const error = errors.response.data.errors;

                        if (error.input_photo_bike_name) {
                            this.required.bike_name = true;
                            this.message.bike_name = error.input_photo_bike_name[0];
                        } else {
                            this.required.bike_name = false;
                        }

                        if (error.input_photo_bike_description) {
                            this.required.bike_description = true;
                            this.message.bike_description = error.input_photo_bike_description[0];
                        } else {
                            this.required.bike_description = false;
                        }

                        if (error.input_photo_name) {
                            this.required.bike_image = true;
                            this.message.bike_image = error.input_photo_name[0];
                        } else {
                            this.required.bike_image = false;
                        }
                    });
            }
        }
    }
</script>

