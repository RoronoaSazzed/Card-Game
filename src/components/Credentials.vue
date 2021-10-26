<template>
	<div>
		

		<div class="stepDiv" id="stepZero">
			<h3 class="steps">Fill Out The info to Start</h3>

			<div v-if="errors.length" class="text-center alert" style="width: 80%; margin: auto;">
				<div class="alert-danger" style="padding: 10px">
					<p v-for="error in errors" :key="error" ><b>{{ error }}</b></p>
				</div>
			</div>

			<div class="contactInfo">
				<input type="text" v-model="name" placeholder="Your Name *" />
				<input type="email" v-model="email" placeholder="Email *" />
			</div>
			<div class="text-center">
				<button class="stepButton" @click="showCards">Next</button>
			</div>
		</div>
		
	</div>
</template>

<script>
	export default {
		name: 'Credentials',
		props: {
			msg: String
		},
		data:function(){
			return {
				email:'',
				name:'',
				submitEmail : 1,
				errors: [],
			}
		},
		methods:{
			showCards()
			{
				this.errors = [];

				if(!this.name || !this.validEmail(this.email))
				{
					this.errors.push('Valid email required.');
				}
				if (!this.name)
				{
					this.errors.push("Name required.");
				}
				if(!this.errors.length)
				{
					this.submitEmail = 2;
					const obj = {
						name:this.name,
						email:this.email,
						submitEmail:this.submitEmail
					}
					this.$emit('getNameEmail', obj)
				}
			},
			validEmail (email) {
				var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}
		}
	}
</script>