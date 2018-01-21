<template>
    <div class="container">
        <div class="row">
            <div class="col-12 bg-info">
                <br>
                <br>
            </div>
        </div>
        <br>
        <div class="row bg-white">
            <div class="col-12">
                <div class="col-2 mx-auto" v-if="loading">
                    <clip-loader color="blue"></clip-loader>
                </div>
                <div class="row" v-if="!loading">
                    <div class="col-4 bg-danger">

                    </div>
                    <div class="col-8">
                        <h5 class="text-info mt-5">Concert</h5>
                        <h2 class="text-dark text-uppercase">{{ title }}</h2>
                        <p class="my-5">{{ eventData.description }}</p>
                        <div class="row">
                            <div class="col">
                                <span class="text-uppercase text-muted">venue</span>
                                <h3 class="text-uppercase">
                                    {{ eventData.venue }}
                                </h3>
                            </div>
                            <div class="col">
                                <span class="text-uppercase text-muted">time</span>
                                <h3 class="text-uppercase">
                                    {{ eventTimeConverter(eventData.date) }}
                                </h3>
                            </div>
                            <div class="col">
                                <span class="text-uppercase text-muted">date</span>
                                <h3 class="text-uppercase">
                                    {{ eventDateConverter(eventData.date) }}
                                </h3>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="text-uppercase text-muted">
                                    price
                                </span>
                                <div class="col-12">
                                    <h1 class="font-weight-bold text-danger">N{{ eventData.tickets[0].price }}</h1>
                                </div>
                            </div>
                            <div class="col-4">
                                <span class="text-uppercase text-muted">
                                    ticket grade
                                </span>
                                <div class="select my-2">
                                    <select name="ticketGrade" id="ticketGrade">
                                        <option value="1" selected>Regular</option>
                                        <option value="2">VIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <span class="text-uppercase text-muted">
                                    quantity
                                </span>
                                <div class="my-2">
                                    <div class="input-group">
                                        <input type="text" :value="quantity">
                                        <span class="input-group-btn">
                                            <button class="btn btn-add text-white" type="button"
                                                    @click="incrementQuantity()">&plus;</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 my-3">
                                <button id="floater" class="btn btn-ticket text-white" @click="buyTicket()">Buy Tickets
                                </button>
                                <span class="text-info font-weight-bold">  50% off</span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "eventsInner",
        props: ['name'],
        mounted: function () {
            this.getEventDetails()
        },
        data: function () {
            return {
                eventData: {},
                loading: 'true',
                quantity: 1
            }
        },
        methods: {
            incrementQuantity: function () {
                return this.quantity++
            },
            getEventDetails: function () {
                console.log(this.name);
                axios.get('/events/details/' + this.name).then(
                    (response) => {
                        this.eventData = response.data;
                        this.loading = false;
                    }
                )
            },
            eventDateConverter(eventDate) {
                let newDate = new Date(eventDate).toLocaleDateString(undefined, {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                return newDate;
            },
            eventTimeConverter(eventTime) {
                let date = new Date(eventTime);
                let hours = date.getHours();
                let suffix = 'AM';
                let time;
                if (hours < 12) {
                    time = hours + suffix
                } else {
                    suffix = 'PM';
                    switch (hours) {
                        case 12:
                            time = '12PM';
                            break;
                        case 13:
                            time = '1PM';
                            break;
                        case 14:
                            time = '2PM';
                            break;
                        case 15:
                            time = '3PM';
                            break;
                        case 16:
                            time = '4PM';
                            break;
                        case 17:
                            time = '5PM';
                            break;
                        case 18:
                            time = '6PM';
                            break;
                        case 19:
                            time = '7PM';
                            break;
                        case 20:
                            time = '8PM';
                            break;
                        case 21:
                            time = '9PM';
                            break;
                        case 22:
                            time = '10PM';
                            break;
                        case 23:
                            time = '11PM';
                            break;
                        case 0:
                            time = '12AM';
                            break;
                    }
                }
                return time;
            },
            buyTicket: function () {
                const ticket = this.eventData.tickets[0];
                const ticket_id = ticket.id;
                let qty = this.quantity;
                let total_amt = ticket.price * qty;
                let email = localStorage.getItem('email') ? localStorage.getItem('email') : '';
                if (ticket.amount === 0) {
                    swal({
                        title: "Error!",
                        text: ticket.name + " tickets sold out",
                        type: "error",
                        confirmButtonText: "Cool"
                    });
                    return false;
                }
                if (qty > ticket.amount && ticket.amount !== 0) {
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
                                let self = this;
                                if (total_amt === 0) {

                                    if (qty !== 1) {
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
                                                }).then((response) => {
                                                    self.all_events = response.data;
                                                    swal("Please check your email for your tickets");
                                                })
                                                    .catch((error) => {
                                                        swal("An error occurred. If your ticket was not sent, and you have been debited, please send an email to tickets@coolfm.ng");
                                                    });
                                            });
                                    }

                                } else {
                                    var handler = PaystackPop.setup({
                                        key: 'pk_live_96225c07868c79dfa4651c2d085c65e8d26ddfe0',
                                        email,
                                        amount: total_amt * 100,
                                        ref: "cool_ticket_" + total_amt + qty + Math.round(+new Date() / 1000),
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
                                                            swal("An error occurred. If your ticket was not sent, and you have been debited, please send an email to tickets@coolfm.ng");
                                                        });
                                                });
                                        },
                                        onClose: () => {
                                            swal('An error occurred, please try again later');
                                        }
                                    });
                                    handler.openIframe();


                                }


                            }


                        });


                }


            },
        },
        computed: {
            title: function () {
                let name = this.name;
                let title = name.replace(/-/g, " ");
                return title
            }
        }
    }
</script>

<style scoped>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        appearance: none;
        outline: 0;
        box-shadow: none;
        border: 0 !important;
        background: #e8e8e8;
        background-image: none;
    }

    input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        appearance: none;
        outline: 0;
        box-shadow: none;
        border: 0 !important;
        background: #e8e8e8;
        display: block;
        height: 2em;
        width: 6em;
        line-height: 2;
        padding-left: 10px;
    }

    /* Custom Select */
    .select {
        position: relative;
        display: block;
        height: 2em;
        width: 7em;
        line-height: 2;
        background: #e8e8e8;
        overflow: hidden;
        border-radius: .25em;
    }

    select {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0 0 0 .2em;
        color: #000;
        cursor: pointer;
    }

    select::-ms-expand {
        display: none;
    }

    /* Arrow */
    .select::after {
        content: '\25BC';
        color: #fff;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        padding: 0 .5em;
        background: #0b58b1;
        pointer-events: none;
    }

    .btn-add {
        background: #0b58b1;
        height: 2em;
    }

    /* Transition */
    .select:hover::after {
        color: #f8f8f8;
    }

    .select::after {
        -webkit-transition: .25s all ease;
        -o-transition: .25s all ease;
        transition: .25s all ease;
    }
</style>