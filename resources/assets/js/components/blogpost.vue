
<template>
   <div id="blogpost">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <clip-loader v-if="loading" color="blue"></clip-loader>
    <div class="row" v-if="!loading">
        <!-- advert -->
        <div class="col-md-12">
            <a v-if="homepage_chart[0]" :href="homepage_chart[0].url">
                <adimage :src="'/'+homepage_chart[0].image_url" width="100%" height="100%"></adimage>
            </a>
            <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
        </div>

        <!-- 3 grid for trending, rising and hot topics -->
        <div class="col-md-12"><br><br><br>
            <div class="col-md-9">
                <div class="panel panel-default shadowed">
                    <h1 class="title">{{post.title}}</h1>

                    <div class="article">
                        <P id="p-sh" class="p-body">Story Highlights</P>
                        <P class="p-body" v-for="(keypoint, index) in keypoints" :key="index" v-html="keypoint"></P>

                    </div>


                    <div class="item-content ">
                        <div class="item-meta">
                            <div class="author" :style="'background: url('+post.user.image+'); background-size: cover; '">
                            </div>
                            <div class="title-meta">
                                <h6>WRITTEN BY</h6>
                            </div>
                            <div class="title-meta">
                                <h5>{{post.user.name}}</h5>
                                <h6>CATEGORY</h6>
                            </div>
                            <div class="title-meta">
                                <h5>{{post.category.name}}</h5> <br>
                                <h5 style="color:#999;">{{timeago(post.created_at)}}</h5>
                            </div>
                        </div>

                        <div class="item-body">

                            <p v-html="post.content">

                            </p>



                            <!--- slider test -->
                            <div class="slider" v-if="(sliderimages && sliderimages.length !=0)">
                                <ul>
                                    <li class="slide" v-for="(slide, index) in sliderimages" :id="'no-js-slider-'+index">
                                        <img :src="'/uploads/'+slide" class="imsg">
                                        <a class="prev" v-if="index ==0 " :href="'#no-js-slider-'+(sliderimages.length -1)">prev</a>
                                        <a class="prev" v-if="index !=0 " :href="'#no-js-slider-'+(index-1)">prev</a>
                                        <a class="next" v-if="index != (sliderimages.length -1)" :href="'#no-js-slider-'+(index+1)">next</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- slider end -->



                            <div class="col-md-12">
                                <!--<img src="img/cool_adv.png" width="100%", height="100%"/>-->
                            </div>

                        </div>
                        <!-- SHARE COMPONENT  -->

                        <center><ul class="social-network social-circle">

                            <li><a style="border: 1px solid #3B5998; color: #3B5998 !important; background: #3B5998;" href="#" class="icoFacebook" title="Facebook" onclick="sharon.facebook()"><i class="fa fa-facebook" ></i></a></li>
                            <li><a style="border: 1px solid #33ccff; color: #33ccff !important; background: #33ccff;" href="#" class="icoTwitter" title="Twitter" onclick="sharon.twitter()"><i class="fa fa-twitter"></i></a></li>
                            <li><a style="border: 1px solid #BD3518; color: #BD3518 !important; background: #BD3518;" href="#" class="icoGoogle" title="Google +" onclick="sharon.plus()"><i class="fa fa-google-plus"></i></a></li>

                        </ul></center>



                        <div class="panel" style="width:60%; background:none; margin:0 auto; border: none !important;">

                        </div>
                        <div>
                            <br>

                            <div id="more" class="col-md-12">
                                <div class="row">
                                    <div>
                                        <h5 class="header-title" v-if="related_posts[0]"> RELATED POSTS</h5>
                                        <div id="more-news" class="col-md-3" v-for="rel in related_posts" :style="'background-image: url('+rel.image+'); background-size:cover; background-position:center; margin-bottom: 1em;'" v-if="rel.id != post.id">
                                            <router-link v-bind:to="{ name: 'blogpost', params: { id: rel.id, title: rel.title }}">
                                                <p>{{rel.title}}</p>
                                            </router-link>
                                        </div>
                                    </div>

                                    <div> </div>
                                </div>
                            </div>
                            <br>
                            <!-- end chart details --><br><br>

                            <br><br>
                            <!-- freshly pressed -->



                            <div class="container-fluid">



                                <div v-if="shows.length != 0">
                                    <h5 class="header-title"> SHOWS</h5>

                                    <div style="background: #333;"><br>
                                        <h5 style="color: yellow;" class="header-title-white"> SHOWS</h5>

                                        <p style="margin-left: 3em;">
                                            <iframe width="95%" height="600" :src="shows[0].link" frameborder="0" allowfullscreen></iframe>
                                        </p>
                                        <h1 class="video-title">{{shows[0].title}}</h1>
                                        <p class="video-meta">{{shows[0].user.name}} / {{timeago(shows[0].created_at)}}</p>
                                        <p class="video-caption">{{shows[0].description}}</p>
                                        <br><br>
                                        <h5 class="header-title-white"> UP NEXT </h5>
                                        <!-- Flickity HTML init -->

                                        <flickity ref="flickity" :options="flickityOptions">
                                            <div class="carousel-cell" v-for="(sho, index) in shows" v-if="index !=0" @click="showme(sho)">
                                                <p><span class="catgory">{{sho.title}}</span> <br>{{sho.description}}</p>
                                            </div>
                                        </flickity>



                                        <br><br>

                                    </div>
                                </div>
                            </div>
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

                <div class="panel" style="width:60%; background:none; margin:0 auto; border: none !important;">
                    <br>
                    <p style="
                        text-align: left;
                        margin-left: 1.5em;
                        font-size: 1.5em;
                        font-family: 'Circular-Bold';
                        margin-bottom: 1em;
                        margin-top: 2em;
                     
                    ">Responses </p>
                    <comment type="blog" :id="post.id" user="s"></comment>
                    <br>
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
        props: ['id', 'title'],
        data: function() {
            return {
                post: {},
                keypoints: [],
                sliderimages: [],
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
                related_posts: []
            }
        },
        created: function() {
    
            axios.get('/posts/' + this.$route.params.id)
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.post = response.data;
                    this.loading = false;
                    var str = this.post.keypoints;
                    this.keypoints = str.match(/<p>.*?<\/p>/g);
                    this.sliderimages = JSON.parse(this.post.extra_images);
                    document.body.scrollTop = document.documentElement.scrollTop = 0;
    
                    var status = {
                        title: 'Cool FM Nigeria | ' + this.post.title,
                        description: this.post.content
                    }
                    this.$store.dispatch('SET_SEO', status);
                })
                .catch(e => {
    
                });
            this.getshows();
    
    
    
    
    
    
        },
        components: {
            sidebar,
            Flickity,
            comment
        },
       
        methods: {
            timeago: function(time) {
                return moment(time).fromNow();
            },
            next() {
                this.$refs.flickity.next();
            },
            previous() {
                this.$refs.flickity.previous();
            },
            showme(show) {
                this.shows[0] = show;
            },
            getshows: function() {
                axios.get('/shows/')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.shows = response.data;
                        this.fetch_related();
    
                    })
                    .catch(e => {
    
                    });
    
            },
            fetch_related: function() {
    
    
                axios.get('/related/' + this.post.category.id)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        //alert('related');
                        this.related_posts = response.data;
    
                    })
                    .catch(e => {
    
                    });
    
            }
        },
        computed: {
            homepage_chart: function() {
                var homeads = _.filter(window.Laravel.ads, function(o) {
                    if (o.advert_category.type == "homepage_main") return o;
                });
                return homeads;
            }
        },
        watch: {
            id: function() {
                this.loading = true;
                axios.get('/posts/' + this.$route.params.id)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.post = response.data;
                        this.loading = false;
                        var str = this.post.keypoints;
                        this.keypoints = str.match(/<p>.*?<\/p>/g);
                        this.sliderimages = JSON.parse(this.post.extra_images);
                        var status = {
                            title: 'Cool FM Nigeria | ' + this.post.title,
                            description: this.post.content
                        }
                        this.$store.dispatch('SET_SEO', status);
                    })
                    .catch(e => {
    
                    });
                this.getshows();
                setTimeout(() => {
                    this.fetch_related();
                }, 1000);
            }
        }
    }
