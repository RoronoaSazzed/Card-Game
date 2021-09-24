<template>
	<div>
		<div class="StepDiv" id="stepThree">
			<h3 class="steps">
				<span class="stepName">Step 2</span>Your selected top priorities cards
				are as follows
			</h3>
			<p class="tootlTips">
				Hint: You can also prioritize these 3 by dragging.
			</p>
			<div class="prioritizedCards"  v-if="allCardsData">
				<draggable v-model="allCardsData.resultCards">
					<transition-group>
						<Card v-for="link in allCardsData.resultCards" :url="link" :key="link" />
					</transition-group>
				</draggable>
			</div>

			<div class="text-center">
				<button @click="clickNextTwo" class="stepButton">Next</button>
			</div>
		</div>
	</div>
</template>

<script>
	import Card from './Card.vue'
	import draggable from 'vuedraggable'

	export default {
		name: 'priorityCards',
		props: {
			allCards: Object
		},
		components: {
			Card,
			draggable
		},
		data(){
			return {
				submitEmail:3,
				allCardsData: { "brown": [ "http://127.0.0.1/vue/cards/brown-2.svg", "http://127.0.0.1/vue/cards/brown-3.svg", "http://127.0.0.1/vue/cards/brown-4.svg" ], "green": [ "http://127.0.0.1/vue/cards/green-2.svg", "http://127.0.0.1/vue/cards/green-3.svg", "http://127.0.0.1/vue/cards/green-4.svg" ], "yellow": [ "http://127.0.0.1/vue/cards/yellow-2.svg", "http://127.0.0.1/vue/cards/yellow-3.svg", "http://127.0.0.1/vue/cards/yellow-4.svg" ], "resultCards": [ "http://127.0.0.1/vue/cards/green-1.svg", "http://127.0.0.1/vue/cards/brown-1.svg", "http://127.0.0.1/vue/cards/yellow-1.svg" ] }
			}
		},
		methods:{
			clickNextTwo()
			{
				this.submitEmail=4;
				const obj = {
					submitEmail:this.submitEmail,
					allCards:this.allCardsData
				}
				this.$emit('submit3PriorityCards', obj)
			}
		},
		mounted()
		{
			// let obj = this.lodash.cloneDeep(this.allCards)
			// this.allCardsData = obj
			localStorage.setItem('storedAllCards', JSON.stringify(this.allCards))
			let dataFull = localStorage.getItem('storedAllCards');
			this.allCardsData = JSON.parse(dataFull)
		}
	}

</script>

<style scoped>
	* {
		transition: transform 1s;
	}
</style>