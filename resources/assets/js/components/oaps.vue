<template>
<div id="oapspage">
 <pulse-loader v-if="loading"></pulse-loader>

 <h1 style="text-align: center; font-weight: 700;">OAPS</h1><br><br>
   
<div class="doubleColumns">
  <div style="background: #fff; background-size: cover;" class="doubleColumn">           

                 <div>
                     <br> 
                     <div id="more" class="col-md-12"> 
                      <div class="row">
                        <div v-for="(oa, index) in oaps" v-if="index < split_oaps()" > 
                        <router-link :to="{ name: 'single_oap', params: { id: oa.id, name:oa.name }}"> 
                          <div  :style="'background: url('+oa.image+'); background-size: cover;'" id="oaps" class="col-md-3"><p>{{oa.name}}</p> 
                          </div>
                        </router-link>
                        </div>
                        

                    </div>
                    
                    </div> 
    <br>
    <!-- end chart details -->
  </div>
    
  </div>

  <div class="doubleColumn" >         

                 <div>
                     <br> 
                     <div id="more" class="col-md-12"> 
                       <div class="row">
                            <div v-for="(oa, index) in oaps" v-if="index >= split_oaps()" >   
                              <router-link :to="{ name: 'single_oap', params: { id: oa.id, name:oa.name }}"> 
                              <div  :style="'background: url('+oa.image+'); background-size: cover;'" id="oaps" class="col-md-3"><p>{{oa.name}}</p> </div>
                              </router-link>
                            </div>

                  </div>
                </div> 
    <br>
    <!-- end chart details -->
  </div>
</div>

</div>


</div>

</template>
<script>
    export default {
        name: 'oaps',
        data: function (){
            return{
               oaps: [],
               loading: true
            }
        },
        created: function(){
                axios.get('/oaps')
                .then(response => {
                // JSON responses are automatically parsed.
                this.oaps = response.data;
                this.loading = false;
                
                })
                .catch(e => {
                
                });    
        }, 
        methods: {
            split_oaps: function(){
                 var length = this.oaps.length/2
                 length = Math.floor(length);
                
                return length;
            }
        }
    }
</script>
<style>
.doubleColumn {
    background: #FFF;
    display: table-cell;
    width: 8% !important;
    padding: 2em;
}
</style>
