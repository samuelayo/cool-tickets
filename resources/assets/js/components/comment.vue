<template>
    <div class="comments">
        <clip-loader v-if="loading" color="blue"></clip-loader>
    
        <div id="login" v-if="!loggedin">
            <div class="row margin-bottom-10">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <a :href="'/auth/facebook?curr='+$route.path" class="btn btn-lg waves-effect waves-light  btn-block facebook" style="
            border-radius: 40px;
            height: 50px;
            color: #fff !important;-webkit-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
        -moz-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
        box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            padding-top: .7em !important;
            background-image: linear-gradient(to top, #1e3c72 0%, #1e3c72 1%, #2a5298 100%);
        ">
                        <span style="
            border-right: 1px solid #fff;
            margin-right: 1em;
            padding-right: 1em;
        " class="ion-social-facebook"> </span> Sign in with Facebook</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <a :href="'/auth/twitter?curr='+$route.path" class="btn btn-lg  waves-effect waves-light btn-block twitter" style="
            border-radius: 40px;
            height: 50px;-webkit-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
        -moz-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
        box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            color: #fff !important;
            padding-top: .7em !important;
            background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);
                                                                                                      "> <span class="ion-social-twitter" style="
            border-right: 1px solid #fff;
            margin-right: 1em;
            padding-right: 1em;
        "></span> Sign in with Twitter</a>
                </div>
            </div>
    
        </div>
    
        <form action="" @submit.prevent="edit ? editComment(comment.id) : createComment()" v-if="loggedin">
            <div class="form-group col-md-12">
                <div class="form-group col-md-12"> <textarea name="comment" id="textarea" placeholder=" Write your response" rows="3" class="form-control" style="
           padding: 1em;
            border: none;
            width: 100%;
            border-radius: 10px;
            font-family: Circular-light;
            font-size: 1.5em;
            box-shadow: rgba(0, 0, 0, 0.07) -1px 9px 53px -6px;
            background-image: url(http://i.imgur.com/8BNiTwp.png);
            background-repeat: no-repeat;
            text-indent: 2em;
            background-position: 2% 15%;
        " v-model="comment.body"></textarea> <br> <button style="
            font-family: 'Circular-Book';
            width: 200px;
            text-transform: capitalize !important;
            height: 49px;
            background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%)!important;
            color: #fff;
            font-size: 1.1em;
            -webkit-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            -moz-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            border: none;
            border-radius: 45px;
        " class="btn btn-primary" type="submit">Add Comment</button></div>
    
            </div>
        </form>
    
        <div class="post-comments col-md-12">
    
            <div class="row">
                <div class="media" v-for="(comment, index) in getChildren(null)" v-if="index < load_limit">
                    <!-- first comment -->
    
    
    
                    <div class="panel-collapse collapse in" id="collapseThree">
                        <!-- media-left -->
                        <div class="media-body">
    
                            <p>
                                <span style="float: right;">
                                          <a class="" role="button" class="btn btn-primary" style="color: black !important; border: none !important;" @click="childreply(comment.id)"  v-if="loggedin"><span class="ion-ios-undo-outline"> </span>                            &nbsp; reply</a>
                                </span>
                                <span class="" style="
            display: block;
            font-size: .8em;
            margin-bottom: 4px;
            color: #607490 !important;
        "> {{username(comment.creator_id)}}</span>
                                <span style="
            display: block;
            font-size: .6em;
            color: rgba(0,0,0,.44)!important;
            margin-bottom: 12.5px;
            font-family: 'Circular-Book';
        ">{{timeago(comment.created_at)}}</span> {{comment.body}}
                            </p>
                            <div class="comment-meta">
    
    
                            </div>
    
    
    
                            <div class="media" v-for="com in getChildren(comment.id)">
                                <!-- first comment -->
    
    
    
                                <div class="panel-collapse collapse in" id="collapseThree">
                                    <!-- media-left -->
                                    <div class="media-body">
                                        <p>
                                            <span style="float: right;">
                                          <a class="" role="button" class="btn btn-primary" style="color: black !important; border: none !important;" @click="childreply(com.id)"  v-if="loggedin"><span class="ion-ios-undo-outline"> </span>                                        &nbsp; reply</a>
                                            </span>
                                            <span class="" style="
            display: block;
            font-size: .8em;
            margin-bottom: 4px;
            color: #607490 !important;
        "> {{username(com.creator_id)}}</span>
                                            <span style="
            display: block;
            font-size: .6em;
            color: rgba(0,0,0,.44)!important;
            margin-bottom: 12.5px;
            font-family: 'Circular-Book';
        ">{{timeago(com.created_at)}}</span> {{com.body}}
                                        </p>
                                        <div class="comment-meta">
    
    
                                        </div>
                                        <!-- comment-meta -->
    
    
                                        <div class="media" v-for="co in getChildren(com.id)">
                                            <!-- first comment -->
    
    
    
                                            <div class="panel-collapse collapse in" id="collapseThree">
                                                <!-- media-left -->
                                                <div class="media-body">
                                                    <p>
                                                        <span style="float: right;">
                                          <a class="" role="button" class="btn btn-primary" style="color: black !important; border: none !important;" @click="childreply(co.id)"  v-if="loggedin"><span class="ion-ios-undo-outline"> </span>                                                    &nbsp; reply</a>
                                                        </span>
                                                        <span class="" style="
            display: block;
            font-size: .8em;
            margin-bottom: 4px;
            color: #607490 !important;
        "> {{username(co.creator_id)}}</span>
                                                        <span style="
            display: block;
            font-size: .6em;
            color: rgba(0,0,0,.44)!important;
            margin-bottom: 12.5px;
            font-family: 'Circular-Book';
        ">{{timeago(co.created_at)}}</span> {{co.body}}
                                                    </p>
                                                    <div class="comment-meta">
    
    
                                                    </div>
                                                    <!-- comment-meta -->
                                                    <!-- answer to the first comment -->
    
    
    
    
                                                    <div class="media" v-for="c in getChildren(co.id)">
                                                        <!-- first comment -->
    
    
    
                                                        <div class="panel-collapse collapse in" id="collapseThree">
                                                            <!-- media-left -->
                                                            <div class="media-body">
                                                                <p>
                                                                    <span style="float: right;">
                                          <a class="" role="button" class="btn btn-primary" style="color: black !important; border: none !important;" @click="childreply(c.id)"  v-if="loggedin"><span class="ion-ios-undo-outline"> </span>                                                                &nbsp; reply</a>
                                                                    </span>
                                                                    <span class="" style="
            display: block;
            font-size: .8em;
            margin-bottom: 4px;
            color: #607490 !important;
        "> {{username(c.creator_id)}}</span>
                                                                    <span style="
            display: block;
            font-size: .6em;
            color: rgba(0,0,0,.44)!important;
            margin-bottom: 12.5px;
            font-family: 'Circular-Book';
        ">{{timeago(c.created_at)}}</span> {{c.body}}
                                                                </p>
                                                                <div class="comment-meta">
    
                                                                </div>
                                                                <!-- comment-meta -->
                                                                <!-- answer to the first comment -->
    
                                                            </div>
                                                        </div>
                                                        <!-- comments -->
    
                                                    </div>
    
                                                </div>
                                            </div>
                                            <!-- comments -->
    
                                        </div>
                                        <!-- answer to the first comment -->
    
                                    </div>
                                </div>
                                <!-- comments -->
    
                            </div>
                            <!-- first comment -->
    
    
    
    
                            <!-- comment-meta -->
                            <!-- answer to the first comment -->
    
    
                        </div>
    
                    </div>
    
    
    
                    <br>
                </div>
                <!-- first comment -->
    
            </div>
    
        </div>
        <!-- post-comments -->
        <div class="media-body" v-if="load_limit!=10000000000">
            <p> <span style="display: block;text-align: center;font-size: 0.8em;margin-bottom: 4px;font-family: 'Circular-book';color: rgb(96, 116, 144) !important;"><a href="#" @click="load_limit=10000000000">Show all responses</a></span> </p>
            <div class="comment-meta"></div>
        </div>
    
        <a href="#openModal" id="open" style="display: none;">Open Modal</a>
    
        <div id="openModal" class="modalDialog">
            <div>
                <a href="#close" id="close" title="Close" class="close">X</a>
    
                <div>
    
                    <textarea name="comment" id="textarea" ref="textarea" placeholder=" Write your responses" rows="3" class="form-control" style="
           padding: 1em;
            border: none;
            width: 100%; 
            margin-top: 1.2em;
            border-radius: 10px;
            font-family: Circular-light;
            font-size: 1.5em;
            box-shadow: rgba(0, 0, 0, 0.07) -1px 9px 53px -6px;
            background-image: url(http://i.imgur.com/8BNiTwp.png);
            background-repeat: no-repeat;
            text-indent: 2em;
            background-position: 2% 15%;
        " v-model="comment.body"></textarea>
    
                    <br> <button style="
            font-family: 'Circular-Book';
            width: 200px;
            text-transform: capitalize !important;
            height: 49px;
            background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%)!important;
            color: #fff;
            font-size: 1.1em;
            -webkit-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            -moz-box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            box-shadow: -1px 9px 94px -6px rgba(0,0,0,0.36);
            border: none;
            border-radius: 45px;
        " class="btn btn-primary" type="submit" v-show="!edit" @click="childsubmit()">Add Comment</button></div>
            </div>
        </div>
    </div>
    
    
    
    
    
    </div>
