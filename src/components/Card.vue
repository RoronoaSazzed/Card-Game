<template>
	<div>
		<img class="cardSolo grab" :src="url" alt="card" :class="isSelected ? 'selected' : '' "/>
		<!-- {{url}} -->
	</div>
</template>

<script>
	export default {
		name: 'Card',
		props: {
			url: String,
			isSelected: Boolean
		}
	}
</script>

<style scoped>
	.grab {cursor: -webkit-grab; cursor: grab;}
	.grab:focus,.grab:active  {cursor: -webkit-grabbing; cursor: grabbing;}
	.selected
	{
		opacity: 0.5;
	}
</style>