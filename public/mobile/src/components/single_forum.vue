<template>
    <div id="sidebar" class="xs-m4">
        <div id="now-buzzing" class="xs-mb3">

            <div id="now-buzzing" class="xs-mb3" v-if="forum.user">
                <h3 class=" xs-text-2 xs-mb1"> <a id="categ" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1"> {{forum.category_name.name}}</a> </h3>
                <h1 class="title">{{forum.topic}}
                </h1>
                <p><a id="author" href="#" target="_blank" class="button  xs-col-12 xs-text-left xs-mb1">By {{forum.user.name}} &#183; {{timeago(forum.created_at)}}</a> </p>
                <div class="item-body">
                    <p v-html="forum.description">
                    </p>
                    <br>
                    <div id="connect" class="xs-mb3">
                        <a href="#" target="_blank" class="button button--facebook xs-col-12 xs-text-left xs-mb1"> <span class="mdi-facebook-box
                       "></span> Share On Facebook </a>
                        <a href="#" class="button button--twitter button--icon xs-col-12 xs-text-left xs-mb1"><span class="ion-social-twitter"></span> Share On Twitter</a>


                        <p id="share-m"> <span style="    font-size: 1.7em;
                       font-weight: 900;
                       vertical-align: sub;" class="ion-android-open"> </span> 200 <span style="font-weight: 100;">SHARES</span> </p>
                    </div>
                    <forumcomment :id="forum.id"></forumcomment>
                </div>
            </div>
            <br>
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
