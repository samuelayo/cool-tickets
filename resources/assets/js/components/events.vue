<template>
    <div>
        <eventSlider height="400px" ></eventSlider>
        <div class="container mt-2">
            <div class="col-12 bg-white inner-shadow">
                <div class="row pt-2">
                    <span class="col text-capitalize text-secondary text-center p-1 m-1" v-for="val in categories">
                        <a href="javascript:void(0)" v-text="val" :class="{'cool-blue': (val === category), 'font-weight-bold': (val === category)}" @click="eventCategory(val)"></a>
                    </span>
                    <div class="col-12">
                        <hr v-if="categories.length !== 0">
                    </div>
                </div>
                <div id="products" class="row">
                    <div class="col-2 mx-auto" v-if="loading">
                        <clip-loader color="blue"></clip-loader>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-12" v-for="(evn, index) in searchable">
                        <div id="event-single" class="thumbnail">
                            <div class="event-image" v-lazy:background-image="evn.image"></div>
                            <div class="col-12">
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h6 class="text-capitalize cool-blue font-weight-bold">{{evn.category.name}}</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 id="event-date" v-text="eventDateConverter(evn.date)" class="text-right"></h6>
                                    </div>
                                </div>
                                <h4 id="event-title" class="group inner list-group-item-heading" v-text="evn.title" @click="navigate(evn.title, evn, index)"></h4>
                                <p id="event-caption" class="group inner list-group-item-text" v-text="evn.description"></p>
                                <div id="ticket-panel" class="row">
                                    <div class="col-12">
                                        <p class="font-weight-bold">
                                            <span v-if="evn.tickets[0].price !== 0 " class="text-danger">*Starting from N{{evn.tickets[0].price | money }}</span>
                                            <span v-if="evn.tickets[0].price === null " class="text-success"> Free </span>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <button id="floater" class="btn btn-ticket text-white" @click="navigate(evn.title, evn, index)">Buy Tickets
                                        </button>
                                        <span class="text-info font-weight-bold">
                                        {{getDiscount(evn.tickets)}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="(searchable.length == 0 && loading == false)" class="col-12 text-center py-4">
                        <h1>No events available at this moment</h1>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
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
                original_events: [],
                ticket_price: [],
                ticket_qty: [],
                loading: true,
                categories: [],
                category_event: false,
                category: '',
                slides: []
            }
        },
        components: {
            eventSlider
        },
        created: function () {
            this.get_tickets();
            this.get_categories();
        },
        mounted: function () {
            var status = {
                title: 'Cool FM Nigeria | Events',
                description: `Buy your event tickets from coolfm 96.9fm`
            };
            this.$store.dispatch('SET_SEO', status);

        },
        methods: {
            navigate: function (name, data, index) {
                this.$router.push({
                    name: 'events-inner',
                    params: {
                        name: this.eventUrlCreator(name),
                        data: data,
                        index: index
                    }
                })
            },
            getDiscount: function (tickets) {
                let discounts = [];
                tickets.forEach((val) => {
                    if (val.discount){
                        discounts.push(val.discount)
                    }
                });
                if (discounts.length === 0){
                    return null
                } else {
                    return ('up to ' + discounts[discounts.length - 1] + '% off');
                }
            },
            get_tickets: function () {
                axios.get("/all_tickets")
                    .then((response) => {
                        this.all_events = response.data;
                        this.all_events = this.searchable;
                        this.original_events = this.searchable;
                        //this.loadable();
                        this.pushem();
                        this.loading = false;
                    });
            },
            get_categories: function () {
                axios.get("/categories")
                    .then((response) => {
                        const data = response.data;
                        data.forEach((value) => {
                            this.categories.push(value.name);
                        })
                    });
            },
            eventCategory: function (name) {
                if (this.all_events[0] !== undefined){
                    if (this.category_event === false ){
                        this.category_event = true;
                        let events = [];
                        this.all_events.forEach((value) => {
                            if (value.category.name === name){
                                events.push(value)
                            }
                        });
                        this.category = name;
                        this.all_events = events;
                    } else if (this.all_events[0] !== undefined && this.all_events[0].category.name === name){
                        this.category = null;
                        this.all_events = this.original_events;
                        this.category_event = false;
                    } else if (this.category_event === true && this.all_events[0] !== undefined && this.all_events[0].category.name !== name){
                        const events = [];
                        this.original_events.forEach((value) => {
                            if (value.category.name === name){
                                events.push(value)
                            }
                        });
                        this.category = name;
                        this.all_events = events;
                    } else {
                        this.category = null;
                        this.all_events = this.original_events;
                        this.category_event = false;
                    }
                } else {
                    if (this.category_event === false ){
                        this.category_event = true;
                        this.category = name;
                    } else if (this.category=== name && this.category_event === true){
                        this.category = null;
                        this.category_event = false;
                        this.all_events = this.original_events;
                    } else {
                        this.category = null;
                        this.all_events = this.original_events;
                        this.category_event = false;
                    }
                }
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
                    };
                    this.ticket_price.push(obj);
                    this.ticket_qty.push(1);
                }
            },
            check: function (index) {
                var tickets = this.searchable[index].tickets;
                var ticket = tickets.find(x => x.id == this.ticket_price[index].id);
                this.ticket_price[index].price = ticket.price * this.ticket_qty[index];
            },
            eventDateConverter(eventDate) {
                let newDate = new Date(eventDate).toLocaleDateString(undefined, {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                return newDate;
            },
            eventUrlCreator(eventName){
                let name = eventName;
                let url = name.replace(/ /g, '-');
                return url;
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

    #event-title:hover{
        cursor: pointer;
    }

    #event-date {
        color: #666;
    }

    .btn-ticket {
        background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%) !important;
        border: none !important;
        cursor: pointer;
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

    span.col>a:hover{
        transition: ease 0.3s;
        color: #275faa;
    }
</style>
