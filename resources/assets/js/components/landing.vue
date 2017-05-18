<template>
<div id="landing">
   <div class="col-md-12">
      <a  v-if="homepage_chart[0]" :href="homepage_chart[0].url">
         <adimage  :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></adimage>
      </a>
   </div>
   <!-- Header -->
   <div class="intro-header">
      <div id="fb-streaming-row">
         <div class="row">
            <div class="col-lg-12">
               <div class="container-fluid">
                  <br><br>
                  <div class="col-lg-7">
                     <p class="on-air-title" >On Air Now</p>
                     <div v-if="now_playing" :style="'background: url('+now_playing.image+'); background-size: cover;'" class="streaming">
                        <div class="col-md-12">
                           <div class="col-md-8">
                              <div id="live-play" class="col-md-12">
                                 <button class="c-btn c-btn--pill-l c-btn--on-air" role="button"><span class="c-btn__icon"> <span class="u-font-size--s"> <span style="font-size: 1.8em; vertical-align: middle;" :class="'ion-ios-'+play+''" @click="playthis(0,'livestream', 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos', now_playing.title);"></span>&nbsp; Listen Live</span></span></button> &nbsp; Ending {{timeleft(now_playing.end)}}
                              </div>
                           </div>
                        </div>
                     </div>
                     <div v-if="now_playing">
                        <h3 class="center"><strong> {{now_playing.title}} </strong></h3>
                        <h5 class="center">{{now_playing.description}}</h5>
                     </div>
                  </div>
                  <div  class="col-lg-5">
                   <p  style="color: rgb(51, 51, 51); text-align: center; font-size: 1.71667rem; margin-top: .9em;">Schedules</p>
                   <br>
                     <!-- <div class="onair">
                        </div> -->
                        <div class="col-md-12" style="-webkit-box-shadow: 10px 10px 101px -31px rgba(0,0,0,0.4);
                     -moz-box-shadow: 10px 10px 101px -31px rgba(0,0,0,0.4);
                     box-shadow: 10px 10px 101px -31px rgba(0,0,0,0.4); padding:0;" >
                     <div class="waves">
                        <div class="wave wave_1"></div>
                        <div class="wave wave_2"></div>
                        <div class="wave wave_3"></div>
                        <div class="wave wave_4"></div>
                        <div class="wave wave_5"></div>
                     </div>
                     <div class="playlist ">
                        <ul style="list-style-type: none;">
                           <li v-for="(schedule, index) in formated_schedules">
                              <div class="col-md-12">
                                 <div id="center"  class="col-md-2">
                                    <p class="player-status-live">{{between(schedule.start, schedule.end)}}</p>
                                 </div>
                                 <div class="col-md-10" >
                                    <h5>{{schedule.title}}</h5>
                                    <p style="color: grey;">
                                       {{schedule.description}}
                                    </p>
                                    <p>
                                       <small style="color:red" v-if="index==0">Ending: {{timeleft(schedule.end)}} </small>
                                       <small style="color:red" v-if="index!=0">Running Time: {{schedule.start}} - {{schedule.end}} </small>
                                    </p>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.intro-header -->
   <!-- Page Content -->
   <!-- podcast details -->
   <div class="container-fluid">
      <div class="row">
         <br><br><br>
         <div style="margin-left: 1em;" class="col-md-12" v-if="rearrange_podcasts[currentweek]">
            <h3>
               PODCASTS
               &nbsp;
               &nbsp;
               <span style="color:#B2BEB5">
               <small>
               <a href="javascript:void(0)" @click="pweekpod"> <span class="ion-ios-arrow-left"></span> </a><span style="    text-transform: uppercase;
                  letter-spacing: 1px;"> Week {{currentweek}} </span> <a href="javascript:void(0)" @click="nweekpod"> <span class="ion-ios-arrow-right"></span> </a>
               </small>
               </span> 
            </h3>
         </div>
         <!-- chart header -->
         <!-- -->
         <!-- chart images -->
         <div class="col-md-12" v-if="rearrange_podcasts[currentweek]">
            <div class="col-md-6">
               <div class="row" >
                  <br><br>
                  <div   class="col-sm-3" v-for="(pod, index) in rearrange_podcasts[currentweek]" v-if="index <= 3">
                     <a  href="javascript:void(0)" class="ratio img-responsive img-circle" :style="'background-image: url('+pod.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.2);'"></a> 
                     <span class="badge badge-play"><small><a href="javascript:void(0)" @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play" ></span></a></small>  </span>     
                     <span>
                        <center><small><a class="listen" href="#"><span class="ion-ios-play"></span> 1000 Listens</a></small> </center>
                        <center><small><a style="color: #4facfe;" href=""> {{pod.title}} </a> </small></center>
                        <center><small><a href="#">{{pod.part}}</a></small></center>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <br><br>
                  <div  class="col-sm-3" v-for="(pod, index) in rearrange_podcasts[currentweek]" v-if="(index > 3 && index <=6)" >
                     <a href="javascript:void(0)" class="ratio img-responsive img-circle" :style="'background-image: url('+pod.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.2);'"></a>
                     <span class="badge badge-play"><small><a href="javascript:void(0)" @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play" ></span></a></small>  </span>     
                     <span>
                        <center><small><a class="listen" href="#"><span class="ion-ios-play"></span> 1000 Listens</a></small> </center>
                        <center><small><a style="color: #4facfe;" href=""> {{pod.title}} </a> </small></center>
                        <center><small><a href="#">{{pod.part}}</a></small></center>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <!-- -->
      </div>
   </div>
   <span v-if="rearrange_podcasts[currentweek]">
   <br>
   <br>
   <br>
   </span>
   <!-- end chart details -->
   <router-link :to="{ name: 'all_podcasts', params: { week: currentweek}}">
      <p style="text-align: center;" v-if="rearrange_podcasts[currentweek]"><span style="border-bottom: 1px solid #ddd;
         vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> <a href=""><span style="color: #666; text-align: center;  font-style: italic; padding: 1em;     vertical-align: -webkit-baseline-middle;"> Show more</span></a>  <span style="border-bottom: 1px solid #ddd;
         vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> </p>
   </router-link>
   <br><br>
   <!-- advert -->
   <div class="col-md-12">
      <a  v-if="homepage_chart[1]" :href="homepage_chart[1].url">
         <adimage  :src="'/'+homepage_chart[1].image_url" width="100%" height="100%"></adimage>
      </a>
   </div>
   <br>
   <!-- chart details -->
   <div class="container-fluid">
      <div class="row">
         <div style="margin-left: 1em;" class="col-md-12">
            <br>
            <br>  
            <h3>
               CHARTS
               &nbsp;
               &nbsp;
               <span style="color:#B2BEB5">
               <small>
               <a href="javascript:void(0)" @click="pweekcht()"> <span class="ion-ios-arrow-left"></span> </a><span style="    text-transform: uppercase;
                  letter-spacing: 1px;"> Week {{currentchartweek}} </span> <a href="javascript:void(0)" @click="nweekcht()"> <span class="ion-ios-arrow-right"></span> </a>
               </small>
               </span>
               <span class="centered">
                  <div class="btn-group btn-toggle"> 
                     <button :class="'btn btn-'+selectedcat[0]+' chart'" @click="change_chart(0)">Nigerian</button>
                     <button :class="'btn btn-'+selectedcat[1]+' chart'" @click="change_chart(1)">Global</button>
                     <button :class="'btn btn-'+selectedcat[2]+' chart'" @click="change_chart(2)">Alternative</button>
                  </div>
               </span>
               <span style="float: right; margin-right: 2em;">
               <small>
               <span class="badge badge-pink">&nbsp;</span>
               <span>Weeks On Chart</span>
               &nbsp;
               &nbsp;
               <span class="badge badge-orange">&nbsp;</span>
               <span>New Entry</span>
               &nbsp;
               &nbsp;
               <span class="badge badge-pink" style="background-color: #009efd;">&nbsp;</span>
               <span>Last week</span>
               </small>
               </span>
            </h3>
         </div>
         <!-- chart header -->
         <!-- -->
         <!-- chart images -->
         <div class="col-md-12">
            <div class="col-md-6">
               <div class="row">
                  <br><br>
                  <div  class="col-sm-3" v-for="(chart, index) in all_chart[currentchart][currentchartweek]" v-if="index <= 3" >
                     <p class="chart-num"><strong> {{chart.position}} </strong></p>
                     <a  class="ratio img-responsive img-circle" :style="'background-image: url('+chart.songs.image+');'"></a>
                     <span class="badge badge-notify"><small>{{noofchart(chart.song)}}</small></span>
                     <span class="badge badge-new" v-if="noofchart(chart.song)==1"><small> <strong> New </strong> </small></span>
                     <span class="badge badge-lw" ><small> <strong> {{lastweek(chart.song)}} </strong> </small></span>
                     <span>
                        <center><small>{{chart.songs.song_title}}</small></center>
                        <center><small><a href="#">{{chart.songs.artistname}}</a></small></center>
                     </span>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <br><br>
                  <div  class="col-sm-3" v-for="(chart, index) in all_chart[currentchart][currentchartweek]" v-if="(index > 3 && index <=6)" >
                     <p class="chart-num"><strong> {{chart.position}} </strong></p>
                     <a  class="ratio img-responsive img-circle" :style="'background-image: url('+chart.songs.image+');'"></a>
                     <span class="badge badge-notify"><small>{{noofchart(chart.song)}}</small></span>
                     <span class="badge badge-new" v-if="noofchart(chart.song)==1"><small> <strong> New </strong> </small></span>
                     <span class="badge badge-lw" ><small> <strong> {{lastweek(chart.song)}} </strong> </small></span>
                     <span>
                        <center><small>{{chart.songs.song_title}}</small></center>
                        <center><small><a href="#">{{chart.songs.artistname}}</a></small></center>
                     </span>
                  </div>
                  <br><br>
                  <div  class="col-sm-3" >
                     <router-link v-bind:to="{ name: 'chartcurrated', params: {currentchartweek: currentchartweek }}">
                        <a id="see-all" href="http://trovacamporall.com" class="ratio img-responsive img-circle" >See Complete List</a>
                     </router-link>
                  </div>
               </div>
            </div>
         </div>
         <!-- -->
      </div>
   </div>
   <!-- end chart details -->
   <br>
   <br>
   <!-- freshly pressed -->
   <div class="container-fluid">
      <h3>
         FRESHLY PRESSED
      </h3>
      <br>
      <br>
      <!-- Flickity HTML init -->
      <flickity ref="flickity" :options="flickityOptions">
         <div  class="carousel-cell box_text"  v-for="fres in fresh" :style="'background-image: url('+fres.image+'); background-size:cover; background-position:center; left: 73.57%'">
            <p>
               <span class="catgory">{{fres.category.name}}</span> <br>
               <router-link v-bind:to="{ name: 'blogpost', params: { id: fres.id, title: respace(fres.title) }}">{{fres.title}}</router-link>
            </p>
         </div>
      </flickity>
      <!-- if you don't want to use the buttons Flickity provides -->
   </div>
   <!-- -->
   <div class="row">
      <!-- advert -->
      <div class="col-md-12">
      </div>
      <!-- 3 grid for trending, rising and hot topics -->
      <div class="col-md-12">
         <div class="col-md-3">
            <br><br>
            <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Trending</h4>
            <br>
            <div class="panel panel-default shadowed">
               <div>
                  <br>
                  <!-- trending posts -->
                  <div class="row">
                   <a  v-if="sidebar_chart[0]" :href="sidebar_chart[0].url">
                    <adimage  :src="'/'+sidebar_chart[0].image_url" width="100%" height="100%"></adimage>
                  </a>
                     <div class="col-md-12 tr_content" v-for="trend in trending">
                        <div class="col-md-4">
                           <img :src="trend.image" width="100%" height="100%"/>
                        </div>
                        <div class="col-md-8">
                           <h4  class="category-tag"> {{trend.category.name}} <small class="time-stamp">{{timeago(trend.created_at)}}</small></h4>
                           <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: respace(trend.title) }}">
                              <h4>{{trend.title}}</h4>
                           </router-link>
                           <i style="color: blue;" class="ion-android-share" aria-hidden="true"></i>
                           <a href="#">7500 shares</a>
                        </div>
                     </div>
                  </div>
                  <!-- -->
               </div>
            </div>
         </div>
         <!-- rising -->
         <div class="col-md-6">
            <br><br>
            <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Rising</h4>
            <br>
            <div class="panel panel-default shadowed" v-for="newpost in newones">
               <div  class="rising" :style="'background-image: url('+newpost.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.3);'">
                  <router-link v-bind:to="{ name: 'blogpost', params: { id: newpost.id, title: respace(newpost.title) }}">
                     <h4 class="rising_head" style="color: white;">{{newpost.category.name}}</h4>
                     <h3 class="rising_topic" style="color: white;">{{newpost.title}}</h3>
                  </router-link>
                  <span style="color: white;" class="rising_share" >
                  <i  class="ion-android-share" aria-hidden="true"></i>
                  <a href="#" style="color: white;">7500 shares</a>
                  </span>
               </div>
            </div>
         </div>
         <!-- end rising -->
         <div class="col-md-3">
            <br><br>
            <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Hot</h4>
            <br>
            <div class="panel panel-default shadowed">
            <adimage  src="" width="100%" height="100%"></adimage>
               <div class="row" >
                  <br>
                  <div class="col-md-12 ht_content" v-for="(ho, x) in hot" v-if="x < 6">
                     <small style="color: grey;">Last activity: {{hottago(ho)}}</small>
                     <router-link :to="{ name: 'forum', params: { id: ho.id, name: respace(ho.topic) }}">
                        <h4>{{ho.topic}}</h4>
                     </router-link>
                     <small style="color:red;">
                     In this conversation 
                     </small>
                     <div id="convert">
                        <adimage src="/img/4671_1.png" width="100%" height="100%" sclass="conversation"></adimage>
                        <adimage src="/img/s.png" width="100%" height="100%" sclass="conversation2"></adimage>
                        <adimage src="/img/33.png" width="100%" height="100%" sclass="conversation2"></adimage>
                        <adimage src="/img/3e.png" width="100%" height="100%" sclass="conversation2"></adimage>
                        <span style="color: #007adf;">+ {{ho.comments.length-4}}</span>
                     </div>
                     <hr>
                  </div>
                    <a  v-if="sidebar_chart[1]" :href="sidebar_chart[1].url">
                    <adimage  :src="'/'+sidebar_chart[1].image_url" width="100%" height="100%"></adimage>
                  </a>
                  <a  v-if="sidebar_chart[2]" :href="sidebar_chart[2].url">
                    <adimage  :src="'/'+sidebar_chart[2].image_url" width="100%" height="100%"></adimage>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
   <br>
