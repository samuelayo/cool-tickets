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
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:site" content="@coolfmnigeria" />
    <div class="container-fluid topnav" style="
                height: 40px !important;
                 background-image: url('https://i.imgur.com/PRammPf.png') ; border-bottom: 3px solid #f9f9f9; box-shadow: inset 0 0 0 1000px rgba(0, 79, 253, 0.4); ;
                                                       ">
      <p style="
                text-align:center;
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
            ">Learn more</button></router-link>
      </p>
    </div>
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
        <div class="collapse navbar-collapse htop" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <!--<li>
                            <a class="active" href="#">On Air</a>
                          </li>
                          <li>
                            <a href="#">Schedules</a>
                          </li> -->
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
              <router-link to="/forums">Forum</router-link>
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
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!-- the router outlet, where all matched components would ber viewed -->
    <center><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4448078976745099" data-ad-slot="5185770514" data-ad-format="auto"></ins></center>
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
    <br>
    <br>
    <div class="navbar navbar-default navbar-fixed-bottom" style="background-color: rgba(255, 255, 255, .9) !important">
      <div class="container">
        <span class="navbar-text" style="margin-top:1%">
                        
                        <!--<div id="timeline">
                          <div id="playhead"></div>
                        </div><span style="vertical-align: -webkit-baseline-middle;">&nbsp <span id="len">5.50</span></span>-->
        <audio id="ourplay" ref="ourplay" controls> 
                        <source :src="current_stream"/>
                      </audio>
        </span>
        <p class="navbar-text pull-right">
          <span><p></p>
                        <span id="playname">
                        Cool FM live stream
                        </span>
          <span id="live" style="
                 margin-left: 1em;
                 color: red;
                 padding: .19em;
                 font-weight: 400;
                 font-size: 0.8em;
                 letter-spacing: 3px;
                 border: 1.2px solid red;
                 padding-left: .5em;
                 padding-right: .5em;
              ">LIVE</span>
          </span>
        </p>
      </div>
    </div>
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
        categories: Laravel.categories
      }
    },
    created: function() {},
    mounted: function() {
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
      change_state: function(status, stream) {
        this.$store.dispatch('SET_STATE', status);
        this.$store.dispatch('SET_STREAM', stream);
      }
    },
    computed: {
      title: function() {
        return this.$store.state.title;
      },
      description: function() {
        return this.$store.state.description;
      },
      current_stream: function() {
        if (this.$refs.ourplay != undefined) {
          var audio = this.$refs.ourplay;
          audio.src = this.$store.state.current_stream;
          audio.play();
        }
        return this.$store.state.current_stream;
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
    background: #fff;
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
</style>
