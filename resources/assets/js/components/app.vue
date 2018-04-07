<template>
    <div id="app">
        <title>{{title}}</title>
        <meta name="description" :content="description"/>
        <meta name="robots" content="nodp"/>
        <meta name="author" content="ogundipe samuel">
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" :content="title"/>
        <meta property="og:description" :content="description"/>
        <meta property="og:url" content="/"/>
        <meta property="og:site_name" content="Coolfm"/>
        <meta property="og:image" content="/img/logo.svg"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:description" :content="description"/>
        <meta name="twitter:title" :content="title"/>
        <meta name="twitter:site" content="@coolfmnigeria"/>
        <meta name="twitter:image" :content="twitterimage"/>


        <div class="container">
        	<nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="#">
                <router-link to="/">
                    <img src="/img/ticket-logo.jpeg" width="150" alt="Cool Fm Tickets">
                </router-link>
            </a>
            <button class="btn ml-auto d-block d-sm-block d-md-none btn-transparent" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-search"></i>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 ml-auto d-none d-md-block">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control home-search-input" placeholder="Search for tickets"
                               aria-label="Search" aria-describedby="basic-addon2" id="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info home-search-button" type="button"><i
                                    class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link text-info" to="/vendor/register">Sell Tickets <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize btn get-app-button text-white" href="#">Get the app</a>
                        <button type="button" class="btn btn-primary" id="show" data-toggle="modal" data-target="#exampleModal" v-show="false">
                            Launch demo modal
                        </button>
                    </li>
                </ul>

            </div>
        </nav>
        </div>

        <!-- the router outlet, where all matched components would ber viewed -->
        <center>
            <!-- homepage ad -->
            <!-- homepage ad -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4448078976745099"
                 data-ad-slot="5185770514" xdata-ad-format="auto"></ins>

        </center>
        <br>
        <transition>
            <router-view></router-view>
        </transition>
        <br>
        <br>

    <search></search>
    </div>
</template>

<script>
    import $ from 'jquery'
    import search from './search'

    export default {
        name: 'app',
        data: () => {
            return {
                type: '',
                src: '',
                play: 'play',
                player: '',
                schedule: [],
                categories: Laravel.categories
            }
        },
        components: {
            search
        },
        created: function () {
            //this.schedules();
        },
        mounted: function () {
            $('#search').focus(() => {
                $('#show').trigger('click')
            });
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
            ///mailchimp
            loadScript("//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js").then(function () {
                (function ($) {
                    window.fnames = new Array();
                    window.ftypes = new Array();
                    fnames[0] = 'EMAIL';
                    ftypes[0] = 'email';
                    fnames[1] = 'FNAME';
                    ftypes[1] = 'text';
                    fnames[2] = 'LNAME';
                    ftypes[2] = 'text';
                    fnames[3] = 'BIRTHDAY';
                    ftypes[3] = 'birthday';
                }(jQuery));
                var $mcj = jQuery.noConflict(true);
            });
            //
            ///
            (function () {
                var cx = '004277073545021023643:yuy8iwmq_ky';
                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gcse, s);
            })();

        },
        computed: {
            playorpause: function () {
                if (this.$refs.ourplay != undefined) {
                    var audio = this.$refs.ourplay;
                    if (audio.paused) {
                        return 'play';
                    }
                    return 'paused';
                }
                return 'play';
            }
        },
        methods: {
            playthis: (id, type, src, name) => {
                if (type == "livestream") {
                    document.getElementById('live').style.display = 'inline-block';
                } else {
                    document.getElementById('live').style.display = 'none';
                }
                var audio = document.getElementById('ourplay');
                if (this.type == "livestream") {
                } else if (this.type == "podcast") {
                }
                audio.src = src;
                this.src = src;
                this.type = type;
                audio.play();
                if (this.type == type && this.play == 'play') {
                    this.play = 'pause';
                    audio.pause();
                } else if (this.type == type && this.play != 'play') {
                    this.play = 'play';
                    audio.play();
                }
                document.getElementById('playname').innerHTML = name;
            },
            playthat: function (id, type, src, name) {
                if (type == 'podcast' && this.play == 'pause') {
                    this.play = 'play';
                } else if (type == 'livestream') {
                    this.play = (this.play == 'pause') ? 'play' : 'pause';
                }
                this.playthis(id, type, src, name);
            },
            change_state: function (status, stream) {
                this.$store.dispatch('SET_STATE', status);
                this.$store.dispatch('SET_STREAM', stream);
            },
            schedules: function () {
                axios.get('/schedules')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.schedule = _.groupBy(response.data, function (car) {
                            return car.state;
                        });
                    })
                    .catch(e => {

                    });
            },
            between: function (start, end) {


                var format = 'hh:mm:ss'

                // var time = moment() gives you current time. no format required.
                var time = moment(),
                    beforeTime = moment(start, format),
                    afterTime = moment(end, format);

                if (time.isBetween(beforeTime, afterTime)) {

                    return 'NOW';
                } else if (beforeTime.isAfter(time)) {

                    return 'Later';

                } else {
                    return 'Ended';
                }
            },
            timeleft: function (value) {
                value = new moment(value + ":00", "HH:mm:ss a");
                return moment(value).fromNow();
            }

        },
        computed: {
            title: function () {
                return this.$store.state.title;
            },
            description: function () {
                return this.$store.state.description;
            },
            twitterimage: function () {
                return this.$store.state.twitterimage;
            },
            current_stream: function () {
                if (this.$refs.ourplay != undefined) {
                    var audio = this.$refs.ourplay;
                    audio.src = this.$store.state.current_stream;
                    audio.play();
                }
                return this.$store.state.current_stream;
            },
            current_state: function () {
                return this.$store.state.current_state;
            }
        }
    }
