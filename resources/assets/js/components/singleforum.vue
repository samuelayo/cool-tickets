<template>
<div>
 <clip-loader v-if="loading" color="blue"></clip-loader>
   <div class="row">
      <!-- advert -->
      <div class="col-md-12">
          <a  v-if="category_chart[0]" :href="category_chart[0].url">
         <adimage  :src="'/'+category_chart[0].image_url" width="100%" height="100%"></adimage>
      </a>
      </div>
      <!-- 3 grid for trending, rising and hot topics -->
      <div class="col-md-12">
         <br><br><br>
         <div class="col-md-9" v-if="forum.id" style="background: #f9f9f9;">
            <div class="panel shadowed">
               <br>
               <h5 style="text-align: center;" >{{forum.category_name.name}}</h5>
               <br>
               <h1 class="forum-lg" >{{forum.topic}}</h1>
               <div class="item-content ">
                  <div class="item-meta">
                     <div class="author" :style="'background: url('+forum.user.image+'); background-size: cover;'"></div>
                     <div class="title-meta" >
                        <h6>WRITTEN BY</h6>
                     </div>
                     <div class="title-meta">
                        <h5>{{forum.user.name}}</h5>
                        <h6>CATEGORY</h6>
                     </div>
                     <div class="title-meta">
                        <h5>{{forum.category_name.name}}</h5>
                        <br> 
                        <h5 style="color:#999;">{{timeago(forum.created_at)}}</h5>
                     </div>
                  </div>
                  <div class="item-body">
                     <p v-html="forum.description">
                     </p>
                     <br>
                     <br>
                     
                  </div>
               </div>
               <div id="forum-div" class="container-fluid">        
               </div>
               <!-- end forum  ends-->
            </div>
            <div>
               <div>
                  <div>
                  </div>
               </div>
            </div>
            <div class="panel" style="width:60%; background:none; margin:0 auto; border: none !important;">
                       <p style="
    text-align: left;
    font-family: 'Circular-Bold';
    margin-bottom: 1em;
    margin-top: 2em;
    font-size: 1em;
">Responses </p>
                     <forumcomment :id="forum.id" ></forumcomment>
            </div>
            <br><!-- advert -->
            <div class="col-md-12">
                <a  v-if="category_chart[1]" :href="category_chart[1].url">
         <adimage  :src="'/'+category_chart[1].image_url" width="100%" height="100%"></adimage>
      </a>
            </div>
            <div>
               <br> 
               <div id="more" class="col-md-12">
                  <div class="row">
                     <div>
                        <div  class="col-md-3"> </div>
                     </div>
                  </div>
               </div>
               <br><br>   <!-- freshly pressed -->
               <!-- trending posts -->
               <div class="row">
                  <div class="col-md-12 tr_content">
                  </div>
               </div>
               <!-- -->
            </div>
         </div>
         <forumads></forumads>
      </div>
   </div>
</div>
</div>
    
</template>
<script>
    import forumcomment from './forumcomment.vue'
    import forumads from './forumads.vue'

    export default{
        name: 'singleforum',
        props: ['id', 'name'],
        components: {forumcomment, forumads},
        data: function(){
            return {
                forum: {},
                loading: true
               
            }
        },
        created: function(){
            this.getforum();
        },
        methods: {
            getforum: function(){
                 axios.get('/thisforum/'+this.id)
                .then(response => {
                // JSON responses are automatically parsed.
                this.forum = response.data;
                var status = {
                    title: 'CoolFmNigeria | '+this.name,
                    description: this.forum.description
                }
                this.$store.dispatch('SET_SEO', status);
                this.loading = false;
                
                })
                .catch(e => {
                
                });
            },
            timeago: function(time){
                return moment(time).fromNow();
            }
        },
         watch: {
            id: function (val) {
                this.getforum();
            }
        },
        computed: {
            category_chart: function(){
                if(this.forum.category_name){
                    var homeads = _.filter(window.Laravel.ads, (o)=>{
                        if (o.advert_category.type == this.forum.category_name.name+"_ads") return o;
                    });
                    return homeads;
                }
            return [];
          }
        }
    }
</script>