</template>

 




<script>
    function getNestedChildren(arr, parent) {
        var out = []
        for (var i in arr) {
            if (arr[i].parent_id == parent) {
                var children = getNestedChildren(arr, arr[i].id)
    
                if (children.length) {
                    arr[i].children = children
                }
                out.push(arr[i])
            }
        }
        return out
    }

    var ds = deepstream('wss://coolfm.ng:6020').login();
    var record = ds.record.getRecord('post-comment');
    
    export default {
        props: ['id'],
        data: function() {
            return {
                
                users: [],
                load_limit: 4,
                edit: false,
                comments: [],
                comment: {
                    title: '',
                    body: '',
                    id: '',
                },
                replyid: 0,
                loggedin: localStorage.getItem('username') ? true : false,
                loading: true
            }
        },
    
        created: function() {
            record.subscribe('comments', (value)=> {
                
                if(value.data.all_comments.length !=0 && value.data.all_comments[0].commentable_id == this.id){
                    this.comments = value.data.all_comments;
                }
                
            })
    
        },
        mounted: function() {
            this.all_users();
    
            this.fetchComments();
    
        },
    
        methods: {
            fetchComments: function() {
                axios.get("/post/" + this.id + "/comments")
                    .then((response) => {
                        this.comments = response.data;
                        this.loading = false;
                    });
            },
            broadcasted: function() {
            },
            all_users: function() {
                axios.get("/all_users")
                    .then((response) => {
                        this.users = response.data;
                    });
    
            },
            username: function(userid) {
    
                for (var i = 0; i < this.users.length; i++) {
                    if (this.users[i].id == userid) {
    
                        return this.users[i].name;
                    }
                }
            },
            createComment: function() {
                axios.post("/post/" + this.id + "/comment", this.comment)
                    .then((response) => {
                        this.comment.body = '';
                        //this.comments = response.data;
                        record.set('comments', response.data);
                    });
            },
            childreply: function(id) {
    
                this.replyid = id;
                document.getElementById('open').click();
            },
            childsubmit: function() {
                var comment = this.comment;
                comment.parent_id = this.replyid;
                axios.post("/post/" + this.id + "/comment", this.comment)
                    .then((response) => {
                        this.comment.body = '';
    
                        document.getElementById('close').click();
                        record.set('comments', response.data);
                    });
            },
            getChildren: function(id) {
    
                return this.comments.filter(function(el) {
                    return el.parent_id == id;
                })
            },
            timeago: function(time) {
                return moment(time).fromNow();
            }
        },
        watch: {
            id: function() {
                this.all_users();
                this.fetchComments();
            }
        },
        computed: {
            record: function() {
                return this.ds.record.getRecord('forum-comment');
            }
    
        }
    
    
    }
