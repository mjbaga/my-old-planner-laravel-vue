<template lang="pug">
	.user-form
		.container
			h2 Create a new user
			form(action="/user/create", method="post", @submit="handleSubmit", enctype="multipart/form-data")
				input(type="hidden", name="_token", :value="csrf")
				input(type="hidden", name="title_id", :value="userData.title.id")

				.form-group.cf
					.row
						.col-md-4
							label(for="first-name") First Name

						.col-md-6(:class="{ 'form-error': submitted && $v.userData.$anyError }")
							input#first-name.form-control(type="text", name="first_name", v-model="userData.firstName", :class="{ 'is-invalid': submitted && $v.userData.firstName.$error }")

							.invalid-feedback(v-if="submitted && !$v.userData.firstName.required") First Name is required
				.form-group.cf
					.row
						.col-md-4
							label(for="last-name") Last Name

						.col-md-6(:class="{ 'form-error': submitted && $v.userData.$anyError }")
							input#last-name.form-control(type="text", name="last_name", v-model="userData.lastName", :class="{ 'is-invalid': submitted && $v.userData.lastName.$error }")

							.invalid-feedback(v-if="submitted && !$v.userData.lastName.required") Last Name is required
				.form-group.cf
					.row
						.col-md-4
							label(for="email") Email

						.col-md-6(:class="{ 'form-error': submitted && $v.userData.$anyError }")
							input#email.form-control(type="text", name="email", v-model="userData.email", :class="{ 'is-invalid': submitted && $v.userData.email.$error }")
							.invalid-feedback(v-if="submitted && $v.userData.email.$error")
								span(v-if="!$v.userData.email.$error.required") Email is required
								span(v-if="!$v.userData.email.$error.email") Must be a valid email
								
				.form-group.cf
					.row
						.col-md-4
							label(for="title") Title
						.col-md-6(:class="{ 'form-error': submitted && $v.userData.$anyError }")
							v-select(:value="userData.title" label="title" :options="titleData" @input="setSelected")
							.invalid-feedback(v-if="submitted && !$v.userData.title.required") Title is required

				.form-group.cf
					.row
						.col-md-4
							label(for="image") Image

						.col-md-6
							input#image.form-control(type="file", name="image", accept="image/*")
				
				input.btn.btn-primary(type="submit" value="Submit")
</template>
<script>
import { required, email } from "vuelidate/lib/validators";
import vSelect from 'vue-select';

export default {
	data () {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			userData: this.user,
			titleData: this.titles,
			valid: false,
			submitted: false
		}
	},
	props: {
		user: {
			type: Object,
			default: () => ({
				firstName: "",
				lastName: "",
				email: "",
				image: "",
				title: {
					type: Object,
					default: () => ({
						"id": 0,
						"title": "Select Title"
					})
				}
			})
		},
		titles: {
			type: Array,
			default: () => ({
				"id": 0,
				"title": "Select Title"
			})
		}
	},
	components: {
		vSelect
	},
	validations: {
		userData: {
			firstName: { required },
			lastName: { required },
			email: { required, email },
			title: { required }
		}
	},
	methods : {
		handleSubmit(e){
            this.submitted = true;

            this.$v.$touch();
            if (this.$v.$invalid) {
				e.preventDefault();
                return;
            }
		},
		setSelected(value) {
			this.userData.title = value;
		}
	}
}
</script>