<template lang="pug">
	.resources
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
							a.btn(:href="'/user/'+ item.slug +'/edit'") Edit
							form.inblock(:action="'/user/' + item.id", method="post", @submit="handleDelete")
								input(type="hidden", name="_token", :value="csrf")
								input(type="hidden", name="_method", value="delete")
								button.btn.btn-delete(type="submit") Delete
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
            
			axios.get('/api/resources').then((response) => {
				this.listing = response.data;
			});
		},
		handleDelete(e){
            e.preventDefault();

            this.$dialog
				.confirm('Are you sure you want to delete this user?')
				.then(function(dialog) {
					e.target.submit();
				})
				.catch(function() {
					e.preventDefault();
				});
		}
	}
}
</script>