</script>

<style>
    .post-comments {
        padding-bottom: 9px;
        margin: 5px 0 5px;
    }
    
    .comments-nav {
        border-bottom: 1px solid #eee;
        margin-bottom: 5px;
    }
    
    .post-comments .comment-meta {
        border-bottom: 1px solid #eee !important;
        margin-bottom: 5px;
    }
    
    .post-comments .media {
        border-left: 1px dotted #f9f9f9;
        border-bottom: 1px dotted #f9f9f9;
        margin-bottom: 5px;
        padding-left: 10px;
    }
    
    .post-comments .media-heading {
        font-size: 12px;
        color: grey;
    }
    
    .post-comments .comment-meta a {
        font-size: 12px;
        color: grey;
        font-weight: bolder;
        margin-right: 5px;
    }
    
    .modalDialog {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 99999;
        opacity: 0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    
    .modalDialog:target {
        opacity: 1;
        pointer-events: auto;
    }
    
    .modalDialog>div {
        width: 400px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
    }
    
    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }
    
    .close:hover {
        background: #00d9ff;
    }
    
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    
    .form-signin .checkbox {
        font-weight: normal;
    }
    
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
    
    .form-signin .form-control:focus {
        z-index: 2;
    }
    
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .form-signin input[type="password"] {
        margin-bottom: -1px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    
    .login-btn {
        margin-top: 10px;
    }
    
    .or-social {
        text-align: center;
        margin: 10px 0 10px 0;
    }
    
    .facebook {
        color: white;
        outline: none;
        background-color: #4863ae;
        border-color: #4863ae;
    }
    
    .facebook:hover {
        background-color: #2871aa;
        border-color: #2871aa;
    }
    
    .twitter {
        color: white;
        outline: none;
        background-color: #46c0fb;
        border-color: #46c0fb;
    }
    
    .twitter:hover {
        background-color: #00c7fb;
        border-color: #00c7fb;
    }
    
    .google {
        color: white;
        outline: none;
        background-color: #DD4B39;
        border-color: #DD4B39;
    }
    
    .google:hover {
        background-color: #e15f4f;
        border-color: #e15f4f;
    }
    
    .github {
        color: white;
        outline: none;
        background-color: #4183C4;
        border-color: #4183C4;
    }
    
    .github:hover {
        background-color: #5490ca;
        border-color: #5490ca;
    }
    
    .margin-bottom-10 {
        margin-bottom: 10px;
    }
    
    [type=checkbox]:checked,
    [type=checkbox]:not(:checked) {
        position: absolute;
        left: -9999px;
        visibility: hidden;
    }
    
    [type=checkbox],
    [type=radio] {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0;
    }
    
    [type=checkbox]+label {
        position: relative;
        height: 25px;
    }
    
    [type=checkbox]+label:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 18px;
        height: 18px;
        z-index: 0;
        border: 2px solid #5a5a5a;
        border-radius: 1px;
        margin-top: 2px;
        -webkit-transition: .2s;
        -moz-transition: .2s;
        -o-transition: .2s;
        -ms-transition: .2s;
        transition: .2s;
    }
    
    [type=radio]:checked+label,
    [type=radio]:not(:checked)+label,
    [type=checkbox]+label {
        -khtml-user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        cursor: pointer;
        font-size: 1rem;
        padding-left: 35px;
        display: inline-block;
        line-height: 25px;
    }
    
    [type=checkbox]:checked+label:before {
        top: -4px;
        left: -3px;
        width: 12px;
        height: 22px;
        border-top: 2px solid transparent;
        border-left: 2px solid transparent;
        border-right: 2px solid #4285F4;
        border-bottom: 2px solid #4285F4;
        -webkit-transform: rotate(40deg);
        -moz-transform: rotate(40deg);
        -ms-transform: rotate(40deg);
        -o-transform: rotate(40deg);
        transform: rotate(40deg);
        -webkit-backface-visibility: hidden;
        -webkit-transform-origin: 100% 100%;
        -moz-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
        -o-transform-origin: 100% 100%;
        transform-origin: 100% 100%;
    }
    
    [type=checkbox]+label:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 18px;
        height: 18px;
        z-index: 0;
        border: 2px solid #5a5a5a;
        border-radius: 1px;
        margin-top: 2px;
        -webkit-transition: .2s;
        -moz-transition: .2s;
        -o-transition: .2s;
        -ms-transition: .2s;
        transition: .2s;
    }
    
    .comment .error-text {
        color: #F44336 !important;
        transition: .2s opacity ease-out, .2s color ease-out;
    }
    
    .comments .btn {
        padding: 3px 10px !important;
    }
    
    .comments .btn-primary {
        color: blue;
        background: none !important;
        color: #ddd;
        margin-bottom: 1em !important;
        text-transform: lowercase !important;
    }
    
    .comments .label-info {
        background: none !important;
        color: #000;
    }
    
    .comments .media-body p {
        background: #fff !important;
        padding: 1.8em!important;
        font-family: 'Circular-Light';
        border: 1px solid #f7f7f7;
        -webkit-box-shadow: -1px 9px 53px -6px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: -1px 9px 53px -6px rgba(0, 0, 0, 0.07);
        box-shadow: -1px 9px 53px -6px rgba(0, 0, 0, 0.07);
        font-size: 1.5em;
    }
    
    .comments .label-info {
        background: none !important;
        font-size: .9em !important;
    }
    
    .comments .label-info:after {
        background: none !important;
        font-size: .9em;
        content: ' /';
    }
</style>
