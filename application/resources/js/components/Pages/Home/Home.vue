<template>
    <v-carousel>
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        reverse-transition="fade-transition"
        transition="fade-transition"
      ></v-carousel-item>
    </v-carousel>
</template>

<script>
import {useTimer} from '../../../../Stores/Timer'
import { useAuth } from '../../../../Stores/Auth';
  export default {
    setup() {
        const authStore = useAuth();
        const timerstore = useTimer();
        return { authStore, timerstore }
    },
    mounted(){
      document.getElementsByClassName("v-window__prev")[0].innerHTML = ""
      document.getElementsByClassName("v-window__next")[0].innerHTML = ""
    },
    data () {
      return {
        items: [
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2022/04/UPDATE-BANNER-JETBUS-TRANSIT.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2022/04/UPDATE-BANNER-DREAM-COACH.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2020/01/HERO-SCENE-JETBUS-SDD-1.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2021/07/HERO-SCENE-JETBUS-UHD-1-2021.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2021/07/HERO-SCENE-JETBUS-SHD-1-2021.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2021/07/HERO-SCENE-JETBUS-HDD-1-2021.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2021/07/HERO-SCENE-JETBUS-MD-1-2021.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2020/01/HERO-SCENE-JETBUS-BIG-BENZ-1.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2020/01/HERO-SCENE-JETBUS-BIG-JUMBO-1.jpg',
          },
          {
            src: 'https://adiputrogroup.com/wp-content/uploads/2022/04/UPDATE-BANNER-JUMBO-1.jpg',
          }

        ],
      }
    },
    onIdle() {
        if(this.authStore.user != null){
            this.timerstore.LogoutTimers()
        }
    },
  }
</script>
