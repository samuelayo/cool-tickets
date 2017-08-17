<template>
    <div>
        <div class="fb-comments" :data-href="'/blogpost/'+id" data-width="100%" data-num-posts="6"></div>
        <div id="fb-root"></div>
    </div>
</template>

 




<script>
    export default {
        props: ['id'],
        mounted: function() {
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1707896929508771";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }
    }
</script>

