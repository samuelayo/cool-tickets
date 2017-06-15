<template>
    <div id="forumcomponent">
        <div class="row">
            <!-- advert -->
            <div class="col-md-12">
                <a v-if="forum_chart[0]" :href="forum_chart[0].url">
                    <adimage :src="'/'+forum_chart[0].image_url" width="100%" height="100%"></adimage>
                </a>
            </div>
            <!-- 3 grid for trending, rising and hot topics -->
            <div class="col-md-12">
                <br><br><br>
                <div class="col-md-9">
                    <div class="panel">
                        <br>
                        <h3 style="text-align: center; font-weight: 700;">FORUM</h3>
                        <br>
                        <div class="article">
                            <div id="forum-div" class="container-fluid">
                                <table class="my_table">
                                    <tr>
                                        <th>Topic </th>
                                        <th>Last Activity</th>
                                        <th>Replies</th>
                                        <th>In this conversation</th>
                                        <th>Category</th>
                                    </tr>
                                    <tr v-for="forum in forums">
                                        <td class="forum-topic">
                                            <router-link :to="{ name: 'forum', params: { id: forum.id, name:respace(forum.topic) }}"> {{forum.topic}}</router-link>
                                        </td>
                                        <td>{{hottimeago(forum)}}</td>
                                        <td>{{forum.comments.length}}</td>
                                        <td>
                                            <span id="convert">
                                     <adimage src="/img/4671_1.png" width="100%" height="100%" sclass="conversation"></adimage>
                                     <adimage src="/img/s.png" width="100%" height="100%" sclass="conversation2"></adimage>
                                     <adimage src="/img/33.png" width="100%" height="100%" sclass="conversation2"></adimage>
                                     <adimage src="/img/3e.png" width="100%" height="100%" sclass="conversation2"></adimage>
                                     <!--    <img class="conversation" src="img/4671_1.png"/> -->
                                     <!--     <img class="conversation2" src="img/s.png"/> -->
                                     <span style="color: #007adf;">+ {{forum.comments.length-4}}</span>
                                            </span>
                                        </td>
                                        <td>{{forum.category_name.name}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end forum  ends-->
                        </div>
                        <div>
                            <div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- advert -->
                        <div class="col-md-12">
                            <a v-if="forum_chart[1]" :href="forum_chart[1].url">
                                <adimage :src="'/'+forum_chart[1].image_url" width="100%" height="100%"></adimage>
                            </a>
                        </div>
                        <div>
                            <br>
                            <div id="more" class="col-md-12">
                                <div class="row">
                                    <div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <!-- freshly pressed -->
                            <!-- trending posts -->
                            <div class="row">
                                <div class="col-md-12 tr_content">
                                </div>
                            </div>
                            <!-- -->
                        </div>
                    </div>
                </div>
                <forumads></forumads>
            </div>
        </div>
    </div>
</template>

<script>
    import forumads from './forumads'
    export default {
        name: 'forumcomponent',
        data: function() {
            return {
                forums: []
            }
        },
        components: {
            forumads
        },
        created: function() {
            this.getforums();
        },
        methods: {
            getforums: function() {
                axios.get('/getforums')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.forums = response.data;
                        var status = {
                            title: 'CoolFmNigeria | Forums topics, discuss, share your opinions',
                            description: `Get your opinions aired, lend your voice to the masses, get outspoken, use the coolfm forums`
                        }
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        this.$store.dispatch('SET_SEO', status);
                    })
                    .catch(e => {
    
                    });
            },
            timeago: function(time) {
                return moment(time).fromNow();
            },
            respace: function(str) {
                return str.replace(/ /g, "_");
            },
            hottimeago: function(obj) {
                if (obj.comments != undefined && obj.comments.length != 0) {
                    var last = obj.comments[obj.comments.length - 1];
                    return this.timeago(last.updated_at);
                }
                return "No activity yet";
            }
        },
        computed: {
            forum_chart: function() {
                var homeads = _.filter(window.Laravel.ads, function(o) {
                    if (o.advert_category.type == "forum_main") return o;
                });
                return homeads;
            }
        }
    }
</script>