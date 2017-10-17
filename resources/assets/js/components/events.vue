<template>
    <div id="products" class="container row list-group" style="padding: 2em;">
        <clip-loader v-if="loading" color="blue"></clip-loader>
        <div class="item  col-xs-4 col-lg-4" v-for="(evn, index) in searchable">
    
            <div id="event-single" class="thumbnail">
                <img class="group list-group-image" :src="evn.image" alt="" />
                <div class="caption">
                    <h4 id="event-title" class="group inner list-group-item-heading">
                        {{evn.title}}</h4>
                    <h5 id="event-date" class="group inner list-group-item-heading">
                        {{evn.date}}</h5>
                    <p id="event-caption" class="group inner list-group-item-text">
                        {{evn.description}}
                    </p>
                    <div id="ticket-panel" class="row">
                        <div class="col-xs-12 col-md-6">
    
                            <p><span>Ticket Type</span></p>
                            <p><span>Ticket Quantity</span></p>
                            <p id="price" class="lead">
                                N{{ticket_price[index].price | money }}<small class="days-left">{{daysRemaining(evn.date)}}</small></p>
                        </div>
                        <div class="col-xs-12 col-md-6">
    
                            <form>
                                <div class="dropdown">
                                    <select id="select" type="button" class="btn btn-select" v-model="ticket_price[index].id" @change="check(index)" data-toggle="dropdown">
                                                         
                                                                    <option v-for="typ in evn.tickets" :value="typ.id">{{typ.name}}</option>
                                                           
                                                        </select>
                                </div>
                            </form>
    
                            <form>
                                <div class="dropdown">
                                    <select id="select" type="button" class="btn btn-select" @change="check(index)" v-model="ticket_qty[index]" data-toggle="dropdown">
                                                            
                                                                    <option v-for="(i, index) in 10">{{i}}</option>
                                                            
                                                        </select>
                                </div>
                            </form> <button id="floater" class="btn btn-success" @click="buyticket(index)">Buy Tickets</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center v-if="(searchable.length == 0 && loading == false)"><span  style="color: black; font-size: 38px;">No events available at this moment</span></center>
        <br>
        <br>
        <br>
        <br>
    
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                all_events: [],
                ticket_price: [],
                ticket_qty: [],
                loading: true,
            }
        },
        created: function() {
            this.get_tickets();
        },
        mounted: function() {
            var status = {
                title: 'Cool FM Nigeria | Events',
                description: `Buy your event tickets from coolfm 96.9fm`
            }
            this.$store.dispatch('SET_SEO', status);
    
        },
        methods: {
            get_tickets: function() {
                axios.get("/all_tickets")
                    .then((response) => {
                        this.all_events = response.data;
                        //this.loadable();
                        this.pushem();
                        this.loading = false;
                    });
            },
            verify: function(start) {
                moment.locale('en');
                var beforeTime = moment(start);
                if (moment().diff(beforeTime) <= 0) {
                    return true;
                }
                return false;
            },
            loadable: function() {
    
            },
            daysRemaining: function(eventdate) {
                return moment(eventdate).fromNow();
            },
            lowest: function(ticketarrays) {
                var sorted = ticketarrays.sort(function(a, b) {
                    return parseFloat(a.price) - parseFloat(b.price);
                });
                if (sorted != undefined) {
                    if (sorted.length != 0) {
                        return sorted[0].price;
                    }
                }
                return 0.00;
    
            },
            pushem: function() {
                for (var i = 0; i < this.searchable.length; i++) {
                    var obj = {
                        price: this.searchable[i].tickets[0].price,
                        id: this.searchable[i].tickets[0].id
                    }
                    this.ticket_price.push(obj);
                    this.ticket_qty.push(1);
                }
            },
            check: function(index) {
                var tickets = this.searchable[index].tickets;
                var ticket = tickets.find(x => x.id == this.ticket_price[index].id);
                this.ticket_price[index].price = ticket.price * this.ticket_qty[index];
            },
            buyticket: function(index) {
                var ticket_id = this.ticket_price[index].id;
                var qty = this.ticket_qty[index];
                var total_amt = this.ticket_price[index].price;
                var email = localStorage.getItem('email') ? localStorage.getItem('email') : '';
                var tickets = this.searchable[index].tickets;
                var ticket = tickets.find(x => x.id == this.ticket_price[index].id);
                if (ticket.amount == 0) {
                    swal({
                        title: "Error!",
                        text: ticket.name + " tickets sold out",
                        type: "error",
                        confirmButtonText: "Cool"
                    });
                    return false;
                }
                if (this.ticket_qty[index] > ticket.amount && ticket.amount != 0) {
                    swal({
                        title: "Error!",
                        text: "we have only " + ticket.amount + " " + ticket.name + " tickets available",
                        type: "error",
                        confirmButtonText: "Cool"
                    });
    
                    return false;
                }
                if (email == "" || email != "") {
                    var getemail = "";
                    var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
                    swal({
                            title: "Your Email!",
                            text: "Please provide us with an email:",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            inputPlaceholder: "email",
                            inputValue: email
                        },
                        (inputValue) => {
                            if (inputValue === false) {
                                return false;
                            } else if (inputValue === "") {
                                swal.showInputError("You need to write something!");
                                return false
                            } else if (!regex.test(inputValue)) {
                                swal.showInputError("Your email is not valid!");
                                return false;
                            } else {
                                email = inputValue;
                                var self = this;
                                var handler = PaystackPop.setup({
                                    key: 'pk_live_96225c07868c79dfa4651c2d085c65e8d26ddfe0',
                                    email,
                                    amount: this.ticket_price[index].price * 100,
                                    ref: "cool_ticket_" + this.ticket_price[index].price + this.ticket_qty[index] + Math.round(+new Date() / 1000),
                                    metadata: {
                                        // custom_fields: [{
                                        //     display_name: "Mobile Number",
                                        //     variable_name: "mobile_number",
                                        //     value: "+2348012345678"
                                        // }]
                                    },
                                    callback: function(response) {
                                        swal({
                                                title: "In progress",
                                                text: "Please hold on, your ticket is being processed",
                                                type: "info",
                                                showCancelButton: true,
                                                closeOnConfirm: false,
                                                showLoaderOnConfirm: true,
                                            },
                                            () => {
                                                axios.post('ticket_purchased', {
                                                        ticket_id,
                                                        qty,
                                                        total_amt,
                                                        email
                                                    })
                                                    .then((response) => {
                                                        self.all_events = response.data;
                                                        swal("Please check your email for your tickets");
                                                    })
                                                    .catch((error) => {
                                                        swal("An error occured. If your ticket was not sent, and you have been debitted, please send an email to tickets@coolfm.ng");
                                                    });
    
    
                                            });
                                        //alert('success. transaction ref is ' + response.reference);
    
                                    },
                                    onClose: () => {
                                        swal('An error occured, please try agian later');
                                    }
                                });
                                handler.openIframe();
                            }
    
    
                        });
    
    
                }
    
    
            }
    
        },
        computed: {
            searchable: function() {
                if (!this.all_events) {
                    return [];
                }
                var ll = _.filter(this.all_events, (event) => {
                    return this.verify(event.date);
                });
                return ll;
            }
    
        }
    }
