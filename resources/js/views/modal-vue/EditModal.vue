<template>
    <div class="modal fade" id="editBikeModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-cog"></i> Update Bike Details</h5>
                </div>
                <form class="form-horizontal" @submit.prevent="confirmUpdateBike">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bike Name</label>
                            <input type="text" class="form-control" v-model="edit_bike_details.edit_bike_name" placeholder="Input Bike Name" required>
                        </div>
                        <div class="form-group">
                            <label>Bike Quantity</label>
                            <vue-numeric currency="PC/s" currency-symbol-position="suffix" separator="," v-model="edit_bike_details.edit_bike_qty" class="form-control" placeholder="Input Bike Quantity" required></vue-numeric>
                            
                        </div>
                        <div class="form-group">
                            <label>Bike Price</label>
                            <vue-numeric currency="₱" separator="," v-bind:precision="2" v-model="edit_bike_details.edit_bike_price" class="form-control" placeholder="Input Bike Price" required></vue-numeric>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-save"></i>Update</button>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"> <i class="fa fa-close"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            edit_bike_details: {
                bike_id: '',
                edit_bike_name: '',
                edit_bike_qty: '',
                edit_bike_price: '',
            }
        }
    },
    watch: {
        // $('#editBikeModal'): function () {

        // }
    },
    methods: {
        showEditModal(bike_id) {
            $('#editBikeModal').modal('show');

            fetch('api/keysto-bike/'+bike_id, {
                method: 'get',
            }).then(res => res.json())
            .then(result => {
                this.edit_bike_details.bike_id = result.data.id;
                this.edit_bike_details.edit_bike_name = result.data.bike_name;
                this.edit_bike_details.edit_bike_qty = result.data.bike_quantity;
                this.edit_bike_details.edit_bike_price = result.data.bike_price;
            })
            .catch(err => console.log(err))
        },

        confirmUpdateBike() {
            this.$parent.put_method.bike_details = 1;
            // fetch('api/keysto-bike/'+this.bike_id, {
            //     method: 'put',
            //     body: JSON.stringify(this.edit_bike_details),
            //     headers: {
            //         'content-type': 'application/json'
            //     }
            // }).then(res => res.json())
            // .then(result => {
            //     console.log(result);
            // })
            // .catch(err => console.log(err))
        }
    }
}
</script>

