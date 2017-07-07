<template>
    <div id="forumcomponent">
        <clip-loader v-if="loading" color="blue"></clip-loader>
        <div class="row">
            <!-- create a topic -->
            <div v-if="loggedin" class="container" style="margin-top:1em;background:#f7f9fa;height: 561px;width: 98%;border: 1px solid #ddd;">
                <div class="row product" style="background-image:url('https://www.dropbox.com/cms/content/dam/dropbox/www/en-us/help/170222_CX_HelpCenter_Production_Header.svg');background-repeat:no-repeat;background-position:bottom;">
                    <div class="col-md-7 col-md-offset-3" style="margin-bottom:2em;">
                        <h2 style="text-align:center;margin-top:2em;font-size: 45px;font-family: 'Circular-light';">Hey, What's on your mind?</h2>
                        <h6 style="text-align:center;margin-top:0;font-size: 18px;opacity: 0.3;">Discuss &amp; discover topics that interest you.</h6>
                        <textarea v-model="whatsonyourmind" style="width:100%;height:100px;margin-bottom:0;margin-top:2em;outline:none;font-size: 1.3em;padding-left:2em;padding-top:1em;font-family: 'Circular-Book';color: #000;border-radius:51px;"></textarea>
                        <h6 style="text-align:center;margin-top:0;"></h6>
                        <h6 style="margin-top:0;margin-bottom:15em;width:100%;">Choose a category <select class="js-example-placeholder-single" v-model="selcat">
          <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
        </select>
                            <button class="btn btn-primary" :disabled="(whatsonyourmind =='' || whatsonyourmind.length < 10)" @click="postforum()" type="button"  style="float:right;background-color:rgb(7,17,254);border:none;border-radius: 50px;width: 144px;height: 43px;">Publish </button></h6>
                    </div>
                </div>
            </div>
    
            <!-- advert -->
            <div class="col-md-12">
                <a v-if="forum_chart[0]" :href="forum_chart[0].url">
                    <adimage :src="'/'+forum_chart[0].image_url" width="100%" height="100%" style="padding: 1em;"></adimage>
                </a>
            </div>
    
    
            <!-- 3 grid for forum topics -->
            <div class="col-md-12">
                <br><br><br>
                <div class="col-md-9">
                    <div class="panel shadowed">
    
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
                                <adimage :src="'/'+forum_chart[1].image_url" width="100%" height="100%" style="padding: 1em;"></adimage>
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
                loading: true,
                forums: [],
                loggedin: localStorage.getItem('username') ? true : false,
                categories: [],
                whatsonyourmind: '',
                selcat: ''
            }
        },
        components: {
            forumads
        },
        created: function() {
            this.getforums();
            this.forumcategories();
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
                        this.loading = false;
                    })
                    .catch(e => {
    
                    });
            },
            timeago: function(time) {
                return moment(time).fromNow();
            },
            postforum: function() {
                if (this.whatsonyourmind != '' && this.selcat !="") {
                    axios.post('/forum_create', {
                            content: this.whatsonyourmind,
                            category:this.selcat
                        })
                        .then((response) => {
                            //console.log(response);
                           this.$router.push({ name: 'forum', params: { id: response.data.id, name: response.data.topic }});
                        })
                        .catch((error) => {
                            swal("An error occured. We were unable to post your topic. Our development team has been notified of this error. Error id:"+Math.floor(Math.random() * (10000-25 + 1) + 7500));
                        });
                }
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
            },
            forumcategories: function() {
                axios.get('/forum_category')
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(e => {
    
                    });
    
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