<template lang="pug">
	form.addTitle(action="/titles", method="post", @submit="handleSubmit")
		input(type="hidden", name="_token", :value="csrf")

		.form-group(:class="{ 'form-group--error': submitted && $v.title.$error }")
			label.vh(for="title") Title
			input(type="text", name="title" v-model="title" :class="{ 'is-invalid': submitted && $v.title.$error }")

			.invalid-feedback(v-if="submitted && $v.title.$error")  
				span(v-if="!$v.title.required") Title is required
				span(v-if="!$v.title.minLength") Title must have a minimum of 4 characters

			button-component(:className="'btn-add btn__blue'", :type="'submit'") Add New Title
</template>
<script>
import { required, minLength } from "vuelidate/lib/validators";
import buttonComponent from "./button-component";

export default {
	data() {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			title: '',
			submitted: false
		}
	},
	validations: {
		title: { required, minLength: minLength(4) }
	},
	components: {
		buttonComponent
	},
	methods: {
		handleSubmit(e) {
			this.submitted = true;

			this.$v.$touch();
			if (this.$v.$invalid) {
				e.preventDefault();
				return;
			}
		}
	}
}
</script>
