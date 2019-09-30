<template lang="pug">
	.auth-project-list.right-pane
		.message
			.alert
				.alert-success(role="alert", v-if="success != ''")
					| {{ success }}
			.alert
				.alert-error(role="alert", v-if="errors.length")
					li(v-for="error in errors")
						|| {{ error }}
		ul.project-list
			li.heading
				.row
					.col-md-2
						h4 Engagement Code
					.col-md-3
						h4 Client Name
					.col-md-4
						h4 Project

			li(v-for="item in listing")
				.row
					.col-md-2
						p {{ item.engagement_code }}
					.col-md-3
						p {{ item.client_name }}
					.col-md-4
						p {{ item.project_name }}
					.col-md-3
						.button-group
							a.btn(:href="'/project/edit/' + item.slug") Edit
							form.inblock(:action="'/project/' + item.id", method="post", @submit="handleDelete")
								input(type="hidden", name="_token", :value="csrf")
								input(type="hidden", name="_method", value="delete")
								button.btn.btn-delete(
									type="submit",
									v-confirm="{ loader: true, ok: okCallback, message: 'Are you sure you want to delete?' }"
								) Delete
</template>
<script>
import buttonComponent from "../elements/button-component";

export default {
	data () {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			listing : []
		}
	},
	created () {
        this.fetch();
	},
	props: {
		errors: {
			type: Array,
			default: []
		},
		success: {
			default: ''
		}
	},
	components: {
		buttonComponent
	},
	methods : {
		fetch(){
			const axios = require('axios');
            
			axios.get('/api/engagements').then((response) => {
				this.listing = response.data;
			});
		}
	}
}
</script>