</script>

<style scoped>
    /*=========================
      Icons
     ================= */
    
    
    /* footer social icons */
    
    ul.social-network {
        list-style: none;
        display: inline;
        margin-left: 0 !important;
        padding: 0;
    }
    
    ul.social-network li {
        display: inline;
        margin: 0 5px;
    }
    
    #more-news {
        margin-bottom: 1em !important;
    }
    
    
    /* footer social icons */
    
    .social-network a.icoRss:hover {
        background-color: #F56505;
    }
    
    .social-network a.icoFacebook:hover {
        background-color: #3B5998;
    }
    
    .social-network a.icoTwitter:hover {
        background-color: #33ccff;
    }
    
    .social-network a.icoGoogle:hover {
        background-color: #BD3518;
    }
    
    .social-network a.icoVimeo:hover {
        background-color: #0590B8;
    }
    
    .social-network a.icoLinkedin:hover {
        background-color: #007bb7;
    }
    
    .social-network a.icoRss:hover i,
    .social-network a.icoFacebook:hover i,
    .social-network a.icoTwitter:hover i,
    .social-network a.icoGoogle:hover i,
    .social-network a.icoVimeo:hover i,
    .social-network a.icoLinkedin:hover i {
        color: #fff;
    }
    
    a.socialIcon:hover,
    .socialHoverClass {
        color: #44BCDD;
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
        margin: 0;
        line-height: 50px;
        text-align: center;
    }
    
    .social-circle li a:hover i,
    .triggeredHover {}
    
    .social-circle i {
        color: #fff;
        -webkit-transition: all 0.8s;
        -moz-transition: all 0.8s;
        -o-transition: all 0.8s;
        -ms-transition: all 0.8s;
        transition: all 0.8s;
    }
    
    a {}
    
    .et-wrapper {
        background-color: rgba(48, 45, 55, .7);
        border-radius: 5px;
        padding: 10px 30px;
        display: inline-block;
        max-width: 500px !important;
        min-width: 120px !important;
        color: #fff;
        z-index: 9999;
        margin: auto;
        position: fixed;
        top: 80%;
    }

