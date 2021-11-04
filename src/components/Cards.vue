<template>
	<div>
		<div class="stepDiv" id="stepTwo">
			<h3 class="steps">Step 1</h3>

        <h3>Instructions:</h3>
        <p class="toolTips">
          1. Double click the stack to expand.<br />
          2. Click and drag to organize the cards from most important to you (top) to least important to you (bottom).<br />
          3. Double click the top card to collapse the stack.<br />
        </p>
			<div class="cardsAllDiv" v-if="allCards">
				<div id="green" class="cardBox">
					<draggable v-model="allCards.green">
						<transition-group>
							<Card v-for="(link,index) in allCards.green" :url="link" :key="link" :cardIndex="index" :isStack="isStackGreen" @toggleStack="toggleStack($event)" color="green"/>
						</transition-group>
					</draggable>
				</div>
				<div id="brown" class="cardBox">
					<!-- <Card v-for="link in allCards.brown" :url="link" :key="link"/> -->
					<draggable v-model="allCards.brown">
						<transition-group>
							<Card v-for="(link,index) in allCards.brown" :url="link" :key="link" :cardIndex="index" :isStack="isStackBrown" @toggleStack="toggleStack($event)" color="brown"/>
						</transition-group>
					</draggable>
				</div>
				<div id="yellow" class="cardBox">
					<draggable v-model="allCards.yellow">
						<transition-group>
							<Card v-for="(link,index) in allCards.yellow" :url="link" :key="link" :cardIndex="index" :isStack="isStackYellow" @toggleStack="toggleStack($event)" color="yellow"/>
						</transition-group>
					</draggable>
				</div>

			</div>
			<div class="text-center">
				<button @click="clickNext" class="stepButton">Next</button>
			</div>
		</div>
	</div>
</template>

<script>
	import Card from './Card.vue'
	// import axios from 'axios'
	import draggable from 'vuedraggable'

	export default {
		name: 'Cards',
		components: {
			Card,
			draggable
		},
		data()
		{
			return{
				allCards:{},
				errorMessage:'',
				submitEmail:2,
				isStackGreen:true,
				isStackYellow:true,
				isStackBrown:true
			}
		},
		mounted(){
			this.$axios.get("http://127.0.0.1:80/vue/cards/getSvg.php")
			.then(response => this.allCards = response.data)
			.catch(error => {
				this.errorMessage = error.message;
				this.$toasted.show(this.errorMessage, { 
					theme: "bubble", 
					position: "top-right", 
					duration : 5000
				});
			});
			// this.$toasted.show('Hello, I am from ItSolutionStuff.com')
		},
		methods:{
			clickNext()
			{
				this.submitEmail=3;
				const obj = {
					submitEmail:this.submitEmail,
					allCards:this.allCards
				}
				this.$emit('getCards', obj)
			},
			toggleStack(color)
			{
				if(color == 'green')
				this.isStackGreen = !this.isStackGreen
				else if (color == 'brown')
				this.isStackBrown = !this.isStackBrown
				else if (color == 'yellow')
				this.isStackYellow = !this.isStackYellow
			}
		}
	}
</script>
