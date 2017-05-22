<template>
  <div class="">


  <div class="post-comments col-md-12">

    <div class="row">
      <div class="media" v-for="comment in getChildren(null)" >
        <!-- first comment -->

        <div class="media-heading">
         <span class="label label-info">{{timeago(comment.created_at)}}</span> {{username(comment.creator_id)}}
        </div>

        <div class="panel-collapse collapse in" id="collapseThree">
          <!-- media-left -->
          <div class="media-body">
            <p v-html="comment.body"></p>
            <div class="comment-meta">

              <span>
                        <a class="" role="button" class="btn btn-primary" style="color: white;" @click="childreply(comment.id)" v-if="loggedin">reply</a>
                      </span>
            </div>



                <div class="media" v-for="com in getChildren(comment.id)" >
                  <!-- first comment -->

                  <div class="media-heading">
                  <span class="label label-info">{{timeago(com.created_at)}}</span> {{username(com.creator_id)}}
                  </div>

                  <div class="panel-collapse collapse in" id="collapseThree">
                    <!-- media-left -->
                    <div class="media-body">
                      <p v-html="com.body"></p>
                      <div class="comment-meta">

                        <span>
                                  <a class="" role="button" class="btn btn-primary" style="color: white;" @click="childreply(com.id)"  v-if="loggedin">reply</a>
                                </span>
                      </div>
                      <!-- comment-meta -->


                                    <div class="media" v-for="co in getChildren(com.id)" >
                                    <!-- first comment -->

                                    <div class="media-heading">
                                    <span class="label label-info">{{timeago(co.created_at)}}</span> {{username(co.creator_id)}}
                                    </div>

                                    <div class="panel-collapse collapse in" id="collapseThree">
                                      <!-- media-left -->
                                      <div class="media-body">
                                        <p v-html="co.body"></p>
                                        <div class="comment-meta">

                                          <span>
                                                    <a class="" role="button" class="btn btn-primary" style="color: white;" @click="childreply(co.id)"  v-if="loggedin">reply</a>
                                                  </span>
                                        </div>
                                        <!-- comment-meta -->
                                        <!-- answer to the first comment -->




                                                  <div class="media" v-for="c in getChildren(co.id)" >
                  <!-- first comment -->

                                                        <div class="media-heading">
                                                        <span class="label label-info">{{timeago(c.created_at)}}</span> {{username(c.creator_id)}}
                                                        </div>

                                                        <div class="panel-collapse collapse in" id="collapseThree">
                                                          <!-- media-left -->
                                                          <div class="media-body">
                                                            <p v-html="c.body"></p>
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


<a href="#openModal" id="open" style="display: none;">Open Modal</a>

<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" id="close" title="Close" class="close">X</a>
		<h2>Send reply</h2>
		 <div>
        <label for="comment">Your Comment</label>
        <textarea name="comment"  v-model="comment.body" ref="textarea"  class="form-control" id="textarea" rows="3"></textarea>
        <button type="submit" class="btn btn-primary" v-show="!edit" @click="childsubmit()">Add Comment</button>
      </div>
	</div>
</div>


   <form action="" @submit.prevent="edit ? editComment(comment.id) : createComment()" v-if="loggedin">
     <div class="form-group col-md-12">
        <label for="comment">Your Comment</label>
        <textarea name="comment"  v-model="comment.body" ref="textarea"  class="form-control" id="textarea" rows="3"></textarea>
        <button type="submit" class="btn btn-primary" v-show="!edit">Add Comment</button>
      </div>
    </form>

    <div id="login" v-if="!loggedin">
  <p style="text-align: center;" ><span style="border-bottom: 1px solid #ddd;
    vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> Please login to comment</span>  <span style="border-bottom: 1px solid #ddd;
    vertical-align: super; color: #f9f9f9; "> dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfddfdfdfddfdfd dfdfdfddfdfd dfdfdfddfdfd </span> </p>
              <div class="row margin-bottom-10" style="text-align: center;">
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <a href="/auth/facebook" class="btn btn-lg waves-effect waves-light  btn-block facebook">Facebook</a>


                  <a href="/auth/twitter" class="btn btn-lg  waves-effect waves-light btn-block twitter">Twitter</a>
              </div>
          </div>



    </div>

  </div>
