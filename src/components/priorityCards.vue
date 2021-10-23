<template>
	<div>
		<div class="StepDiv" id="stepThree">
			<h3 class="steps">
				<span class="stepName">Step 2</span> Select 4 cards according to your
				priority & serialize them vertically from the stacks.
			</h3>
			<p class="toolTips">
				Select one card at a time from the stack.
			</p>
			<div class="cardsAllDiv">
				<div class="cardBox" id="green">
					<Card2 v-for="(link,index) in allCardsData.green" :url="link" :key="link" :cardIndex="index" @toggleSelect="cardClicked($event)" isStack="green"/>
				</div>

				<div class="cardBox" id="brown">
					<Card2 v-for="(link,index) in allCardsData.brown" :url="link" :key="link" :cardIndex="index" @toggleSelect="cardClicked($event)" isStack="brown" />
				</div>

				<div class="cardBox" id="yellow">
					<Card2 v-for="(link,index) in allCardsData.yellow" :url="link" :key="link" :cardIndex="index" @toggleSelect="cardClicked($event)" isStack="yellow" />
				</div>
			</div>
			<p class="toolTips">
				You can serialize them vertically by dragging.
			</p>
			<div class="prioritizedCards"  v-if="allCardsData.resultCards">
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
	import Card2 from './Card2.vue'
	import draggable from 'vuedraggable'

	export default {
		name: 'priorityCards',
		props: {
			allCards: Object
		},
		components: {
			Card,
			Card2,
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
				if(this.allCardsData.resultCards.length < 4 )
				{
					this.$toasted.show('Select 4 cards.');
				}
				else
				{
					this.submitEmail=4;
					const obj = {
						submitEmail:this.submitEmail,
						allCards:this.allCardsData
					}
					this.$emit('submit3PriorityCards', obj)
				}
			},
			reloadOnPropChange()
			{
				localStorage.setItem('storedAllCards', JSON.stringify(this.allCards))
				let dataFull = localStorage.getItem('storedAllCards');
				this.allCardsData = JSON.parse(dataFull)
				localStorage.removeItem('storedAllCards')
			},
			cardClicked(refUrl)
			{
				const index = this.allCardsData.resultCards.indexOf( refUrl )
				if(this.allCardsData.resultCards.length >= 4 )
				{
					this.$toasted.show('Select 4 cards.');
				}
				else if (index <= -1) //in array
				{
					this.allCardsData.resultCards.push(refUrl);
					this.removeFromParentList(refUrl , ['green','brown','yellow']);
				}
				
			},
			removeFromParentList(linkValue , listNames=[])
			{
				for (let i = 0; i < listNames.length; i++)
				{ 
					const index = this.allCardsData[ listNames[i] ].indexOf( linkValue )
					if (index > -1) //in array
					{
						this.allCardsData[ listNames[i] ].splice(index, 1);
					}
				}
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



