<template>
    <div id="carousel" style="height: 300px">
        <div style="width: 200px; background: green; height: 300px;"><h3>1</h3></div>
        <div style="width: 500px; background: blue; height: 300px"><h3>2</h3></div>
        <div style="width: 700px; background: orange; height: 300px"><h3>3</h3></div>
        <div style="width: 300px; background: violet; height: 300px"><h3>4</h3></div>
        <div style="width: 950px; background: blue; height: 300px"><h3>5</h3></div>
        <div style="width: 350px; background: red; height: 300px"><h3>6</h3></div>
    </div>
</template>

<script>
    import "jquery"
    import "slick-carousel"
    export default {
        name: "eventSlider",
        data() {
            return {

            }
        },
        mounted: () => {
            $('#carousel').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                centerMode: true,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                vertical: false
            });
        }
    }
</script>

<style scoped>
    #carousel > div{
        height: 200px;
    }
</style>