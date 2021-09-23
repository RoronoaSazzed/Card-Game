<template>
	<div>
		<img class="cardSolo" :src="url" alt="card" />
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