<template>
	<section class=" min-h-screen bg-gray-100 pb-10" id="filter-section">
		<div class="container">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 py-10">
				<div
					class="select-container border-2 rounded-lg py-3 pl-3 inline-flex items-center bg-white">
					<label for="sort" class="text-gray-500 text-base font-medium">Sort:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="sort"
						:options="sort_options"
						v-model="sort"
					></v-select>
				</div>
				<div
					class="select-container border-2 rounded-lg py-3 pl-3 inline-flex items-center bg-white">
					<label for="category" class="text-gray-500 text-base font-medium">Category:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="category"
						:options="category_options"
						v-model="category"
					></v-select>
				</div>
				<div
					class="select-container border-2 rounded-lg py-3 pl-3 inline-flex items-center bg-white">
					<label for="language" class="text-gray-500 text-base font-medium">Language:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="language"
						:options="language_options"
						v-model="language"
					></v-select>
				</div>
				<div
					class="border-2 rounded-lg py-3 px-3 inline-flex items-center bg-white border-themeBrown"
				>
					<input id="search" type="text" placeholder="Type here" v-model="keywords" class="border-0 w-full outline-none font-medium">
					<svg-vue icon="search-dark" width="18" height="18" class="fill-current text-white"></svg-vue>
				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-10 gap-x-7 my-10" v-if="updates && updates.length>0">
				<a :href="item.link?item.link:'#'" v-for="(item, i) in updates" :key="i" class="press-card">
					<div class="p-7">
						<span class="my-2 w-full inline-block font-bold tracking-wider leading-normal" 
							v-html="item.categories.length
							? item.categories.map((el) => {
								if (el.name.toLowerCase().includes('news'))
									return `<label style='color:#A0643D'>${el.name}</label>`;
								if (el.name.toLowerCase().includes('blog'))
									return `<label style='color:#337c4c'>${el.name}</label>`;
								if (el.name.toLowerCase().includes('press'))
									return `<label style='color:#871D3D'>${el.name}</label>`;
							}).join(', ')
							: ''">
						</span>
						<h3 class="font-bold text-2xl leading-tight">{{ item.title }}</h3>
						<span class="text-gray-400 font-display w-full inline-block mt-1 mb-4">{{ item.date }}</span>
						<div class="mb-2 font-display" v-html="item.excerpt"></div>
					</div>
					<button 
						class="text-left text-black py-8 px-7 rounded-b-md text-white mt-auto font-bold underline text-xl block"
						:style="styleButton(item)"
					>Continue Reading</button>
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
	data() {
		return {
			eventKey:null,
			keywords:'',
			category:'all',
			language:null,
			nextPage:false,
			updates:[],
			isLoaded:false,
			sort:{
				label: 'Latest First',
				key: 'latest',
			},
			category_options:[],
			language_options:[],
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
		styleButton(item) {
			let Element = item.categories[0].name;
			if (Element.toLowerCase().includes('news'))
				return `background-color:#A0643D`;
			else if (Element.toLowerCase().includes('blog'))
				return `background-color:#337c4c`;
			else (Element.toLowerCase().includes('press'))
				return `background-color:#871D3D`;
		},
        getData(page) {
			this.isLoaded = false;
            let formData = {
                page: page,
                perpage: 6,
                // language: this.$settings.language,
            };
			if (this.category && this.category !='all') {
                formData.categories = this.category.key;
			}
			if (this.sort) {
                formData.sortby = this.sort.key;
			}
			if (this.language) {
                formData.lang = this.language.key;
			}
			if (this.keywords != '') {
                formData.keywords = this.keywords;
			}
            this.$api.Posts.getUpdates(formData).then(({ data }) => {
                this.updates.push(...data.posts);
				this.nextPage = data.nextPage;
				const url = new URL(window.location);
				if (this.category && this.category !="all")
					url.searchParams.set('cat', this.category.key);
				if (this.keywords && this.keywords != '')
					url.searchParams.set('keywords', this.keywords);
				if (this.sort)
					url.searchParams.set('sort', this.sort.key);
				if (this.language)
					url.searchParams.set('lang', this.language.key);
					
				window.history.pushState({}, '', url);
				this.isLoaded = true;
            });
        },
		getCategories() {
			let formData = {
                language: this.$settings.language,
            };
      		this.category_options.push({"key":"all","label":"All"});
			return this.$api.Posts.getCategories(formData).then(({ data }) => {
				this.category_options.push(...data);
			});
		},
		getLanguage() {
			return this.$api.Posts.getLanguage().then(({ data }) => {
				this.language_options.push(...data);
			});
		},
		submitFilter() {
			this.updates=[];
			this.page = 1;
			this.getData(this.page);
		},
		getDefaultData() {
			let param = ITSHelpers.getParam(window.location.href);
			if (param.hasOwnProperty("cat")) {
				let hasCat = this.category_options.filter(v=>{
					return v.key == param.cat;
				});
				if (hasCat) {
					this.category = hasCat[0];
				}
			}

			if (param.hasOwnProperty("cat")) {
				let hasLang = this.language_options.filter(v=>{
					return v.key == param.lang;
				});
				if (hasLang) {
					this.language = hasLang[0];
				}
			}

			if (param.hasOwnProperty("cat")) {
				this.keywords = param.keys;
			}

			if (param.hasOwnProperty("sorting")) {
				let hasSort = this.sort_options.filter(v=>{
					return v.key == param.sorting;
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
		},
		language() {
			if (!this.isLoaded) return;
			this.submitFilter();
		}
	},
	created() {
		let _this = this;
		async function init() {
			await _this.getCategories();
			await _this.getLanguage();

			let param = ITSHelpers.getParam(window.location.href);
			if (param.hasOwnProperty("keywords") || param.hasOwnProperty("sort") || param.hasOwnProperty("lang") || param.hasOwnProperty("cat")) {
				_this.getDefaultData();
			}else{
				_this.getData(_this.page);
			}
		}

		init();
    },
};
</script>
<style lang="scss">
.press-card {
	@apply cursor-pointer flex flex-col h-full rounded-lg hover:shadow-2xl bg-white;
	&:hover {
		@apply bg-gradient-to-b from-primary to-secondary text-white;
		h3, span, button, label {
			color:#FFF !important;
			background-color: transparent !important;
		}
	}
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
