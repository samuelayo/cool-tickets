<template>
  <div id="app">
    <header>
      <div class="cd-auto-hide-header">
        <div class="logo">
          <router-link v-bind:to="'/'"><img src="/mobile/img/logo.png" alt="Logo"></router-link>
        </div>

        <nav class="cd-primary-nav">
          <a href="#cd-navigation" class="nav-trigger">
            <span>
            <em aria-hidden="true"></em>

          </span>
          </a>
          <!-- .nav-trigger -->

          <ul id="cd-navigation">
            <li><router-link v-bind:to="'/oaps'" style="border-top: none;">OAPs</router-link>
            <li>
              <router-link v-bind:to="'/forums'">Forums</router-link>
            </li>
            <li>
              <router-link v-bind:to="'/events'">Events</router-link>
            </li>
            <li><a href="javascript:void()" style="color: grey;">Switch Channels</a></li>
            <li><a href="javascript:void()" @click="change_state('Lagos', 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos')">Coolfm Lagos</a></li>
            <li><a href="javascript:void()" @click="change_state('Kano', 'http://icestream.coolwazobiainfo.com:8000/coolfm-kano')">Coolfm Kano</a></li>
            <li><a href="javascript:void()" @click="change_state('Abuja', 'http://icestream.coolwazobiainfo.com:8000/coolfm-abuja')">Coolfm Abuja</a></li>
            <li><a href="javascript:void()" @click="change_state('Ph', 'http://icestream.coolwazobiainfo.com:8000/coolfm-ph')">Coolfm Port-Harcourt</a></li>

          </ul>
        </nav>
        <!-- .cd-primary-nav -->



        <table class="table-fill" style="height: 40px !important; border: none !important;" v-if="now_playing">
          <tbody class="table-hover" style="color: black;">
            <tr>
              <td class="text-left" style="letter-spacing: 3px;color: rgb(255, 255, 255);display: inline-block;font-style: normal !important;padding: 1.1em 2.9em 18px 2em;font-size: 0.8em;margin-top: 1.5em;margin-left: 1em;width: 62px;text-align: center;border-radius: 50%;background: rgba(255,255,255,.1);"><i :class="'ion-'+current_play_state" @click="livestream()" style="font-size: 1.5em;"></i></td>
              <td class="text-left" style="padding: 1.3em;line-height: 1.2;background: none;font-weight: 100;text-align: left;text-transform: capitalize;color: #fff;font-family: 'Circular-lIGHT';">
              <span style="display: none; opacity: 0.6;">Now</span>
              {{now_playing.title}} </td>
            </tr>
          </tbody>
        </table>

        <nav class="cd-secondary-nav">
          <ul>
            <li v-for="category in categories">
              <router-link v-bind:to="{ name: 'blogcategory', params: {'name': category.name, 'id': category.id }}">
                <a class="" href="#">{{category.name}}
    			</a>
              </router-link>
            </li>

          </ul>
        </nav>
        <!-- .cd-secondary-nav -->
      </div>
    </header>
    <br><br><br><br><br><br><br><br><br>
    <router-view></router-view>
    <footer style="display: none;">
      <audio id="coolradio">
        <source :src="current_stream" />
        </audio>
    </footer>
  </div>
</template>

