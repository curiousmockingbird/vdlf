<template>
	<section class=" min-h-screen bg-gray-100">

		<div class="container">
			<div class="grid grid-cols-5 gap-4 py-10">
				<div
					class="select-container border-2 rounded-lg p-3 px-4 inline-flex items-center bg-white"
					v-for="(filter, i) in filters"
					:key="i"
				>
					<label :for="filter.name" class="text-gray-500 text-base font-medium">{{ filter.name }}:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						:id="filter.name"
						
						:options="filter.options"
					></v-select>
				</div>
				<div
					class="border-2 rounded-lg p-3 px-4 inline-flex items-center bg-white border-themeBrown"
					
				>
					<input id="search" type="text" placeholder="Type here" class="border-0 outline-none font-medium">
					<svg-vue icon="search-dark" width="18" height="18" class="fill-current text-white"></svg-vue>
				</div>
			</div>

			<div class="grid grid-cols-3 gap-y-10 gap-x-7 my-10">
				<a href="#" v-for="(v, i) in 10" :key="i">
					<div class="border-2 border-themeBlue p-7 rounded-lg border-opacity-0 hover:border-opacity-100 hover:shadow-2xl bg-white transition-shadow">
						<h3 class="font-black text-2xl leading-tight mb-4">Immigrants: The Unsung Heroes of the Pandemic</h3>
						<p class="mb-6">ESPAÑOL ABAJO By Christine Neumann-Ortiz Labor Day is a day that we honor the contributions of working people. This Labor Day, in the midst of a global pandemic, it is only fitting that we take time to honor...</p>
						<span class="text-gray-400  w-full inline-block">September 7, 2021</span>
						<span class="mt-1 w-full inline-block">Immigration Reform, News, Noticias, Press Releases</span>
						<a href="#" class="text-themeGreen text-xl font-black underline mt-11 inline-block">Continue Reading</a>
					</div>
				</a>

			</div>

			<div class="w-full inline-flex justify-center pt-10 mb-24">
				<button class="bg-white border-2 border-themeGreen px-16 py-5 rounded-xl font-bold hover:shadow-2xl transition-shadow">Load More</button>
			</div>

		</div>
	</section>
</template>
<script>
export default {
	data() {
		return {
			filters: [
				{
					name: 'Sort',
					options: [
						{
							label: 'Latest First',
							key: 'latest-first',
						},
						{
							label: 'Oldest First',
							key: 'latest-first',
						},
					],
				},
				{
					name: 'Type',
					options: [
						{
							label: 'Latest First',
							key: 'latest-first',
						},
						{
							label: 'Oldest First',
							key: 'latest-first',
						},
					],
				},
				{
					name: 'Time',
					options: [
						{
							label: 'Latest First',
							key: 'latest-first',
						},
						{
							label: 'Oldest First',
							key: 'latest-first',
						},
					],
				},
				{
					name: 'Lang',
					options: [
						{
							label: 'Latest First',
							key: 'latest-first',
						},
						{
							label: 'Oldest First',
							key: 'latest-first',
						},
					],
				},
			],
		};
	},
};
</script>
<style lang="scss">
.select-container{
	&:nth-child(1){
		@apply border-themeBlue;
	}
	&:nth-child(2){
		@apply border-themeMagenta;
	}
	&:nth-child(3){
		@apply border-themeRed;
	}
	&:nth-child(4){
		@apply border-themeBrown;
	}
}
.select  .vs__search::placeholder,
.select  .vs__dropdown-toggle,
{
  background: none;
  border: none;
  color: #000;
  text-transform: lowercase;
  font-variant: small-caps;
}
// .select  .vs__dropdown-menu {
// 	background: #394066;
// 	color: #fff;
// }

.select  .vs__clear,
.select  .vs__open-indicator {
  fill: #394066;
}
</style>
</style>
