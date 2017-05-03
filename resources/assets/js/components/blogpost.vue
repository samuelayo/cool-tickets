
<template>
<div id="blogpost">
    <pulse-loader v-if="loading"></pulse-loader>
    <div class="row"  v-if="!loading">
     <!-- advert -->
        <div class="col-md-12">
              <adimage src="/img/cool_adv.png" width="100%" height="100%"></adimage>
            <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
        </div>

    <!-- 3 grid for trending, rising and hot topics -->
        <div class="col-md-12"><br><br><br>
            <div class="col-md-9">
                <div class="panel panel-default shadowed"><h1 class="title">{{post.title}}</h1>

                <div class="article">
                    <P id="p-sh" class="p-body" >Story Highlights</P>
                    <P class="p-body" v-for="keypoint in post.keypoints" :key="keypoint.id">{{keypoint.Point}}</P>
                  
                </div>


<div class="item-content ">
    <div class="item-meta">
        <div class="author" :style="'background: url('+post.user.image+'); background-size: cover; '">
        </div>
        <div class="title-meta" >
            <h6>WRITTEN BY</h6>  
        </div>
        <div class="title-meta"><h5>{{post.user.name}}</h5><h6>CATEGORY</h6>  
        </div>
        <div class="title-meta"><h5>{{post.category.name}}</h5> <br> <h5 style="color:#999;">{{timeago(post.created_at)}}</h5> 
        </div>
    </div>

        <div class="item-body">
            <p>{{post.content}}</p> 
            <div class="col-md-12">
                <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
        </div>           

        </div>
        <!-- DISCUSS COMPONENT  -->
        <social-sharing  inline-template>
  <div >
      <network network="facebook" id="socialshare">
        <i class="fa fa-facebook"></i> Facebook
      </network>
      <network network="googleplus" id="socialshare">
        <i class="fa fa-google-plus"></i> Google +
      </network>
      <network network="linkedin" id="socialshare">
        <i class="fa fa-linkedin"></i> LinkedIn
      </network>
      <network network="pinterest" id="socialshare">
        <i class="fa fa-pinterest"></i> Pinterest
      </network>
      <network network="reddit" id="socialshare">
        <i class="fa fa-reddit"></i> Reddit
      </network>
      <network network="twitter" id="socialshare">
        <i class="fa fa-twitter"></i> Twitter
      </network>
      <network network="whatsapp" id="socialshare">
        <i class="fa fa-whatsapp"></i> Whatsapp
      </network>
  </div>
</social-sharing>

        <comment type="blog" :id="post.id" user="s" ></comment>
                <div>
                     <br> 
                     <div id="more" class="col-md-12"> 
                         <div class="row">
                            <div> 
                                <h5 class="header-title"> RELATED POSTS</h5> 
                                 <div id="more-news" class="col-md-3" v-for="rel in related_posts">
                                 <router-link v-bind:to="{ name: 'blogpost', params: { id: rel.id, title: rel.title }}">
                                 <p>{{rel.title}}</p> 
                                 </router-link>
                                 </div>
                        </div>

                    <div>  </div></div>
                </div> 
    <br>
    <!-- end chart details --><br><br>

                    <br><br>   <!-- freshly pressed -->



    <div class="container-fluid">
      


      <div v-if="shows.length != 0" > <h5  class="header-title"> SHOWS</h5>
        
         <div style="background: #333;"><br>
             <h5 style="color: yellow;" class="header-title-white"> SHOWS</h5>

              <p style="margin-left: 3em;">
              <iframe width="95%" height="600" :src="shows[0].link" frameborder="0" allowfullscreen></iframe>
              </p>
        <h1 class="video-title" >{{shows[0].title}}</h1>
        <p class="video-meta">{{shows[0].user.name}} /  {{timeago(shows[0].created_at)}}</p>
        <p class="video-caption">{{shows[0].description}}</p>
       <br><br>      
        <h5 class="header-title-white"> UP NEXT </h5>
<!-- Flickity HTML init -->

<flickity ref="flickity" :options="flickityOptions">
    <div  class="carousel-cell" v-for="(sho, index) in shows" v-if="index !=0" @click="showme(sho)"> <p><span class="catgory">{{sho.title}}</span> <br>{{sho.description}}</p></div>
</flickity>



<br><br>

    </div></div></div>
    <!-- -->

                    

                    <!-- trending posts -->
                    
                     <div class="row">
                         <div class="col-md-12 tr_content">
                          
                         </div>
                     </div>
                     <!-- -->

                       
                 </div>
                </div>
            </div>
                </div>
            
           
 <!--- trending component -->
    <sidebar></sidebar>
            </div>
        </div>
</div>

</div>
</template>

<script>

    import comment from './comment.vue'
    import sidebar from './sidebar.vue'
     import Flickity from 'vue-flickity';
    export default {
        name: 'blogpost',
        data: function (){
            return{
               post: {},
               loading: true,
               fresh: window.Laravel.fresh,
               shows: [],
                 flickityOptions: {
                initialIndex: 3,
                prevNextButtons: true,
                pageDots: false,
                wrapAround: true
                    // any options from Flickity can be used
                },
                related_posts:[]
            }
        },
        created: function (){
                axios.get('/posts/'+this.$route.params.id)
                .then(response => {
                // JSON responses are automatically parsed.
                this.post = response.data;
                this.loading = false;
                })
                .catch(e => {
                
                });
                this.getshows();
                setTimeout(()=>{ 
                    this.fetch_related();
                 }, 1000);
                
                
                
        },
         components: {sidebar, Flickity, comment},
        methods: {
            timeago: function (time){
                return moment(time).fromNow();
            },
        next() {
           this.$refs.flickity.next();
        },
        previous() {
           this.$refs.flickity.previous();
        },
        showme(show){
            this.shows[0]= show;
        },
        getshows: function(){
            axios.get('/shows/')
            .then(response => {
            // JSON responses are automatically parsed.
            this.shows = response.data;
            
            })
            .catch(e => {
            
            });

        },
        fetch_related: function(){


             axios.get('/related/'+this.post.category.name)
            .then(response => {
            // JSON responses are automatically parsed.
            alert('related');
                this.related_posts = response.data;
            
            })
            .catch(e => {
            
            });

        }
      }
    }
</script>
<style>
#socialshare {
    cursor: pointer;
    cursor: hand;
 
    padding: 2px;
    margin: 2px;
    color: blue;
}
</style>