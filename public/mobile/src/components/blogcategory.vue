<template>
<div id="sidebar" class="xs-m4">
   <div id="now-buzzing" class="xs-mb3">
      <table style="height: 40px !important;" class="table-fill">
         <br><br><br><br><br><br>
         <tbody class="table-hover" v-if="now_playing">
            <tr>
              <td style="border-left: 6px solid red;border-right: 1px solid rgb(221, 221, 221);letter-spacing: 3px;color: red;display: inline-block;font-style: normal !important;font-size: 0.8em;width: 103px;" class="text-left"><i :class="'ion-'+current_play_state" @click="livestream()"></i> <small>LIVE</small> </td>
              <td class="text-left" style="padding-left: 11.4px !important; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">{{now_playing.title}} </td>
            </tr>
          </tbody>
      </table>
      <br>
      <div id="now-buzzing" class="xs-mb3">
         <h3 class=" xs-text-2 xs-mb1">  <a href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> {{name}}</a></h3>
         <div id="vertical-feed" class="">
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
               <div class="xs-text-left text-gray">
                  <ul class="list-unstyled" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                     <li class="xs-col-12 xs-mb2"  v-for="(fre, index) in posts.fresh" v-if="index <=count">
                        <router-link v-bind:to="{ name: 'blogpost', params: { id: fre.id, title: respace(fre.title) }}"  class="bold text-gray">
                      
                      <img class="buzz-image xs-block xs-mb05" :src="fre.image">
                      <P id="post-cat-m"> {{fre.category.name}} </P>
                      <h4 class="xs-text-4 lg-text-3">{{fre.title}}</h4>
                    
                    </router-link>
                    <p id="share-m"> <span style="    font-size: 1.7em;
    font-weight: 900;
    vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{shares('/blogpost/'+fre.id+'/'+respace(fre.title))}} <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span>  <span style="font-weight: 100;">{{timeago(fre.created_at)}}</span> </p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <br>
      </div>
   </div>
</div>
</template>
<script>
export default{
    props: ['id', 'name'],
    data:function(){
        return{
            schedule: [],
            posts: [],
            busy: false,
            count: 5
        }
    },
    created: function(){
        this.schedules();
        this.cat_posts();
    },
    methods: {
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
      cat_posts: function(){
            axios.get("/blog_category/"+this.id)
            .then((response)=>{
            this.posts = response.data;
            });
      },
      loadMore: function() {
      this.busy = true;
      this.count = this.count+10;
      this.busy = false;
    },
      livestream: function(){
              if(this.current_play_state == 'play'){
                var status = 'pause';
              }else{
                var status = 'play';
              }
              this.$store.dispatch('SET_PLAY', status);
            },
            respace: function(str){
              return str.replace(/ /g,"_");
            },
            shares: function(url){
                sharon.facebook.count(url=url,(err, count)=>{
                   return count;
                    //console.log('Whoa, we have ' + count + ' shares!');
                });

            },
            timeago: function (time){
                return moment(time).fromNow();
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
    },
    watch: {
        id: function(){
            this.cat_posts();
        }
    }
}
</script>