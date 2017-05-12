<template>
    <div id="sidebar" class="xs-m4">

    <div id="now-buzzing" class="xs-mb3">
        <table style="height: 40px !important; border: none !important;" class="table-fill"><br><br><br><br><br><br>
           <tbody class="table-hover" v-if="now_playing">
            <tr>
              <td style="border-left: 6px solid red;border-right: 1px solid rgb(221, 221, 221);letter-spacing: 3px;color: red;display: inline-block;font-style: normal !important;font-size: 0.8em;width: 103px;" class="text-left"><i :class="'ion-'+current_play_state" @click="livestream()"></i> <small>LIVE</small> </td>
              <td class="text-left" style="padding-left: 11.4px !important; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">{{now_playing.title}} </td>
            </tr>
  
  
          </tbody>
        </table>

        <br>

        <div id="now-buzzing" class="xs-mb3" v-if="post.title">

            <h3 class=" xs-text-2 xs-mb1">  <a id="categ" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1">{{post.category.name}}</a> </h3>

            <h1 class="title">{{post.title}}</h1>

            <p><a id="author" class="button  xs-col-12 xs-text-left xs-mb1">By {{post.user.name}} &#183; {{timeago(post.created_at)}}</a> </p>

            <div class="article">
                <P id="p-sh" class="p-body">Story Highlights</P>
                <P class="p-body" v-for="(keypoint, index) in keypoints" :key="index" v-html="keypoint"></P>

            </div>

            <br>
            <br>
            

            <div class="item-body">
         
               <p v-html="post.content" style="width: 100% !important;">
               </p>
               <comment v-if="post.id" :id="post.id"></comment>
               <br>
                <div id="connect" class="xs-mb3">

                    <a onclick="sharon.facebook()" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> <span class="mdi-facebook-box
"></span> Share On Facebook </a>

                    <a onclick="sharon.twitter()" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"><span class="ion-social-twitter"></span> Share On Twitter</a>

                    <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> {{totalshares}} <span style="font-weight: 100;">SHARES</span> </p>

                </div>

            </div>
        </div>

        <div id="now-buzzing" class="xs-mb3">
            <h3 style="color: black;
    font-size: 1.4em  !important;
    font-weight: 900;
    letter-spacing: -1px;" class="xs-mb1">
    Related Posts
  </h3></div>

        <div id="vertical-feed" class="">
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
                <div class="xs-text-left text-gray">
                    <ul class="list-unstyled">
                        <li class="xs-col-12 xs-mb2" v-for="rel in related_posts" v-if="(post.id && rel.id != post.id)">
                            
                             <router-link  class="bold text-gray" v-bind:to="{ name: 'blogpost', params: { id: rel.id, title: rel.title }}">
                                <img class="buzz-image xs-block xs-mb05" :src="rel.image">

                                <P id="post-cat-m"> {{rel.category.name}} </P>
                                <h4 class="xs-text-4 lg-text-3">{{rel.title}}</h4>
                                </router-link>
                                <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> &nbsp 200 <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span> <span style="font-weight: 100;">3 HOURS AGO</span> </p>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>

    </div>

    <h3 class=" xs-text-2 xs-mb1">  <a style="background: #f83600 !important; text-transform: uppercase;
    font-weight: 900; " href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> <span class="ion-ios-flame"></span> Hot</a></h3><br>
<div id="news" class="card xs-mb2 xs-p2">
  <div id="news-header" class="clearfix">
      <div class="col xs-col-5">

      </div>

    </div>
  <ul id="news-list" class="xs-p0">
    <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled"  v-for="(ho, index) in hot" v-if="index < hotlimit"> <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottimeago(ho)}}</div><br>
            <a href="#" class="link-gray">
             {{ho.topic}}
            </a>   <br><br>
                         <small style="color:red;">
                         In this conversation 
                         </small><br><p></p>
                         <div id="convert">
                         <img class="conversation" src="img/4671_1.png"/>
                         <img class="conversation2" src="img/s.png"/>
                         <img class="conversation2" src="img/33.png"/>
                         <img class="conversation2" src="img/3e.png"/>
                         <span style="color: #007adf; font-size: 15px;font-size: 15px;
    vertical-align: super;">+ {{ho.comments.length-4}}</span>
                         </div>
                         <hr>      
      </li>
  </ul>

  <a href="javascript::void" class="xs-block xs-text-5 bold" @click="hotclick()">+ Show more</a>
</div>

<div id="connect" class="xs-mb3">
  <h3 class="xs-mb1">
    Connect With Us
  </h3>

    <a href="#" target="_blank" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> <span class="mdi-facebook-box
"></span> Like Us On Facebook </a>

    <a href="#" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"> <span class="ion-social-twitter"></span> Follow Us On Twitter</a>

    <a href="#" class="button button--apple-news xs-col-12 xs-text-left xs-mb1"> <span class="mdi-instagram
"></span> Follow Us On Instagram </a>
    <a style="background-image: linear-gradient(to top, #ff0844 0%, red 100%)  !important;" href="#" class="button button--apple-news xs-col-12 xs-text-left xs-mb1"> <span class="ion-social-youtube
"></span> Subscribe On Youtube </a>

</div>

</div>


</template>
<script>
import comment from './comment'
export default{
    name: 'blogpost',
    data: function(){
        return{
            post: {},
            keypoints: [],
            schedule: [],
            related_posts: [],
            hotlimit: 2,
            hot: [],
            totalshares: 0
        }
    },
    created: function (){
                this.schedules();
                this.gethots();
                this.shares();
                axios.get('/posts/'+this.$route.params.id)
                .then(response => {
                // JSON responses are automatically parsed.
                this.post = response.data;
                this.loading = false;
                var str = this.post.keypoints;
                this.keypoints = str.match(/<p>.*?<\/p>/g);
                })
                .catch(e => {
                
                });
                //this.getshows();
                setTimeout(()=>{ 
                    this.fetch_related();
                 }, 1000);
                
                
                
        },
        components:{
            comment
        },
    methods: {
        fetch_related: function(){


             axios.get('/related/'+this.post.category.id)
            .then(response => {
            // JSON responses are automatically parsed.
            //alert('related');
                this.related_posts = response.data;
            
            })
            .catch(e => {
            
            });

        },
        hotclick: function(){
              this.hotlimit = 4;
            },
            shares: function(){
                sharon.facebook.count((err, count)=>{
                    this.totalshares += count;
                    //console.log('Whoa, we have ' + count + ' shares!');
                });

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
        schedules: function() {
        axios.get('/schedules')
          .then(response => {
            // JSON responses are automatically parsed.
            this.schedule = response.data;
  
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
  
          return 'Now';
        } else {
  
          return 'Later';
  
        }
      },
      livestream: function(){
              if(this.current_play_state == 'play'){
                var status = 'pause';
              }else{
                var status = 'play';
              }
              this.$store.dispatch('SET_PLAY', status);
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
            }
    },
    computed: {
        now_playing: function() {
        for (var i = 0; i < this.schedule.length; i++) {
          var schedu = this.schedule[i];
          if (this.between(schedu.start, schedu.end) == "Now") {
            return schedu
          }
        }
      },
      current_play_state: function(){
            return this.$store.state.play;
          }
    }
}
</script>
<style>
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.btn-primary {
    color: #fff;
    background-color: none;
    border-color: blue;
    color: blue !important;
}
</style>