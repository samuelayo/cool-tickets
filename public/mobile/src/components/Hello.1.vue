<template>
  <!-- .cd-auto-hide-header -->

  <div class="hello">


    <div id="sidebar" class="xs-m4">

      <div id="now-buzzing" class="xs-mb3">


        <div id="now-buzzing" class="xs-mb3">



          <h3 class=" xs-text-2 xs-mb1"> <a href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Freshly Pressed</a></h3>
          <div id="vertical-feed" class="" v-for="(fre, index) in fresh" v-if="index <= freshlimit">
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
              <div class="xs-text-left text-gray">
                <ul class="list-unstyled">
                  <li class="xs-col-12 xs-mb2">
                  <router-link v-bind:to="{ name: 'blogpost', params: { id: fre.id, title: respace(fre.title) }}"  class="bold text-gray">

                      <img class="buzz-image xs-block xs-mb05" :src="fre.image">
                      <P id="post-cat-m"> {{fre.category.name}} </P>
                      <h4 class="xs-text-4 lg-text-3">{{fre.title}}</h4>

                    </router-link>
                    <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{shares('/blogpost/'+fre.id+'/'+respace(fre.title))}} <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">{{timeago(fre.created_at)}}</span> </p>
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
        <a  v-if="homepage_chart[0]" :href="homepage_chart[0].url">
         <img  :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></img>
      </a>

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


        <div>
          <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
           <a  v-if="homepage_chart[1]" :href="homepage_chart[1].url">
         <img  :src="'/'+homepage_chart[1].image_url" width="100%" height="100%"></img>
      </a>
          </div>
          <br>

          <div id="now-buzzing" class="xs-mb3">
            <h3 class=" xs-text-2 xs-mb1"> <a style="background: #ff0844 !important" href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> Rising</a></h3><br>

            <div id="vertical-feed" class="" >
              <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
                <div class="xs-text-left text-gray">
                  <ul class="list-unstyled">
                    <li class="xs-col-12 xs-mb2" v-for="(rising, index) in newones" v-if="index <= newlimit">
                    <router-link v-bind:to="{ name: 'blogpost', params: { id: rising.id, title: respace(rising.title) }}"  class="bold text-gray">

                        <img class="buzz-image xs-block xs-mb05" :src="rising.image">
                        <P id="post-cat-m"> {{rising.category.name}} </P>
                        <h4 class="xs-text-4 lg-text-3">{{rising.title}}</h4>

                      </router-link>
                      <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{shares('/blogpost/'+rising.id+'/'+respace(rising.title))}}<span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">{{timeago(rising.created_at)}}</span> </p>
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
           <a  v-if="sidebar_chart[0]" :href="sidebar_chart[0].url">
         <img  :src="'/'+sidebar_chart[0].image_url" width="100%" height="100%"></img>
      </a>


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
              <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: respace(trend.title) }}"  class="bold text-gray">
                  <img class="xs-block xs-mb05 buzz-image" :src="trend.image">
                  <P id="post-cat-m"> {{trend.category.name}} </P>
                  <h4 class="xs-text-4 lg-text-3">{{trend.title}}</h4>
                </router-link>
                <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{shares('/blogpost/'+trend.id+'/'+respace(trend.title))}}<span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">{{timeago(trend.created_at)}}</span> </p>
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

       this.getcharts();
       this.gethots();
    },
    methods: {

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
            shares: function(url){
                sharon.facebook.count(url=url,(err, count)=>{
                   return count;
                    //console.log('Whoa, we have ' + count + ' shares!');
                });

            },
            livestream: function(){
              if(this.current_play_state == 'play'){
                var status = 'pause';
              }else{
                var status = 'play';
              }
              this.$store.dispatch('SET_PLAY', status);
            },
            respace: function(str){
              return str.replace(/ /g,"_");
            }
    },
    computed: {

       all_chart: function(){
              var arr = {
                  0: this.nigerianchart,
                  1: this.globalchart,
                  2: this.alternativechart
              }


              return arr;
          },

          homepage_chart: function(){
            var homeads = _.filter(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_main") return o;
            });
            return homeads;
          },
          sidebar_chart: function(){
            var homeads = _.filter(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_side") return o;
            });
            return homeads;
          }
    }
  }
</script>

