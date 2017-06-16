<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">
                    <form class="form-horizontal" method="post" onsubmit="return false;">
                        <fieldset>
                            <legend class="text-center header" style="color: black;">Contact us</legend>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="fname" v-model="firstname" type="text" placeholder="First Name" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="lname" v-model="lastname" type="text" placeholder="Last Name" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="email" v-model="email" type="email" placeholder="Email Address" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="phone" v-model="phone" type="number" placeholder="Phone" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <select class="form-control" v-model="dept_email" >
                                        <option value="" disabled selected hidden>Which Department would you like to contact?</option>
                                        <option value="saleslagos@coolwazobiainfo.com">Sales</option>
                                        <option value="newslagos@coolwazobiainfo.com">News</option>
                                        <option value="webteam@coolwazobiainfo.com">Web Team</option>
                                        <option value="webteam@coolwazobiainfo.com">Social Media</option>
                                        <option value="admin@coolwazobiainfo.com">General Enquiries</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <textarea class="form-control" id="message" v-model="content" required placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg" :disabled="ready" @click="sendcontact()">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="panel panel-default">
                        <div class="text-center header" style="color: black;">Our Office</div>
                        <div class="panel-body text-center">
                            <h4>Address</h4>
                            <div>
                                267A Etim Inyang Cres<br /> Victoria island annex, <br /> Lagos, Nigeria <br/>
                                <!-- #(703) 1234 1234<br /> -->
                                webteam@coolwazobiainfo.com<br />
                            </div>
                            <hr />
                            <!-- <div id="map1" class="map"> -->
                            <gmap-map :center="{lat:6.433123, lng:3.437555}" :zoom="20" map-type-id="roadmap" style="width: 100%; height: 100%; min-width: 300px; min-height: 300px;">
                                <gmap-marker :position="{lat:6.433123, lng:3.437555}">
                                </gmap-marker>
                            </gmap-map>
    
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
                dept_email: '',
                content: ''
            }
        },
        created: function() {
            var status = {
                title: 'Cool FM Nigeria | Contact Us',
                description: `Contact us at  267A Etim Inyang Cres, Victoria island annex, Lagos, Nigeria. Email: webteam@coolwazobiainfo.com. Longitude:6.433123, Latitude:3.437555`
            }
            this.$store.dispatch('SET_SEO', status);
    
            // function init() {
            //     var myLocation = new google.maps.LatLng(6.433123, 3.437555);
            //     var mapOptions = {
            //         center: myLocation,
            //         zoom: 16
            //     };
            //     var marker = new google.maps.Marker({
            //         position: myLocation,
            //         title: "Property Location"
            //     });
            //     var map = new google.maps.Map(document.getElementById("map1"),
            //         mapOptions);
            //     marker.setMap(map);
            // }
    
            // while (typeof google != undefined) {
            //     init();
            //     break;
            // }
        },
        computed: {
            ready: function() {
                if (this.firstname != '' && this.lastname != '' && this.email != '' && this.phone != '' && this.content != "" && this.dept_email != "") {
                    return false;
                }
                return true;
            }
        },
        methods: {
            sendcontact: function() {
                axios.post('sendmail', {
                    name: this.firstname + ' ' + this.lastname,
                    body: this.content,
                    email: this.email,
                    phone: this.phone,
                    dept: this.dept_email
                }).then(response => {
                    this.firstname = '';
                    this.lastname = '';
                    this.content = '';
                    this.email = '';
                    this.phone = '';
                    this.dept_email = '';
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "100000",
                        "timeOut": "50000000",
                        "extendedTimeOut": "1000000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Mail sent');
                })
            }
        }
    }
</script>

<style scooped>
 select:invalid{
     background: grey; 
 }
    .map {
        min-width: 300px;
        min-height: 300px;
        width: 100%;
        height: 100%;
    }
    
    .header {
        background-color: #F5F5F5;
        color: #36A0FF;
        height: 70px;
        font-size: 27px;
        padding: 10px;
    }
</style>
