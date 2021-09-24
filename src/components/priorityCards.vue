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
				allCardsData: {}
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
			},
			reloadOnPropChange()
			{
				localStorage.setItem('storedAllCards', JSON.stringify(this.allCards))
				let dataFull = localStorage.getItem('storedAllCards');
				this.allCardsData = JSON.parse(dataFull)
				localStorage.removeItem('storedAllCards')
			}
		},
		created()
		{
			this.reloadOnPropChange()
		},
		watch: {
			allCards() 
			{
				this.reloadOnPropChange()
			}
		}
	}

</script>

<style scoped>
	* {
		transition: transform 1s;
	}
</style>