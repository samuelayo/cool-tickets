<template>
<div id="landing">
   <div class="col-md-12">
      <a  v-if="homepage_chart[0]" :href="homepage_chart[0].url">
         <adimage  :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></adimage>
      </a>
   </div>
   <!-- Header -->
   
   <!-- /.intro-header -->
   <!-- Page Content -->
   <!-- podcast details -->
   <div class="container-fluid" v-if="rearrange_podcasts[currentweek]">
      <div class="row">
         <div style="margin-left: 1em;" class="col-md-12" >
            <h3>
               PODCASTS
               &nbsp;
               &nbsp;
               <span style="color:#B2BEB5; display: none;">
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
                  <br>
                  <div   class="col-sm-3" v-for="(pod, index) in rearrange_podcasts[currentweek]" v-if="index <= 3">
                     <!-- <a  href="javascript:void(0)" class="ratio img-responsive" :style="'background-image: url('+pod.image+'); box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 0px 1000px inset;'"></a> 
                     <span class="badge badge-play" style="left: 0px !important;"><small><a href="javascript:void(0)" @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play" ></span></a></small>  </span>     
                     <span>
                        <small><a style="color: #4facfe;" href=""> {{pod.title}} </a> </small>
                        <center><small><a href="#">{{pod.part}}</a></small></center>
                     </span> -->



                    <a href="javascript:void(0)" class="ratio img-responsive" :style="'background-image: url('+pod.image+'); box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 0px 1000px inset;'"></a> <span class="badge badge-play"><small><a href="javascript:void(0)"  @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play"></span></a></small></span> <span> <p style="
    font-size: 1.1em;
    background: #ececec;
   
    padding: 1em;
    line-height: 1.2;
    font-family: Garamond;
"><small><a href="" style="color: rgb(0, 0, 0);">
        
            
            {{pod.title}}
            
        
        </a></small></p> <center><small><a href="#">{{pod.part}}</a></small></center></span>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <br>
                  <div   class="col-sm-3" v-for="(pod, index) in rearrange_podcasts[currentweek]" v-if="(index >3 && index <= 6)">
                     <!-- <a  href="javascript:void(0)" class="ratio img-responsive" :style="'background-image: url('+pod.image+'); box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 0px 1000px inset;'"></a> 
                     <span class="badge badge-play" style="left: 0px !important;"><small><a href="javascript:void(0)" @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play" ></span></a></small>  </span>     
                     <span>
                        <small><a style="color: #4facfe;" href=""> {{pod.title}} </a> </small>
                        <center><small><a href="#">{{pod.part}}</a></small></center>
                     </span> -->



                    <a href="javascript:void(0)" class="ratio img-responsive" :style="'background-image: url('+pod.image+'); box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 0px 1000px inset;'"></a> <span class="badge badge-play"><small><a href="javascript:void(0)"  @click="playthis(pod.id, 'podcast', pod.path, pod.title)"><span class="ion-ios-play"></span></a></small></span> <span> <p style="
    font-size: 1.1em;
    background: #ececec;

    padding: 1em;
    line-height: 1.2;
    font-family: Garamond;
"><small><a href="" style="color: rgb(0, 0, 0);">
        
            
            {{pod.title}}
            
        
        </a></small></p> <center><small><a href="#">{{pod.part}}</a></small></center></span>
                  </div>
               </div>
            </div>
         </div>
         <!-- -->
      </div>
   </div>
 
   <!-- end chart details -->
   <router-link :to="{ name: 'all_podcasts', params: { week: currentweek}}">
      <!-- <p style="text-align: center;" v-if="rearrange_podcasts[currentweek]"><span style="border-bottom: 1px solid #ddd;
         vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> <a href=""><span style="color: #666; text-align: center;  font-style: italic; padding: 1em;     vertical-align: -webkit-baseline-middle;"> Show more</span></a>  <span style="border-bottom: 1px solid #ddd;
         vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> </p>
 -->
         <div v-if="rearrange_podcasts[currentweek]" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
  <span style="font-size: 40px; background-color: #F3F5F6; padding: 0 10px;">
    Show more <!--Padding is optional-->
  </span>
</div>
   </router-link>

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

   <span v-if="!all_chart[currentchart][currentchartweek]">
   <br>
   </span>
  
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

<!-- side -->

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
                sv: "data:image/svg+xml,%3Csvg width=40 height=40 viewBox=0 0 40 40 xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23363636' fill-opacity='0.4' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E",
                 flickityOptions: {
                initialIndex: 0,
                prevNextButtons: true,
                pageDots: false,
                wrapAround: true
                    // any options from Flickity can be used
                },
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

