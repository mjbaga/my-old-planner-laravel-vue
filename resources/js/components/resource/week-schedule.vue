<template lang="pug">
	.week-schedule
		.half-box
			ul.weekdays
				li Monday
				li Tuesday
				li Wednesday
				li Thursday
				li Friday
		.resource-row(v-for="user in resources")
			.box
				ul.weekdays
					li(v-for="day in weekDates")
						| {{ day.format('MMM D YYYY') }}

</template>
<script>
import moment from 'moment';

export default {
	data() {
		return {
			weekDates: []
		}
	},
	created() {
		this.setDays();
	},
	props: {
		resources: {
			type: Array,
			default: []
		},
		startDate: {
			type: Object,
			default: () => {
				return moment().startOf('week');
			}
		}
	},
	methods: {
		setDays() {
			for(var i = 1; i <= 5; i++) {
				var day = this.startDate.clone();
				day.add(i,'d');
				this.weekDates.push(day);
			}
		}
	}
}
</script>