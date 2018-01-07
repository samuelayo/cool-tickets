<template>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme" :style="style">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    import 'owl.carousel/dist/assets/owl.carousel.css';
    import $ from 'jquery';
    require('owl.carousel');
    export default {
        name: "eventSlider",
        props: ['height'],
        data() {
            return {
                style: {
                    height: this.height
                }
            }
        },
        mounted: () => {
            $('.owl-carousel').owlCarousel({
                margin:10,
                loop:true,
                autoWidth:true,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true
            });
        }
    }
</script>

<style scoped>

</style>