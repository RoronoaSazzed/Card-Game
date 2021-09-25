<template>
  <div id="app">
<!--     <img alt="Vue logo" src="./assets/logo.png"> -->
  <transition name="fade-in">
    <Credentials @getNameEmail="getNameEmail($event)" v-show="submitEmail==1"/>
  </transition>
  <transition name="fade">
    <Cards @getCards="getCards($event)" v-show="submitEmail==2"/>
  </transition>
  <transition name="fade">
    <PriorityCards @submit3PriorityCards="submit3PriorityCards($event)" :allCards="allCards" v-show="submitEmail==3"/>
  </transition>
  <transition name="fade">
    <SelectCards @submit4SelectCards="submit4SelectCards($event)" :allCards="allCards" v-show="submitEmail==4"/>
  </transition>
  <transition name="fade">
    <PriorityCards2 @submitDataForEmail="submitDataForEmail($event)" :allCards="allCards" v-show="submitEmail==5"/>
  </transition>

  <h1>{{ name }} - {{ email }} - page {{ submitEmail }}</h1>
  <ol>
    <li v-for="link in allCards.green"  :key="link">{{link}}</li>
  </ol>
  <ol>
    <li v-for="link in allCards.brown"  :key="link">{{link}}</li>
  </ol>
  <ol>
    <li v-for="link in allCards.yellow" :key="link">{{link}}</li>
  </ol>
  <ol>
    <li v-for="link in allCards.resultCards" :key="link">result: {{link}}</li>
  </ol>
  </div>
  
</template>

<script>
import Credentials from './components/Credentials.vue'
import Cards from './components/Cards.vue'
import PriorityCards from './components/priorityCards.vue'
import SelectCards from './components/SelectCards.vue'
import PriorityCards2 from './components/PriorityCards2.vue'

export default {
  name: 'app',
  components: {
    Credentials,
    Cards,
    PriorityCards,
    PriorityCards2,
    SelectCards
  },
  data(){
    return {
      email:'',
      name:'',
      submitEmail : 1,
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
      let resultCards =[];
      resultCards.push(obj.allCards.green.shift());
      resultCards.push(obj.allCards.brown.shift());
      resultCards.push(obj.allCards.yellow.shift());
      this.allCards=obj.allCards;
      this.allCards['resultCards']= resultCards;
    },
    submit3PriorityCards(obj)
    {
      this.submitEmail=obj.submitEmail;
      this.allCards=obj.allCards;
    },
    submit4SelectCards(obj)
    {
      this.submitEmail=obj.submitEmail;
      this.allCards=obj.allCards;
    },
    submitDataForEmail(obj)
    {
      this.submitEmail=obj.submitEmail;
      this.allCards=obj.allCards;
    },
    sendPostReqFroeEmail()
    {
      this.$axios.post("http://127.0.0.1:80/vue/cards/sendMail.php", {
        allData: JSON.stringify(this.allCards),
        email: this.email,
        name: this.name
      })
      .then(function (response) {
        this.allCards = response;
      })
      .catch(error => {
        this.$toasted.show(error.message, 
        { 
          theme: "bubble", 
          position: "top-right", 
          duration : 5000
        });
      });
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
