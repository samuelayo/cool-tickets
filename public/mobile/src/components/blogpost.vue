<template>
  <div id="sidebar" class="xs-m4">

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
          <comment v-if="post.id" :id="post.id"></comment>
          <div id="connect" class="xs-mb3"><a onclick="sharon.facebook()" class="button button--facebook xs-col-12 xs-text-left xs-mb1 border-radius: 43px;"><span class="ion-social-facebook" style="margin-right: .5em;border-right: 1px solid #fff;padding-right: 1em;margin-left: 0.1em;"></span> Share On Facebook </a>          <a onclick="sharon.twitter()" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"><span class="ion-social-twitter" style="
                    margin-right: .5em;
                    border-right: 1px solid #fff;
                    padding-right: .6em;

                "></span> Share On Twitter</a>
            <p id="share-m"><span class="ion-android-open" style="font-size: 1.7em; font-weight: 900; vertical-align: sub;"></span> 0 <span style="font-weight: 100;">SHARES</span></p>
          </div>

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
                    vertical-align: sub;" class="ion-android-open"> </span> &nbsp 200 <span style="font-weight: 100;">SHARES</span> <span style="font-weight: 100; opacity: .3;">/</span> <span style="font-weight: 100;">3 HOURS AGO</span> </p>

              </li>
            </ul>
          </div>
        </div>
      </div>
      <br>

    </div>

    <h3 class=" xs-text-2 xs-mb1">
      <a style="background: #f83600 !important; text-transform: uppercase;
                    font-weight: 900; " href="#" target="_blank" class="button button--title xs-col-12 xs-text-left xs-mb1"> <span class="ion-ios-flame"></span> Hot</a>
    </h3><br>
    <div id="news" class="card xs-mb2 xs-p2">
      <div id="news-header" class="clearfix">
        <div class="col xs-col-5">

        </div>

      </div>
      <ul id="news-list" class="xs-p0">
        <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled" v-for="(ho, index) in hot" v-if="index < hotlimit">
          <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottimeago(ho)}}</div><br>
          <a href="#" class="link-gray">
                             {{ho.topic}}
                            </a> <br><br>
          <small style="color:red;">
                                         In this conversation
                                         </small><br>
          <p></p>
          <div id="convert">
            <img class="conversation" src="img/4671_1.png" />
            <img class="conversation2" src="img/s.png" />
            <img class="conversation2" src="img/33.png" />
            <img class="conversation2" src="img/3e.png" />
            <span style="color: #007adf; font-size: 15px;font-size: 15px;
                    vertical-align: super;">+ {{ho.comments.length-4}}</span>
          </div>
          <hr>
        </li>
      </ul>

      <a href="javascript::void" class="xs-block xs-text-5 bold" @click="hotclick()">+ Show more</a>
    </div>



  </div>
</template>

<script>
  import comment from './comment'
  export default {
    name: 'blogpost',
    data: function() {
      return {
        post: {},
        keypoints: [],
        related_posts: [],
        hotlimit: 2,
        hot: [],
        totalshares: 0
      }
    },
    created: function() {

      this.gethots();
      this.shares();
      axios.get('/posts/' + this.$route.params.id)
        .then(response => {
          // JSON responses are automatically parsed.
          this.post = response.data;
          this.loading = false;
          var str = this.post.keypoints;
          this.keypoints = str.match(/<p>.*?<\/p>/g);
          this.fetch_related();
        })
        .catch(e => {

        });
      //this.getshows();

    },
    components: {
      comment
    },
    methods: {
      fetch_related: function() {


        axios.get('/related/' + this.post.category.id)
          .then(response => {
            // JSON responses are automatically parsed.
            //alert('related');
            this.schedule = _.groupBy(response.data, function(car) {
              return car.state;
            });


          })
          .catch(e => {

          });

      },
      timeago: function(time) {
        return moment(time).fromNow();
      },
      hotclick: function() {
        this.hotlimit = 4;
      },
      shares: function() {
        sharon.facebook.count((err, count) => {
          this.totalshares += count;
          //console.log('Whoa, we have ' + count + ' shares!');
        });

      },
      gethots: function() {
        axios.get('/hotforum')
          .then(response => {

            var list = response.data;
            list = list.sort(function(a, b) {
              return getValue(a.comments.length) - getValue(a.comments.length);
            });
            this.hot = list;

          })
          .catch(e => {

          });
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
