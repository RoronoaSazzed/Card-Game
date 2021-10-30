<template>
	<div>
		<div class="row displayClass" v-if="index">
			<div class="col-sm-5">
				<h3 class="indexClass"><span v-if="hideCloseButton" @click="closeCard()" aria-hidden="true" class="closeButton">&times;</span> {{ index }} )</h3>
			</div>
			<div class="col-sm-6">
				<img style="float:left" class="cardSolo grab" :src="url" alt="card" :class="[isSelected ? 'selected' : '' ,hideCard]" @dblclick="clicked()"/>
			</div>
		</div>
		<img class="cardSolo grab" :src="url" alt="card" :class="[isSelected ? 'selected' : '' ,hideCard]" @dblclick="clicked()" v-else />
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
			isStack:[Boolean,String],
			color:String,
			index:Number
		},
		data()
		{
			return{

				hideCloseButton:true
			}
		},
		methods:{
			clicked()
			{
				if(this.cardIndex == 0)
				{
					this.$emit('toggleStack',this.color)
				}
			},
			closeCard()
			{
				this.hideCloseButton = false;
				this.$emit('closeCard',this.url)
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
	.indexClass
	{
		float: right;
	}
	.displayClass
	{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.closeButton
	{
		background-color: #e84118;
		color:white;
		padding-left: 5px;
		padding-right: 5px;
		border-radius: 5px;
		cursor: pointer;
		margin: 10px;
	}
</style>
