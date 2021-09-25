<template>
	<div>
		<div class="stepDiv" id="stepFour">
			<h3 class="steps">
				<span class="stepName">Step 3</span>Select 2 more cards to fulfill the
				list.
			</h3>
			<p class="tootlTips">
				Hint: You can select 2 cards by clicking from your remaining 9 cards below. Click again to unselect.
			</p>

			<div class="cardsAllDiv">
				<div class="cardBox" id="green">
					<Card2 v-for="link in allCards.green" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)"/>
				</div>

				<div class="cardBox" id="brown">
					<Card2 v-for="link in allCards.brown" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)"/>
				</div>

				<div class="cardBox" id="yellow">
					<Card2 v-for="link in allCards.yellow" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)"/>
				</div>
			</div>
			<div class="text-center">
				<button class="stepButton" @click="submitToNext">Next</button>
			</div>
		</div>
	</div>
</template>

<script>
	import Card2 from './Card2.vue'

	export default {
		name: 'SelectCards',
		components: {
			Card2
		},
		props:{
			allCards: Object
		},
		data()
		{
			return{
				allCardsData:{},
				submitEmail:4,
				selectedCardList:[]
			}
		},
		methods:{
			reloadOnPropChange()
			{
				localStorage.setItem('storedAllCards', JSON.stringify(this.allCards))
				let dataFull = localStorage.getItem('storedAllCards');
				this.allCardsData = JSON.parse(dataFull)
				localStorage.removeItem('storedAllCards')
			},
			submitToNext()
			{
				if(this.selectedCardList.length < 2)
				{
					this.$toasted.show('Must select 2 cards. Selected: '+this.selectedCardList.length)
				}
				else
				{
					this.submitEmail=5;
					for (let i = 0; i < this.selectedCardList.length; i++) 
					{
						this.removeFromParentList(this.selectedCardList[ i ] , ['green','brown','yellow'])
					}
					this.allCardsData.resultCards = this.allCardsData.resultCards.concat(this.selectedCardList)
					const obj = {
						submitEmail:this.submitEmail,
						allCards:this.allCardsData
					}
					this.$emit('submit4SelectCards', obj)
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
			getSelectedClass(refLink)
			{

				const index = this.selectedCardList.indexOf( refLink )
				if (index > -1) 
				{
					return 'selectedCard'
				}
				
			},
			toggleSelect(refLink)
			{
				const index = this.selectedCardList.indexOf( refLink )
				if (index > -1) //in array
				{
					this.selectedCardList.splice(index, 1);
				}
				else if (this.selectedCardList.length <2)
				{
					this.selectedCardList.push( refLink )
				}
				else
				{
					this.$toasted.show('Please select 2 cards.')
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

<style scoped>
	.selectedCard{
		opacity: 0.7;
	}
</style>