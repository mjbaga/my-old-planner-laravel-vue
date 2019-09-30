<template lang="pug">
	.project-form
		.container
			form(action="/project/create", method="post", @submit="handleSubmit")
				input(type="hidden", name="_token", :value="csrf")
				input(type="hidden", name="type", value="authorised-project")
				input(type="hidden", name="status", :value="project.status.value")

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
							label(for="client-name") Client Name
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							textarea#client-name.form-control(name="client_name", v-model="project.client_name", rows="3" :class="{ 'is-invalid': submitted && $v.project.client_name.$error }")
							.invalid-feedback(v-if="submitted && !$v.project.client_name.required") Client Name is required
					
				.form-group.cf
					.row
						.col-md-4
							label(for="project-name") Project
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							textarea#project-name.form-control(name="project_name", v-model="project.project_name", rows="3" :class="{ 'is-invalid': submitted && $v.project.project_name.$error }")
							.invalid-feedback(v-if="submitted && !$v.project.project_name.required") Project Name is required

				.form-group.cf
					.row
						.col-md-4
							label(for="abbreviation") Abbreviation
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							input#abbreviation.form-control(type="text", name="abbreviation", v-model="project.abbreviation", :class="{ 'is-invalid': submitted && $v.project.abbreviation.$error }")
							.invalid-feedback(v-if="submitted && $v.project.abbreviation.$error")
								span(v-if="!$v.project.abbreviation.required") Abbreviation is required
								span(v-if="!$v.project.abbreviation.maxLength") Abbreviation must have a maximum of 10 characters

				.form-group.cf
					.row
						.col-md-4
							label(for="status") Status
						
						.col-md-6(:class="{ 'form-error': submitted && $v.project.$anyError }")
							v-select(v-model="project.status" label="label" :options="options")
							.invalid-feedback(v-if="submitted && !$v.project.status.required") Status is required

				.form-group.form-submit.cf
					.row
						.offset-md-4.col-md-6
							a.btn.mright_5(href="settings/authorised-projects") Cancel
							button-component(:className="'btn-save btn__blue'", :type="'submit'") Save
</template>
<script>
import buttonComponent from "../elements/button-component";
import { required, numeric, maxLength } from "vuelidate/lib/validators";
import vSelect from 'vue-select';

export default {
	data () {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			valid: false,
			submitted: false,
			options: [
				{ 
					value: 'engagement',
					label: 'Engagement'
				},
				{ 
					value: 'write-off-engagement',
					label: 'Write-off Engagement'
				},
				{ 
					value: 'pending-engagement',
					label: 'Pending Engagement'
				}
			]
		}
	},
	props: {
		project: {
			type: Object,
			default: {
				type: 0,
				engagement_code: "",
				client_name: "",
				project_name: "",
				abbreviation: "",
				status: ""
			}
		}
	},
	components: {
		buttonComponent,
		vSelect
	},
	validations: {
		project: {
			engagement_code: { required, numeric },
			client_name: { required },
			project_name: { required },
			abbreviation: { required, maxLength: maxLength(10) },
			status: { required },
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