<template>
    <div id="all_podcasts">
        <h1 style="text-align: center; font-weight: 700;line-height: 1.3;">PODCASTS   </h1><br>


<!-- podcast starts-->
    <div id="chartcurrent" class="container-fluid">
         <div class="row"><br>
             <div style="margin-left: 1em;" class="col-md-12">
                 <h3>
           WEEK {{week}}
                  &nbsp;
                  &nbsp;
           
                </h3> 
                
             </div>
            <!-- podcast header -->
            <!-- -->
            <!-- podcast items/images -->
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="row"><br><br>
                        <div   class="col-sm-3" v-for="pod in part_one"> 
                            <a  href="" class="ratio img-responsive img-circle" :style="'background-image: url('+pod.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.2);'"></a> 
                             <span class="badge badge-play"><small><span class="ion-ios-play"></span></small>  </span>     
                 
                            <span>   <center><small><a class="listen" href="#"><span class="ion-ios-play"></span> 1000 Listens</a></small> </center>
                                <center><small><a style="color: #4facfe;" href=""> {{pod.title}}</a> </small></center>
                                <center><small><a href="#">{{pod.part}}</a></small></center>


                            </span>
                        </div>
                        
                    </div>
                </div>
               
               <div class="col-md-6">
                    <div class="row"> <br><br>
                        
                       
                         <div   class="col-sm-3" v-for="pod in part_two"> 
                            <a  href="" class="ratio img-responsive img-circle" :style="'background-image: url('+pod.image+'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.2);'"></a> 
                             <span class="badge badge-play"><small><span class="ion-ios-play"></span></small>  </span>     
                 
                            <span>   <center><small><a class="listen" href="#"><span class="ion-ios-play"></span> 1000 Listens</a></small> </center>
                                <center><small><a style="color: #4facfe;" href=""> {{pod.title}}</a> </small></center>
                                <center><small><a href="#">{{pod.part}}</a></small></center>


                            </span>
                        </div>
                  
                   </div>
                   
               </div>
                
               
            </div>
            <!-- -->
        </div>
       <br>
    
    <!-- end podcast details -->
    </div>
    


   <!-- Podcast ends-->
    </div>
</template>
<script>
     export default {
         name: 'all_podcasts',
         props: ['week'],
         data: function(){
            return {
                podcasts: [],
                part_one:[],
                part_two:[]
            }
         }, 
         created: function(){
             this.get_podcast();
         },
         methods: {
             get_podcast: function(){
                  axios.get('/podcast/'+this.week)
                    .then(response => {
                    // JSON responses are automatically parsed.
                    this.podcasts = response.data;
                    this.split_podcasts();
                    })
                    .catch(e => {
                    
                    });    
             },
             split_podcasts: function(){
                
                 var length = this.podcasts.length/2
                 if(length > 1){
                    length = Math.floor(length);
                    var halfs = _.chunk(this.podcasts, length);
                    this.part_one = halfs[0];
                    this.part_two = halfs[1];
                 }else{
                     this.part_one = this.podcasts;
                 }
                

             }
         }
     }
</script>