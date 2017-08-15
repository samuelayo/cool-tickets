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



                  <div class="row clearmargin clearpadding row-image-txt" style="height:178px; width: 98%; margin: 0 auto;" v-if="now_playing">
        <div v-if="now_playing" class="col-xs-12 col-sm-6 col-md-6 clearmargin clearpadding col-sm-push-6" :style="'background: url('+now_playing.image+');background-size:100%;height:242px;background-position:center;width:50%;'">
            <div></div>
            <p style="margin-top:.5EM;margin-left:.3em;font-family:'Circular-medium';width:100%;text-shadow:-1px -1px 25px rgb(1,1,1);padding:1em; color: white;">Live from {{current_state}}</p>
            <div style="cursor:pointer;display:-ms-inline-flexbox;display:inline-flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:center;height:3em;width:9em;border-radius:40px;font-size:1.09em;color:#fff;margin-top:7em;margin-left:1em;text-align:center;background-color:rgba(5,5,6,0.35);"><i :class="'ion-ios-'+play+''" @click="playthis(0,'livestream', 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos', now_playing.title);" style="padding-left:1em;"></i>
                <p style="margin-top:.5EM;margin-left:.3em;font-family:'Circular-medium';">Listen Live</p>
                <p class="help-block"> </p>
            </div>
           
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-sm-pull-6" style="/*padding:20px;*/margin-bottom:0;height:242px;width:50%;background:#000;">
            <h1 v-if="now_playing" style="font-size:1em;text-align:center; color: white; font-family: Circular-black;">{{now_playing.title}}<span style="opacity:.4;float:right;padding-right:1em;"> Ending {{timeleft(now_playing.end)}}</span> <span style="opacity:1;float:left;color:red;margin-right:1em;">Now </span></h1>
            <hr style="opacity:.2;">
            <h1 v-for="(schedule, index) in formated_schedules" v-if="(between(schedule.start, schedule.end)=='Later')" style="font-size:1em;text-align:center;font-family: Circular-black;color: white;"><span style="opacity:.4;float:right;padding-right:1em;">{{schedule.start}} - {{schedule.end}}</span><span style="opacity:1;float:left;color:rgb(137,136,136);margin-right:1em;">{{between(schedule.start, schedule.end)}} </span>{{schedule.title}}</h1>
            </div>
    </div>
    <div></div>
<center v-if="!now_playing">Loading...</center>

               </div>



            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.intro-header -->
   <!-- Page Content -->
   <!-- podcast details -->
   <div class="container-fluid" v-if="rearrange_podcasts[currentweek]">
      <div class="row">
         <br><br><br>
         <div style="margin-left: 1em;" class="col-md-12" >
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
         <adimage  :src="'/'+homepage_chart[1].image_url" width="100%" height="100%" style="padding: 1em;"></adimage>
      </a>
   </div>
   <br>
   <!-- chart details -->
   <div class="container-fluid"  v-if="all_chart[currentchart][currentchartweek]">
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
         <div class="col-md-12 chartsall">
            <div class="col-md-6">
               <div class="row">
                  <br><br>
                  <div  class="col-sm-3" v-for="(chart, index) in all_chart[currentchart][currentchartweek]" v-if="index <= 3" :id="'sa_'+index">
                     <p class="chart-num"><strong> {{chart.position}} </strong></p>
                     <a  class="ratio img-responsive img-circle" :style="'background-image: url('+chart.songs.image+');'"></a>
                     <span class="badge badge-notify"><small>{{noofchart(chart.song)}}</small></span>
                     <span class="badge badge-new" v-if="noofchart(chart.song)==1"><small> <strong> New </strong> </small></span>
                     <span class="badge badge-lw" ><small> <strong> {{lastweek(chart.song)}} </strong> </small></span>
                     <span>
                        <center><small>{{chart.songs.song_title}}</small></center>
                        <center><small><a href="#">{{chart.songs.artistname}}</a></small></center>
                     </span>
                     {{fadein('sa_'+index)}}
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <br><br>
                  <div  class="col-sm-3" v-for="(chart, index) in all_chart[currentchart][currentchartweek]" v-if="(index > 3 && index <=6)" :id="'sa2_'+index">
                     <p class="chart-num"><strong> {{chart.position}} </strong></p>
                     <a  class="ratio img-responsive img-circle" :style="'background-image: url('+chart.songs.image+');'"></a>
                     <span class="badge badge-notify"><small>{{noofchart(chart.song)}}</small></span>
                     <span class="badge badge-new" v-if="noofchart(chart.song)==1"><small> <strong> New </strong> </small></span>
                     <span class="badge badge-lw" ><small> <strong> {{lastweek(chart.song)}} </strong> </small></span>
                     <span>
                        <center><small>{{chart.songs.song_title}}</small></center>
                        <center><small><a href="#">{{chart.songs.artistname}}</a></small></center>
                     </span>
                     {{fadein('sa2_'+index)}}
                  </div>
                  <br><br>
                  <div  class="col-sm-3" >
                     <router-link v-bind:to="{ name: 'chartcurrated', params: {currentchartweek: currentchartweek }}">
                        <a id="see-all" href="#" class="ratio img-responsive img-circle" >See Complete List</a>
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
   <span v-if="!all_chart[currentchart][currentchartweek]">
   <br>
   </span>
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
               <span class="catgory"><router-link :to="{ name: 'blogcategory', params: { id: fres.category.id, name:fres.category.name }}">{{fres.category.name}}</router-link></span> <br>
               <router-link v-bind:to="{ name: 'blogpost', params: { id: fres.id, title: respace(fres.title) }}" style="font-family: 'Circular-Black; font-size: 1.0em;'">{{fres.title}}</router-link>
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
                <a  v-if="sidebar_chart_2[0]" :href="sidebar_chart_2[0].url" >
                    <adimage  :src="'/'+sidebar_chart_2[0].image_url" width="100%" height="100%" isd="0" style="padding: 1em;"></adimage>
                  </a>
                  <br>
                  <br>
                  <!-- trending posts -->
                  <div class="row">
                  
                     <div class="col-md-12 tr_content" v-for="trend in trending">
                        <div class="col-md-4">
                           <img :src="trend.image" width="100%" height="100%"/>
                        </div>
                        <div class="col-md-8">
                           <h4  class="category-tag" style="margin-top: 1em;"> <span id="tag-cat"><router-link :to="{ name: 'blogcategory', params: { id: trend.category.id, name:trend.category.name }}">{{trend.category.name}}</router-link></span> </h4>
                           <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: respace(trend.title) }}" style="margin-top: 1em;">
                              <h4>{{trend.title}}</h4>
                           </router-link>
                           <i style="color: blue;" class="ion-android-open" aria-hidden="true"></i>
                           <a href="#">{{trend.view_count | money }} shares</a>
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
                     <h4 class="rising_head" style="color: white;"><router-link :to="{ name: 'blogcategory', params: { id: newpost.category.id, name:newpost.category.name }}">{{newpost.category.name}}</router-link></h4>
                     <h3 class="rising_topic" style="color: white;">{{newpost.title}}</h3>
                  </router-link>
                  <span class="rising_share" style="color: white;"><i aria-hidden="true" class="ion-android-open" style="font-size:1.57em;vertical-align:middle;"></i> <a href="#" style="color: white;">{{newpost.view_count | money }} shares</a></span>
               </div>
            </div>
         </div>
         <!-- end rising -->
         <div class="col-md-3">
            <br><br>
            <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;"></h4>
            <br>
            <br>
            <div class="panel panel-default shadowed">
               <div class="row" >
                  
                 <!--  <div class="col-md-12 ht_content" v-for="(ho, x) in hot" v-if="x < 6">
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
                  </div> -->
                    <a  v-if="sidebar_chart[0]" :href="sidebar_chart[0].url" >
                     <adimage :src="'/'+sidebar_chart[0].image_url" width="100%" height="100%" isd="1" style="padding: 1em;"></adimage>
                  </a>
                   <br>
                   <br>
                  <a  v-if="sidebar_chart_2[1]" :href="sidebar_chart_2[1].url" >
                    <adimage  :src="'/'+sidebar_chart_2[1].image_url" width="100%" height="100%" isd="2" style="padding: 1em;"></adimage>
                  </a>
                  <br>
                  <br>
