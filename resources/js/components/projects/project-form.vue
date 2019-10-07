<template lang="pug">
	.project-form
		form(:action="submiturl", method="post", @submit="handleSubmit")
			input(type="hidden", name="_token", :value="csrf")
			input(type="hidden", name="type", :value="type")
			input(type="hidden", name="status", v-if="type =='engagement'", :value="projectData.status.value")
			input(type="hidden", name="_method", value="PUT", v-if="projectData.id > 0")
			input(type="hidden", name="id", :value="projectData.id", v-if="projectData.id > 0")

			.form-group.cf
				.row
					.col-md-4
						label(for="engagement-code") Engagement Code
					
					.col-md-6(:class="{ 'form-error': submitted && $v.projectData.$anyError }")
						input#engagement-code.form-control(type="text", name="engagement_code", v-model="projectData.engagement_code", :class="{ 'is-invalid': submitted && $v.projectData.engagement_code.$error }")

						.invalid-feedback(v-if="submitted && $v.projectData.engagement_code.$error")
							span(v-if="!$v.projectData.engagement_code.required") Engagement code is required
							span(v-if="!$v.projectData.engagement_code.numeric") Engagement code must be a number

			.form-group.cf(v-if="type =='engagement'")
				.row
					.col-md-4
						label(for="client-name") Client Name
					
					.col-md-6(:class="{ 'form-error': submitted && $v.projectData.$anyError }")
						textarea#client-name.form-control(name="client_name", v-model="projectData.client_name", rows="3" :class="{ 'is-invalid': submitted && $v.projectData.client_name.$error }")
						.invalid-feedback(v-if="submitted && !$v.projectData.client_name.required") Client Name is required
				
			.form-group.cf(v-if="type =='engagement'")
				.row
					.col-md-4
						label(for="project-name") Project
					
					.col-md-6(:class="{ 'form-error': submitted && $v.projectData.$anyError }")
						textarea#project-name.form-control(name="project_name", v-model="projectData.project_name", rows="3" :class="{ 'is-invalid': submitted && $v.projectData.project_name.$error }")
						.invalid-feedback(v-if="submitted && !$v.projectData.project_name.required") Project Name is required

			.form-group.cf(v-else-if="type =='authorised-project'")
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
					
					.col-md-6(:class="{ 'form-error': submitted && $v.projectData.$anyError }")
						input#abbreviation.form-control(type="text", name="abbreviation", v-model="projectData.abbreviation", :class="{ 'is-invalid': submitted && $v.projectData.abbreviation.$error }")
						.invalid-feedback(v-if="submitted && $v.projectData.abbreviation.$error")
							span(v-if="!$v.projectData.abbreviation.required") Abbreviation is required
							span(v-if="!$v.projectData.abbreviation.maxLength") Abbreviation must have a maximum of 10 characters

			.form-group.cf(v-if="type =='engagement'")
				.row
					.col-md-4
						label(for="status") Status
					
					.col-md-6(:class="{ 'form-error': submitted && $v.projectData.$anyError }")
						v-select(:value="projectData.status" label="label" :options="options" @input="setSelected")
						.invalid-feedback(v-if="submitted && !$v.projectData.status.required") Status is required

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
			],
			projectData: this.project
		}
	},
	props: {
		project: {
			type: Object,
			default: () => ({
				id: 0,
				engagement_code: "",
				client_name: "",
				project_name: "",
				abbreviation: "",
				status: {
					type: Object,
					default: () => ({
						value: null,
						label: ""
					})
				}
			})
		},
		submiturl: {
			type: String,
			default: '/project'
		},
		type: {
			type: String,
			default: 'engagement'
		}
	},
	components: {
		buttonComponent,
		vSelect
	},
	validations: {
		projectData: {
			engagement_code: { required, numeric },
			client_name: { required },
			project_name: { required },
			abbreviation: { required, maxLength: maxLength(10) },
			status: { required }
		}
	},
	beforeMount() {
		if(typeof this.project.status == "string") {
			var selected = this.options.filter(opt => {
				return opt['value'] == this.project.status
			});

			this.project.status = selected[0];
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
			this.projectData.status = value;
		}
	}
}
</script>