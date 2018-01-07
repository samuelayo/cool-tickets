<template>
    <div>
        <eventSlider height="400px">
            <div class="bg-black item" style="width: 500px"></div>
            <div class="bg-success item" style="width: 300px"></div>
            <div class="bg-danger item" style="width: 700px"></div>
            <div class="bg-info item" style="width: 200px"></div>
            <div class="bg-warning item" style="width: 400px"></div>
        </eventSlider>
        <div class="container bg-white inner-shadow">
            <div class="col-12">
                <div class="row pt-2">
                    <span class="col text-uppercase text-secondary text-center" v-for="val in categories">
                        <a href="javascript:void(0)" v-text="val"></a>
                    </span>
                    <div class="col-12"><hr></div>
                </div>
            </div>
            <div id="products" class="row">
                <div class="col-2 mx-auto" v-if="loading">
                    <clip-loader color="blue"></clip-loader>
                </div>
                <div class="item  col-md-3 col-lg-3" v-for="(evn, index) in searchable">
                    <div id="event-single" class="thumbnail">
                        <div class="event-image" style="background-image: url('event.jpg')"></div>
                        <div class="col-12">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <h6 class="text-capitalize text-info font-weight-bold">Concert</h6>
                                </div>
                                <div class="col-6">
                                    <h6 id="event-date" v-text="eventDateConverter(evn.date)" class="text-right"></h6>
                                </div>
                            </div>
                            <h4 id="event-title" class="group inner list-group-item-heading" v-text="evn.title"></h4>
                            <p id="event-caption" class="group inner list-group-item-text" v-text="evn.description"></p>
                            <div id="ticket-panel" class="row">
                                <div class="col-12">
                                    <p class="font-weight-bold">
                                        <span v-if="ticket_price[index].price != 0 " class="text-danger">*Starting from N{{ticket_price[index].price | money }}</span>
                                        <span v-if="ticket_price[index].price == 0 " class="text-success"> Free </span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button id="floater" class="btn btn-success" @click="buyticket(index)">Buy Tickets</button>
                                    <span class="text-info font-weight-bold">  10% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center v-if="(searchable.length == 0 && loading == false)"><span style="color: black; font-size: 38px;">No events available at this moment</span>
                </center>
                <br>
                <br>
                <br>
                <br>

            </div>
        </div>
    </div>
</template>

<script>
    import eventSlider from "./eventslider";
    export default {
        data: function () {
            return {
                all_events: [],
                ticket_price: [],
                ticket_qty: [],
                loading: true,
                categories: ['all', 'concerts', 'festivals', 'cinema', 'party', 'carnivals', 'religious', 'sports', 'conference', 'kids']
            }
        },
        components: {
            eventSlider
        },
        created: function () {
            this.get_tickets();
        },
        mounted: function () {
            var status = {
                title: 'Cool FM Nigeria | Events',
                description: `Buy your event tickets from coolfm 96.9fm`
            }
            this.$store.dispatch('SET_SEO', status);

        },
        methods: {
            get_tickets: function () {
                axios.get("/all_tickets")
                    .then((response) => {
                        this.all_events = response.data;
                        //this.loadable();
                        this.pushem();
                        this.loading = false;
                    });
            },
            verify: function (start) {
                moment.locale('en');
                var beforeTime = moment(start);
                if (moment().diff(beforeTime) <= 0) {
                    return true;
                }
                return false;
            },
            lowest: function (ticketarrays) {
                var sorted = ticketarrays.sort(function (a, b) {
                    return parseFloat(a.price) - parseFloat(b.price);
                });
                if (sorted != undefined) {
                    if (sorted.length != 0) {
                        return sorted[0].price;
                    }
                }
                return 0.00;

            },
            pushem: function () {
                for (var i = 0; i < this.searchable.length; i++) {
                    var obj = {
                        price: this.searchable[i].tickets[0].price,
                        id: this.searchable[i].tickets[0].id
                    }
                    this.ticket_price.push(obj);
                    this.ticket_qty.push(1);
                }
            },
            check: function (index) {
                var tickets = this.searchable[index].tickets;
                var ticket = tickets.find(x => x.id == this.ticket_price[index].id);
                this.ticket_price[index].price = ticket.price * this.ticket_qty[index];
            },
            buyticket: function (index) {
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
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "email",
                            inputValue: email
                        },
                        (inputValue) => {
                            if (inputValue == false) {
                                return false;
                            } else if (inputValue == "") {
                                swal.showInputError("You need to input an email!");
                                return false;
                            } else if (!regex.test(inputValue)) {
                                swal.showInputError("Your email is not valid!");
                                return false;
                            } else {
                                email = inputValue;
                                var self = this;
                                if (total_amt == 0) {

                                    if (qty != 1) {
                                        swal("We are sorry, but you can only order one free ticket");
                                        return false;
                                    } else {

                                        swal({
                                                title: "In progress",
                                                text: "Please hold on, your ticket is being processed",
                                                type: "info",
                                                showCancelButton: true,
                                                closeOnConfirm: false,
                                                showLoaderOnConfirm: true,
                                            },
                                            function () {
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

                                    }


                                } else {


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
                                        callback: function (response) {
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


                            }


                        });


                }


            },
            eventDateConverter(date) {
                let newDate = new Date(date).toLocaleDateString(undefined, {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                return newDate;
            }

        },
        computed: {
            searchable: function () {
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
    * {
        font-family: 'Circular-Book'
    }
    .item{
        height: 400px;
    }
    .inner-shadow {
        -moz-box-shadow: inset 0 0 8px #d9d9d9;
        -webkit-box-shadow: inset 0 0 8px #d9d9d9;
        box-shadow: inset 0 0 8px #d9d9d9;
    }

    .thumbnail {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        font-family: 'Karla', sans-serif;
    }

    div#products {
        padding: 2em !important;
        padding-left: 0 !important;
        padding-right: 0.2em !important;
    }

    .item.list-group-item .thumbnail {
        margin-bottom: 0px;
    }

    .item.list-group-item .caption {
        padding: 9px 9px 0px 9px;
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
    }

    .btn-success {
        background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%) !important;
        border: none !important;
    }

    .thumbnail .caption {
        padding: 1.2em !important;
    }

    .event-image {
        height: 200px;
        width: 100%;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
