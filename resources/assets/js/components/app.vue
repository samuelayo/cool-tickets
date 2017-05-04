<template>
  <div id="app">
  
    <nav class="navbar topnav navbar-default" role="navigation">
      <div class="container-fluid topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
  
        <div class="navbar-header htop">
  
          <div class="navbar-brand topnav">
            <a>
              <router-link to="/">
                <img src="/img/logo.png" width="120" alt="Cool Fm">
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
              <a data-toggle="dropdown">Categories
                            <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li v-for="cat in categories"> <router-link :to="{ name: 'blogcategory', params: { id: cat.id, name:cat.name }}">{{cat.name}}</router-link></li>
              </ul>
            </li>
            
            <li>
              <router-link to="/all_oaps">OAPs</router-link>
  
            </li>
            <li>
  
              <router-link to="/forums">Forum</router-link>
            </li>
            <li>
  
              <a class="switch" data-toggle="dropdown">Switch Channel
                            <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Coolfm Kano</a></li>
                <li><a href="#">Coolfm Abuja</a></li>
                <li><a href="#">Coolfm Port-Harcourt</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
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
        <audio id="ourplay" ref="ourplay" controls > 
          <source src="http://icestream.coolwazobiainfo.com:8000/coolfm-lagos"/>
        </audio>
        </span>
  
  
        <p class="navbar-text pull-right">
          <span  ><p></p>
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
    data: ()=>{
      return {
        type: '',
        src: '',
        play: 'play',
        player:'',
        categories: Laravel.categories
      }
    },
    
    created: function() {
     
    },
    mounted: function(){
      this.player=plyr.setup();
      console.log('mounted');
    },
    computed: {
      playorpause: function() {
        if(this.$refs.ourplay !=undefined)
        {
          var audio = this.$refs.ourplay;
          if(audio.paused){
            return 'play';
          }
        return 'paused';
        }
        return 'play';
         
      }
    },
    methods: {
      playthis: (id, type, src, name)=>{
        if(type=="livestream"){
          document.getElementById('live').style.display='inline-block';
        }else{
          document.getElementById('live').style.display='none';
        }
        var audio = document.getElementById('ourplay');
        console.log(this.type);
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
        }else if(this.type == type && this.play != 'play'){
           this.play = 'play';
           audio.play();
        }
        document.getElementById('playname').innerHTML='Now Playing: '+name;
        //console.log(this.playorpause);
        // if(!audio.paused){
        //   audio.pause();
        // }else{
        //   audio.play();
        // }
  
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
  audio::-webkit-media-controls-enclosure, video::-webkit-media-controls-enclosure {
  max-width: 100%;
}
</style>
