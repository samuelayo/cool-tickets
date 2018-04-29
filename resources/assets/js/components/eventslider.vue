<template>
    <div class="container">
        <div class="col-2 mx-auto" v-if="!loaded">
            <clip-loader color="blue"></clip-loader>
        </div>
        <div class="owl-carousel owl-theme" :style="style">
            <div class="item" v-for="(slide, index) in slides">
                <a @click="navigate(slide.event.title, slide.event, index )" >
                    <img :src="slide.image_path" alt="" class="slide_img">
                    <div :class="slide.title ? 'overlay' : ''">
                        <div class="overlay_content">
                            <div class="row" v-if="(slide.title != null || slide.description != null)">
                                <div class="col-12"><h1 v-text="slide.title"></h1></div>
                                <div class="col-12"><p v-text="slide.description"></p></div>
                                <div class="col-12 text-left" style="mix-blend-mode: difference">
                                    <button class="btn" :style="{ background: slide.button_color }" v-text="slide.button_text" @click="navigate(slide.event.title, slide.event, index )"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
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
                },
                loaded: false,
                slides: []
            }
        },
        created: function () {
            const self = this;
            this.get_slides().then((slides) => {
                if (slides.length === 0){
                    self.style.height = '5px'
                }
                this.initOwlCarousel().then(() => {
                    setTimeout(this.loaded = true, 3000);
                });
            });
        },
        methods: {
            get_slides: function () {
                const self = this;
                return new Promise(function (resolve, reject) {
                    axios.get("/get_slides")
                        .then((response) => {
                            const data = response.data;
                            data.forEach((val) => {
                                self.slides.push(val);
                            });
                            resolve(self.slides);
                        }).catch((err) => {
                            reject(err)
                    })
                })
            },
            initOwlCarousel: function () {
                return new Promise((resolve, reject) => {
                    const owl = $('.owl-carousel');
                    function initialized(event){
                        resolve();
                    }
                    owl.owlCarousel({
                        margin: 10,
                        loop: true,
                        autoWidth: true,
                        autoplay: true,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        responsive: {
                            0:{
                                items: 1,
                                autoWidth: false
                            },
                            480:{
                                items: 2,
                                autoWidth: false,
                                nav: false
                            },
                            720:{
                                margin: 10,
                                loop: true,
                                autoWidth: true,
                                autoplay: true,
                                autoplayTimeout: 2500,
                                autoplayHoverPause: true,
                            }
                        },
                        onInitialized: initialized
                    });
                });
            },
            navigate: function (name, data, index) {
                this.$router.push({
                    name: 'events-inner',
                    params: {
                        name: this.eventUrlCreator(name),
                        data: data,
                        index: index
                    }
                })
            },
            eventUrlCreator(eventName){
                return eventName.replace(/ /g, '-');
            }
        }
    }
</script>

<style scoped>
    .item {
        height: 400px;
    }
    .btn{
        mix-blend-mode: screen;
        color: white;
    }
    .overlay{
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.2) 20%, rgba(0, 0, 0, 0.9) 70% );
    }
    .slide_img{
        height: 400px;
        width: auto !important;
    }
    .overlay_content{
        position: absolute;
        bottom: 10px;
        left: 20px;
        color: white !important;
        width: calc(100% - 40px);
    }

    @media screen and (max-width: 480px){
        .slide_img{
            width: 100% !important;
        }
    }
    @media screen and (max-width: 720px){
        .slide_img{
            width: 100% !important;
        }
    }
</style>