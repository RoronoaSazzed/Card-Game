<template>
	<div>
		<img class="cardSolo grab" :src="url" alt="card" :class="[isSelected ? 'selected' : '' ,hideCard]" @dblclick="clicked()"/>
		<!-- {{url}} -->
	</div>
</template>

<script>
	export default {
		name: 'Card',
		props: {
			url: String,
			isSelected: Boolean,
			cardIndex:Number,
			isStack:Boolean,
			color:String
		},
		methods:{
			clicked()
			{
				if(this.cardIndex == 0)
				{
					this.$emit('toggleStack',this.color)
				}
			}
		},
		computed:{
			hideCard()
			{
				if (this.cardIndex>0 && this.isStack)
				{
					return 'hideCard'
				}
				else
				{
					return ''
				}
			}

		}
	}
</script>

<style scoped>
	.hideCard {
        display: none;
      }
</style>
