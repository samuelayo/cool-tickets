<template>
  <div id="now-buzzing" class="xs-mb3">
<br>


    <div id="now-buzzing" class="xs-mb3">



      <h3 class=" xs-text-2 xs-mb1"> <a href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Events</a></h3>

      <div class="card" v-for="(evn, index) in searchable">
        <img :src="evn.image" alt="Avatar" style="width:100%">
        <div class="container">
          <h4><b>{{evn.title}}</b></h4>
          <p>{{evn.date}}</p>
          <hr>
          <p style="color:grey;">{{evn.description}}</p>
          <hr>
          <div class="a" style="display: inline-block;">
          <div id="ticket-panel" class="row" >
            <div class="col-xs-12 col-md-6" style="float: left;" >
              <p ><span>Ticket Type</span></p>
              <br>
              <p style="margin-bottom: .7em;"><span>Ticket Quantity</span></p>
              <p id="price" class="lead">
                N{{ticket_price[index].price | money }}<small class="days-left"> {{daysRemaining(evn.date)}}</small></p>
            </div>
            <div class="col-xs-12 col-md-6" style="float: right; margin-left: 3em;">
              <form lpformnum="1">
                <div class="dropdown"><select id="select" type="button" data-toggle="dropdown" class="btn btn-select" v-model="ticket_price[index].id" @change="check(index)"><option v-for="typ in evn.tickets" :value="typ.id">{{typ.name}}</option></select></div>
              </form>
              <form lpformnum="2">
                <div class="dropdown"><select id="select" type="button" data-toggle="dropdown" class="btn btn-select" @change="check(index)" v-model="ticket_qty[index]">
                <option v-for="(i, index) in 10">{{i}}</option>
                </select></div>
              </form>
              <button id="floater" class="btn btn-success"  @click="buyticket(index)">Buy Tickets</button></div>
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
        all_events: [],
        ticket_price: [],
        ticket_qty: [],

      }
    },
    created: function() {
      this.get_tickets();

    },
    mounted: function() {


    },
    methods: {
      get_tickets: function() {
        axios.get("/all_tickets")
          .then((response) => {
            this.all_events = response.data;
            //this.loadable();
            this.pushem();
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
      day: function(date) {
        var check = moment(date);
        return check.format('D');
      },
      month: function(date) {
        var check = moment(date);
        return check.format('MMMM').substring(0, 3);
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
                  key: 'pk_test_e5b2f82bc75abecde0e0fe9c004b2eb8551c7549',
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
                            swal("Please check your email: " + email + " for your tickets");
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
  .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
    margin-top: 10px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
  }

  img {
    border-radius: 5px 5px 0 0;
  }

  .container {
    padding: 2px 16px;
  }

  .btn-success {
    background-image: linear-gradient(to top, #f77062 0, #fe5196 100%)!important;
    border: none!important;
  }

  #select {
    margin-bottom: 2.1px;
  }

  #select,
  #select-quantity {
    background: #fff!important;
    float: right;
    width: 88px;
    outline: 0!important;
    border: 1px solid #ddd;
    font-weight: 700;
  }
</style>
