<template lang="pug">
	.title-list.right-pane
		.message
			.alert
				.alert-success(role="alert", v-if="success != ''")
					| {{ success }}
			.alert
				.alert-error(role="alert", v-if="errors.length")
					li(v-for="error in errors")
						|| {{ error }}
		ul.titles
			li(v-for="item in listing")
				form(:action="'/titles/' + item.id", method="post", @submit="handleDelete")
					input(type="hidden", name="_token", :value="csrf")
					input(type="hidden", name="_method", value="delete")
					input(type="text", name="title", :value="item.title", disabled)
					button.btn.btn-delete(
						type="submit",
						v-confirm="{ loader: true, ok: okCallback, message: 'Are you sure you want to delete?' }"
					) Delete
		span
		.form-container(ref="container")

		button-component(:className="'add-title'", @click="addTitle") Add Title
</template>
<script>
import buttonComponent from "../elements/button-component";
import titleForm from "./title-form";
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';

export default {
	data () {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			listing : [],
			adding: false
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
		buttonComponent,
		titleForm
	},
	methods : {
		fetch(){
			const axios = require('axios');
            
			axios.get('/api/titles').then((response) => {
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
		},
		addTitle(){
			if(!this.adding) {
				this.adding = true; // so as to not be able to add another form

				var ComponentClass = Vue.extend(titleForm);
				var instance = new ComponentClass();
				instance.$mount();

				this.$refs.container.appendChild(instance.$el);
			}
		}
	}
}
</script>