<template>
	<div>
		<div class="stepDiv" id="stepFour">
			<h3 class="steps">
				<span class="stepName">Step 3</span>Select the 5th Card from the
        remaining Cards. Double-click on the Stack to open up & pick the 5th one.
			</h3>

			<div class="cardsAllDiv">
				<div class="cardBox" id="green">
					<Card2 v-for="(link,index) in allCards.green.slice().reverse()" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)" :cardIndex="index" :isStack="isStackGreen" @toggleStack="toggleStack($event)" color="green"/>
				</div>

				<div class="cardBox" id="brown">
					<Card2 v-for="(link,index) in allCards.brown.slice().reverse()" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)" :cardIndex="index" :isStack="isStackBrown" @toggleStack="toggleStack($event)" color="brown"/>
				</div>

				<div class="cardBox" id="yellow">
					<Card2 v-for="(link,index) in allCards.yellow.slice().reverse()" :url="link" :key="link" :class="getSelectedClass(link)" @toggleSelect="toggleSelect($event)" :cardIndex="index" :isStack="isStackYellow" @toggleStack="toggleStack($event)" color="yellow"/>
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
				selectedCardList:[],
				isStackGreen:true,
				isStackYellow:true,
				isStackBrown:true
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
				if(this.selectedCardList.length < 1)
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
				else if (this.selectedCardList.length <1)
				{
					this.selectedCardList.push( refLink )
				}
				else
				{
					this.$toasted.show('Please select 1 cards.')
				}
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