header {
	height:40px;
	width:100%;
	position:fixed;
	background:rgba(0,0,0,0.9);
	z-index:120;
}
header li {
	float: left;
	list-style-type:none;
	border-right: 1px solid #252525;
}
header li a {
	float: left;
	width: 98px;
	height: 12px;
	padding: 14px 7px;
	color: #fff;
	text-decoration: none;
	text-align: center;
	text-transform: uppercase;
	font-weight: 700;
	letter-spacing: 1px;
	font: normal 62.5% "proxima-nova-alt", Helvetica, Arial, sans-serif;
}
header .logo {
	float: left;
	width: 201px;
	height: 40px;
	background:#fde624 url('https://lh4.googleusercontent.com/-JN1IZLtuToI/UUoZnMG3C_I/AAAAAAAAAE8/SEbJ9nqXGnY/s226/sprite.png') no-repeat 16px 1px;
}
#show-nails:hover div.thumbnail-peekaboo {
	display:block;
}
header div.thumbnail-peekaboo {
	display:none;
	height:165px;
	width:3000px;
	top:40px;
	left:0;
	background:#222;
	background-size:100px 100px;
	position:absolute;
}
/*header div.thumbnail-peekaboo:hover {
	-webkit-animation: TMNT 4s ease-in;
	-webkit-animation-fill-mode:backwards;
}*/
.thumb {
	height:140px;
	width:210px;
	top:136px;
	left:12px;
	position:relative;
	background-size:contain;
	box-shadow:-12px 0 0 12px #000;
}
.thumb:last-of-type {
  box-shadow:0 0 0 12px #000;
}
.thumb:after {
  content:attr(title);
  font:normal normal 20pt 'impact';
  position:relative;
}
.thumb:hover {
	-webkit-filter: grayscale(80%);
	-moz-filter: grayscale(80%);
	-ms-filter: grayscale(80%);
	-o-filter: grayscale(80%);
	filter: grayscale(80%);
	/*filter: url(grayscale.svg#greyscale); */
	filter: gray;
}
@-webkit-keyframes TMNT {
	0%  { left: 0px; }
	100% { left: -1200px; }
}
a.prev,a.next {
	height:91px;
	position:absolute;
	width:43px;
	top:50%;
	margin-top:-30px;
	opacity:0.6;
	text-indent:-99999px;
	cursor:pointer;
	-webkit-transition:opacity 200ms ease-out;
}
* {

list-style-type:none;
}
a.prev:hover,a.next:hover {
	opacity:1;
}
.prev {
	left:0;
	background: #000 url('https://lh4.googleusercontent.com/-JN1IZLtuToI/UUoZnMG3C_I/AAAAAAAAAE8/SEbJ9nqXGnY/s226/sprite.png') no-repeat -200px 25px;
}
.next {
	right:0;
	background: #000 url('https://lh4.googleusercontent.com/-JN1IZLtuToI/UUoZnMG3C_I/AAAAAAAAAE8/SEbJ9nqXGnY/s226/sprite.png') no-repeat -167px 25px;
}
.slider {
	/** height:100vh; **/
    height: 450px;
	position: relative;
}
.slide {
	position:absolute;
	height:100%;
	width:100%;
}
.slider .slide:target {
	z-index: 100;
}
.slide li img {
	max-width:100%;
	width:100%;
	position:fixed;
	left:0;
}
img.imsg {
    max-width: 100%;
    max-height: 100%;
    left: 0;
}
</style>