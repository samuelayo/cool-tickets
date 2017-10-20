<template>
  <div id="app">
    <title>{{title}}</title>
    <meta name="description" :content="description" />
    <meta name="robots" content="nodp" />
    <meta name="author" content="ogundipe samuel">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" :content="title" />
    <meta property="og:description" :content="description" />
    <meta property="og:url" content="/" />
    <meta property="og:site_name" content="Coolfm" />
    <meta property="og:image" content="/img/logo.svg" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:site" content="@coolfmnigeria" />
    <meta name="twitter:image" :content="twitterimage" />
    <!--<div class="container-fluid topnav" style="
                        height: 40px !important;
                        background-color: blue !important; border-bottom: none !important;
    width: auto !important; box-shadow: inset 0 0 0 1000px rgba(0, 79, 253, 0.4); ;
                                                               ">
      <p style="text-align:center;
                        width: 100%;
                        padding: 1em;
                        font-size: 1.5em; color:#fff;
                        font-family: 'Circular-light';
                              ">All your favorite events, All the time.
        <router-link to="/events"><button style="
                        border-radius: 40px;
                        border: 1px solid blue;
                        background: rgba(240, 248, 255, 0.97);
                        /* -webkit-box-shadow: 10px 10px 139px -32px rgba(0,0,0,0.75); */
                        -moz-box-shadow: 10px 10px 139px -32px rgba(0,0,0,0.75);
                        /* box-shadow: 10px 10px 139px -32px rgba(0,0,0,0.75); */
                        border: 1px solid blue;
                        color: blue;
                        height: 36px;
                        font-size: .7em !important;
                        width: 149px;
                        margin-left: 2em;
                        font-family: 'Circular-Book';
                        vertical-align: middle;
                    "><img src="/img/logo.svg" width="150" alt="Cool Fm"></button></router-link>
      </p>
    </div> -->
  
  
  <!--  <div class="intro-header">
      <div id="fb-streaming-row">
        <div class="row">
          <div class="col-lg-12">
  
  
            <div class="container-fluid">
              <div class="row clearmargin clearpadding row-image-txt" style="height:178px; width: auto;" v-if="now_playing">
                <div v-if="now_playing" class="col-xs-12 col-sm-6 col-md-6 clearmargin clearpadding col-sm-push-6" :style="'background: url('+now_playing.image+');background-size:100%;height:242px;background-position:center;width:50%;'">
                  <div></div>
                  <p style="margin-top:.5EM;margin-left:.3em;font-family:'Circular-medium';width:100%;text-shadow:-1px -1px 25px rgb(1,1,1);padding:1em; color: white;"><i class="ion-location"></i>&nbsp Live from {{current_state}}</p>
                  <div style="cursor:pointer;display:-ms-inline-flexbox;display:inline-flex;-ms-flex-align:center;align-items:center;-ms-flex-pack:center;height:3em;width:9em;border-radius:40px;font-size:1.09em;color:#fff;margin-top:7em;margin-left:1em;text-align:center;background-color:red;"><span style="padding-left: 1.2em;
        padding-top: 0.2em;
        border: 1px solid;
        margin: 0.6em;
        margin-right: 0.4em;
        width: 27px;
        border-radius: 50%;"><i :class="'ion-ios-'+play+''" @click="playthat(0,'livestream', 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos', now_playing.title);" style="margin-left: -1em;"></i></span>
                    <p style="margin-top:.8EM;margin-left:.3em;font-family:'Circular-medium';padding-top: 0.2em;">Listen Live</p>
                    <p class="help-block"> </p>
                  </div>
  
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-sm-pull-6 panning" style='margin-bottom:0;height:242px;width:50%;
            background-color: rgb(21, 21, 21);
    background-image: url("/diagonal-stripes 2.svg");
    animation: panning 50s infinite linear;
            '>
                  <h1 v-if="now_playing" style="font-size:1em;text-align:center; color: white; font-family: Circular-black;">{{now_playing.title}}<span style="opacity:.4;float:right;padding-right:1em;"> Ending {{timeleft(now_playing.end)}}</span> <span style="opacity:1;float:left;color:red;margin-right:1em;"><span class="pulse"></span> Now </span>
                  </h1>
                  <hr style="opacity:.2;">
                  <div v-for="(schedule, index) in formated_schedules" v-if="(between(schedule.start, schedule.end)=='Later')">
                  <h1 style="font-size:1em;text-align:center;font-family: Circular-black;color: white;"><span style="opacity:.4;float:right;padding-right:1em;">{{schedule.start}} - {{schedule.end}}</span><span style="opacity:1;float:left;color:rgb(137,136,136);margin-right:1em;"><i class="ion-ios-time"></i>&nbsp {{between(schedule.start, schedule.end)}} </span>{{schedule.title}}</h1>
                  <hr style="opacity:.2;">
                  </div>

                  <div v-for="(schedule, index) in formated_schedules" v-if="(between(schedule.start, schedule.end)=='Ended')">
                  <h1 style="font-size:1em;text-align:center;font-family: Circular-black;color: white;"><span style="opacity:.4;float:right;padding-right:1em;">{{schedule.start}} - {{schedule.end}}</span><span style="opacity:1;float:left;color:rgb(137,136,136);margin-right:1em;"><i class="ion-android-remove-circle"></i>&nbsp {{between(schedule.start, schedule.end)}} </span>{{schedule.title}}</h1>
                  <hr style="opacity:.2;">
                  </div>
                </div>
              </div>
              <div></div>
              <center v-if="!now_playing">Loading...</center>
  
            </div>
  
  
  
          </div>
        </div>
      </div>
       
    </div>-->
  
  
  
    <nav class="navbar topnav navbar-default" role="navigation">
      <div class="container-fluid topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header htop">
          <div class="navbar-brand topnav">
            <a>
              <router-link to="/">
                <img src="/img/logo.svg" width="150" alt="Cool Fm">
              </router-link>
            </a>
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
          </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
     <!--   <div class="collapse navbar-collapse htop" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            
            <li style="padding: 0px;padding-top: 0px !important;padding-left: 0px !important;padding-right: 0px !important;">
              <gcse:search></gcse:search>
            </li>
            <li>
              <a data-toggle="dropdown">Categories
                                                  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li v-for="cat in categories">
                  <router-link :to="{ name: 'blogcategory', params: { id: cat.id, name:cat.name }}">{{cat.name}}</router-link>
                </li>
              </ul>
            </li>
            <li>
              <router-link to="/all_oaps">OAPs</router-link>
            </li>
            <li>
              <a data-toggle="dropdown">Company
                                                  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li>
                  <router-link to="/aboutus">About Us</router-link>
                </li>
                <li>
                  <router-link to="/contact-us">Contact Us</router-link>
                </li>
              </ul>
            </li>
            <li style="margin-right: -1.1em;">
              <a class="switch" data-toggle="dropdown">Switch Channel
                                                  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="javascript:void()" @click="change_state('Lagos', 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos')">Coolfm Lagos</a></li>
                <li><a href="javascript:void()" @click="change_state('Kano', 'http://icestream.coolwazobiainfo.com:8000/coolfm-kano')">Coolfm Kano</a></li>
                <li><a href="javascript:void()" @click="change_state('Abuja', 'http://icestream.coolwazobiainfo.com:8000/coolfm-abuja')">Coolfm Abuja</a></li>
                <li><a href="javascript:void()" @click="change_state('Ph', 'http://icestream.coolwazobiainfo.com:8000/coolfm-ph')">Coolfm PH</a></li>
              </ul>
            </li>
          </ul>
        </div> -->
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!-- the router outlet, where all matched components would ber viewed -->
    <center>
      <!-- homepage ad -->
<!-- homepage ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4448078976745099"
     data-ad-slot="5185770514"
     data-ad-format="auto"></ins>

    </center>
    <br>
    <transition>
      <router-view></router-view>
    </transition>
    <div class="row product" style="width: 92%;border-radius: 30px;margin: 2em auto 7em;border: none;padding: 0; box-shadow: none !important;">
      <div class="col-md-5 col-md-offset-0" style="
                  padding-left: 0;
                  box-shadow: none !important;
              "><img src="https://i.imgur.com/nCbmJox.png" style="width: 100%;border-radius: 40px;border-right: 15px solid #f9f9f9;/* -webkit-box-shadow: 10px 10px 101px -28px rgba(0, 0, 0, 0.37); */-moz-box-shadow: 10px 10px 101px -28px rgba(0, 0, 0, 0.37);/* box-shadow: 10px 10px 101px -28px rgba(0, 0, 0, 0.37); */height: auto;"></div>
      <div id="newsletter" class="col-md-7" style="border-radius: 14px;margin-left: -1em;">
        <h2 style="font-size: 2em;width: 95%;color: rgb(0, 0, 0);margin-left: .5em;margin-top: 1em;font-family: 'Circular-book';"> Get the latest news &amp; giveaways straight to your inbox. Join our teeming community of fans .</h2>
        <div class="swiper-slide" style="background-image: url(&quot;https://placeholdit.imgix.net/~text?txtsize=68&amp;txt=Slideshow+Image&amp;w=1920&amp;h=500&quot;);"></div>
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <div id="mc_embed_signup">
          <form action="//coolfm.us16.list-manage.com/subscribe/post?u=11b9dec20b5f95351d12ef4ff&amp;id=22862615ab" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
  
              <div class="mc-field-group">
                <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
            </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter your email">
              </div>
              <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
              </div>
              <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_11b9dec20b5f95351d12ef4ff_22862615ab" tabindex="-1" value=""></div>
              <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <br>
    <br>
   
    
  </div>
</template>

<script>
  export default {
    name: 'app',
    data: () => {
      return {
        type: '',
        src: '',
        play: 'play',
        player: '',
        schedule: [],
        categories: Laravel.categories
      }
    },
    created: function() {
      //this.schedules();
    },
    mounted: function() {

      
      // setInterval(()=>{ 
      //   var sch = this.schedule;
      //   this.schedule = [];
      //   this.schedule = sch;
      //  }, 3000);
      /// loadscript function that returns promise and resolves to confirm a scrip has been loaded///
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
      ///mailchimp
      loadScript("//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js").then(function() {
        (function($) {
          window.fnames = new Array();
          window.ftypes = new Array();
          fnames[0] = 'EMAIL';
          ftypes[0] = 'email';
          fnames[1] = 'FNAME';
          ftypes[1] = 'text';
          fnames[2] = 'LNAME';
          ftypes[2] = 'text';
          fnames[3] = 'BIRTHDAY';
          ftypes[3] = 'birthday';
        }(jQuery));
        var $mcj = jQuery.noConflict(true);
      });
      //
      ///
      (function() {
        var cx = '004277073545021023643:yuy8iwmq_ky';
        var gcse = document.createElement('script');
        gcse.type = 'text/javascript';
        gcse.async = true;
        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(gcse, s);
      })();
      this.player = plyr.setup();
    },
    computed: {
      playorpause: function() {
        if (this.$refs.ourplay != undefined) {
          var audio = this.$refs.ourplay;
          if (audio.paused) {
            return 'play';
          }
          return 'paused';
        }
        return 'play';
      }
    },
    methods: {
      playthis: (id, type, src, name) => {
        if (type == "livestream") {
          document.getElementById('live').style.display = 'inline-block';
        } else {
          document.getElementById('live').style.display = 'none';
        }
        var audio = document.getElementById('ourplay');
        if (this.type == "livestream") {} else if (this.type == "podcast") {}
        audio.src = src;
        this.src = src;
        this.type = type;
        audio.play();
        if (this.type == type && this.play == 'play') {
          this.play = 'pause';
          audio.pause();
        } else if (this.type == type && this.play != 'play') {
          this.play = 'play';
          audio.play();
        }
        document.getElementById('playname').innerHTML = name;
      },
      playthat: function(id, type, src, name){
                if(type=='podcast' && this.play=='pause'){
                    this.play='play';
                }else if(type=='livestream'){
                    this.play = (this.play=='pause')?'play':'pause';
                }
                this.playthis(id, type, src, name);
            },
      change_state: function(status, stream) {
        this.$store.dispatch('SET_STATE', status);
        this.$store.dispatch('SET_STREAM', stream);
      },
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
      between: function(start, end) {
  
  
        var format = 'hh:mm:ss'
  
        // var time = moment() gives you current time. no format required.
        var time = moment(),
          beforeTime = moment(start, format),
          afterTime = moment(end, format);
  
        if (time.isBetween(beforeTime, afterTime)) {
  
          return 'NOW';
        } else if(beforeTime.isAfter(time)) {
  
          return 'Later';
  
        }else{
          return 'Ended';
        }
      },
       timeleft: function(value){
                value  = new moment(value+":00", "HH:mm:ss a");
                return moment(value).fromNow();
            }
  
    },
    computed: {
      title: function() {
        return this.$store.state.title;
      },
      description: function() {
        return this.$store.state.description;
      },
      twitterimage: function() {
        return this.$store.state.twitterimage;
      },
      current_stream: function() {
        if (this.$refs.ourplay != undefined) {
          var audio = this.$refs.ourplay;
          audio.src = this.$store.state.current_stream;
          audio.play();
        }
        return this.$store.state.current_stream;
      },
      formated_schedules: function() {
        //set array to hold before items
        var form_sche = [];
        //set array t hold after items
        var after_sche = [];
        //set schedule to current schedule
        var schedule_arry = this.schedule[this.current_state];
        //array_s is am empty array to hold the final value
        var array_s = [];
        var myDate = new Date();
        if (schedule_arry) {
          if (myDate.getDay() == 6) {
            //saturday
            //filter by saturday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "saturday";
            });
            array_s = schedule_arry.sort(function(a, b) {
              return a.start > b.start;
            });
          } else if (myDate.getDay() == 0) {
            //sunday
            //filter by sunday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "sunday";
            });
            array_s = schedule_arry.sort(function(a, b) {
              return a.start > b.start;
            });
          } else {
            //otherdays
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period != "sunday" && sch.period != "saturday";
            });
  
            array_s = schedule_arry.sort(function(a, b) {
              return a.start > b.start;
            });
          }
  
        }
  
        array_s = array_s.filter(function(num) {
          var format = 'hh:mm:ss'
          var time = moment();
          var beforeTime = moment(num.start, format);
          var afterTime = moment(num.end, format);
          if (time.isBetween(beforeTime, afterTime)) {
            //return num
            form_sche.push(num);
          }
  
          if (beforeTime.isAfter(time)) {
              form_sche.push(num);
          }

          if (afterTime.isBefore(time)) {
              after_sche.push(num);
          }
        })
        //return array_s.slice(0, 4);

        return form_sche.concat(after_sche.reverse()).slice(0, 4);
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
            if (this.between(schedu.start, schedu.end) == "NOW") {
              return schedu
            }
          }
        }
      },
      current_state: function() {
        return this.$store.state.current_state;
      }
    }
  }
