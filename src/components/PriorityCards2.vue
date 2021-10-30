<template>
	<div>
		<div class="stepDiv" id="stepFive">
			<h3 class="steps">
				<span class="stepName">Results </span>Review Your Top 5 Cards
			</h3>
			<h3>Instruction:</h3>
			<p class="toolTips">
				1. You can click and drag to rearrange.
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
