<template>
    <div class="modal animated fadeIn" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 text-left">
                            <h1>Search</h1>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-12">
                            <div class="row">
                                <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-search-15" viewBox="0 0 40 40">
                                        <path d="M24.034 29.906c-2.356 1.363-5.092 2.143-8.01 2.143C7.174 32.05 0 24.873 0 16.023S7.174 0 16.024 0c8.85 0 16.025 7.174 16.025 16.024 0 2.918-.78 5.654-2.144 8.01l8.96 8.962c1.175 1.174 1.184 3.07.008 4.246l-1.632 1.632c-1.17 1.17-3.067 1.173-4.247-.007l-8.96-8.96zm-8.01.54c7.965 0 14.422-6.457 14.422-14.422 0-7.965-6.457-14.422-14.422-14.422-7.965 0-14.422 6.457-14.422 14.422 0 7.965 6.457 14.422 14.422 14.422zm9.55-1.24l3.63-3.632 8.956 8.955c.392.392.4 1.02.01 1.41l-2.23 2.23c-.387.387-1.022.38-1.41-.01l-8.956-8.955zm-9.55-25.2c-.663 0-1.32.054-1.965.16-.438.072-.733.484-.662.92.072.437.484.733.92.66.56-.09 1.13-.137 1.706-.137.443 0 .8-.36.8-.803 0-.442-.357-.8-.8-.8zm-5.457 1.308c-3.993 2.038-6.56 6.146-6.56 10.71 0 .443.358.802.8.802.443 0 .8-.36.8-.802 0-3.956 2.227-7.516 5.69-9.283.393-.2.55-.683.348-1.077-.2-.394-.684-.55-1.078-.35z"
                                              fill-rule="evenodd" ></path>
                                    </symbol>
                                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-clear-5" viewBox="0 0 20 20">
                                        <path d="M10 20c5.523 0 10-4.477 10-10S15.523 0 10 0 0 4.477 0 10s4.477 10 10 10zm1.35-10.123l3.567 3.568-1.225 1.226-3.57-3.568-3.567 3.57-1.226-1.227 3.568-3.568-3.57-3.57 1.227-1.224 3.568 3.568 3.57-3.567 1.224 1.225-3.568 3.57zM10 18.272c4.568 0 8.272-3.704 8.272-8.272S14.568 1.728 10 1.728 1.728 5.432 1.728 10 5.432 18.272 10 18.272z"
                                              fill-rule="evenodd" ></path>
                                    </symbol>
                                </svg>

                                <form novalidate="novalidate" class="searchbox sbx-custom col-12">
                                    <div role="search" class="sbx-custom__wrapper col-12">
                                        <input type="search" name="search" placeholder="Search for Events" autocomplete="off" required="required" class="sbx-custom__input col-12" v-model="query">
                                        <button type="submit" title="Submit your search query." class="sbx-custom__submit">
                                            <svg role="img" aria-label="Search">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#sbx-icon-search-15"></use>
                                            </svg>
                                        </button>
                                        <button type="reset" title="Clear the search query." class="sbx-custom__reset" @click="query = ''">
                                            <svg role="img" aria-label="Reset">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#sbx-icon-clear-5"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                                <ais-index
                                        app-id="WAU8KEZS6S"
                                        api-key="78ffd5bf867dabdad8d025d0a0dd3a90"
                                        index-name="events"
                                        :query="query"
                                        :classNames="{'ais-index' : 'col-12'}"
                                >
                                    <ais-results :classNames="{'ais-results' : 'row'}">
                                        <template slot-scope="{ result }">
                                            <div class="col-12 py-3" style="border-bottom: solid 1px #cfcfcf">
                                                <div class="row">
                                                    <div class="col-3" :style="{'background-image': 'url('+result.image+')', 'background-size':'cover', 'background-repeat':'no-repeat', 'background-position':'center center'}">
                                                        <!--<img :src="result.image" alt="" style="width: 100%; height: auto">-->
                                                    </div>
                                                    <div class="col-9">
                                                        <h2>
                                                            <ais-highlight :result="result" attribute-name="title"/>
                                                        </h2>
                                                        <p>venue: <b><ais-highlight :result="result" attribute-name="venue"/></b></p>
                                                        <p>Price: <b class="text-danger">from N{{result.tickets[0].price}}</b></p>
                                                        <div class="col-12">
                                                            <button class="btn btn-ticket text-white" @click="navigate(result.title)">See Tickets</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </ais-results>
                                    <ais-no-results :classNames="{'ais-no-results' : 'text-capitalize text-center col-12'}">
                                        <template slot-scope="props">
                                            <h2 class="my-auto mx-auto p-2">No products found for <b>"{{ props.query }}"</b></h2>
                                        </template>
                                    </ais-no-results>
                                </ais-index>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {Index, SearchBox, Results, Pagination, Highlight, NoResults} from 'vue-instantsearch'
    import 'animate.css/animate.min.css'
    import 'SimpleBar'
    import $ from 'jquery'

    export default {
        name: "search",
        data: function () {
            return {
                query: ""
            }
        },
        mounted: function (){
            document.querySelector('.searchbox [type="reset"]').addEventListener('click', function() {  this.parentNode.querySelector('input').focus();});
        },
        components: {
            'ais-index': Index,
            'ais-search-box': SearchBox,
            'ais-results': Results,
            'ais-pagination': Pagination,
            'ais-highlight': Highlight,
            'ais-no-results': NoResults
        },
        methods: {
            navigate: function (name) {
                window.location.href = '/events/' + this.eventUrlCreator(name)
            },
        eventUrlCreator(eventName){
            let name = eventName;
            let url = name.replace(/ /g, '-');
            return url;
        }
        }
    }