</script>

<!-- styling for the component -->
<style>
    .btn-transparent{
        background-color: transparent;
        margin-right: 10px;
    }

    .btn-transparent:focus{
        border: solid 0 transparent;
        background-color: transparent;
    }
    html, body, h1, h2, h3, h4, h5, h6, p, li, a, button{
        font-family: Whitney, serif !important;
    }

    #timeline {
        width: 700px;
        height: 1px;
        background: #4200f7;
        margin-top: 2%;
        float: left;
    }

    #playhead {
        width: 7px;
        height: 1px;
        background: rgba(0, 255, 196, 0.82);
    }

    audio::-webkit-media-controls-enclosure,
    video::-webkit-media-controls-enclosure {
        max-width: 100%;
    }

    /**.cse .gsc-control-cse, .gsc-control-cse{
                          padding: 0 0 0 0 !important;
                          margin: -1em !important;
                        }**/

    .cse .gsc-control-cse,
    .gsc-control-cse {
        font-family: Arial, serif !important;
        background-color: none !important;
        border: none !important;
    }

    .gsc-control-cse {
        font-family: Arial, sans-serif !important;
        border-color: none !important;
        background-color: none !important;
    }

    input#gsc-i-id1 {
        outline: none;
        background: none !important;
        text-indent: 0px !important;
        font-family: 'circular-medium' !important;
    }

    input.gsc-input {
        border-color: none !important;
    }

    input.gsc-search-button {
        background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%) !important;
        border: none !important;
        color: #fff !important;
        width: 86px !important;
        height: 31px !important;
        border-radius: 26px !important;
    }

    .cse input.gsc-input,
    input.gsc-input {
        font-family: inherit !important;
        font-size: 16px !important;
        border: none !important;
        border-bottom: 1px dashed #ddd !important;
        padding: 4px 6px !important;
        -moz-border-radius: 2px !important;
        -webkit-border-radius: 2px !important;
        border-radius: 2px !important;
    }

    .toast-success {
        background-color: #117af2 !important;
    }

    #toast-container > .toast-success {
        background-image: none !important;
    }

    #toast-container > div {
        position: relative;
        pointer-events: auto;
        overflow: hidden;
        margin: 0 0 6px;
        padding: 15px 15px 15px 10px !important;
        width: 300px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        background-position: 15px center;
        background-repeat: no-repeat;
        -moz-box-shadow: 0 0 12px #999;
        -webkit-box-shadow: 0 0 12px #999;
        box-shadow: 0 0 12px #999;
        color: #fff;
        opacity: .8;
        -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
        filter: alpha(opacity=80);
    }

    div#___gcse_0 {
        width: 90% !important;
        margin: 0 auto !important;
    }

    .cse .gsc-control-cse,
    .gsc-control-cse {
        padding: 0px !important;
        width: auto;
    }

    td.gsc-clear-button {
        width: 14px !important;
        display: none !important;
    }

    #mc_embed_signup {
        background: none;
        clear: left;
        font: 14px Helvetica, Arial, sans-serif;
    }

    #newsletter {
        -webkit-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
        -moz-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
        box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49) !important;
        font-family: 'Circular-bold' !important;
    }

    div#newsletter .button {
        border-radius: 40px;
        background-image: linear-gradient(to right, #43e97b 0%, #38f9d7 100%) !important;
        height: 49px;
        font-size: 1.3em;
        color: #fff;
        font-family: 'circular-book';
        width: 177px;
    }

    div#newsletter input {
        -webkit-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
        -moz-box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
        box-shadow: -23px 10px 93px -25px rgba(0, 0, 0, 0.49);
        background: #fff !important;
        border: 1px solid #ddd;
        border-radius: 100px;
        height: 3.5em;
    }

    div#newsletter input {
        font-family: 'Circular-Book';
        color: #000;
        font-size: 1.1em;
        outline: none;
    }

    div#newsletter label {
        font-family: 'Circular-bold' !important;
    }

    #newsletter:before {
        content: '';
        position: absolute;
        top: 71%;
        right: 100%;
        margin-top: -8px;
        width: 0;
        height: 0;
        border-right: 25px solid #fff;
        border-top: 1px solid transparent;
        border-bottom: 40px solid transparent;
    }

    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                         We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */

    @-webkit-keyframes pulse {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
        }
        70% {
            -webkit-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
        }
        100% {
            -webkit-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
        }
    }

    @keyframes pulse {
        0% {
            -moz-box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4);
        }
        70% {
            -moz-box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
            box-shadow: 0 0 0 10px rgba(204, 169, 44, 0);
        }
        100% {
            -moz-box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
            box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
        }
    }

    .pulse {
        width: 13px;
        height: 12px;
        display: inline-flex;
        border-radius: 50%;
        background: #fb0027;
        vertical-align: top;
        cursor: pointer;
        box-shadow: 0 0 0 rgba(255, 0, 20, 0.4);
        animation: pulse 2s infinite;
    }

    .pulse:hover {
        animation: none;
    }

    @-webkit-keyframes panning {
        0% {
            background-position: 0% 0%;
        }
        25% {
            background-position: 100% 100%;
        }
        50% {
            background-position: 100% 0%;
        }
        75% {
            background-position: 0 100%;
        }
        200% {
            background-position: 0 0;
        }
    }

    @keyframes panning {
        0% {
            background-position: 0% 0%;
        }
        25% {
            background-position: 100% 100%;
        }
        50% {
            background-position: 100% 0%;
        }
        75% {
            background-position: 0 100%;
        }
        200% {
            background-position: 0 0;
        }
    }
</style>
