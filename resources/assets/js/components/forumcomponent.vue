<template>
    <div id="forumcomponent">

    <div class="row">
     <!-- advert -->
    <div class="col-md-12">
         <adimage src="/img/cool_adv.png" width="100%" height="100%"></adimage>

    </div>

    <!-- 3 grid for trending, rising and hot topics -->
        <div class="col-md-12"><br><br><br>
            <div class="col-md-9">
                <div class="panel"><br><h3 style="text-align: center; font-weight: 700;" >FORUM</h3><br>

<div class="article">
     <div id="forum-div" class="container-fluid">
        
       
     <table class="my_table">
  <tr>
    <th>Topic   </th>
    <th>Last Activity</th>
    <th>Replies</th>
    <th>In this conversation</th>
    <th>Category</th>
  </tr>
  <tr v-for="forum in forums">
    <td class="forum-topic"><router-link :to="{ name: 'forum', params: { id: forum.id, name:forum.topic }}"> {{forum.topic}}</router-link></td>
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
                        
                         <span style="color: #007adf;">+ {{forum.comments.length-4}}</span> </span></td>   <td>{{forum.category_name.name}}</td>
  </tr>
</table>



                         
               
    </div>


   <!-- end forum  ends-->
</div>


<div>


<div><div>



</div></div></div>  <br><!-- advert -->
    <div class="col-md-12">
        <adimage src="/img/cool_adv.png" width="100%" height="100%"></adimage>
    </div>           

                 <div>
                     <br> <div id="more" class="col-md-12"> <div class="row">
                   <div>  <div  class="col-md-3"> </div></div>



                  </div></div> 
    

                    <br><br>   <!-- freshly pressed -->



    
                    

                    <!-- trending posts -->
                     <div class="row">
                         <div class="col-md-12 tr_content">
                          
                         </div>
                     </div>
                     <!-- -->

                       
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
           
           
</template>
<script>
    export default{
        name: 'forumcomponent',
        data: function(){
            return {
                forums: []
            }
        },
        created: function(){
            this.getforums();
        },
        methods: {
            getforums: function(){
                axios.get('/getforums')
                .then(response => {
                // JSON responses are automatically parsed.
                this.forums = response.data;
                 var status = {
                    title: 'CoolFmNigeria | Forums topics, discuss, share your opinions',
                    description: `Get your opinions aired, lend your voice to the masses, get outspoken, use the coolfm forums`
                }
                this.$store.dispatch('SET_SEO', status);
                })
                .catch(e => {
                
                });
            },
            timeago: function (time){
                return moment(time).fromNow();
            },
             hottimeago: function(obj){
                var last = obj.comments[obj.comments.length-1];
                return this.timeago(last.created_at); 
            }
        }
    }
</script>