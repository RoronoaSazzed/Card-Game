<template>
	<div>
		<img class="cardSolo grab" :src="url" alt="card" />
		<!-- {{url}} -->
	</div>
</template>

<script>
	export default {
		name: 'Card',
		props: {
			url: String
		}
	}
</script>

<style scoped>
	.grab {cursor: -webkit-grab; cursor: grab;}
	.grab:focus,.grab:active  {cursor: -webkit-grabbing; cursor: grabbing;}
</style>