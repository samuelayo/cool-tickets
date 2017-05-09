<template>
  <div class="row" id="blogcategory">
     <!-- advert -->
    <div class="col-md-12">   <h1 style="text-align: center; font-weight: 700;">{{name}}</h1><br><br>
       <adimage src="/img/cool_adv.png" width="100%" height="100%"></adimage>
    </div>



    <!-- 3 grid for trending, rising and hot topics -->
        <div class="col-md-12">
            <div class="col-md-3"><br><br>
                <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Trending</h4><br>
                <div class="panel panel-default shadowed">
                <adimage src="/img/sq_ad.png" width="100%" height="100%"></adimage>
       

                 <div>
                     <br>
                    <!-- trending posts -->
                     <div class="row" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
                         <div class="col-md-12 tr_content" v-for="(trend, index) in all.trending" v-if="index <=count">
                             <div class="col-md-4">
                                <adimage :src="trend.image" width="100%" height="100%"></adimage>
                             </div>
                             <div class="col-md-8">
                                 <h4  class="category-tag" >{{trend.category.name}} <small class="time-stamp">{{timeago(trend.created_at)}}</small></h4>
                                <router-link v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: trend.title }}"><h4>{{trend.title}}</h4></router-link>
                                 <i style="color: blue;" class="ion-android-share" aria-hidden="true"></i>

                                     <a href="#">7500 shares</a>
                             </div>
                         </div>

                     <!-- -->

                </div>
                </div>
                </div>
            </div>
            <!-- rising -->
            <div class="col-md-6"><br><br>
                     <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;"  v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">Rising</h4><br>
                     <div class="panel panel-default shadowed" v-for="newpost in all.latest" v-if="index <=count">
                    <div  class="rising" :style="'background-image: url('+newpost.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.3);'">
                       <router-link v-bind:to="{ name: 'blogpost', params: { id: newpost.id, title: newpost.title }}"> <h4 class="rising_head" style="color: white;">{{newpost.category.name}}</h4></router-link>
                        <h3 class="rising_topic" style="color: white;">{{newpost.title}}</h3>
                        <span style="color: white;" class="rising_share" >
                            <i  class="ion-android-share" aria-hidden="true"></i>
                            <a href="#" style="color: white;">7500 shares</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end rising -->
            <div class="col-md-3"><br><br>
                      <h4 style="text-align: center; text-transform: uppercase; font-weight: 700;">Fresh</h4><br>
                <div class="panel panel-default shadowed" >
                    <div class="row" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10"><br>
                     <div class="col-md-12 ht_content" v-for="newpost in all.fresh" v-if="index <=count">
                        <small style="color: grey;">Last activity: {{hottimeago(newpost)}}</small>
                                 
                        <router-link v-bind:to="{ name: 'blogpost', params: { id: newpost.id, title: newpost.title }}"> <h4 class="rising_head" style="color: white;">{{newpost.category.name}}</h4></router-link>
                         
                         <hr>      
                    </div>

                    
                    
                </div>
            </div>
            <adimage src="/img/ht_ad1.png" width="100%" height="70%"></adimage>
             <adimage src="/img/ht_ad2.png" width="100%" height="70%"></adimage>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name: 'blogcategory',
    props: ['id', 'name'],
    data: function(){
        return {
            all: {},
            busy: false,
            count: 10
        }
    }, 
    created: function(){
        var status = {
                title: 'CoolFmNigeria |'+this.name,
                description: `All news, gossips and exclusive interviews in the `+this.name+' category'
            }
            this.$store.dispatch('SET_SEO', status);
        this.get_all();
    },
    methods: {
    loadMore: function() {
      this.busy = true;

      setTimeout(() => {
        this.count = this.count+10;
        this.busy = false;
      }, 1000);
    },
    timeago: function (time){
                return moment(time).fromNow();
            },
    get_all: function(){

        axios.get("/blog_category/"+this.id)
        .then((response)=>{
          this.all = response.data;
      });

    },
    hottimeago: function(obj){
                var last = obj.comments[obj.comments.length-1];
                return this.timeago(last.created_at); 
            }

  }
}
</script>