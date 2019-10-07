<template lang="pug">
	.resources
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
					.col-md-3
						h4 Name
					.col-md-3
						h4 Title
					.col-md-3
						h4 Planned Leaves

			li(v-for="item in listing")
				.row
					.col-md-2
						p {{ item.full_name }}
					.col-md-3
						p {{ item.title.title }}
					.col-md-4
						//- p {{ item.project_name }}
					.col-md-3
						.button-group
							a.btn(:href="'/user/edit/' + item.slug") Edit
							form.inblock(:action="'/user/' + item.id", method="post", @submit="handleDelete")
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
            
			axios.get('/api/resources').then((response) => {
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