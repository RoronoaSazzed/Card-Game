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
