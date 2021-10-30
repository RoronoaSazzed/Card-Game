<template>
	<div>
		<div class="StepDiv" id="stepThree">
			<h3 class="steps">
				<span class="stepName">Step 2</span> Select Your Top 4 Cards
			</h3>
			<h3>Instruction:</h3>
			<p class="toolTips">
				1. From the top card of each stack, select the card that is the most important to you.<br />
				2. Now select your next most important.<br />
				3. Repeat until you have selected 4 cards.<br />
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
			<hr />
			<p class="toolTips">
				Selected cards:
			</p>
			<div class="prioritizedCards"  v-if="allCardsData.resultCards">
				<!-- <draggable v-model="allCardsData.resultCards"> -->
					<!-- <transition-group> -->
					<Card v-for="(link,index) in allCardsData.resultCards" :index="index+1" :url="link" :key="link" @closeCard="closeCard($event)" />
					<!-- </transition-group> -->
				<!-- </draggable> -->
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
	// import draggable from 'vuedraggable'

	export default {
		name: 'priorityCards',
		props: {
			allCards: Object
		},
		components: {
			Card,
			Card2,
			// draggable
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
			},
			getIndexFromParentArray(linkValue , listNames=[])
			{
				for (let i = 0; i < listNames.length; i++)
				{ 
					const index = this.allCards[ listNames[i] ].indexOf( linkValue )
					if (index > -1) //in array
					{
						return {parentIndex:index , listName:listNames[i]}
					}
				}
			},
			closeCard(url)
			{
				const index = this.allCardsData.resultCards.indexOf( url )
				if (index > -1)
				{
					const parentDataIndex = this.getIndexFromParentArray(url , ['green','brown','yellow']);
					// alert(parentDataIndex.parentIndex)
					if (parentDataIndex && parentDataIndex.parentIndex > -1)
					{
						this.allCardsData[ parentDataIndex.listName ].push( url )
						let takenUrl = []
						for (let i=0; i < this.allCards[ parentDataIndex.listName ].length;i++ )
						{
							const removeIndex = this.allCardsData[ parentDataIndex.listName ].indexOf( this.allCards[ parentDataIndex.listName ][i] )

							if( removeIndex > -1 && !takenUrl.includes(this.allCards[ parentDataIndex.listName ][i]) )
							{
								this.allCardsData[ parentDataIndex.listName ].splice(removeIndex, 1)
								this.allCardsData[ parentDataIndex.listName ].push( this.allCards[ parentDataIndex.listName ][i] )
								takenUrl.push( this.allCards[ parentDataIndex.listName ][i] )
							}
						}
						this.allCardsData.resultCards.splice(index, 1);
					}
				}
			}
		},
		created()
		{
			this.reloadOnPropChange();
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
	hr{
		border-top: 2px solid black;
		margin: 30px;
	}
</style>

