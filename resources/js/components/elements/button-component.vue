<template lang="pug">
	button.btn(:class="className", :type="type", v-on:click="$emit('click')")
		span
			slot
</template>
<script>
export default {
	props: {
		className: {
			type: String
		},
		type: {
			type: String
		}
	}
}
</script>