<template>
	<section class=" min-h-screen">
		<!-- <div class="container px-2"> -->
		<!-- <div class="">
				<h3>Contentn filter</h3>
			</div>

			<div class="">
				<div class="grid grid-cols-3 gap-4">
					<div class="item" v-fog="(v, i) in 10" :key="i">
						<h2>Title</h2>
						<p>Description</p>
						<span class="date">September 7, 2021</span>
						<span class="tags"
							>Immigration, Reform, Newsm Noticias, Press Release</span
						>
						<a href="continue-reading">Continue Reading</a>
					</div>
				</div>
			</div>
		</div> -->

		<div class="container">
			<div class="content-filters">
				<v-select
					label="countryName"
					:options="['test', 'test23']"
				></v-select>
			</div>
		</div>
	</section>
</template>
<script>
export default {};
</script>