</script>

<style scoped>
    .btn-ticket {
        background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%) !important;
        border: none !important;
        cursor: pointer;
    }
    .modal-dialog{
        min-width: 100vw;
        min-height: 100vh;
        margin: 0;
        border-radius: 0;
    }
    .modal-content{
        min-height:100vh;
        border-radius: 0 !important;
    }

    .sbx-custom {
        display: inline-block;
        position: relative;
        height: 51px;
        white-space: nowrap;
        box-sizing: border-box;
        font-size: 14px;
    }

    .sbx-custom__wrapper {
        width: 100%;
        height: 100%;
    }

    .sbx-custom__input {
        display: inline-block;
        -webkit-transition: box-shadow .4s ease, background .4s ease;
        transition: box-shadow .4s ease, background .4s ease;
        border: 0;
        border-radius: 26px;
        box-shadow: inset 0 0 0 2px #CCCCCC;
        background: #FFFFFF;
        padding: 0;
        padding-right: 41px;
        padding-left: 51px;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        white-space: normal;
        font-size: inherit;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .sbx-custom__input::-webkit-search-decoration, .sbx-custom__input::-webkit-search-cancel-button, .sbx-custom__input::-webkit-search-results-button, .sbx-custom__input::-webkit-search-results-decoration {
        display: none;
    }

    .sbx-custom__input:hover {
        box-shadow: inset 0 0 0 2px #b3b3b3;
    }

    .sbx-custom__input:focus, .sbx-custom__input:active {
        outline: 0;
        box-shadow: inset 0 0 0 2px #F77062;
        background: #FFFFFF;
    }

    .sbx-custom__input::-webkit-input-placeholder {
        color: #BBBBBB;
    }

    .sbx-custom__input::-moz-placeholder {
        color: #BBBBBB;
    }

    .sbx-custom__input:-ms-input-placeholder {
        color: #BBBBBB;
    }

    .sbx-custom__input::placeholder {
        color: #BBBBBB;
    }

    .sbx-custom__submit {
        position: absolute;
        top: 0;
        right: inherit;
        left: 0;
        margin: 0;
        border: 0;
        border-radius: 25px 0 0 25px;
        background-color: rgba(255, 255, 255, 0);
        padding: 0;
        width: 91px;
        height: 100%;
        vertical-align: middle;
        text-align: center;
        font-size: inherit;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .sbx-custom__submit::before {
        display: inline-block;
        margin-right: -4px;
        height: 100%;
        vertical-align: middle;
        content: '';
    }

    .sbx-custom__submit:hover, .sbx-custom__submit:active {
        cursor: pointer;
    }

    .sbx-custom__submit:focus {
        outline: 0;
    }

    .sbx-custom__submit svg {
        width: 31px;
        height: 31px;
        vertical-align: middle;
        fill: #F77062;
    }

    .sbx-custom__reset {
        display: none;
        position: absolute;
        top: 12px;
        right: 25px;
        margin: 0;
        border: 0;
        background: none;
        cursor: pointer;
        padding: 0;
        font-size: inherit;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        fill: rgba(0, 0, 0, 0.5);
    }

    .sbx-custom__reset:focus {
        outline: 0;
    }

    .sbx-custom__reset svg {
        display: block;
        margin: 4px;
        width: 19px;
        height: 19px;
    }

    .sbx-custom__input:valid ~ .sbx-custom__reset {
        display: block;
        -webkit-animation-name: sbx-reset-in;
        animation-name: sbx-reset-in;
        -webkit-animation-duration: .15s;
        animation-duration: .15s;
    }

    @-webkit-keyframes sbx-reset-in {
        0% {
            -webkit-transform: translate3d(-20%, 0, 0);
            transform: translate3d(-20%, 0, 0);
            opacity: 0;
        }
        100% {
            -webkit-transform: none;
            transform: none;
            opacity: 1;
        }
    }

    @keyframes sbx-reset-in {
        0% {
            -webkit-transform: translate3d(-20%, 0, 0);
            transform: translate3d(-20%, 0, 0);
            opacity: 0;
        }
        100% {
            -webkit-transform: none;
            transform: none;
            opacity: 1;
        }
    }

</style>