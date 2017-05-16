<template>
    <div id="chartcurrated">

           



<div class="col-md-12">   <h1 style="text-align: center; font-weight: 700;line-height: 1.3;">CHARTS <br>   <div class="btn-group btn-toggle"> 
                         <button :class="'btn btn-'+selectedcat[0]+' chart'" @click="change_chart(0)">Nigerian</button>
                        <button :class="'btn btn-'+selectedcat[1]+' chart'" @click="change_chart(1)">Global</button>
                        <button :class="'btn btn-'+selectedcat[2]+' chart'" @click="change_chart(2)">Alternative</button>
                      </div></h1> <br>
    </div>



 <!-- advert -->
    <div class="col-md-12">




<section>
    <!-- LAST WEEK chart details -->
    <div id="chartcurrent" class="container-fluid">
         <div class="row">
             <div style="margin-left: 1em;" class="col-md-12">
               <br>
    

    <br>  <h3>
           WEEK {{currentchartweek}}
                  &nbsp;
                  &nbsp;
                  
                 
                  <span style="float: right; margin-right: 2em;">
                    <small>
                    <span class="badge badge-pink">&nbsp;</span>
                    <span>Weeks On Chart</span>
                    &nbsp;
                    &nbsp;
                    <span class="badge badge-orange">&nbsp;</span>
                    <span>New Entry</span>
                    &nbsp;
                    &nbsp;
                   <span class="badge badge-pink" style="background-color: #009efd;">&nbsp;</span>
                    <span>Last week</span>
                    </small>
                
                </span>
                </h3>
                
             </div>

            <!-- chart header -->
            <!-- -->
            <!-- chart images -->
            <div class="col-md-12">
                
                    <div class="row"><br>
                         <div  class="col-md-2" v-for="(chart, index) in all_chart[currentchart][currentchartweek]"><p class="chart-num"><strong> {{chart.position}} </strong></p>
                            <a  class="ratio img-responsive img-circle" :style="'background-image: url('+chart.songs.image+');'"></a>
                            <span class="badge badge-notify"><small>{{noofchart(chart.song)}}</small></span>
                            <span class="badge badge-new" v-if="noofchart(chart.song)==1"><small> <strong> New </strong> </small></span>
                            <span class="badge badge-lw" ><small> <strong> {{lastweek(chart.song)}} </strong> </small></span>
                            
                            <span>
                                <center><small id="tet">{{chart.songs.song_title}}</small></center>
                                 
                                <center><small id="tet"><a href="#">{{chart.songs.artistname}}</a></small></center>
                            </span>
                            <br>
                        </div>
                        
                        
                    </div>
           
               
               
                
               
            </div>
            <!-- -->
        </div>
    </div>
    <!-- LAST WEEK end chart details -->


  


</section>


    
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
</template>
<script>
    export default {
        name: 'chartcurrated',
        props:['currentchartweek'],
        data: function (){
            return {
                nigerianchart:[],
                globalchart:[],
                alternativechart:[],
                selectedcat:['nigerian','global','global'],
                currentchart: 0,
                all_chart_ever: []
            }
        },
        created: function(){
             var status = {
                    title: 'CoolFmNigeria | Chart billboard',
                    description: `Top Ten Nigeria, Top 20 Global and Top 10 alternatives on the coolfm bill board`
                }
                this.$store.dispatch('SET_SEO', status);
            this.getcharts();
        },
        methods: {
            getcharts: function(){

                axios.get('/charts')
                .then(response => {
                this.all_chart_ever = response.data;
                // JSON responses are automatically parsed.
                var grouped = _.groupBy(response.data, function(car) {
                                return car.category;
                                });
                    //group charts by category
                    this.nigerianchart = grouped.nigerian;
                    this.globalchart = grouped.global;
                    this.alternativechart = grouped.alternative;

                    //group each chart by week
                     this.nigerianchart = _.groupBy(this.nigerianchart, function(car) {
                                            return car.week;
                                            });
                    this.globalchart =  _.groupBy(this.globalchart, function(car) {
                                            return car.week;
                                            });
                    this.alternativechart =  _.groupBy(this.alternativechart, function(car) {
                                            return car.week;
                                            });                   
                
                })
                .catch(e => {
                
                });

            },
             change_chart: function(id){
                var ch = ['global','global','global'];
                ch[id]='nigerian';
                this.selectedcat = ch;
                this.currentchart = id;

            },
            noofchart: function(id){
                var arr_to_check = this.all_chart_ever;
                var count = 0;
                for (var i=0; i < arr_to_check.length; i++){
                    if(arr_to_check[i].song==id){
                        count++;
                    }
                }
                return count;
            },
            lastweek: function(id){
                var arr_to_check = this.all_chart[this.currentchart][this.currentchartweek-1];
                if(arr_to_check != undefined){
                    for (var i=0; i < arr_to_check.length; i++){
                        if(arr_to_check[i].song==id){
                        return arr_to_check[i].position;
                        }
                    }
                }
                
                return 0;
            },
            get_length: function(){
               var len =  this.all_chart[this.currentchart][this.currentchartweek];
               len = len.length/2;
               return Math.floor(len);
            }
        },
        computed:{
            all_chart: function(){
              var arr = {
                  0: this.nigerianchart,
                  1: this.globalchart,
                  2: this.alternativechart
              }
              
             
              return arr;
          }
        }
    }
</script>
<style>
#tet{
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    width: 70%;
}

.col-md-2 {
    width: 10% !important;
}

</style>