</script>

<!-- styling for the component -->
<style>
  #timeline {
    width: 700px;
    height: 1px;
    background: #4200f7;
    margin-top: 2%;
    float: left;
  }
  
  #playhead {
    width: 7px;
    height: 1px;
    background: rgba(0, 255, 196, 0.82);
  }
  
  audio::-webkit-media-controls-enclosure,
  video::-webkit-media-controls-enclosure {
    max-width: 100%;
  }
  
  
  /**.cse .gsc-control-cse, .gsc-control-cse{
                        padding: 0 0 0 0 !important;
                        margin: -1em !important;
                      }**/
  
  .cse .gsc-control-cse,
  .gsc-control-cse {
    font-family: Arial, serif !important;
    background-color: none !important;
    border: none !important;
  }
  
  .gsc-control-cse {
    font-family: Arial, sans-serif !important;
    border-color: none !important;
    background-color: none !important;
  }
  
  input#gsc-i-id1 {
    outline: none;
    background: none !important;
    text-indent: 0px !important;
    font-family: 'circular-medium' !important;
  }
  
  input.gsc-input {
    border-color: none !important;
  }
  
  input.gsc-search-button {
    background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%) !important;
    border: none !important;
    color: #fff !important;
    width: 86px !important;
    height: 31px !important;
    border-radius: 26px !important;
  }
  
  .cse input.gsc-input,
  input.gsc-input {
    font-family: inherit !important;
    font-size: 16px !important;
    border: none !important;
    border-bottom: 1px dashed #ddd !important;
    padding: 4px 6px !important;
    -moz-border-radius: 2px !important;
    -webkit-border-radius: 2px !important;
    border-radius: 2px !important;
  }
  
  .toast-success {
    background-color: #117af2 !important;
  }
  
  #toast-container>.toast-success {
    background-image: none !important;
  }
  
  #toast-container>div {
    position: relative;
    pointer-events: auto;
    overflow: hidden;
    margin: 0 0 6px;
    padding: 15px 15px 15px 10px !important;
    width: 300px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background-position: 15px center;
    background-repeat: no-repeat;
    -moz-box-shadow: 0 0 12px #999;
    -webkit-box-shadow: 0 0 12px #999;
    box-shadow: 0 0 12px #999;
    color: #fff;
    opacity: .8;
    -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
    filter: alpha(opacity=80);
  }
  
  div#___gcse_0 {
    width: 90% !important;
    margin: 0 auto !important;
  }
  
  .cse .gsc-control-cse,
  .gsc-control-cse {
    padding: 0px !important;
    width: auto;
  }
  
  td.gsc-clear-button {
    width: 14px !important;
    display: none !important;
  }
  
  #mc_embed_signup {
    background: none;
    clear: left;
    font: 14px Helvetica, Arial, sans-serif;
  }
  
  #newsletter {
    -webkit-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
    -moz-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
    box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
    font-family: 'Circular-bold' !important;
  }
  
  div#newsletter .button {
    border-radius: 40px;
    background-image: linear-gradient(to right, #43e97b 0%, #38f9d7 100%) !important;
    height: 49px;
    font-size: 1.3em;
    color: #fff;
    font-family: 'circular-book';
    width: 177px;
  }
  
  div#newsletter input {
    -webkit-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
    -moz-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
    box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
    background: #fff !important;
    border: 1px solid #ddd;
    border-radius: 100px;
    height: 3.5em;
  }
  
  div#newsletter input {
    font-family: 'Circular-Book';
    color: #000;
    font-size: 1.1em;
    outline: none;
  }
  
  div#newsletter label {
    font-family: 'Circular-bold' !important;
  }
  
  #newsletter:before {
    content: '';
    position: absolute;
    top: 71%;
    right: 100%;
    margin-top: -8px;
    width: 0;
    height: 0;
    border-right: 25px solid #fff;
    border-top: 1px solid transparent;
    border-bottom: 40px solid transparent;
  }
  
  
  /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  
  @-webkit-keyframes pulse {
    0% {
      -webkit-box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
    }
    70% {
      -webkit-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
    }
    100% {
      -webkit-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
    }
  }
  
  @keyframes pulse {
    0% {
      -moz-box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
      box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
    }
    70% {
      -moz-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
      box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
    }
    100% {
      -moz-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
      box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
    }
  }
  
  .pulse {
    width: 13px;
    height: 12px;
    display: inline-flex;
    border-radius: 50%;
    background: #fb0027;
    vertical-align: top;
    cursor: pointer;
    box-shadow: 0 0 0 rgba(255, 0, 20, 0.4);
    animation: pulse 2s infinite;
  }
  
  .pulse:hover {
    animation: none;
  }
  
  @-webkit-keyframes panning {
    0% {
      background-position: 0% 0%;
    }
    25% {
      background-position: 100% 100%;
    }
    50% {
      background-position: 100% 0%;
    }
    75% {
      background-position: 0 100%;
    }
    200% {
      background-position: 0 0;
    }
  }
  
  @keyframes panning {
    0% {
      background-position: 0% 0%;
    }
    25% {
      background-position: 100% 100%;
    }
    50% {
      background-position: 100% 0%;
    }
    75% {
      background-position: 0 100%;
    }
    200% {
      background-position: 0 0;
    }
  }
</style>
