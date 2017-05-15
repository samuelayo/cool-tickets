<template>
      <div id="sidebar" class="xs-m4">
            <div id="now-buzzing" class="xs-mb3">
                  <table style="height: 40px !important;" class="table-fill">
                        <br><br><br><br><br><br>
                        <tbody class="table-hover" v-if="now_playing">
                              <tr>
                                    <td style="border-left: 6px solid red;border-right: 1px solid rgb(221, 221, 221);letter-spacing: 3px;color: red;display: inline-block;font-style: normal !important;font-size: 0.8em;width: 103px;" class="text-left"><i :class="'ion-'+current_play_state" @click="livestream()"></i> <small>LIVE</small> </td>
                                    <td class="text-left" style="padding-left: 11.4px !important; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">{{now_playing.title}} </td>
                              </tr>
      
      
                        </tbody>
                  </table>
                  <br>
                  <h3 class=" xs-text-2 xs-mb1"> <a style="background: #f83600 !important" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Forums</a></h3>
                  <br>
                  <div id="news" class="card xs-mb2 xs-p2">
                        <div id="news-header" class="clearfix">
                              <div class="col xs-col-5">
                              </div>
                        </div>
                        <ul id="news-list" class="xs-p0">
                              <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled" v-for="(ho, index) in hot">
                                    <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottago(ho)}}</div>
                                    <br>
                                    <router-link :to="{ name: 'single_forum', params: { id: ho.id, name: respace(ho.topic) }}">
                                          <h4>{{ho.topic}}</h4>
                                    </router-link> <br><br>
                                    <small style="color:red;">
                     In this conversation 
                     </small><br>
                                    <p></p>
                                    <div id="convert">
                                          <img class="conversation" src="img/4671_1.png" />
                                          <img class="conversation2" src="img/s.png" />
                                          <img class="conversation2" src="img/33.png" />
                                          <img class="conversation2" src="img/3e.png" />
                                          <span style="color: #007adf; font-size: 15px;font-size: 15px;
                           vertical-align: super;">+ {{ho.comments.length-4}}</span>
                                    </div>
                                    <hr>
                              </li>
      
                        </ul>
                  </div>
                  <div id="connect" class="xs-mb3">
                        <h3 class="xs-mb1">
                              Connect With Us
                        </h3>
                        <a href="#" target="_blank" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> Like Us On Facebook </a>
                        <a href="#" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1">Follow Us On Twitter</a>
                        <a href="#" class="button button--apple-news xs-col-12 xs-text-left xs-mb1"> Follow Us On Instagram </a>
                  </div>
            </div>
      </div>
</template>

<script>
      export default {
            name: '',
            data: function() {
                  return {
                        hot: [],
                        schedule: []
                  }
            },
            created: function() {
                  this.gethots();
                  this.schedules();
            },
            methods: {
                  gethots: function() {
                        axios.get('/hotforum')
                              .then(response => {
                                    var list = response.data;
                                    list = list.sort(function(a, b) {
                                          return a.comments.length - a.comments.length;
                                    });
                                    this.hot = list;
      
                              })
                              .catch(e => {
      
                              });
                  },
                  schedules: function() {
                        axios.get('/schedules')
                              .then(response => {
                                    // JSON responses are automatically parsed.
                                    this.schedule = response.data;
      
                              })
                              .catch(e => {
      
                              });
                  },
                  respace: function(str) {
                        return str.replace(/ /g, "_");
                  },
                  hottago: (obj) => {
      
      
                        if (obj.comments != undefined && obj.comments.length != 0) {
                              var last = obj.comments[obj.comments.length - 1];
                              return this.timeago(last.updated_at);
                        }
                        return "No activity yet";
      
                  },
                  livestream: function() {
                        if (this.current_play_state == 'play') {
                              var status = 'pause';
                        } else {
                              var status = 'play';
                        }
                        this.$store.dispatch('SET_PLAY', status);
                  },
                  between: function(start, end) {
      
      
                        var format = 'hh:mm:ss'
      
                        // var time = moment() gives you current time. no format required.
                        var time = moment(),
                              beforeTime = moment(start, format),
                              afterTime = moment(end, format);
      
                        if (time.isBetween(beforeTime, afterTime)) {
      
                              return 'Now';
                        } else {
      
                              return 'Later';
      
                        }
                  }
            },
            computed: {
                  now_playing: function() {
                        for (var i = 0; i < this.schedule.length; i++) {
                              var schedu = this.schedule[i];
                              if (this.between(schedu.start, schedu.end) == "Now") {
                                    return schedu
                              }
                        }
                  },
                   current_play_state: function(){
            return this.$store.state.play;
          }
            }
      }
</script>