<template>
  <!-- .cd-auto-hide-header -->

  <div class="oapss">
<center><clip-loader v-if="loading" color="blue"></clip-loader></center>


    <div id="sidebar" class="xs-m4">

      <div id="now-buzzing" class="xs-mb3">


        <div id="now-buzzing" class="xs-mb3">


          <div id="vertical-feed" class="" v-for="(oap, index) in oaps" >
            <div class="vertical-specific-feed" id="mod-vertical-specific-feed-1">
              <div class="xs-text-left text-gray">
                <ul class="list-unstyled">
                  <li class="xs-col-12 xs-mb2">
                  <router-link v-bind:to="{ name: 'single_oap', params: {'id': oap.id, 'name': oap.name  }}" class="bold text-gray">


                      <img class="buzz-image xs-block xs-mb05" :src="oap.image">
                      <P id="post-cat-m"> {{oap.state}} </P>

                      <h4 class="xs-text-4 lg-text-3">{{oap.name}}</h4>

                    </router-link>
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <br>
        </div>
      </div>


    </div>
  </div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
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

    }
  }
</script>
