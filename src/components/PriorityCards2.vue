<template>
	<div>
		<div class="stepDiv" id="stepFive">
			<h3 class="steps">Results</h3>
			<h3>Instructions:</h3>
			<p class="toolTips">
				1. You can click and drag to rearrange.<br />
				2. Click finish to end the task.
			</p>
			<div class="prioritizedCards"  v-if="allCardsData">
				<draggable v-model="allCardsData.resultCards">
					<transition-group>
						<Card v-for="(link,index) in allCardsData.resultCards" :index="index+1" :url="link" :key="link" showCloseIcon="false" />
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
