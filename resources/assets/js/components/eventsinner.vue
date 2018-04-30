<template>
    <div class="container">
        <div class="col-12" style="max-height: 330px;">
          <center>
            <ins class="adsbygoogle"
                style="display:block; height: 330px;"
                data-ad-format="autorelaxed"
                data-ad-client="ca-pub-4448078976745099"
                data-ad-slot="5292952536"></ins>
            </center>
        </div>
        <br>
        <div class="col-12 bg-white">
            <div class="col-2 mx-auto" v-if="loading">
                <clip-loader color="blue"></clip-loader>
            </div>
            <div class="row" v-if="!loading">
                <div class="col-lg-5 col-md-4 col-sm-12 img_cover"
                     :style="{'background-image': 'url('+eventData.image+')', 'background-size': 'cover', 'background-position': 'center center'}">

                </div>
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <h5 class="cool-blue mt-2">{{eventData.category.name}}</h5>
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
                        <div class="col-12 col-lg-4">
                                <span class="text-uppercase text-muted">
                                    price
                                </span>
                            <div class="col-12 col-lg-8 pl-0">
                                <h1 class="font-weight-bold text-danger">N{{ price }}</h1>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                                <span class="text-uppercase text-muted">
                                    ticket grade
                                </span>
                            <div class="select my-2">
                                <select name="ticketGrade" id="ticketGrade" v-model="grade">
                                    <option :value="ticket.price" v-for="(ticket, index) in tickets"
                                            :selected="(index === 0) ? 'selected' : false">{{ticket.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                                <span class="text-uppercase text-muted">
                                    quantity
                                </span>
                            <div class="my-2">
                                <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-add text-white" type="button"
                                                    @click="decrementQuantity()">-</button>
                                        </span>
                                    <input type="text" v-model="quantity">
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
                            <span class="text-info font-weight-bold">{{discount ? discount + '% off' : ''}}</span>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
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
            this.loadScript("http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js").then(function () {
                (window.adsbygoogle = window.adsbygoogle || []).push({})
            });
            this.getEventDetails().then(response => this.getDiscountedPrice(response));
        },
        data: function () {
            return {
                eventData: {},
                loading: 'true',
                quantity: 1,
                grade: 1,
                ticketPrice: 0,
                tickets: [],
                discountPrice: 0,
                discount: 0
            }
        },
        watch: {
            grade: function () {
                this.getDiscountedPrice(this.tickets);
            },
            ticketPrice: function () {
                this.getDiscountedPrice(this.tickets);
            }
        },
        methods: {
            loadScript: function (url) {
                return new Promise(function (resolve, reject) {
                    var script = document.createElement("script")
                    script.type = "text/javascript";
                    if (script.readyState) { //IE
                        script.onreadystatechange = function () {
                            if (script.readyState == "loaded" ||
                                script.readyState == "complete") {
                                script.onreadystatechange = null;
                                resolve();
                            }
                        };
                    } else { //Others
                        script.onload = function () {
                            resolve();
                        };
                    }
                    script.src = url;
                    document.getElementsByTagName("head")[0].appendChild(script);
                });
            },
            incrementQuantity: function () {
                this.quantity++;
                this.getDiscountedPrice(this.tickets);
                return this.quantity;
            },
            decrementQuantity: function () {
                if (this.quantity > 1) {
                    this.quantity--;
                    this.getDiscountedPrice(this.tickets);
                    return this.quantity;
                }
                return this.quantity
            },
            getEventDetails: function () {
                console.log(this.name);
                return new Promise((resolve, reject) => {
                    axios.get('/events/details/' + this.name).then(
                        (response) => {
                            this.eventData = response.data;
                            this.loading = false;
                            this.grade = this.eventData.tickets[0].price;
                            this.eventData.tickets.forEach((val) => {
                                this.tickets.push(val);
                            });
                            var status = {
                                title: 'Cool Tickets | ' + this.name,
                                description: `Buy your event tickets from coolfm 96.9fm`
                            };
                            this.$store.dispatch('SET_SEO', status);
                            resolve(this.tickets)
                        }
                    ).catch((err) => {
                        reject(err)
                    })
                })
            },
            eventDateConverter(eventDate) {
                let newDate = new Date(eventDate).toLocaleDateString(undefined, {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                return newDate;
            },
            getDiscountedPrice: function (tickets) {
                const result = tickets.find(ticket => ticket.price === this.grade);
                if (result.discount !== null) {
                    this.discount = result.discount;
                    return this.discountPrice = this.ticketPrice - (this.ticketPrice * (this.discount / 100));
                } else {
                    return null;
                }
            },
            eventTimeConverter(eventTime) {
                let date = new Date(eventTime);
                let hours = date.getHours();
                let suffix = 'AM';
                let time;
                if (hours < 12) {
                    if (hours === 0) time = 12 + suffix;
                    else time = hours + suffix
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
                let total_amt = this.discountPrice ? this.discountPrice : this.ticketPrice;
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
                        title: "&#f422",
                        text: "Please provide us with an email:",
                        type: "input",
                        content: {
                            element: "input",
                            attributes: {
                                placeholder: "Type your Email",
                                type: "email",
                            }
                        },
                        buttons: {
                            cancel: {
                                text: "Cancel",
                                value: null,
                                visible: true,
                                closeModal: true,
                            },
                            confirm: {
                                text: "Submit",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: false
                            }
                        }
                    }).then((inputValue) => {
                        if (!inputValue) {
                            return false;
                        } else if (inputValue === "") {
                            swal.showInputError("You need to input an email!");
                            return false;
                        } else if (!regex.test(inputValue)) {
                            swal.showInputError("Your email is not valid!");
                            return false;
                        } else {
                            email = inputValue;
                            let self = this;
                            if (total_amt === 0) {

                                if (qty !== 0) {
                                    swal("We are sorry, but you can only order up to one free ticket");
                                    return false;
                                } else {
                                    swal({
                                        title: "In progress",
                                        text: "Please hold on, your ticket is being processed",
                                        type: "info",
                                        buttons: {
                                            cancel: {
                                                text: "Cancel",
                                                value: null,
                                                visible: true,
                                                closeModal: true,
                                            },
                                            confirm: {
                                                text: "Continue",
                                                value: true,
                                                visible: true,
                                                className: "",
                                                closeModal: false
                                            }
                                        }
                                    }).then(() => {
                                        return new Promise((resolve, reject) => {
                                            axios.post('ticket_purchased', {
                                                ticket_id,
                                                qty,
                                                total_amt,
                                                email
                                            }).then((response) => {
                                                self.all_events = response.data;
                                                resolve(response.data);
                                            })
                                                .catch((error) => {
                                                    reject(error);
                                                    swal("An error occurred. If your ticket was not sent, and you have been debited, please send an email to tickets@coolfm.ng");
                                                });
                                        })
                                    }).then(data => {
                                        console.log(data);
                                        const response = data[0];
                                        if (response) {
                                            swal("Please check your email for your tickets");
                                        }
                                    })
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
                                            button: {
                                                text: "Continue",
                                                value: true,
                                                visible: true,
                                                closeModal: false
                                            }
                                        }).then((val) => {
                                            if (!val) throw null;
                                            else {
                                                axios.post('/ticket_purchased', {
                                                    ticket_id,
                                                    qty,
                                                    total_amt,
                                                    email
                                                })
                                                    .then((response) => {
                                                        self.all_events = response.data;
                                                        swal("Woo! You\"ve got mail", "Please check your email for your tickets", "success");
                                                    })
                                                    .catch((error) => {
                                                        swal("Oops...", "An error occurred. If your ticket was not sent, and you have been debited, please send an email to tickets@coolfm.ng", "error");
                                                    });
                                            }
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
            },
            price: function () {
                this.ticketPrice = this.quantity * this.grade;
                return this.ticketPrice;
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

    @media (max-width: 575px) {
        .img_cover {
            height: 200px;
        }
    }

    @media (min-width: 576px) {
        .img_cover {
            height: 200px;
        }
    }

    @media (min-width: 768px) {
        .img_cover {
            height: inherit;
        }
    }

    #floater:hover {
        cursor: pointer;
    }
</style>