<template lang="pug">
	.message
		.alert
			.alert-success(role="alert", v-if="success")
				| {{ success }}
		.alert
			.alert-error(role="alert", v-if="errors.length")
				li(v-for="error in errors")
					|| {{ error }}
</template>
<script>
export default {
	props: {
		success: {
			type: String,
			default: null
		},
		errors: {
			type: Array,
			default: []
		}
	}
}
</script>