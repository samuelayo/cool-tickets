<template>
  <!-- .cd-auto-hide-header -->
  <div class="hello">
       <center><clip-loader v-if="loading" color="blue"></clip-loader></center>
    <div id="sidebar" class="xs-m4">
      <div id="now-buzzing" class="xs-mb3">
        <div id="now-buzzing" class="xs-mb3">
        <center><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4448078976745099" data-ad-slot="5185770514" data-ad-format="auto"></ins></center>
          <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
            <a v-if="homepage_chart[0]" :href="homepage_chart[0].url">
              <img :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></img>
            </a>
          </div>
          <h3 class=" xs-text-2 xs-mb1"><a href="#" target="_blank" class="" style="
          font-size: 1.1em;
          line-height: 2;
          color: #000;
          font-family: 'Circular-Black';
          letter-spacing: -.5px;
      "> Latest News</a></h3>
          <div id="vertical-feed" class="" v-for="(fre, index) in fresh" v-if="index <= freshlimit" :key="index">
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
              <div class="xs-text-left text-gray">
                <ul class="list-unstyled">
                  <li class="xs-col-12 xs-mb2">
                    <router-link v-bind:to="{ name: 'blogpost', params: { id: fre.id, title: respace(fre.title) }}" class="bold text-gray">
                      <img class="buzz-image xs-block xs-mb05" :src="fre.image">
                      <P id="post-cat-m"> {{fre.category.name}} </P>
                      <h4 class="xs-text-4 lg-text-3">{{fre.title}}</h4>
                    </router-link>
                    <p id="share-m"> <span style="    font-size: 1.7em;
            font-weight: 900;
            vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{shares('/blogpost/'+fre.id+'/'+respace(fre.title))}} <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span> <span style="font-weight: 100;">{{timeago(fre.created_at)}}</span>                    </p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <br>
          <a id="more-buzz" class="button button--secondary xs-col-12" href="javascript::void" @click="morefresh()">
               + More News
            </a>
        </div>
        <div>
        <center><ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4448078976745099"
                    data-ad-slot="5545697316"
                    data-ad-format="auto"></ins></center>
          <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
            <a v-if="homepage_chart[1]" :href="homepage_chart[1].url">
              <img :src="'/'+homepage_chart[1].image_url" width="100%" height="100%"></img>
            </a>
          </div>
        </div>
        <h3 class=" xs-text-2 xs-mb1"><a href="#" target="_blank" class="" style="
          font-size: 1.1em;
          line-height: 2;
          color: #000;
          font-family: 'Circular-Black';
          letter-spacing: -.5px;
      "> Charts </a></h3>
        <span class="centered">
                                  <div class="btn-group btn-toggle">
                                    <button :class="'btn btn-'+selectedcat[0]+' chart'" @click="change_chart(0)">Nigerian</button>
                                    <button :class="'btn btn-'+selectedcat[1]+' chart'" @click="change_chart(1)">Global</button>  <button :class="'btn btn-'+selectedcat[2]+' chart'" @click="change_chart(2)">Alternative</button>
                                  </div>
                              </span><br><br>
        <div id="now-buzzing" class="xs-mb3">
          <div id="slider" v-if="all_chart[currentchart][currentchartweek]">
            <slider animation="fade" :auto="false">
              <slider-item v-for="(chart, index) in all_chart[currentchart][currentchartweek]" :key="index">
                <div>
                  <img :src="chart.songs.image">
                  <p style="
    margin-top: -17em;
    margin-left: 1em;
"><span style="
    color: #fff;
    border: 3px solid #fff;
    border-radius: 50%;
    background: rgba(0,0,0,.2);
    padding: 0.8em 1.3em;
">{{chart.position}}</span></p>

<p style="
    margin-top: 8.5em;
    margin-left: 1em;
    border-left: 1px solid #fff;
"><span style="
    color: #fff;
    border-radius: 50%;
    padding-top: .4em;
    padding-bottom: .4em;
    background: rgba(0, 0, 0, .9);
    padding-right: 1em;
    display: block;

">{{chart.songs.artistname}}</span><span style="
    color: #fff;
    border-radius: 50%;
    padding-top: .4em;
    padding-bottom: .4em;
    background: rgba(0,0,0,.2);
    display: block;
    font-size: 1.2em;
    background: rgba(0, 0, 0, .9);
    font-family: 'Circular-Bold';
