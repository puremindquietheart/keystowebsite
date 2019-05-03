<template>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Product</h4>
            </div>
            <form class="forms-sample">
                <div class="card-body">
                    <div class="form-group">
                        <label for="input_photo_bike_name">Bike Name</label>
                        <input type="text" class="form-control" id="input_photo_bike_name" v-model="photo_details.input_photo_bike_name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="input_photo_bike_description">Bike Description</label>
                        <textarea class="form-control" id="input_photo_bike_description" v-model="photo_details.input_photo_bike_description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="file" style="display:none;" ref="inputFileUpload" class="form-control file-upload-info" @change="uploadedImage" placeholder="Upload Image">
                            <button class="file-upload-browse btn btn-primary" type="button" @click="$refs.inputFileUpload.click()">Select Image</button>&nbsp;
                            <button class="file-upload-browse btn btn-info" type="button" @click="confirmUpload">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>       
    </div>
</template>

<script>
export default {
    data() {
        return {
            photo_details: {
                input_photo_bike_name: '',
                input_photo_bike_description: '',
                input_photo_name: ''
            }   
        }
    },
    methods: {
        uploadedImage (event) {
            this.photo_details.input_photo_name = event.target.files[0];
        },

        confirmUpload() {
            fetch('api/admin-dashboard', {
                method: 'post',
                body: JSON.stringify(this.photo_details),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(res => res.json())
                .then(data => {
                    this.photo_details.input_photo_bike_name = '';
                    this.photo_details.input_photo_bike_description = '';
                    this.photo_details.input_photo_name = '';
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

