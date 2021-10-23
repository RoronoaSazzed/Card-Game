<template>
	<div>
		<div class="stepDiv" id="stepFive">
			<h3 class="steps">
				<span class="stepName">Final Step</span>Your selected cards are listed
				according to priority.
			</h3>
			<p class="tootlTips">
				Hint: You can also re arrange these cards by dragging.
			</p>
			<div class="prioritizedCards"  v-if="allCardsData">
				<draggable v-model="allCardsData.resultCards">
					<transition-group>
						<Card v-for="link in allCardsData.resultCards" :url="link" :key="link" />
					</transition-group>
				</draggable>
			</div>

			<div class="text-center">
				<button @click="submitFinalData" class="stepButton">Finish</button>
			</div>
		</div>
	</div>
</template>

<script>
	import Card from './Card.vue'
	import draggable from 'vuedraggable'

	export default {
		name: 'PriorityCards2',
		props: {
			allCards: Object
		},
		components: {
			Card,
			draggable
		},
		data(){
			return {
				submitEmail:5,
				allCardsData: {}
			}
		},
		methods:{
			submitFinalData()
			{
				this.submitEmail=1;
				const obj = {
					submitEmail:this.submitEmail,
					allCards:this.allCardsData
				}
				this.$emit('submitDataForEmail', obj)
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
