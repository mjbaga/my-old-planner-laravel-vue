<template lang="pug">
	.project-form
		.container
			.message
				.alert
					.alert-success(role="alert", v-if="success")
						| {{ success }}
				.alert
					.alert-error(role="alert", v-if="errors")
						li(v-for="error in errors")
							|| {{ error }}
			form(action="/projects/create", method="post", @submit="handleSubmit")
				input(type="hidden", name="_token", :value="csrf")
				input(type="hidden", name="type", value="authorised-project")

				.form-group.cf
					.row
						.col-md-4
							label(for="engagement-code") Engagement Code
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							input#engagement-code.form-control(type="text", name="engagement_code", v-model="project.engagement_code", :class="{ 'is-invalid': submitted && $v.project.engagement_code.$error }")

							.invalid-feedback(v-if="submitted && $v.project.engagement_code.$error")
								span(v-if="!$v.project.engagement_code.required") Engagement code is required
								span(v-if="!$v.project.engagement_code.numeric") Engagement code must be a number
					
				.form-group.cf
					.row
						.col-md-4
							label(for="project-name") Authorised Project
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							textarea#project-name.form-control(name="project_name", v-model="project.project_name", rows="3" :class="{ 'is-invalid': submitted && $v.project.project_name.$error }")
							.invalid-feedback(v-if="submitted && !$v.project.project_name.required") Authorised Project Name is required

				.form-group.cf
					.row
						.col-md-4
							label(for="abbreviation") Abbreviation
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							input#abbreviation.form-control(type="text", name="abbreviation", v-model="project.abbreviation", :class="{ 'is-invalid': submitted && $v.project.abbreviation.$error }")
							.invalid-feedback(v-if="submitted && $v.project.abbreviation.$error")
								span(v-if="!$v.project.abbreviation.required") Abbreviation is required
								span(v-if="!$v.project.abbreviation.maxLength") Abbreviation must have a maximum of 10 characters

				.form-group.form-submit.cf
					.row
						.offset-md-4.col-md-6
							a.btn.mright_5(href="settings/authorised-projects") Cancel
							button-component(:className="'btn-save btn__blue'", :type="'submit'") Save
</template>
<script>
import buttonComponent from "../elements/button-component";
import { required, numeric, maxLength } from "vuelidate/lib/validators";

export default {
	data () {
		return {
			project: {
				type: 0,
				engagement_code: "",
				project_name: "",
				abbreviation: "",
			},
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			valid: false,
			submitted: false
		}
	},
	components: {
		buttonComponent
	},
	validations: {
		project: {
			engagement_code: { required, numeric },
			project_name: { required },
			abbreviation: { required, maxLength: maxLength(10) }
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
        }
	}
}
</script>