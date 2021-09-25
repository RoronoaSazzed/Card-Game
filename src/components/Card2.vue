<template>
	<div>
		<img class="cardSolo" :src="url" alt="card" @click="clicked()"/>
		<!-- {{url}} -->
	</div>
</template>

<script>
	export default {
		name: 'Card2',
		props: {
			url: String
		},
		methods:{
			clicked()
			{
				this.$emit('toggleSelect', this.url)
			}
		}
	}
</script>
