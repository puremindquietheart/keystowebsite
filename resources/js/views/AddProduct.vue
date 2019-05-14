<style scoped>
    .table td, th {
        text-align: center;   
    }
</style>

</style>


<template>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-transparent border-success">
                <h4 class="card-title">Create New Product</h4>
                <button type="button" class="btn btn-primary btn-sm" @click="addModal"><i class="fa fa-plus-square"></i>New Bike</button>
                <addmodal ref="addModalOpen"></addmodal>
                <editmodal ref="editModalOpen"></editmodal>
                <uploadmodal ref="uploadModalOpen"></uploadmodal>
            </div>
            <div class="card-body table-responsive">
                <h4 class="card-title">Keysto Bike List</h4>
                <div v-if="success" class="alert alert-success">
                    {{ message }}
                </div>
                <div v-if="available === 1" class="alert alert-success">
                    {{ message }}
                </div>
                <div v-else-if="available === 0" class="alert alert-danger">
                    {{ message }}
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th>Bike Name</th>
                        <th>Bike Quantity</th>
                        <th>Bike Price</th>
                        <th>Bike Available</th>
                        <th>Edit Bike Details</th>
                        <th>Upload</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="details in bike_details" v-bind:key="details.id">
                            <td>{{ details.bike_name }}</td>
                            <td>{{ details.bike_quantity }} PC/s</td>
                            <td>{{ details.bike_price | toCurrency }}</td>
                            <td v-if="details.bike_available == 1">
                                <button type="button" class="btn btn-primary btn-sm" @click="bikeAvailable(details.id)"><i class="fa fa-check"></i> Available</button>
                            </td>
                            <td v-else-if="details.bike_available == 0">
                                <button type="button" class="btn btn-danger btn-sm" @click="bikeAvailable(details.id)"><i class="fa fa-ban"></i> Not Available</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" @click="showBikeDetails(details.id)"><i class="fa fa-edit"></i> Edit Details</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" @click="uploadImage(details.id)"><i class="fa fa-upload"></i> Upload</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav>
                    <ul class="pagination rounded-flat pagination-success">
                        <li class="page-item" v-bind:class="[{ disabled: !bike_pagination.prev_page_url }]">
                            <a class="page-link" href="#" @click="fetchBikeDetails(bike_pagination.prev_page_url)"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ bike_pagination.current_page }} of {{ bike_pagination.last_page }} </a></li>
                        <li class="page-item" v-bind:class="[{ disabled: !bike_pagination.next_page_url }]">
                            <a class="page-link" href="#" @click="fetchBikeDetails(bike_pagination.next_page_url)"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>       
    </div>
</template>

<script>

import addmodal from './modal-vue/AddModal'
import editmodal from './modal-vue/EditModal'
import uploadmodal from './modal-vue/UploadModal'

export default {
    data () {
        return {
            bike_details: [],
            bike_pagination: {},
            success: false,
            available: '',
            message: '',
            put_method: {
                bike_available: ''
            }
        }
    },
    components: {
        addmodal,
        editmodal,
        uploadmodal
    },
    created() {
        this.fetchBikeDetails();
    },
    methods: {
        // for table
        fetchBikeDetails(page_url) {
            page_url = page_url || '/api/keysto-bike';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.bike_details = res.data;
                this.bikePagination(res.meta, res.links);
            }).catch(err => console.log(err));
        },

        // for pagination
        bikePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.bike_pagination = pagination;
        },

        // for product availability
        bikeAvailable(id) {
            this.put_method.bike_available = 1;

            fetch('api/keysto-bike/'+id, {
                method: 'put',
                body: JSON.stringify(this.put_method),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(res => res.json())
            .then(result => {
               if (result.unavailable === false) {
                    this.$swal({
                        title: 'Available!',
                        type: 'success',
                        text: 'Bike was Available!'
                    }).then(() => {
                        this.available = 1;
                        this.message = result.message;
                        this.fetchBikeDetails();
                    });
                    setTimeout(() => {
                        this.available = '';
                        this.message = '';
                    }, 3500);
               } else if (result.unavailable === true) {
                    this.$swal({
                        title: 'Unavailable!',
                        type: 'warning',
                        text: 'Bike was Unavailable!'
                    }).then(() => {
                        this.available = 0;
                        this.message = result.message;
                        this.fetchBikeDetails();
                    });
                    setTimeout(() => {
                        this.available = '';
                        this.message = '';
                    }, 3500);
               }
            })  
            .catch(err => console.log(err))
        },
        // for add modal open
        addModal() {
            this.$refs.addModalOpen.showAddModal();
        },

        // for edit modal open
        showBikeDetails(id) {
            this.$refs.editModalOpen.showEditModal(id);
        },

        uploadImage(id) {
            this.$refs.uploadModalOpen.showUploadModal(id);
        }
    }
}
</script>

