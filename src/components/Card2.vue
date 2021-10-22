<template>
	<div>
		<img class="cardSolo" :src="url" alt="card" :class="[hideCard]" @click="clicked()" @dblclick="dbclicked()"/>
		<!-- {{url}} -->
	</div>
</template>

<script>
	export default {
		name: 'Card2',
		props: {
			url: String,
			cardIndex:Number,
			isStack:Boolean,
			color:String
		},
		methods:{
			clicked()
			{
				this.$emit('toggleSelect', this.url)
			},
			dbclicked()
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
        transition: display 500ms;
      }
</style>