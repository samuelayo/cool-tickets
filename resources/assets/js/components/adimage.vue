<template>
    
        <img :src="src" :width="width" :height="height" :class="sclass">
    
</template>
<script>
    export default{
        name:'adimage',
        props: ['src', 'height', 'width', 'sclass'],
        data: function(){
            return{

            }
        }
    }
</script>
