<template>
  <!-- .cd-auto-hide-header -->
  
  <div class="hello">
  
  
    <div id="sidebar" class="xs-m4">
  
      <div id="now-buzzing" class="xs-mb3">
        <table style="height: 40px !important;" class="table-fill"><br><br><br><br><br><br>
          <thead>
  
          </thead>
          <tbody class="table-hover" v-if="now_playing">
            <tr>
              <td style="border-left: 6px solid red;border-right: 1px solid rgb(221, 221, 221);letter-spacing: 3px;color: red;display: inline-block;font-style: normal !important;font-size: 0.8em;width: 103px;" class="text-left"><i :class="'ion-'+current_play_state" @click="livestream()"></i> <small>LIVE</small> </td>
              <td class="text-left" style="padding-left: 11.4px !important; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">{{now_playing.title}} </td>
            </tr>
  
  
          </tbody>
        </table>
  
        <br>
  
        <div id="now-buzzing" class="xs-mb3">
  
  
  
          <h3 class=" xs-text-2 xs-mb1"> <a href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Freshly Pressed</a></h3><br>
          <div id="vertical-feed" class="" v-for="(fre, index) in fresh" v-if="index <= freshlimit">
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
              <div class="xs-text-left text-gray">
                <ul class="list-unstyled">
                  <li class="xs-col-12 xs-mb2">
                  <router-link v-bind:to="{ name: 'blogpost', params: { id: fre.id, title: fre.title }}"  class="bold text-gray">
                 
                      <img class="buzz-image xs-block xs-mb05" :src="fre.image">
                      <h4 class="xs-text-4 lg-text-3">{{fre.title}}</h4>
                    
                    </router-link>
                    <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> 200 <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">3 HOURS AGO</span> </p>
                  </li>
  
  
                </ul>
              </div>
            </div>
          </div>
          <br>
  
          <a id="more-buzz" class="button button--secondary xs-col-12" href="javascript::void" @click="morefresh()">
       + More Fresh
    </a>
        </div>
  
  
  
        <h3 class=" xs-text-2 xs-mb1"> <a style="background: #43e97b !important;" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Charts</a></h3><br>
        <span class="centered">
                          <div class="btn-group btn-toggle"> 
                            <button :class="'btn btn-'+selectedcat[0]+' chart'" @click="change_chart(0)">Nigerian</button>
                            <button :class="'btn btn-'+selectedcat[1]+' chart'" @click="change_chart(1)">Global</button>  <button :class="'btn btn-'+selectedcat[2]+' chart'" @click="change_chart(2)">Alternative</button>
                          </div>
                      </span><br><br>
  
        <div id="now-buzzing" class="xs-mb3">
          <table class="table-fill">
            <thead>
  
            </thead>
            <tbody class="table-hover">
              <tr v-for="(chart, index) in all_chart[currentchart][currentchartweek]" v-if="index <= chartlimit">
                <td class="text-left">{{chart.position}}</td>
                <td class="text-left">{{chart.songs.song_title}} by {{chart.songs.artistname}} </td>
              </tr>
  
            </tbody>
          </table><br>
          <a id="more-buzz"  class="button button--secondary xs-col-12" href="javascript::void" @click="fullchartlimit()">
       + More
    </a>
        </div>
  
  
        <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
          <img id="msu-img" class="xs-border-lighter" src="https://webappstatic.buzzfeed.com/static/2017-03/2/20/campaign_images/buzzfeed-prod-fastlane-03/john-lithgow-is-returning-to-tv-and-its-everything-2-27276-1488502840-14_wide.jpg">
          <h5 class="bold xs-inline-block">John Lithgow Is Returning To TV And It's Everything</h5>
          <div id="msu-disclosure-block" class="xs-mt1">
            <a href="#" class="xs-float-left xs-inline-block text-gray">
              <img id="msu-logo" class="xs-mr1" src="https://webappstatic.buzzfeed.com/static/2017-02/27/18/user_images/buzzfeed-prod-fastlane-03/amberlatorre-v2-11115-1488238873-0_large.jpg">
            </a>
            <div class="msu-ad-disclosure-text xs-inline-block xs-align-middle">
              <h6 class="text-promoted-orange">Promoted by</h6>
              <h5><a class="xs-float-left bold link-blue " href="https://www.buzzfeed.com/trialanderror">Trial &amp; Error</a></h5>
            </div>
          </div>
        </div>
        <h3 class=" xs-text-2 xs-mb1"> <a style="background: #f83600 !important" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Hot</a></h3><br>
        <div id="news" class="card xs-mb2 xs-p2">
          <div id="news-header" class="clearfix">
            <div class="col xs-col-5">
  
            </div>
  
          </div>
          <ul id="news-list" class="xs-p0">
            <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled" v-for="(ho, index) in hot" v-if="index < hotlimit" style="width: 100%;" >
              <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottimeago(ho)}}</div><br>
              <a href="#" class="link-gray" >
               {{ho.topic}}
                </a> <br><br>
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
  
          <a href="javascript::void" class="xs-block xs-text-5 bold" style="float:left; color: blue;" @click="hotclick()">+ Show more</a>
          <br>
        </div>
  
        <div id="connect" class="xs-mb3">
          <h3 class="xs-mb1">
            Connect With Us
          </h3>
  
          <a href="#" target="_blank" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> Like Us On Facebook </a>
  
          <a href="#" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1">Follow Us On Twitter</a>
  
          <a href="#" class="button button--apple-news xs-col-12 xs-text-left xs-mb1"> Follow Us On Instagram </a>
  
        </div>
  
        <div>
          <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
            <img id="msu-img" class="xs-border-lighter" src="https://webappstatic.buzzfeed.com/static/2017-03/2/20/campaign_images/buzzfeed-prod-fastlane-03/john-lithgow-is-returning-to-tv-and-its-everything-2-27276-1488502840-14_wide.jpg">
            <h5 class="bold xs-inline-block">John Lithgow Is Returning To TV And It's Everything</h5>
            <div id="msu-disclosure-block" class="xs-mt1">
              <a href="#" class="xs-float-left xs-inline-block text-gray">
                <img id="msu-logo" class="xs-mr1" src="https://webappstatic.buzzfeed.com/static/2017-02/27/18/user_images/buzzfeed-prod-fastlane-03/amberlatorre-v2-11115-1488238873-0_large.jpg">
              </a>
              <div class="msu-ad-disclosure-text xs-inline-block xs-align-middle">
                <h6 class="text-promoted-orange">Promoted by</h6>
                <h5><a class="xs-float-left bold link-blue " href="https://www.buzzfeed.com/trialanderror">Trial &amp; Error</a></h5>
              </div>
            </div>
          </div>
          <br>
  
          <div id="now-buzzing" class="xs-mb3">
            <h3 class=" xs-text-2 xs-mb1"> <a style="background: #ff0844 !important" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Rising</a></h3><br>
            
            <div id="vertical-feed" class="" >
              <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
                <div class="xs-text-left text-gray">
                  <ul class="list-unstyled">
                    <li class="xs-col-12 xs-mb2" v-for="(rising, index) in newones" v-if="index <= newlimit">
                    <router-link v-bind:to="{ name: 'blogpost', params: { id: rising.id, title: rising.title }}"  class="bold text-gray">
                      
                        <img class="buzz-image xs-block xs-mb05" :src="rising.image">
                        <h4 class="xs-text-4 lg-text-3">{{rising.title}}</h4>
              
                      </router-link>
                      <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> 200 <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">3 HOURS AGO</span> </p>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <br>
  
            <a id="more-buzz" class="button button--secondary xs-col-12" href="javascript::void" @click="newlimitplus()">
       + More Rising
    </a>
          </div>
  
  
  
          <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
            <img id="msu-img" class="xs-border-lighter" src="https://webappstatic.buzzfeed.com/static/2017-03/2/20/campaign_images/buzzfeed-prod-fastlane-03/john-lithgow-is-returning-to-tv-and-its-everything-2-27276-1488502840-14_wide.jpg">
            <h5 class="bold xs-inline-block">John Lithgow Is Returning To TV And It's Everything</h5>
            <div id="msu-disclosure-block" class="xs-mt1">
              <a href="#" class="xs-float-left xs-inline-block text-gray">
                <img id="msu-logo" class="xs-mr1" src="https://webappstatic.buzzfeed.com/static/2017-02/27/18/user_images/buzzfeed-prod-fastlane-03/amberlatorre-v2-11115-1488238873-0_large.jpg">
              </a>
              <div class="msu-ad-disclosure-text xs-inline-block xs-align-middle">
                <h6 class="text-promoted-orange">Promoted by</h6>
                <h5><a class="xs-float-left bold link-blue " href="https://www.buzzfeed.com/trialanderror">Trial &amp; Error</a></h5>
              </div>
            </div>
          </div>
          <br>
  
          <div id="now-buzzing" class="xs-mb3">
  
            <h3 class=" xs-text-2 xs-mb1"> <a style="background:  #4481eb !important" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Trending</a></h3><br>
            <ul class="list-unstyled">
           
              <!--, <li class="xs-col-12 xs-mb2 xs-block">
                <div class="xs-relative">
                  <div class="partner-sash text-white fill-promoted-orange">Promoted</div>
                  <a href="#">
                    <img class="xs-mb05 buzz-image" src="http://hana.cool/stuff/codepen/15-reasons-why-san-diego-is-the-beach-vacation-yo-2-1663-1484676873-0_wide.jpg"></a>
                  <h2 class="xs-text-4 lg-text-3 bold">
                    <a href="https://www.buzzfeed.com/sdtourism/san-diego-is-the-beach-vacation-you-need" class="xs-block text-gray">15 Reasons You Need A San Diego Vacation</a>
                  </h2>
                </div>
              </li> -->
              <li class="xs-col-12 xs-mb2" v-for="(trend, index) in trending" v-if="index <= trendlength">
              <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: trend.title }}"  class="bold text-gray">
                  <img class="xs-block xs-mb05 buzz-image" :src="trend.image">
                  <h4 class="xs-text-4 lg-text-3">{{trend.title}}</h4>
                </router-link>
                <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> 200 <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">3 HOURS AGO</span> </p>
              </li>
  
  
  
            </ul>
          </div>
  
          <a id="more-buzz" class="button button--secondary xs-col-12" href="javascript::void" @click="trendlengthplus()">
      	+ More Trending
    </a>
        </div>
  
  
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'hello',
    data() {
      return {
        schedule: [],
        trending: window.Laravel.trending,
        newones: window.Laravel.newones, 
        fresh: window.Laravel.fresh,
        freshlimit: 2,
        currentweek:this.week(),
        currentchartweek: this.week(),
        nigerianchart:[],
        globalchart:[],
        alternativechart:[],
        selectedcat:['nigerian','global','global'],
        currentchart: 0,
        hot: [],
        hotlimit: 2,
        newlimit: 2,
        chartlimit: 5,
        trendlength: 2
      }
    },
    mounted: function() {
      this.schedules();
       this.getcharts();
       this.gethots();
    },
    methods: {
      schedules: function() {
        axios.get('/schedules')
          .then(response => {
            // JSON responses are automatically parsed.
            this.schedule = response.data;
  
          })
          .catch(e => {
  
          });
      },
      week: function (){
                    var myDate = new Date();
                    if(myDate.getDay() == 6 || myDate.getDay() == 0 || myDate.getDay() == 5){
                        return moment().isoWeek()+1;
                    }
                    return moment().isoWeek();
                    
                },

      getcharts: function(){

                axios.get('/charts')
                .then(response => {
                // JSON responses are automatically parsed.
                var grouped = _.groupBy(response.data, function(car) {
                                return car.category;
                                });
                    //group charts by category
                    this.nigerianchart = grouped.nigerian;
                    this.globalchart = grouped.global;
                    this.alternativechart = grouped.alternative;

                    //group each chart by week
                     this.nigerianchart = _.groupBy(this.nigerianchart, function(car) {
                                            return car.week;
                                            });
                    this.globalchart =  _.groupBy(this.globalchart, function(car) {
                                            return car.week;
                                            });
                    this.alternativechart =  _.groupBy(this.alternativechart, function(car) {
                                            return car.week;
                                            });                   
                
                })
                .catch(e => {
                
                });

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
      },
      change_chart: function(id){
                var ch = ['global','global','global'];
                ch[id]='nigerian';
                this.selectedcat = ch;
                this.currentchart = id;

            },
            gethots: function(){
                axios.get('/hotforum')
                .then(response => {

                        var list=response.data;
                        list = list.sort(function (a, b) {
                            return getValue(a.comments.length) - getValue(a.comments.length);
                        });
                        this.hot=list;
                
                    })
                    .catch(e => {
                    
                    });
            },
            timeago: function (time){
                return moment(time).fromNow();
            },
            hottimeago: function(obj){
                if(obj.comments != undefined && obj.comments.length != 0){
                    var last = obj.comments[obj.comments.length-1];
                    return this.timeago(last.updated_at); 
                }
                return "No activity yet";
            },
            morefresh: function(){
              this.freshlimit = 4;
            },
            hotclick: function(){
              this.hotlimit = 4;
            }, 
            newlimitplus: function(){
              this.newlimit = 4;
            },
            fullchartlimit: function(){
              this.chartlimit = 19;
            },
            trendlengthplus: function(){
              this.trendlength = 5;
            },
            livestream: function(){
              if(this.current_play_state == 'play'){
                var status = 'pause';
              }else{
                var status = 'play';
              }
              this.$store.dispatch('SET_PLAY', status);
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
       all_chart: function(){
              var arr = {
                  0: this.nigerianchart,
                  1: this.globalchart,
                  2: this.alternativechart
              }
              
             
              return arr;
          },
          current_play_state: function(){
            return this.$store.state.play;
          }
    }
  }
</script>

