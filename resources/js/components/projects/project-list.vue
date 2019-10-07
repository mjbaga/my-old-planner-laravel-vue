<template lang="pug">
	.auth-project-list.right-pane
		ul.project-list
			li.heading
				.row
					.col-md-2
						h4 Engagement Code
					.col-md-6(v-if="type =='authorised-project'")
						h4 Authorised Project
					.col-md-3(v-if="type =='engagement'")
						h4 Client Name
					.col-md-4(v-if="type =='engagement'")
						h4 Project

			li(v-for="item in listing")
				.row
					.col-md-2
						p {{ item.engagement_code }}
					.col-md-7(v-if="type =='authorised-project'")
						p {{ item.project_name }}
					.col-md-3(v-if="type =='engagement'")
						p {{ item.client_name }}
					.col-md-4(v-if="type =='engagement'")
						p {{ item.project_name }}
					.col-md-3
						.button-group
							a.btn(:href="'/project/edit/' + item.engagement_code") Edit
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
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';

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
		type: {
			type: String,
			default: 'engagement'
		}
	},
	components: {
		buttonComponent
	},
	methods : {
		fetch(){
			const axios = require('axios');

			var apiUrl = '/api/' + this.type + 's';
            
			axios.get(apiUrl).then((response) => {
				this.listing = response.data;
			});
		},
		handleDelete(){
            this.$dialog
				.confirm('Please confirm to continue')
				.then(function(dialog) {
					this.dialog.close();
				})
				.catch(function() {
					e.preventDefault();
				});
		}
	}
}
</script>