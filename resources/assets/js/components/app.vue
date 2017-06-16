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
    <meta property="og:image" content="/img/logo.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:site" content="@coolfmnigeria" />
    <nav class="navbar topnav navbar-default" role="navigation">
      <div class="container-fluid topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
  
        <div class="navbar-header htop">
        
          <div class="navbar-brand topnav">
            <a>
              <router-link to="/">
                <img src="/img/logo.png" width="130" alt="Cool Fm">
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
              <li>
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
  
              <router-link to="/events">Events</router-link>
            </li>
  
            <li>
              <router-link to="/aboutus">About Us</router-link>
            </li>
            <li>
              <router-link to="/contact-us">Contact Us</router-link>
            </li>
            <li>
  
  
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
    <br>
    <!-- the router outlet, where all matched components would ber viewed -->
    <transition>
      <router-view></router-view>
    </transition>
    <div class="navbar navbar-default navbar-fixed-bottom">
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
            Now Playing: Cool fm live stream
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
  
    created: function() {
  
      
  
    },
    mounted: function() {
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
        if (this.type == "livestream") {
  
        } else if (this.type == "podcast") {
  
        }
  
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
        document.getElementById('playname').innerHTML = 'Now Playing: ' + name;
  
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

  .cse .gsc-control-cse, .gsc-control-cse {
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

.cse input.gsc-input, input.gsc-input {
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
control-cse {
    padding: none !important;
    width: auto;
}
</style>
