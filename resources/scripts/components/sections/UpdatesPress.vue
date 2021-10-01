<template>
	<section class=" min-h-screen bg-gray-100 pb-10" id="filter-section">
		<div class="container">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 py-10">
				<div
					class="select-container border-2 rounded-lg p-3 px-4 inline-flex items-center bg-white">
					<label for="sort" class="text-gray-500 text-base font-medium">Sort:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="sort"
						:options="sort_options"
						v-model="sort"
					></v-select>
				</div>
				<div
					class="select-container border-2 rounded-lg p-3 px-4 inline-flex items-center bg-white">
					<label for="type" class="text-gray-500 text-base font-medium">Category:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="type"
						:options="category_options"
						v-model="category"
					></v-select>
				</div>
				<div
					class="border-2 rounded-lg p-3 px-4 inline-flex items-center bg-white border-themeBrown"
				>
					<input id="search" type="text" placeholder="Type here" v-model="keywords" class="border-0 w-full outline-none font-medium">
					<svg-vue icon="search-dark" width="18" height="18" class="fill-current text-white"></svg-vue>
				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-10 gap-x-7 my-10" v-if="updates && updates.length>0">
				<a :href="item.link" v-for="(item, i) in updates" :key="i">
					<div class="press-card">
						<h3 class="font-black text-2xl leading-tight mb-4">{{ item.title }}</h3>
						<div class="mb-6" v-html="item.excerpt"></div>
						<div class="mt-auto">
							<span class="text-gray-400  w-full inline-block">{{ item.date }}</span>
							<span class="mt-1 w-full inline-block" 
								v-html="item.categories.length
								? item.categories.map((el) => el.name).join(', ')
								: ''">
							</span>
							<a :href="item.link" class="text-themeGreen text-xl font-black underline mt-11 inline-block">Continue Reading</a>
						</div>
					</div>
				</a>
			</div>
			<div v-else-if="isLoaded">
				<p>No data found</p>
			</div>

			<div class="w-full inline-flex justify-center pt-10 mb-24" v-if="nextPage">
				<button class="bg-white border-2 border-themeGreen px-16 py-5 rounded-xl font-bold hover:shadow-2xl transition-shadow" @click="getData(++page)">Load More</button>
			</div>

		</div>
	</section>
</template>
<script>
import {
  ITSHelpers
} from "../../utils/ITSUtilities";
export default {
	props:["sorting","keys","cat"],
	data() {
		return {
			eventKey:null,
			keywords:'',
			category:'',
			nextPage:false,
			updates:[],
			isLoaded:false,
			sort:{
				label: 'Latest First',
				key: 'latest',
			},
			category_options:[],
			page:1,
			sort_options: [
				{
					label: 'Latest First',
					key: 'latest',
				},
				{
					label: 'Oldest First',
					key: 'oldest',
				},
				{
					label: 'Featured',
					key: 'featured',
				},
			],
		};
	},
	methods: {
        getData(page) {
			this.isLoaded = false;
            let formData = {
                page: page,
                perpage: 6,
                language: this.$settings.language,
            };
			if (this.category) {
                formData.categories = this.category.key;
			}
			if (this.sort) {
                formData.sortby = this.sort.key;
			}
			if (this.keywords != '') {
                formData.keywords = this.keywords;
			}
            this.$api.Posts.getUpdates(formData).then(({ data }) => {
                this.updates.push(...data.posts);
				this.nextPage = data.nextPage;
				const url = new URL(window.location);
				if (this.category)
					url.searchParams.set('cat', this.category.key);
				if (this.keywords != '')
					url.searchParams.set('keywords', this.keywords);
				if (this.sort)
					url.searchParams.set('sort', this.sort.key);
				window.history.pushState({}, '', url);
				this.isLoaded = true;
            });
        },
		getCategories() {
			let formData = {
                language: this.$settings.language,
            };
			return this.$api.Posts.getCategories(formData).then(({ data }) => {
				this.category_options.push(...data);
			});
		},
		submitFilter() {
			this.updates=[];
			this.page = 1;
			this.getData(this.page);
		},
		getDefaultData() {
			if (this.cat) {
				let hasCat = this.category_options.filter(v=>{
					return v.key == this.cat;
				});
				if (hasCat) {
					this.category = hasCat[0];
				}
			}

			if (this.keys) {
				this.keywords = this.keys;
			}

			if (this.sorting) {
				let hasSort = this.sort_options.filter(v=>{
					return v.key == this.sorting;
				});

				if (hasSort) {
					this.sort = hasSort[0];
				}
			}
			this.getData(this.page);
			this.scrollToFilter();
		},
		scrollToFilter() {
            setTimeout(() => {
                ITSHelpers.scrollToElement("#filter-section");
            }, 800);
        }
    },
	watch:{
		keywords() {
			if (!this.isLoaded) return;
			clearTimeout(this.eventKey);
			this.eventKey = setTimeout(() => {
				this.submitFilter();
			}, 1000);
		},
		sort() {
			if (!this.isLoaded) return;
			this.submitFilter();
		},
		category() {
			if (!this.isLoaded) return;
			this.submitFilter();
		}
	},
	async created() {
		await this.getCategories().then(()=> {
			let param = ITSHelpers.getParam(window.location.href);
			if (param.hasOwnProperty("keywords") || param.hasOwnProperty("sort") || param.hasOwnProperty("cat")) {
				this.getDefaultData();
			}else{
				this.getData(this.page);
			}
		});
    },
};
</script>
<style lang="scss">
.press-card {
	@apply flex flex-col h-full border-2 border-themeBlue p-7 rounded-lg border-opacity-0 hover:border-opacity-100 hover:shadow-2xl bg-white transition-shadow
}
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
.select  .vs__dropdown-toggle
{
  background: none;
  border: none;
  color: #000;
  text-transform: lowercase;
  font-variant: small-caps;
}
.select  .vs__clear,
.select  .vs__open-indicator {
  fill: #394066;
}
</style>
