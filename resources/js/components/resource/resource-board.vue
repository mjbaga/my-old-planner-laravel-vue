<template lang="pug">
	.resource-board
		.filter
			.row
				.col-md-3
					form.filter-form
						input(type="hidden", name="title_id", :value="title_id.id")
						v-select(label="title" :options="titles" @input="setSelected" placeholder="All")
				.col-md-9
					ul.legend
						li
							.color-box
								.color.light-blue
							.text
								| Engagement
						li
							.color-box
								.color.yellow
							.text
								| Written-off Engagement
						li
							.color-box
								.color.light-green
							.text
								| Pending Engagement
						li
							.color-box
								.color.purple
							.text
								| Authorised Project
						li
							.color-box
								.color.red
							.text
								| Leave / Public Holiday
		.board
			.resources
				.box
				ul
					li.box(v-for="user in resources")
						.image-container(v-if="user.image != ''")
							img(:src="'/images/users/' + user.image", :alt="user.first_name + ' ' + user.last_name")
						.text-container
							h3.name {{ user.first_name }}
							span.title {{ user.title.title }}
			.week
				.half-box
					p September 2
				week-schedule(:title="title_id.title" :resources="resources" :startDate="thisMonday")
			.week
				.half-box
					p September 9
				week-schedule(:title="title_id.title" :resources="resources" :startDate="nextMonday")

</template>
<script>
import vSelect from 'vue-select';
import weekSchedule from './week-schedule';
import moment from 'moment';

export default {
	data () {
		return {
			resources: [],
			title_id: {
				type: Object,
				default: () => ({
					"id": 0,
					"title": "Select Title"
				})
			}
		}
	},
	created () {
        this.fetch();
	},
	props: {
		thisMonday: {
			type: Object,
			default: ()=> {
				return moment().startOf('week');
			}
		},
		nextMonday: {
			type: Object,
			default: ()=> {
				return moment().add(7,'d').startOf('week');
			}
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
		vSelect,
		weekSchedule
	},
	methods: {
		fetch(){
			const axios = require('axios');
            
			axios.get('/api/resources').then((response) => {
				this.resources = response.data;
			});
		},
		setSelected(value) {
			this.title_id = value;

			console.log(this.title_id.title);
		},
		loadComponent(e) {
			var $weekComponent = new Vue('week-schedule');

			this.$refs['board'].append($weekComponent);
		}
	}
}
</script>