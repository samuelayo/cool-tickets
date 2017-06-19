<template>
  <div id="now-buzzing" class="xs-mb3">
    <table style="height: 40px !important;" class="table-fill"><br><br><br><br><br><br>

      <tbody class="table-hover" v-if="now_playing">
        <tr>
          <td style="border-left: 6px solid red;border-right: 1px solid rgb(221, 221, 221);letter-spacing: 3px;color: red;display: inline-block;font-style: normal !important;font-size: 0.8em;width: 103px;" class="text-left"><i :class="'ion-'+current_play_state" @click="livestream()"></i> <small>LIVE</small> </td>
          <td class="text-left" style="padding-left: 11.4px !important; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">{{now_playing.title}} </td>
        </tr>


      </tbody>
    </table>

    <br>

    <div id="now-buzzing" class="xs-mb3">



      <h3 class=" xs-text-2 xs-mb1"> <a href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Events</a></h3>


      <div class="container" v-for="(evn, index) in searchable">
        <div class="info">

        </div>
        <!-- Normal Demo-->
        <div class="column">
          <!-- Post-->
          <div class="post-module" style="box-shadow: 10px 10px 10px 5px #888888 !important;">
            <!-- Thumbnail-->
            <div class="thumbnail">
              <div class="date">
                <div class="day">{{day(evn.date)}}</div>
                <div class="month">{{month(evn.date)}}</div>
              </div><img :src="evn.image" />
            </div>
            <!-- Post Content-->
            <div class="post-content">
              <h1 class="title">{{evn.title}}</h1>

              <p class="description" v-html="evn.description"></p>
              <div style="float:left;">
                <p> Ticket Type</p>
                <br>
                <p> Ticket Quantity</p>

                <p> N{{ticket_price[index].price | money }} </p>
                <span class="timestamp"><i class="fa fa-clock-"></i> {{daysRemaining(evn.date)}}</span>
              </div>
              <div style="float: right;">
                <div class="col-xs-12 col-md-6">
                  <form lpformnum="1">
                    <div class="dropdown"><select id="select" type="button" data-toggle="dropdown" class="btn btn-select" v-model="ticket_price[index].id" @change="check(index)"><option v-for="typ in evn.tickets" :value="typ.id">{{typ.name}}</option></select></div>
                  </form>
                  <form lpformnum="2">
                    <div class="dropdown"><select id="select" type="button" data-toggle="dropdown" class="btn btn-select" @change="check(index)" v-model="ticket_qty[index]"><option v-for="(i, index) in 10">{{i}}</option></select></div>
                  </form>
                  <button id="floater" class="btn btn-success" @click="buyticket(index)">Buy Tickets</button></div>
              </div>


            </div>
          </div>
        </div>
        <!-- Hover Demo-->

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
        schedule: []
      }
    },
    created: function() {
      this.get_tickets();
      this.schedules();
    },
    mounted: function() {


    },
    methods: {
      schedules: function() {
        axios.get('/schedules')
          .then(response => {
            // JSON responses are automatically parsed.
            this.schedule = _.groupBy(response.data, function(car) {
              return car.state;
            });

          })
          .catch(e => {

          });
      },
      get_tickets: function() {
        axios.get("/all_tickets")
          .then((response) => {
            this.all_events = response.data;
            //this.loadable();
            this.pushem();
          });
      },
      livestream: function() {
        if (this.current_play_state == 'play') {
          var status = 'pause';
        } else {
          var status = 'play';
        }
        this.$store.dispatch('SET_PLAY', status);
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
      },
      now_playing: function() {
        if (this.schedule[this.current_state]) {
          var myDate = new Date();
          var schedule_arry = this.schedule[this.current_state];
          if (myDate.getDay() == 6) {
            //saturday
            //filter by saturday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "saturday";
            });

          } else if (myDate.getDay() == 0) {
            //sunday
            //filter by sunday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "sunday";
            });

          } else {
            //otherdays
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period != "sunday" && sch.period != "saturday";
            });
          }
          for (var i = 0; i < schedule_arry.length; i++) {
            var schedu = schedule_arry[i];
            if (this.between(schedu.start, schedu.end) == "Now") {
              return schedu
            }
          }
        }
      }
    }
  }
