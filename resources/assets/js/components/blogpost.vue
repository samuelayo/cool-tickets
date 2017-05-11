
<template>
<div id="blogpost">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <pulse-loader v-if="loading"></pulse-loader>
    <div class="row"  v-if="!loading">
     <!-- advert -->
        <div class="col-md-12">
             <a  v-if="homepage_chart[0]" :href="homepage_chart[0].url">
                <adimage  :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></adimage>
            </a>
            <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
        </div>

    <!-- 3 grid for trending, rising and hot topics -->
        <div class="col-md-12"><br><br><br>
            <div class="col-md-9">
                <div class="panel panel-default shadowed"><h1 class="title">{{post.title}}</h1>

                <div class="article">
                    <P id="p-sh" class="p-body" >Story Highlights</P>
                    <P class="p-body" v-for="(keypoint, index) in keypoints" :key="index" v-html="keypoint"></P>
                  
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
            <img :src="post.image" height="315px" width="100%" />
            <br>
            <br>
            <p v-html="post.content">
            
            </p> 
            <div class="col-md-12">
                <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
        </div>           

        </div>
        <!-- DISCUSS COMPONENT  -->
        	
                    <ul class="social-network social-circle">
                       
                        <li><a style="border: 1px solid #3B5998; color: #3B5998 !important; background: #3B5998;" href="#" class="icoFacebook" title="Facebook" onclick="sharon.facebook()"><i class="fa fa-facebook" ></i></a></li>
                        <li><a style="border: 1px solid #33ccff; color: #33ccff !important; background: #33ccff;" href="#" class="icoTwitter" title="Twitter" onclick="sharon.twitter()"><i class="fa fa-twitter"></i></a></li>
                        <li><a style="border: 1px solid #BD3518; color: #BD3518 !important; background: #BD3518;" href="#" class="icoGoogle" title="Google +" onclick="sharon.plus()"><i class="fa fa-google-plus"></i></a></li>
                       
                    </ul>				
				

    

        <comment type="blog" :id="post.id" user="s" ></comment>
                <div>
                     <br> 
                     <div id="more" class="col-md-12"> 
                         <div class="row">
                            <div> 
                                <h5 class="header-title"> RELATED POSTS</h5> 
                                 <div id="more-news" class="col-md-3" v-for="rel in related_posts" :style="'background-image: url('+rel.image+'); background-size:cover; background-position:center; margin-bottom: 1em;'" >
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
               keypoints: [],
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
                var str = this.post.keypoints;
                this.keypoints = str.match(/<p>.*?<\/p>/g);
                
                 var status = {
                    title: 'CoolFmNigeria | '+this.post.title,
                    description: this.post.content
                }
                this.$store.dispatch('SET_SEO', status);
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


             axios.get('/related/'+this.post.category.id)
            .then(response => {
            // JSON responses are automatically parsed.
            //alert('related');
                this.related_posts = response.data;
            
            })
            .catch(e => {
            
            });

        }
      }, computed:{
           homepage_chart: function(){
            var homeads = _.map(window.Laravel.ads, function(o) {
                if (o.advert_category.type == "homepage_main") return o;
            });
            return homeads;
          }
      }
    }
</script>
<style>


/*=========================
  Icons
 ================= */

/* footer social icons */
ul.social-network {
	list-style: none;
	display: inline;
	margin-left:0 !important;
	padding: 0;
}
ul.social-network li {
	display: inline;
	margin: 0 5px;
}

#more-news{
    margin-bottom: 1em !important;
}

/* footer social icons */
.social-network a.icoRss:hover {
	background-color: #F56505;
}
.social-network a.icoFacebook:hover {
	background-color:#3B5998;
}
.social-network a.icoTwitter:hover {
	background-color:#33ccff;
}
.social-network a.icoGoogle:hover {
	background-color:#BD3518;
}
.social-network a.icoVimeo:hover {
	background-color:#0590B8;
}
.social-network a.icoLinkedin:hover {
	background-color:#007bb7;
}
.social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
.social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {
	color:#fff;
}
a.socialIcon:hover, .socialHoverClass {
	color:#44BCDD;
}

.social-circle li a {
    display: inline-block;
    position: relative;
    margin: 0 auto 0 auto;
    border-radius: 50%;
    text-align: center;
    width: 50px;
    height: 50px;
    font-size: 18px;

}

.social-circle li i {
	margin:0;
	line-height:50px;
	text-align: center;
}

.social-circle li a:hover i, .triggeredHover {
	
}
.social-circle i {
	color: #fff;
	-webkit-transition: all 0.8s;
	-moz-transition: all 0.8s;
	-o-transition: all 0.8s;
	-ms-transition: all 0.8s;
	transition: all 0.8s;
}

a {
   
}


</style>