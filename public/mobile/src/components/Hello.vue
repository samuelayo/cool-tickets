<template>
  <!-- .cd-auto-hide-header -->

  <div class="hello">


    <div id="sidebar" class="xs-m4">

      <div id="now-buzzing" class="xs-mb3">


        <div id="now-buzzing" class="xs-mb3">



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
          <div id="vertical-feed" class="" v-for="(fre, index) in fresh" v-if="index <= freshlimit">
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


 <swiper :options="swiperOption" ref="mySwiper" v-if="all_chart[currentchart][currentchartweek]">
    <!-- slides -->
    <swiper-slide v-for="(chart, index) in all_chart[currentchart][currentchartweek]"><img :src="chart.songs.image"></swiper-slide>

    <!-- Optional controls -->
    <div class="swiper-pagination"  slot="pagination"></div>
    <div class="swiper-button-prev" slot="button-prev"></div>
    <div class="swiper-button-next" slot="button-next"></div>
    <div class="swiper-scrollbar"   slot="scrollbar"></div>
  </swiper>
        </div>

         <div id="msu" class="card xs-mt4 md-mt0 xs-p2 xs-mb3">
          <a v-if="sidebar_chart[0]" :href="sidebar_chart[0].url">
            <img :src="'/'+sidebar_chart[0].image_url" width="100%" height="100%"></img>
          </a>


        </div>


       <h3 class=" xs-text-2 xs-mb1"><a href="#" target="_blank" class="" style="
      font-size: 1.1em;
      line-height: 2;
      color: #000;
      font-family: 'Circular-Black';
      letter-spacing: -.5px;
  "> Forum </a></h3>
        <div id="news" class="card xs-mb2 xs-p2">
          <div id="news-header" class="clearfix">
            <div class="col xs-col-5">

            </div>

          </div>
          <ul id="news-list" class="xs-p0">
            <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled" v-for="(ho, index) in hot" v-if="index < hotlimit" style="width: 100%;">
              <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottimeago(ho)}}</div><br><br>
               <router-link :to="{ name: 'single_forum', params: { id: ho.id, name: respace(ho.topic) }}" style="color: grey;">
                   {{ho.topic}}
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

            </li>




          </ul>

          <a href="javascript::void" class="xs-block xs-text-5 bold" style="float:left; color: blue;" @click="hotclick()">+ Show more</a>
          <br>
        </div>







      </div>


    </div>
  </div>
  </div>
</template>

<script>
  import { swiper, swiperSlide } from 'vue-awesome-swiper'
  export default {
    name: 'hello',
    data() {
      return {
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
        trendlength: 2,
        swiperOption: {
          // NotNextTick is a component's own property, and if notNextTick is set to true, the component will not instantiate the swiper through NextTick, which means you can get the swiper object the first time (if you need to use the get swiper object to do what Things, then this property must be true)
          // notNextTick是一个组件自有属性，如果notNextTick设置为true，组件则不会通过NextTick来实例化swiper，也就意味着你可以在第一时间获取到swiper对象，假如你需要刚加载遍使用获取swiper对象来做什么事，那么这个属性一定要是true
          notNextTick: true,
          // swiper configs 所有的配置同swiper官方api配置
          autoplay: 3000,
          direction : 'vertical',
          grabCursor : true,
          setWrapperSize :true,
          autoHeight: true,
          pagination : '.swiper-pagination',
          paginationClickable :true,
          prevButton:'.swiper-button-prev',
          nextButton:'.swiper-button-next',
          scrollbar:'.swiper-scrollbar',
          mousewheelControl : true,
          observeParents:true,
          // if you need use plugins in the swiper, you can config in here like this
          // 如果自行设计了插件，那么插件的一些配置相关参数，也应该出现在这个对象中，如下debugger
          debugger: true,
          // swiper callbacks
          // swiper的各种回调函数也可以出现在这个对象中，和swiper官方一样
          onTransitionStart(swiper){
            console.log(swiper)
          },
          // more Swiper configs and callbacks...
          // ...
        }
      }
    },
    mounted: function() {

      this.getcharts();
      this.gethots();
    },
    components: {
    swiper,
    swiperSlide
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
      gethots: function() {
        axios.get('/hotforum')
          .then(response => {

            var list = response.data;


            list = list.sort(function(a, b) {
              return a.comments.length - b.comments.length;
            });

            this.hot = list;

          })
          .catch(e => {

          });
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