</div>
</template>
 
<script>
    import 'vue-toast/dist/vue-toast.min.css'
    import VueToast from 'vue-toast'
    import Flickity from 'vue-flickity';
    export default {
        name: 'landing',
        data: function (){
            return{
                trending: window.Laravel.trending,
                newones: window.Laravel.newones, 
                fresh: window.Laravel.fresh,
                hot:[],
                 flickityOptions: {
                initialIndex: 3,
                prevNextButtons: true,
                pageDots: false,
                wrapAround: true
                    // any options from Flickity can be used
                },
                schedule: [],
                podcasts: [],
                currentweek: this.week(),
                currentchartweek: this.week(),
                nigerianchart:[],
                globalchart:[],
                alternativechart:[],
                selectedcat:['nigerian','global','global'],
                currentchart: 0,
                play: 'play',
                all_chart_ever: []
            }
        },
        components:{Flickity},
        created() {
            var status = {
                title: 'CoolFmNigeria | Welcome to CoolFmNigeria, your #1 hit radio station',
                description: `Cool FM Lagos 96.9 is one of the most poopular radio station broadcasting from Lagos, Nigeria. This radio station is operating in English language and playing lots of popular music 24 hours both air and live online. Currently it is playing music genres like Top 40/Pop, Adult Contemporary etc. Cool fm lagos 96.9`
            }
            this.$store.dispatch('SET_SEO', status);
            this.schedules();
            
            this.getpodcasts();
            this.getcharts();
            this.gethots();
            
        },
        mounted: function(){
          var me = this.$toast(`
                    <a href="http://engine.adzerk.net/r?e=eyJhdiI6NDE0LCJhdCI6NCwiYnQiOjAsImNtIjo0NzE0OTMsImNoIjoxMTc4LCJjayI6e30sImNyIjoxNjM4OTg5LCJkaSI6IjM4YTViMTQ2Y2QxZDRhYWNhZGQ4YWNiMmU3MTg4NTdlIiwiZG0iOjEsImZjIjoxOTQzNDQxLCJmbCI6MjE0MjMxMiwiaXAiOiIxOTcuMjM0LjM1LjIiLCJrdyI6Imh0bWwsY3NzLGNzcy10cmFuc2l0aW9ucyxjc3MtYW5pbWF0aW9ucyxiYW5uZXIseC1wZXJzb25hLWZyb250ZW5kIiwibnciOjIyLCJwYyI6MCwiZWMiOjAsInByIjoxNjA0LCJydCI6MSwicmYiOiJodHRwczovL3d3dy5nb29nbGUuY29tLm5nLyIsInNiIjoiaS0wYjBjMzE5YTdmZjQ2OGZiYyIsInNwIjoxMzQ2LCJzdCI6ODI3NywidWsiOiJ1ZTEtYjVmMjA5Nzk0MjQ2NDQ1MWEzYTQ5ODg1MjNkNjE5YTkiLCJ6biI6NDQsInRzIjoxNDk0NTEwMTY5MTQ2LCJiZiI6dHJ1ZSwicG4iOiJhZHplcms4MzE0MjM2MjgiLCJ1ciI6Imh0dHA6Ly9zdGFja292ZXJmbG93LmNvbS9qb2JzP3V0bV9zb3VyY2U9d2Vic2l0ZSZ1dG1fbWVkaXVtPWJhbm5lciZ1dG1fY29udGVudD1sZWFkZXJib2FyZF84JnV0bV9jYW1wYWlnbj1ob3VzZV9hZHNfaG91c2VfYWRzX1JPU19TTyJ9&amp;s=DQvW8H00IjSFD6F3HmW1ks6DIWk" rel="nofollow" target="_blank" title=""><img src="http://static.adzerk.net/Advertisers/b08a4d7b01a04852b914e7904a73b1b8.png" title="" alt="" border="0" width="100%" height="90"></a>

                    `,{
                id:'tts',
                className: ['my-toast', 'toast-warning'],
                horizontalPosition: 'right',
                verticalPosition: 'right',
                duration: 10000,
                mode: 'queue',
                transition: 'fade'
                }
                )
                setInterval(()=>{ this.schedule = this.schedule; }, 1000);
        },
        methods: {
            timeago: function (time){
                return moment(time).fromNow();
            },
            week: function (){
                    var myDate = new Date();
                    if(myDate.getDay() == 6 || myDate.getDay() == 0 || myDate.getDay() == 5){
                        return moment().isoWeek()+1;
                    }
                    return moment().isoWeek();
                    
                },
            timeleft: function(value){
                value  = new moment(value+":00", "HH:mm:ss a");
                return moment(value).fromNow();
            },
            schedules: function(){
                 axios.get('/schedules')
                .then(response => {
                // JSON responses are automatically parsed.
                this.schedule = response.data;

                
                
                })
                .catch(e => {
                
                });
            },
            running: function(start, end){
                var format = 'hh:mm:ss'
                var start = new moment(start+":00", format);
                var end = new moment(end+":00", format);
                var timeline =  moment.duration(end.diff(start));
                return timeline.asHours();
            },
            between: function(start, end){


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
            getpodcasts: function(){
                axios.get('/allpodcasts')
                .then(response => {
                // JSON responses are automatically parsed.
                this.podcasts = response.data;
                
                })
                .catch(e => {
                
                });

            },
            nweekpod: function(){
                if(this.currentweek == this.week()){

                }else{
                    this.currentweek++;
                }
                
            },
            pweekpod: function(){
                if(this.currentweek == 1){

                }else{
                    this.currentweek--;
                }
            },
                nweekcht: function(){
                if(this.currentchartweek == this.week()){

                }else{
                    this.currentchartweek++;
                }
                
                },
            pweekcht: function(){
                if(this.currentchartweek == 1){

                }else{
                    this.currentchartweek--;
                }
            },
            getcharts: function(){

                axios.get('/charts')
                .then(response => {
                // JSON responses are automatically parsed.
                this.all_chart_ever = response.data;
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
            playthis: function(id, type, src, name){
                if(type=='podcast' && this.play=='pause'){
                    this.play='play';
                }else if(type=='livestream'){
                    this.play = (this.play=='pause')?'play':'pause';
                }
                this.$parent.$options.methods.playthis(id, type, src, name);
            },
             respace: function(str){
              return str.replace(/ /g,"_");
            },
            stringify: function(arr){
                return JSON.stringify(arr);
            }, 
            change_chart: function(id){
                var ch = ['global','global','global'];
                ch[id]='nigerian';
                this.selectedcat = ch;
                this.currentchart = id;

            },
            noofchart: function(id){
                var arr_to_check = this.all_chart_ever;
                var count = 0;
                for (var i=0; i < arr_to_check.length; i++){
                    if(arr_to_check[i].song==id){
                        count++;
                    }
                }
                return count;
            },
            lastweek: function(id){
                var arr_to_check = this.all_chart[this.currentchart][this.currentchartweek-1];
                if(arr_to_check != undefined){
                    for (var i=0; i < arr_to_check.length; i++){
                        if(arr_to_check[i].song==id){
                        return arr_to_check[i].position;
                        }
                    }
                }
                
                return 0;
            }, 
            gethots: function(){
                axios.get('/hotforum')
                .then(response => {

                        var list=response.data;
                        list = list.sort(function (a, b) {
                            return a.comments.length - a.comments.length;
                        });
                        this.hot=list;
                
                    })
                    .catch(e => {
                    
                    });
            },
            hottago: function(obj){
                
            
                if(obj.comments != undefined && obj.comments.length != 0){
                    var last = obj.comments[obj.comments.length-1];
                    return this.timeago(last.updated_at); 
                }
                return "No activity yet";
                
            }
      },
      computed: {
          formated_schedules: function (){
              var form_sche = [];
              var schedule_arry = this.schedule;
                var array_s = schedule_arry.sort(function(a,b){
                    return a.start > b.start; 
                });
                array_s = array_s.filter(function(num){
                        var format = 'hh:mm:ss'
                        var time = moment();
                        var beforeTime = moment(num.start, format);
                        var afterTime = moment(num.end, format);
                        if (time.isBetween(beforeTime, afterTime)) {
                            return num
                        }
                        
                        if(beforeTime.isAfter(time)){
                            return num
                        }
                })
                return array_s.slice(0, 4);
            
          },
          now_playing: function(){
              for(var i =0; i < this.schedule.length; i++){
                  var schedu = this.schedule[i];
                  if(this.between(schedu.start, schedu.end)=="Now"){
                      return schedu
                  }
              }
          },
          rearrange_podcasts: function(){
              var grouped = _.groupBy(this.podcasts, function(car) {
                                return car.week;
                                });
                return grouped
          },
          all_chart: function(){
              var arr = {
                  0: this.nigerianchart,
                  1: this.globalchart,
                  2: this.alternativechart
              }
              
             
              return arr;
          },
          homepage_chart: function(){
            var homeads = _.map(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_main") return o;
            });
            return homeads;
          },
          sidebar_chart: function(){
            var homeads = _.map(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_side") return o;
            });
            return homeads;
          }
      }
    }
</script>
<style>
#live-play {
   margin-top: 22em;
   color: #fff;
   text-shadow: 1px 2px 15px #000;
}
.box_text{
    box-shadow: inset 0 0 0 1000px rgba(0,0,0,.13);
}
.carousel-cell{
    width: 33.36% !important;
}
.carousel-cell p {
   font-size: 2em;
   line-height: 1.1;
   width: auto !important;
   padding: 1em;
   margin-top: 1.9em;
   color: #fff !important;
}
</style>

