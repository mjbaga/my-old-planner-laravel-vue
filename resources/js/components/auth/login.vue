<template lang="pug">
	.login-section
		.container
			.login-container
				.login-box

					.image-container
						img(:src="logo" alt="Logo")

					alert-component(:success="success", :errors="errors")

					form.login-form(method="post", :action="route", @submit="handleSubmit")
						input(type="hidden", name="_token", :value="csrf")
						.form-group
							label(for="email") Email
							input#email.form-control(type="email", name="email", v-model="email", :class="{ 'is-invalid': submitted && $v.email.$error }")
							.invalid-feedback(v-if="submitted && !$v.email.required") Email is required
						.form-group
							label(for="password") Password
							input#password.form-control(type="password", name="password", v-model="password", :class="{ 'is-invalid': submitted && $v.password.$error }")
							.invalid-feedback(v-if="submitted && !$v.password.required") Password is required
						.form-group.form-submit
							button-component(:className="'btn__blue'", :type="'submit'") Log in
							label
								input.remember(type="checkbox", name="remember")
								| Remember me
</template>

<script>
import buttonComponent from "../elements/button-component";
import alertComponent from "../elements/alert-component";
import { required, email } from "vuelidate/lib/validators";

export default {
	name: 'login-component',
	data() {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			email: '',
			password: '',
			submitted: false,
			submitStatus: null
		}
	},
	props: {
		route: {
			type: String
		},
		logo: {
			type: String
		},
		errors: {
			type: Array,
			default: []
		},
		success: {
			default: ''
		}
	},
	validations: {
		email: { required, email },
		password: { required }
	},
	components: {
		buttonComponent,
		alertComponent
	},
	methods : {
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
