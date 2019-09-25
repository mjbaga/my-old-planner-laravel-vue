<template lang="pug">
	.project-form
		.container
			h2 Create a new project
			form(action="/projects/create", method="post", @submit="handleSubmit")
				.form-group
					label(for="type") Type
					select#type.form-control(name="type", v-model="project.type")
						option(value="0") Choose a type
						option(value="1") Chargeable
						option(value="2") Authorized Project
						option(value="3") Non-chargeable
				.form-group
					label(for="engagement-code") Engagement Code
					input#engagement-code.form-control(type="number", name="engagement-code", v-model="project.engagementCode", :class="{ 'is-invalid': submitted && $v.project.engagementCode.$error }")
					.invalid-feedback(v-if="submitted && !$v.project.engagementCode.$error")
						span(v-if="!$v.project.engagementCode.required") Engagement code is required
						span(v-if="!$v.project.engagementCode.numeric") Engagement code must be a number
				.form-group
					label(for="engagement-name") Engagement Name
					input#engagement-name.form-control(type="text", name="engagement-name", v-model="project.engagementName", :class="{ 'is-invalid': submitted && $v.project.engagementName.$error }")
					.invalid-feedback(v-if="submitted && !$v.project.engagementName.required") Engagement Name is required
				.form-group
					label(for="client-name") Client Name
					input#client-name.form-control(type="text", name="client-name", v-model="project.clientName", :class="{ 'is-invalid': submitted && $v.project.clientName.$error }")
					.invalid-feedback(v-if="submitted && !$v.project.clientName.required") Client Name is required
				
				input.btn.btn-primary(type="submit" value="Submit")
</template>
<script>
import { required, numeric } from "vuelidate/lib/validators";

export default {
	data () {
		return {
			project: {
				type: 0,
				engagementCode: "",
				engagementName: "",
				clientName: "",
			},
			valid: false,
			submitted: false
		}
	},
	validations: {
		project: {
			type: { required },
			engagementCode: { required, numeric },
			engagementName: { required },
			clientName: { required }
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