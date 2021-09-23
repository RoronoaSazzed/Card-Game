<template>
  <div id="app">
<!--     <img alt="Vue logo" src="./assets/logo.png"> -->
  <transition name="fade-in">
    <Credentials @getNameEmail="getNameEmail($event)" v-show="submitEmail==1"/>
  </transition>
  <transition name="fade">
    <Cards @getCards="getCards($event)" v-show="submitEmail==2"/>
    <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
  </transition>

  <h1>{{ name }} - {{ email}}</h1>
  <ol>
    <li v-for="link in allCards.green"  :key="link">{{link}}</li>
  </ol>
  <ol>
    <li v-for="link in allCards.brown"  :key="link">{{link}}</li>
  </ol>
  <ol>
    <li v-for="link in allCards.yellow" :key="link">{{link}}</li>
  </ol>
  </div>

</template>

<script>
import Credentials from './components/Credentials.vue'
import Cards from './components/Cards.vue'

export default {
  name: 'app',
  components: {
    Credentials,
    Cards
  },
  data(){
    return {
      email:'',
      name:'',
      submitEmail : 2,
      allCards:{},
    }
  },
  methods:{
    getNameEmail(obj)
    {
      this.name=obj.name;
      this.email=obj.email;
      this.submitEmail=obj.submitEmail;
    },
    getCards(obj)
    {
      this.submitEmail=obj.submitEmail;
      this.allCards=obj.allCards;
    }

  }
}
</script>

<style scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
</style>
