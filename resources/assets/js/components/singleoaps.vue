<template>
    <div id="">
     <clip-loader v-if="loading" color="blue"></clip-loader>

           <div class="doubleColumns">
  <div :style="'background-size: cover; width: 15% !important; background-image: url('+oap.fullimage+');'" class="doubleColumn">
    
  </div>
  <div class="doubleColumn"><p style="text-align: center;"> <router-link to="/all_oaps">OAPS</router-link></p><h5 style="text-align: center;"> <span class="oaps"> {{oap.name}} </span></h5><br>
    <p v-html="oap.description">
        
    </p>
  <br><br> <p><span id="links" class="ion-social-twitter"> <span>@{{oap.twitter}} </span></span> </p> <p ><span id="links" class="ion-social-facebook"> <span> {{oap.facebook}} </span></span></p> <p ><span id="links" class="ion-ios-email"> <span> {{oap.email}} </span></span></p> <p ><span id="links" class="ion-social-whatsapp-outline"> <span> +{{oap.phone}} </span></span></p>
  </div>
</div>


    </div>
</template>
<script>
     export default {
        name: 'singleoaps',
        data: function (){
            return{
                oap:{},
                loading: true
            }
        },
        created: function(){
              axios.get('/thisoap/'+this.$route.params.id)
                .then(response => {
                // JSON responses are automatically parsed.
                this.oap = response.data;
                 var status = {
                    title: 'CoolFmNigeria | '+this.oap.name,
                    description: this.oap.description
                }
                this.$store.dispatch('SET_SEO', status);
                this.loading = false;
                
                })
                .catch(e => {
                
                });
        }, 
        methods: {
           
        }
    }
</script>
<style>
.doubleColumn p {
    font-size: 1.1em !important;
}
</style>
