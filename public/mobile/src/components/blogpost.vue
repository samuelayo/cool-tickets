<template>
  <div id="sidebar" class="xs-m4">
    <center><clip-loader v-if="loading" color="blue"></clip-loader></center>
    <div id="now-buzzing" class="xs-mb3">


      <br>

      <div id="now-buzzing" class="xs-mb3" v-if="post.title">

        <h3 class=" xs-text-2 xs-mb1"> <a id="categ" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1">{{post.category.name}}</a> </h3>

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

          <br>
          
          <slider animation="fade" :auto="false" v-if="(sliderimages && sliderimages.length !=0)">
              <slider-item v-for="(slide, index) in sliderimages" :key="index">
                  <img :src="'/uploads/'+slide" class="imsg">
              </slider-item>
          </slider>

          <br>

          <div id="connect" class="xs-mb3"><a onclick="sharon.facebook()" class="button button--facebook xs-col-12 xs-text-left xs-mb1 border-radius: 43px;"><span class="ion-social-facebook" style="margin-right: .5em;border-right: 1px solid #fff;padding-right: 1em;margin-left: 0.1em;"></span> Share On Facebook </a>          <a onclick="sharon.twitter()" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"><span class="ion-social-twitter" style="
                    margin-right: .5em;
                    border-right: 1px solid #fff;
                    padding-right: .6em;

                "></span> Share On Twitter</a>
            <p id="share-m"><span class="ion-android-open" style="font-size: 1.7em; font-weight: 900; vertical-align: sub;"></span> {{post.view_count}} <span style="font-weight: 100;">SHARES</span></p>
          </div>

           <comment v-if="post.id" :id="post.id"></comment>
        </div>
      </div>

      <div id="now-buzzing" class="xs-mb3">
        <h3 style="color: black;
                    font-size: 1.4em  !important;
                    font-weight: 900;
                    letter-spacing: -1px;" class="xs-mb1">
          Related Posts
        </h3>
      </div>

      <div id="vertical-feed" class="">
        <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
          <div class="xs-text-left text-gray">
            <ul class="list-unstyled">
              <li class="xs-col-12 xs-mb2" v-for="rel in related_posts" v-if="(post.id && rel.id != post.id)">

                <router-link class="bold text-gray" v-bind:to="{ name: 'blogpost', params: { id: rel.id, title: rel.title }}">
                  <img class="buzz-image xs-block xs-mb05" :src="rel.image">

                  <P id="post-cat-m"> {{rel.category.name}} </P>
                  <h4 class="xs-text-4 lg-text-3">{{rel.title}}</h4>
                </router-link>
                <p id="share-m"> <span style="    font-size: 1.7em;
                    font-weight: 900;
                    vertical-align: sub;" class="ion-android-open"> </span> &nbsp {{rel.view_count}} <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span> <span style="font-weight: 100;">3 HOURS AGO</span> </p>

              </li>
            </ul>
          </div>
        </div>
      </div>
      <br>

    </div>

    <br>
    



  </div>
</template>

<script>
  import comment from './comment'
  import {
    Slider,
    SliderItem
  } from 'vue-easy-slider'
  export default {
    name: 'blogpost',
    data: function() {
      return {
        post: {},
        sliderimages: [],
        keypoints: [],
        related_posts: [],
        hotlimit: 2,
        hot: [],
        totalshares: 0,
        loading: true
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
          this.fetch_related();
          this.loading = false;
        })
        .catch(e => {

        });
      //this.getshows();

    },
    components: {
      comment,
      Slider,
      SliderItem
    },
    methods: {
      fetch_related: function() {


        axios.get('/related/' + this.post.category.id)
          .then(response => {
            // JSON responses are automatically parsed.
            //alert('related');
            var answer = _.groupBy(response.data, function(car) {
              return car.state;
            });
            this.schedule = answer;

          })
          .catch(e => {

          });

      },
      timeago: function(time) {
        return moment(time).fromNow();
      },
      hottimeago: function(obj) {
        if (obj.comments != undefined && obj.comments.length != 0) {
          var last = obj.comments[obj.comments.length - 1];
          return this.timeago(last.updated_at);
        }
        return "No activity yet";
      },
       respace: function(str) {
        return str.replace(/ /g, "_");
      },
      hotclick: function() {
        this.hotlimit = 4;
      }

    },
    computed: {

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
