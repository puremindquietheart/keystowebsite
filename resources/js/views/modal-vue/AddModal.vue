<template>
    <div class="modal fade" id="addBikeModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-plus-square"></i> Add New Product</h5>
                </div>
                <form class="form-horizontal" @submit.prevent="confirmNewBike">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label>Bike Name</label>
                            <input type="text" class="form-control" v-model="new_bike_data.bike_name" placeholder="Input Bike Name" required>
                        </div>
                        <div class="form-group">
                            <label>Bike Quantity</label>
                            <vue-numeric currency="PC/s" currency-symbol-position="suffix" separator="," v-model="new_bike_data.bike_qty" class="form-control" placeholder="Input Bike Quantity" required></vue-numeric>
                            
                        </div>
                        <div class="form-group">
                            <label>Bike Price</label>
                            <vue-numeric currency="₱" separator="," v-bind:precision="2" v-model="new_bike_data.bike_price" class="form-control" placeholder="Input Bike Price" required></vue-numeric>
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>Confirm</button>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" @click="closeAddModal"> <i class="fa fa-close"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {   
        return {
            new_bike_data: {
                bike_name: '',
                bike_qty: '',
                bike_price: ''
            }
        }
    },

    methods: {
        showAddModal() {
            $('#addBikeModal').modal('show'); 
        },
        
        closeAddModal() {
            $('#addBikeModal').modal('hide');
            this.whenModalClose();
        },

        whenModalClose() {
            this.new_bike_data.bike_name = '';
            this.new_bike_data.bike_qty = '';
            this.new_bike_data.bike_price = '';
        },

        confirmNewBike() {
            fetch('api/keysto-bike', {
                method: 'post',
                body: JSON.stringify(this.new_bike_data),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(res => res.json())
            .then(data => {
                if (data.success === true) {
                    this.closeAddModal();
                    this.$swal({
                        title: 'Success!',
                        type: 'success',
                        text: 'New Bike was Created!'
                    }).then(() => {
                        this.$parent.message = data.message;
                        this.$parent.success = true;
                        this.$parent.fetchBikeDetails();
                    }).then(() => {
                        setTimeout(() => {
                            this.$parent.message = '';
                            this.$parent.success = false;
                        }, 3500);
                    });
                } else {
                    this.$swal({
                        title: 'Exist!',
                        type: 'warning',
                        text: 'Bike Name Already Exist!',
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    }).then(()=> {
                        this.whenModalClose();
                    });
                }
                
            })
            .catch(err => console.log(err))
        }
    }
}
</script>