</script>

<style scoped>
  body {
    background: #f2f2f2;
    font-size: 14px;
  }

  .post-module {
    position: relative;
    z-index: 1;
    display: block;
    background: #FFFFFF;
    min-width: 270px;
    height: 470px;
    -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
    -webkit-transition: all 0.3s linear 0s;
    -moz-transition: all 0.3s linear 0s;
    -ms-transition: all 0.3s linear 0s;
    -o-transition: all 0.3s linear 0s;
    transition: all 0.3s linear 0s;
  }

  .post-module:hover,
  .hover {
    -webkit-box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
  }

  .post-module:hover .thumbnail img,
  .hover .thumbnail img {
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    transform: scale(1.1);
    opacity: .6;
  }

  .post-module .thumbnail {
    background: #000000;
    height: 400px;
    overflow: hidden;
  }

  .post-module .thumbnail .date {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 1;
    background: #e74c3c;
    width: 55px;
    height: 55px;
    padding: 12.5px 0;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    color: #FFFFFF;
    font-weight: 700;
    text-align: center;
    -webkti-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  .post-module .thumbnail .date .day {
    font-size: 18px;
  }

  .post-module .thumbnail .date .month {
    font-size: 12px;
    text-transform: uppercase;
  }

  .post-module .thumbnail img {
    display: block;
    width: 120%;
    -webkit-transition: all 0.3s linear 0s;
    -moz-transition: all 0.3s linear 0s;
    -ms-transition: all 0.3s linear 0s;
    -o-transition: all 0.3s linear 0s;
    transition: all 0.3s linear 0s;
  }

  .post-module .post-content {
    position: absolute;
    bottom: 0;
    background: #FFFFFF;
    width: 100%;
    padding: 30px;
    -webkti-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
    -moz-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
    -ms-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
    -o-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
    transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
  }

  .post-module .post-content .category {
    position: absolute;
    top: -34px;
    left: 0;
    background: #e74c3c;
    padding: 10px 15px;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
  }

  .post-module .post-content .title {
    margin: 0;
    padding: 0 0 10px;
    color: #333333;
    font-size: 26px;
    font-weight: 700;
  }

  .post-module .post-content .sub_title {
    margin: 0;
    padding: 0 0 20px;
    color: #e74c3c;
    font-size: 20px;
    font-weight: 400;
  }

  .post-module .post-content .description {
    display: block;
    color: #666666;
    font-size: 15px;
    line-height: 1.8em;
  }

  .post-module .post-content .post-meta {
    margin: 30px 0 0;
    color: #999999;
  }

  .post-module .post-content .post-meta .timestamp {
    margin: 0 5px 0 0;
  }

  .post-module .post-content .post-meta a {
    color: #999999;
    text-decoration: none;
  }

  .hover .post-content .description {
    display: block !important;
    height: auto !important;
    opacity: 1 !important;
  }

  .container {
    margin: 0 auto;
  }

  .container:before,
  .container:after {
    content: '';
    display: block;
    clear: both;
  }

  .container .column {
    padding: 0 25px;
    -webkti-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    float: left;
  }

  .container .column .demo-title {
    margin: 0 0 15px;
    color: #666666;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
  }

  .container .info {
    width: 300px;
    margin: 50px auto;
    text-align: center;
  }

  .container .info h1 {
    margin: 0 0 15px;
    padding: 0;
    font-size: 24px;
    font-weight: bold;
    color: #333333;
  }

  .container .info span {
    color: #666666;
    font-size: 12px;
  }

  .container .info span a {
    color: #000000;
    text-decoration: none;
  }

  .container .info span .fa {
    color: #e74c3c;
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