<!-- sidebar ad -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4448078976745099"
                    data-ad-slot="5545697316"
                    data-ad-format="auto"></ins>

               </div>
            </div>
         </div>
      </div>
   </div>
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
                initialIndex: 0,
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
            timeago: function (time){
                return moment(time).fromNow();
            },
            week: function (){
                    // var myDate = new Date();
                    // if(myDate.getDay() == 6 || myDate.getDay() == 0 || myDate.getDay() == 5){
                    //     return moment().isoWeek()+1;
                    // }
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
                 this.schedule = _.groupBy(response.data, function(car) {
                                return car.state;
                                });
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

                return 'NOW';
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
                
            },
            fadein: function(id){
                    var tim = Math.floor(Math.random() * 5000) + 1500;
                    $('#'+id).fadeOut(0).fadeIn(tim);
            }
      },
      computed: {
          formated_schedules: function (){
              var form_sche = [];
               var schedule_arry = this.schedule[this.current_state];
               var array_s = [];
               var myDate = new Date();
               if(schedule_arry){
                   if(myDate.getDay() == 6){
                       //saturday
                       //filter by saturday
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period == "saturday";
                            });
                        array_s = schedule_arry.sort(function(a,b){
                            return a.start > b.start; 
                        });
                    }else if(myDate.getDay() == 0 ){
                        //sunday
                        //filter by sunday
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period == "sunday";
                            });
                         array_s = schedule_arry.sort(function(a,b){
                            return a.start > b.start; 
                        });
                    }else{
                        //otherdays
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period != "sunday" && sch.period != "saturday";
                            });
                       
                        array_s = schedule_arry.sort(function(a,b){
                            return a.start > b.start; 
                        });
                    }
                    
               }
                
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
              if(this.schedule[this.current_state]){
                var myDate = new Date();
                 var schedule_arry = this.schedule[this.current_state];
                if(myDate.getDay() == 6){
                       //saturday
                       //filter by saturday
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period == "saturday";
                            });
                      
                    }else if(myDate.getDay() == 0 ){
                        //sunday
                        //filter by sunday
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period == "sunday";
                            });
                         
                    }else{
                        //otherdays
                        schedule_arry = _.filter(schedule_arry, (sch) => {
                                return sch.period != "sunday" && sch.period != "saturday";
                            });
                    }
                for(var i =0; i < schedule_arry.length; i++){
                    var schedu = schedule_arry[i];
                    if(this.between(schedu.start, schedu.end)=="NOW"){
                        return schedu
                    }
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
          },
          sidebar_chart_2: function(){
            var homeads = _.filter(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_side_2") return o;
            });
            return homeads;
          },
          current_state: function(){
              return this.$store.state.current_state;
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
   margin-top: 1.4em;
   color: #fff !important;
}
</style>

