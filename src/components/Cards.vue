<template>
	<div>
		<div class="stepDiv" id="stepTwo">
			<h3 class="steps">
				<span class="stepName">Step 1</span>List your cards from the top
				priorities to the lowest accordingly
			</h3>
			<p class="tootlTips">
				Hint: Drag the cards to serialize the way you desire.
			</p>
			<div class="cardsAllDiv" v-if="allCards">
				<div id="green" class="cardBox">
					<draggable v-model="allCards.green">
						<transition-group>
							<Card v-for="link in allCards.green" :url="link" :key="link" />
						</transition-group>
					</draggable>
				</div>
				<div id="brown" class="cardBox">
					<!-- <Card v-for="link in allCards.brown" :url="link" :key="link"/> -->
					<draggable v-model="allCards.brown">
						<transition-group>
							<Card v-for="link in allCards.brown" :url="link" :key="link" />
						</transition-group>
					</draggable>
				</div>
				<div id="yellow" class="cardBox">
					<draggable v-model="allCards.yellow">
						<transition-group>
							<Card v-for="link in allCards.yellow" :url="link" :key="link" />
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
				submitEmail:2
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
			}
		}
	}
</script>
<style scoped>
	* {
		transition: transform 1s;
	}
</style>