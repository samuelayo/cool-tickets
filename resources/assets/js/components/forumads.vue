<template>
     <div class="col-md-3">
                <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Hot</h4><br>
                <div class="panel panel-default shadowed">
                    <div class="row"><br>
                       <div class="col-md-12 ht_content" v-for="(ho, index) in hot" v-if="index < 6">
                        <small style="color: grey;">Last activity: {{hottimeago(ho)}}</small>
                                 
                         <router-link :to="{ name: 'forum', params: { id: ho.id, name:respace(ho.topic) }}"><h4>{{ho.topic}}</h4></router-link>
                         
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

                </div>
            </div> 
  <div class="row" style=" position: fixed; right: 120px;">
             <div id="advert-side" class="panel panel-default ">
                 <a v-if="side_ad[0]" :href="side_ad[0].url">
                    <adimage :src="'/'+side_ad[0].image_url" width="100%" height="100%"></adimage>
                </a>
                 <div>
                   
                       

                <a v-if="side_ad[1]" :href="side_ad[1].url">
                    <adimage :src="'/'+side_ad[1].image_url" width="100%" height="100%"></adimage>
                </a>
                <a v-if="side_ad[2]" :href="side_ad[2].url">
                    <adimage :src="'/'+side_ad[2].image_url" width="100%" height="100%"></adimage>
                </a>

            </div>
        </div>
    </div>
    </div>
</template>
<script>
    export default{
        name: 'forumads',
        data: function (){
            return{
               hot: []
            }
        },
        created: function (){
            this.gethots();
                
        },
         methods: {
            timeago: function (time){
                return moment(time).fromNow();
            },
            respace: function(str){
              return str.replace(/ /g,"_");
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
            hottimeago: function(obj){
                if(obj.comments != undefined && obj.comments.length != 0){
                    var last = obj.comments[obj.comments.length-1];
                    return this.timeago(last.updated_at); 
                }
                return "No activity yet";
            }
        }, 
        computed: {
            side_ad: function(){
                
                var homeads = _.filter(window.Laravel.ads, function(o) {
                    if (o.advert_category.type == "forum_side") return o;
                });
                return homeads;
          
            }
        }
    }
</script>