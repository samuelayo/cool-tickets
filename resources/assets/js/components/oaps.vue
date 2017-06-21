<template>
<div id="oapspage">
 <clip-loader v-if="loading" color="blue"></clip-loader>

 <h1 style="text-align: center; font-weight: 700;">OAPS</h1><br><br>
   
<div class="doubleColumns">
  <div style="background: #fff; background-size: cover;" class="doubleColumn">           

                 <div>
                     <br> 
                     <div id="more" class="col-md-12"> 
                      <div class="row">
                        <div v-for="(oa, index) in oaps" v-if="index < split_oaps()" > 
                        <router-link :to="{ name: 'single_oap', params: { id: oa.id, name:oa.name }}"> 
                          <div  :style="'background: url('+oa.image+'); background-size: cover;'" id="oaps" class="col-md-3"> 
                          <p style="padding-top:10.4em;">{{oa.name}} ({{oa.state}})</p>
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
                              <div  :style="'background: url('+oa.image+'); background-size: cover;'" id="oaps" class="col-md-3">
                                 <p style="padding-top:10.4em;">{{oa.name}} ({{oa.state}})</p> 
                               </div>
                             
                              </router-link>
                            </div>

                  </div>
                </div> 
    <br>
    <!-- end chart details -->
  </div>
</div>

</div>

<br>
<br>
<br>
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
                 var status = {
                    title: 'CoolFmNigeria | Oaps Page',
                    description: `Get to know your on air personalities from coolfm 96.9fm`
                }
                this.$store.dispatch('SET_SEO', status);
                
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
