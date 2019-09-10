<template lang="pug">
	.project-form
		.container
			h2 Create a new project
			form(action="/projects/create", method="post")
				.form-group
					label(for="projectName") Project name
					input#projectName.form-control(type="text")
</template>
<script>
export default {

}
</script>