">{{chart.songs.song_title}}</span></p>
                </div>
              </slider-item>
            </slider>
          </div>
        </div>
         <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4448078976745099"
                    data-ad-slot="5545697316"
                    data-ad-format="auto"></ins>
        <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
          <a v-if="sidebar_chart[0]" :href="sidebar_chart[0].url">
            <img :src="'/'+sidebar_chart[0].image_url" width="100%" height="100%"></img>
          </a>
        </div>
             
      </div>
    </div>
  </div>
  </div>
</template>

<script>
  import {
    Slider,
    SliderItem
  } from 'vue-easy-slider' 
  export default {
    name: 'hello',
    data() {
      return {
        loading: true,
        trending: window.Laravel.trending,
        newones: window.Laravel.newones,
        fresh: window.Laravel.fresh,
        freshlimit: 10,
        currentweek: this.week(),
        currentchartweek: this.week(),
        nigerianchart: [],
        globalchart: [],
        alternativechart: [],
        selectedcat: ['nigerian', 'global', 'global'],
        currentchart: 0,
        hot: [],
        hotlimit: 2,
        newlimit: 2,
        chartlimit: 5,
        trendlength: 2
      }
    },
    components: {
      Slider,
      SliderItem
    },
    mounted: function() {
      this.getcharts();

       function loadScript(url) {
        return new Promise(function(resolve, reject) {
          var script = document.createElement("script")
          script.type = "text/javascript";
          if (script.readyState) { //IE
            script.onreadystatechange = function() {
              if (script.readyState == "loaded" ||
                script.readyState == "complete") {
                script.onreadystatechange = null;
                resolve();
              }
            };
          } else { //Others
            script.onload = function() {
              resolve();
            };
          }
          script.src = url;
          document.getElementsByTagName("head")[0].appendChild(script);
        });
      }
      ///adsense
      loadScript("//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js").then(function() {
        (window.adsbygoogle = window.adsbygoogle || []).push({})
      });
    },
    methods: {
      week: function() {
        var myDate = new Date();
        if (myDate.getDay() == 6 || myDate.getDay() == 0 || myDate.getDay() == 5) {
          return moment().isoWeek() + 1;
        }
        return moment().isoWeek();
      },
      getcharts: function() {
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
            this.globalchart = _.groupBy(this.globalchart, function(car) {
              return car.week;
            });
            this.alternativechart = _.groupBy(this.alternativechart, function(car) {
              return car.week;
            });
            this.loading = false;
          })
          .catch(e => {
          });
      },
      change_chart: function(id) {
        var ch = ['global', 'global', 'global'];
        ch[id] = 'nigerian';
        this.selectedcat = ch;
        this.currentchart = id;
      },
     
      timeago: function(time) {
        return moment(time).fromNow();
      },
      hottimeago: function(obj) {
        if (obj.comments != undefined && obj.comments.length != 0) {
          var last = obj.comments[obj.comments.length - 1];
          return this.timeago(last.updated_at);
        }
        return "No activity yet";
      },
      morefresh: function() {
        this.freshlimit = this.freshlimit + 10;
      },
      hotclick: function() {
        this.hotlimit = 4;
      },
      newlimitplus: function() {
        this.newlimit = 4;
      },
      fullchartlimit: function() {
        this.chartlimit = 19;
      },
      trendlengthplus: function() {
        this.trendlength = 5;
      },
      shares: function(url) {
        sharon.facebook.count(url = url, (err, count) => {
          return count;
          //console.log('Whoa, we have ' + count + ' shares!');
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
      respace: function(str) {
        return str.replace(/ /g, "_");
      }
    },
    computed: {
      all_chart: function() {
        var arr = {
          0: this.nigerianchart,
          1: this.globalchart,
          2: this.alternativechart
        }
        return arr;
      },
      homepage_chart: function() {
        var homeads = _.filter(window.Laravel.ads, function(o) {
          if (o.advert_category.type == "homepage_main") return o;
        });
        return homeads;
      },
      sidebar_chart: function() {
        var homeads = _.filter(window.Laravel.ads, function(o) {
          if (o.advert_category.type == "homepage_side") return o;
        });
        return homeads;
      }
    }
  }
</script>

<style>
 .indicators.indi-center {
    display: none !important;
}
</style>
