<template>
    <div id="sidebar">
        <clip-loader v-if="loading" color="blue"></clip-loader>
        <div class="col-md-3">
            <!-- post sidebar -->
            <ins class="adsbygoogle panel panel-default shadowed"
                 style="display:block; height: auto;"
                 data-ad-client="ca-pub-4448078976745099"
                 data-ad-slot="3011460081"
                 data-ad-format="auto"></ins>

            <div class="row">
                <h4 style="text-align: center;"><strong>TRENDING</strong></h4><br>
                <div id="advert-side" class="panel panel-default shadowed" style="margin-right: 1em;">
                    <!-- <img src="img/sq_ad.png" width="100%"/> -->
                    <div><br><br><br>
                        <!-- trending posts -->
                        <div class="row">
                            <div class="col-md-12 tr_content" v-for="trend in trending">
                                <div class="col-md-4">
                                    <img :src="trend.image" width="100%" height="100%"/>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="category-tag" style="margin-top: 1em;"><span id="tag-cat">{{trend.category.name}}</span>
                                    </h4>
                                    <router-link
                                            v-bind:to="{ name: 'blogpost', params: { id: trend.id, title: respace(trend.title) }}"
                                            style="margin-top: 1em;">
                                        <h4>{{trend.title}}</h4>
                                    </router-link>
                                    <i style="color: blue;" class="ion-android-open" aria-hidden="true"></i>

                                    <a href="#">{{trend.view_count | money }} shares</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: 'sidebar',
        data: function () {
            return {
                trending: window.Laravel.trending,
                hot: [],
                loading: true
            }
        },
        created: function () {
            this.gethots();

            function loadScript(url) {
                return new Promise(function (resolve, reject) {
                    var script = document.createElement("script")
                    script.type = "text/javascript";
                    if (script.readyState) { //IE
                        script.onreadystatechange = function () {
                            if (script.readyState == "loaded" ||
                                script.readyState == "complete") {
                                script.onreadystatechange = null;
                                resolve();
                            }
                        };
                    } else { //Others
                        script.onload = function () {
                            resolve();
                        };
                    }
                    script.src = url;
                    document.getElementsByTagName("head")[0].appendChild(script);
                });
            }

            ///adsense
            loadScript("//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js").then(function () {
                (window.adsbygoogle = window.adsbygoogle || []).push({})
            });
        },
        methods: {
            timeago: function (time) {
                return moment(time).fromNow();
            },
            respace: function (str) {
                return str.replace(/ /g, "_");
            },
            gethots: function () {
                axios.get('/hotforum')
                    .then(response => {

                        var list = response.data;
                        list = list.sort(function (a, b) {
                            return a.comments.length - a.comments.length;
                        });
                        this.hot = list;
                        this.loading = false;

                    })
                    .catch(e => {

                    });
            },
            hottimeago: function (obj) {
                if (obj.comments != undefined && obj.comments.length != 0) {
                    var last = obj.comments[obj.comments.length - 1];
                    return this.timeago(last.updated_at);
                }
                return "No activity yet";
            }
        }
    }
</script>