</template>






<script>
var socket = io('https://coolfm.ng/socket');
 function getNestedChildren(arr, parent) {
    var out = []
    for(var i in arr) {
        if(arr[i].parent_id == parent) {
            var children = getNestedChildren(arr, arr[i].id)

            if(children.length) {
                arr[i].children = children
            }
            out.push(arr[i])
        }
    }
    return out
}

  export default{
    props: ['id'],
    data: function(){
      return {
        users: [],
        edit:false,
        comments:[],
        comment: {
          title:'',
          body: '',
          id: '',
        },
        replyid: 0,
        loggedin: localStorage.getItem('username')?true:false
      }
    },

created: function(){
  tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
   loggedin: localStorage.getItem("username")?true:false,
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });

},
  mounted: function(){
    this.all_users();
    this.fetchComments();
    this.broadcasted();
  },

  methods: {
    fetchComments: function(){
      axios.get("/post/"+this.id+"/comments")
        .then((response)=>{
          this.comments = response.data;
      });
    },
    broadcasted: function(){

      socket.on('coolfm-lagos:CommentMade', (d)=>{
        if(d.type=="blog" && d.id==this.id){
          this.comments = d.all_comments;
        }

      });
    },
    all_users: function(){
       axios.get("/all_users")
        .then((response)=>{
          this.users = response.data;
      });

    },
    username: function(userid){
      console.log('fired');
        for(var i=0; i < this.users.length; i++){
          if (this.users[i].id == userid){

            return this.users[i].name;
          }
        }
    },
    createComment: function(){
      axios.post("/post/"+this.id+"/comment", this.comment)
        .then((response)=>{
          this.comment.body= '';

      });
    },
    childreply:function(id){

      this.replyid = id;
      document.getElementById('open').click();
    },
    childsubmit: function(){
      var comment = this.comment;
      comment.parent_id = this.replyid;
      axios.post("/post/"+this.id+"/comment", this.comment)
        .then((response)=>{
          this.comment.body= '';

          document.getElementById('close').click();
      });
    },
    getChildren: function (id) {

            return this.comments.filter(function (el) {
                return el.parent_id == id;
            })
        },
        timeago: function (time){
                return moment(time).fromNow();
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
  border-bottom: 1px solid #eee;
  margin-bottom: 5px;
}

.post-comments .media {
  border-left: 1px dotted #000;
  border-bottom: 1px dotted #000;
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
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
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

.close:hover { background: #00d9ff; }

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

.login-btn{
    margin-top:10px;
}
.or-social{
    text-align:center;
    margin: 10px 0 10px 0;
}
.facebook{
    color: white;
    outline: none;
    background-color: #4863ae;
    border-color: #4863ae;
}
.facebook:hover{
    background-color: #2871aa;
    border-color: #2871aa;
}
.twitter{
    color: white;
    outline: none;
    background-color: #46c0fb;
    border-color: #46c0fb;
}
.twitter:hover{
    background-color: #00c7fb;
    border-color: #00c7fb;
}
.google{
    color: white;
    outline: none;
    background-color: #DD4B39;
    border-color: #DD4B39;
}
.google:hover{
    background-color: #e15f4f;
    border-color:#e15f4f;
}
.github{
    color: white;
    outline: none;
    background-color: #4183C4;
    border-color: #4183C4;
}
.github:hover{
    background-color: #5490ca;
    border-color:#5490ca;
}
.margin-bottom-10{
    margin-bottom:10px;
}
[type=checkbox]:checked, [type=checkbox]:not(:checked) {
    position: absolute;
    left: -9999px;
    visibility: hidden;
}
[type=checkbox], [type=radio] {
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
[type=radio]:checked+label, [type=radio]:not(:checked)+label, [type=checkbox]+label {
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
.error-text{
    color: #F44336;
    transition: .2s opacity ease-out,.2s color ease-out;
}
.btn-primary {
   color: #fff;
   background-color: none;
   border-color: blue;
   color: blue !important;
}
.label-info {
   background-color: none;
   color: #000;
}
</style>
