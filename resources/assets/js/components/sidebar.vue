<template>
<div id="sidebar">
 <clip-loader v-if="loading" color="blue"></clip-loader>
    <div class="col-md-3">
        <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Hot</h4><br>
        <div class="panel panel-default shadowed">
            <div class="row"><br>
                <div class="col-md-12 ht_content" v-for="(ho, index) in hot" v-if="index < 6">
                    <small style="color: grey;">Last activity: {{hottimeago(ho)}}</small>

                    <router-link :to="{ name: 'forum', params: { id: ho.id, name:respace(ho.topic) }}">
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
            </div>
        </div>
        <ins class="adsbygoogle panel panel-default shadowed"
                    style="display:block; margin-right: 1em;"
                    data-ad-client="ca-pub-4448078976745099"
                    data-ad-slot="5545697316"
                    data-ad-format="auto"></ins>
        <div class="row">
            <h4 style="text-align: center;"><strong>TRENDING</strong></h4><br>
            <div id="advert-side" class="panel panel-default shadowed" style="margin-right: 1em;">
                <!-- <img src="img/sq_ad.png" width="100%"/> -->
                <div><br><br><br>
                    <!-- trending posts -->
                    <div class="row">
                        <div class="col-md-12 tr_content" v-for="trend in trending">
                            <div class="col-md-4">
                                <img :src="trend.image" width="100%" height="100%" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="category-tag"> {{trend.category.name}} <small class="time-stamp">{{timeago(trend.created_at)}}</small></h4>
                                <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: respace(trend.title) }}">
                                    <h4>{{trend.title}}</h4>
                                </router-link>
                                <i style="color: blue;" class="ion-android-open" aria-hidden="true"></i>

                                <a href="#">7500 shares</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
</template>
<script>
    export default {
        name: 'sidebar',
        data: function (){
            return{
               trending: window.Laravel.trending,
               hot: [], 
               loading: true
            }
        },
        created: function (){
            this.gethots();
            (window.adsbygoogle = window.adsbygoogle || []).push({});    
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
                        this.loading = false;
                
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
        }
    }
</script>