</script>

<style scoped>
    /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
    
    * {
        font-family: 'Circular-Book'
    }
    
    .glyphicon {
        margin-right: 5px;
    }
    
    .thumbnail {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        font-family: 'Karla', sans-serif;
    }
    
    #select {
        background: #fff !important;
        float: right;
        outline: none !important;
        width: 88px;
        border: 1px solid #ddd;
        margin-bottom: 2.1px;
        font-weight: 700
    }
    
    #select-quantity {
        background: #fff !important;
        float: right;
        width: 88px;
        outline: none !important;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        font-weight: 700;
    }
    
    .item.list-group-item {
        float: none;
        width: 100%;
        background-color: #fff;
        margin-bottom: 10px;
    }
    
    .item.list-group-item:nth-of-type(odd):hover,
    .item.list-group-item:hover {
        background: #428bca;
    }
    
    .item.list-group-item .list-group-image {
        margin-right: 10px;
    }
    
    .item.list-group-item .thumbnail {
        margin-bottom: 0px;
    }
    
    .item.list-group-item .caption {
        padding: 9px 9px 0px 9px;
    }
    
    .item.list-group-item:nth-of-type(odd) {
        background: #eeeeee;
    }
    
    .days-left {
        display: block;
        font-size: .6em;
        font-weight: 100 !important;
        color: #00ab6b;
    }
    
    .item.list-group-item:before,
    .item.list-group-item:after {
        display: table;
        content: " ";
    }
    
    #ticket-panel {
        border-bottom: 1px solid #ddd;
        margin-left: 0px !important;
        margin-right: 0px !important;
    }
    
    .item.list-group-item img {
        float: left;
    }
    
    .item.list-group-item:after {
        clear: both;
    }
    
    .list-group-item-text {
        margin: 0 0 11px;
    }
    
    form {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .dropdown-menu-select {
        padding: 0;
        margin-top: -2px;
        width: 100%;
        border-radius: 0 0 2px 2px;
        border-color: #777;
    }
    
    .dropdown-radio {
        display: block;
        position: relative;
        margin: 0;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        border-bottom: 1px solid #eaeaea;
        cursor: pointer;
    }
    
    .dropdown-radio input {
        visibility: hidden;
        position: absolute;
        left: -30px;
    }
    
    .dropdown-radio i {
        font-weight: normal;
        font-style: normal;
        display: block;
        padding: 7px;
    }
    
    #price {
        font-weight: 700;
    }
    
    #floater {
        float: right;
    }
    
    #event-single {
        -webkit-box-shadow: 10px 10px 126px -14px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 10px 10px 126px -14px rgba(0, 0, 0, 0.3);
        box-shadow: 10px 10px 126px -14px rgba(0, 0, 0, 0.3) !important;
    }
    
    #event-title {
        font-weight: 700 !important;
        font-size: 1.5em !important;
        margin-top: .5em !important;
        margin-bottom: .5em !important;
        letter-spacing: -.3px !important;
    }
    
    #event-date {
        color: #666;
        font-size: 1em !important;
        font-weight: 100 !important;
    }
    
    #event-caption {
        font-size: 1.1em;
        border-bottom: 1px solid #ddd;
        padding-bottom: 1em;
    }
    
    .btn-success {
        background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%) !important;
        border: none !important;
    }
    
    .btn-success:hover {}
    
    .thumbnail .caption {
        padding: 1.2em !important;
    }
</style>
