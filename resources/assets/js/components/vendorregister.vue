<template>
    <div>
        <div class="container">
            <div class="row bg-white">
                <div class="col-12 py-5 text-center">
                    <h2 class="">Offline Vendor Registration</h2>
                    <p class="my-3">Do you want to sell tickets from coolFM tickets offline? Register below to get
                        started!</p>
                </div>

                <div class="col-8 mx-auto mb-5">
                    <form action="" role="form" id="vendorForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="salutation">Title</label>
                                    <select class="form-control" name="salutation" id="salutation" v-model="salutation"
                                            required>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Miss">Miss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text"
                                           class="form-control" name="first_name" id="first_name"
                                           aria-describedby="firstHelpId"
                                           placeholder="First Name" v-model="first_name" required>
                                    <small id="firstHelpId" class="form-text text-muted">Enter your first name here
                                    </small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text"
                                           class="form-control" name="last_name" id="last_name"
                                           aria-describedby="lastHelpId"
                                           placeholder="Last Name" v-model="last_name" required>
                                    <small id="lastHelpId" class="form-text text-muted">Enter your last name here
                                    </small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text"
                                           class="form-control" name="phone_number" id="phone_number"
                                           aria-describedby="lastHelpId"
                                           placeholder="Last Name" v-model="phone_number" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           aria-describedby="emailHelpId"
                                           placeholder="Email" v-model="email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="3"
                                              v-model="address" required></textarea>
                                </div>
                            </div>
                            <div class="co1-12 text-center mx-auto">
                                <a href="javascript:" class="btn btn-lg btn-primary" v-if="!loading" @click="register()">Submit</a>
                                <a href="javascript:" class="btn btn-lg btn-primary disabled" v-if="loading">Loading</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert'

    export default {
        name: "vendorregister",
        data: function () {
            return {
                salutation: '',
                first_name: '',
                last_name: '',
                email: '',
                address: '',
                phone_number: '',
                loading: false
            }
        },
        methods: {
            register: function () {
                const empty = '';
                if ([this.first_name, this.salutation, this.last_name, this.email, this.address, this.phone_number].indexOf(empty) >= 0) {
                    return swal('Oops...', 'All fields are required', 'error');
                } else {
                    this.loading = true;
                    axios.post('/vendor/register',
                        new FormData(document.querySelector('#vendorForm'))
                    ).then((response) => {
                        this.loading = false;
                        if (response.data.type === 'success') {
                            swal('Success', response.data.message, 'success')
                        }
                    }).catch((error) => {
                        this.loading = false;
                        swal('Oops...', 'something went wrong. Please try again later', 'error');
                        console.log(error);
                    })
                }
            }
        }
    }
</script>

<style scoped>
    .gr-top-z-index.gr-top-zero{
        display: none !important;
    }
</style>