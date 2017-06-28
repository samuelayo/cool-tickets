<template>
  <div id="sidebar" class="xs-m4">

    <div id="now-buzzing" class="xs-mb3">


      <br>

      <div id="now-buzzing" class="xs-mb3">
       <div v-if="oap.fullimage" :style="'background-size: cover; width: 15% !important; background-image: url('+oap.fullimage+');'" >

  </div>

        <h3 class=" xs-text-2 xs-mb1"> <a id="categ" class="button  xs-col-12 xs-text-left xs-mb1" v-if="oap.state">{{oap.state}}</a> </h3>

        <h1 class="title" v-if="oap.name">{{oap.name}}</h1>
        <br>


        <div class="item-body">
          <p v-if="oap.description" v-html="oap.description" style="width: 100% !important;">
          </p>



        </div>
      </div>

    </div>
  </div>
</template>
<script>
export default{
  data: function(){
    return {
        oap:{},
        loading: true
    }
  },
  created: function(){
     axios.get('/thisoap/'+this.$route.params.id)
                .then(response => {
                // JSON responses are automatically parsed.
                this.oap = response.data;
                this.loading = false;

                })
                .catch(e => {

                });
  }
}
</script>
