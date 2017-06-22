<template>
    <div id="sidebar" class="xs-m4">
        <div id="now-buzzing" class="xs-mb3">

            <div id="now-buzzing" class="xs-mb3" v-if="forum">
                <h3 class=" xs-text-2 xs-mb1"> <a id="categ" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1"> {{forum.category_name.name}}</a> </h3>
                <h1 class="title">{{forum.topic}}
                </h1>
                <p><a id="author" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1">By {{forum.user.name}} &#183; {{timeago(forum.created_at)}}</a> </p>
                <div class="item-body">
                    <p v-html="forum.description">
                    </p>
                    <br>
                    <br>
                    <center>Comments </center>
                    <forumcomment :id="forum.id"></forumcomment>
                    <div id="connect" class="xs-mb3">
                        <a href="#" target="_blank" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> <span class="mdi-facebook-box
                       "></span> Share On Facebook </a>
                        <a href="#" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"><span class="ion-social-twitter"></span> Share On Twitter</a>


                        <p id="share-m"> <span style="    font-size: 1.7em;
                       font-weight: 900;
                       vertical-align: sub;" class="ion-android-open"> </span> 200 <span style="font-weight: 100;">SHARES</span> </p>
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
                <li class="xs-text-5 xs-mt1 xs-mb2 list-unstyled" v-for="(ho, index) in hot" v-if="index < 6">
                    <div class="col xs-col-7 xs-text-left xs-text-6 text-gray-lightest">Last Activity : {{hottago(ho)}}</div>
                    <br>
                    <br>
                    <router-link :to="{ name: 'single_forum', params: { id: ho.id, name: respace(ho.topic) }}" style="color: grey;">
                        <h4>{{ho.topic}}</h4>
                    </router-link> <br><br>
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

        </div>

    </div>
</template>

<script>
    import forumcomment from './forumcomment'
    export default {
        props: ['id', 'name'],
        data: function() {
            return {

                forum: {},
                hot: []
            }
        },
        created: function() {

            this.getforum();
            this.gethots();
        },
        components: {
            forumcomment
        },
        methods: {
            gethots: function() {
                axios.get('/hotforum')
                    .then(response => {
                        var list = response.data;
                        list = list.sort(function(a, b) {
                            return a.comments.length - a.comments.length;
                        });
                        this.hot = list;

                    })
                    .catch(e => {

                    });
            },
            respace: function(str) {
                        return str.replace(/ /g, "_");
                  },
            getforum: function() {
                axios.get('/thisforum/' + this.id)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.forum = response.data;

                    })
                    .catch(e => {

                    });
            },
            hottago: function(obj){


                if (obj.comments != undefined && obj.comments.length != 0) {
                    var last = obj.comments[obj.comments.length - 1];
                    return this.timeago(last.updated_at);
                }
                return "No activity yet";

            },
            timeago: function(time) {
                return moment(time).fromNow();
            }
        },
        computed: {
        }
    }
</script>