<script>
  export default {
    name: 'app',
    data: () => {
      return {
        schedule: [],
        categories: Laravel.categories
      }
    },
    created: function() {
      this.schedules();
      setTimeout(function() {
        jQuery(document).ready(function($) {
          var mainHeader = $('.cd-auto-hide-header'),
            secondaryNavigation = $('.cd-secondary-nav'),
            //this applies only if secondary nav is below intro section
            belowNavHeroContent = $('.sub-nav-hero'),
            headerHeight = mainHeader.height();

          //set scrolling variables
          var scrolling = false,
            previousTop = 0,
            currentTop = 0,
            scrollDelta = 10,
            scrollOffset = 150;

          mainHeader.on('click', '.nav-trigger', function(event) {
            // open primary navigation on mobile
            event.preventDefault();
            mainHeader.toggleClass('nav-open');
          });

          $(window).on('scroll', function() {
            if (!scrolling) {
              scrolling = true;
              (!window.requestAnimationFrame) ?
              setTimeout(autoHideHeader, 250): requestAnimationFrame(autoHideHeader);
            }
          });

          $(window).on('resize', function() {
            headerHeight = mainHeader.height();
          });

          function autoHideHeader() {
            var currentTop = $(window).scrollTop();

            (belowNavHeroContent.length > 0) ?
            checkStickyNavigation(currentTop) // secondary navigation below intro
              : checkSimpleNavigation(currentTop);

            previousTop = currentTop;
            scrolling = false;
          }

          function checkSimpleNavigation(currentTop) {
            //there's no secondary nav or secondary nav is below primary nav
            if (previousTop - currentTop > scrollDelta) {
              //if scrolling up...
              mainHeader.removeClass('is-hidden');
            } else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
              //if scrolling down...
              mainHeader.addClass('is-hidden');
            }
          }

          function checkStickyNavigation(currentTop) {
            //secondary nav below intro section - sticky secondary nav
            var secondaryNavOffsetTop = belowNavHeroContent.offset().top - secondaryNavigation.height() - mainHeader.height();

            if (previousTop >= currentTop) {
              //if scrolling up...
              if (currentTop < secondaryNavOffsetTop) {
                //secondary nav is not fixed
                mainHeader.removeClass('is-hidden');
                secondaryNavigation.removeClass('fixed slide-up');
                belowNavHeroContent.removeClass('secondary-nav-fixed');
              } else if (previousTop - currentTop > scrollDelta) {
                //secondary nav is fixed
                mainHeader.removeClass('is-hidden');
                secondaryNavigation.removeClass('slide-up').addClass('fixed');
                belowNavHeroContent.addClass('secondary-nav-fixed');
              }

            } else {
              //if scrolling down...
              if (currentTop > secondaryNavOffsetTop + scrollOffset) {
                //hide primary nav
                mainHeader.addClass('is-hidden');
                secondaryNavigation.addClass('fixed slide-up');
                belowNavHeroContent.addClass('secondary-nav-fixed');
              } else if (currentTop > secondaryNavOffsetTop) {
                //once the secondary nav is fixed, do not hide primary nav if you haven't scrolled more than scrollOffset
                mainHeader.removeClass('is-hidden');
                secondaryNavigation.addClass('fixed').removeClass('slide-up');
                belowNavHeroContent.addClass('secondary-nav-fixed');
              }

            }
          }
        });
      }, 100);





    },
    computed: {
      current_stream: function() {
        if (document.getElementById("coolradio") != undefined) {
          var audio = document.getElementById("coolradio");
          audio.src = this.$store.state.current_stream;
        }
        return this.$store.state.current_stream;
      },
      now_playing: function() {
        if (this.schedule[this.current_state]) {
          var myDate = new Date();
          var schedule_arry = this.schedule[this.current_state];
          if (myDate.getDay() == 6) {
            //saturday
            //filter by saturday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "saturday";
            });

          } else if (myDate.getDay() == 0) {
            //sunday
            //filter by sunday
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period == "sunday";
            });

          } else {
            //otherdays
            schedule_arry = _.filter(schedule_arry, (sch) => {
              return sch.period != "sunday" && sch.period != "saturday";
            });
          }
          for (var i = 0; i < schedule_arry.length; i++) {
            var schedu = schedule_arry[i];
            if (this.between(schedu.start, schedu.end) == "Now") {
              return schedu
            }
          }
        }
      },
      current_state: function() {
        return this.$store.state.current_state;
      },
      current_play_state: function() {
        return this.$store.state.play;
      }

    },
    methods: {
      change_state: function(status, stream) {
        this.$store.dispatch('SET_STATE', status);
        this.$store.dispatch('SET_STREAM', stream);
      },
      schedules: function() {
        axios.get('/schedules')
          .then(response => {
            // JSON responses are automatically parsed.
            this.schedule = _.groupBy(response.data, function(car) {
              return car.state;
            });

          })
          .catch(e => {

          });
      },
      between: function(start, end) {


        var format = 'hh:mm:ss'

        // var time = moment() gives you current time. no format required.
        var time = moment(),
          beforeTime = moment(start, format),
          afterTime = moment(end, format);

        if (time.isBetween(beforeTime, afterTime)) {

          return 'Now';
        } else {

          return 'Later';

        }
      },
      livestream: function() {
        if (this.current_play_state == 'play') {
          var status = 'pause';
        } else {
          var status = 'play';
        }
        this.$store.dispatch('SET_PLAY', status);
      },
      timeago: function(time) {
        return moment(time).fromNow();
      },
      hottimeago: function(obj) {
        if (obj.comments != undefined && obj.comments.length != 0) {
          var last = obj.comments[obj.comments.length - 1];
          return this.timeago(last.updated_at);
        }
        return "No activity yet";
      }
    }
  }
</script>

<style>
  footer {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 100px;
    width: 100%;
  }

  .cd-primary-nav>ul {
    margin-top: 1.1em;
    border-radius: 5px;
    width: 95% !important;
    margin-left: .6em;
}

.cd-primary-nav>ul:after {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: 125px;
    width: 0;
    height: 0;
    border-bottom: 8px solid #fff;
    border-right: 8px solid transparent;
    border-left: 8px solid transparent;
}

.cd-primary-nav>ul a {
    width: 97%;
}

.buzz-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

body {
    font-size: 1rem;
    background: #f9f9f9;
    line-height: 1.5;
    font-family: 'Circular-book';
    color: #000;
}
.cd-secondary-nav ul,
.cd-secondary-nav li,
.cd-secondary-nav a {
    padding-right: 0;
}

</style>
