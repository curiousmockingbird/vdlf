<template>
	<section class=" min-h-screen bg-gray-100 pb-10" id="filter-section">
		<div class="container">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 py-10">
				<div
					class="select-container">
					<label for="sort" class="text-gray-500 text-base font-medium">Sort:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="sort"
						:options="sort_options"
						v-model="sort"
					></v-select>
				</div>
				<div
					class="select-container">
					<label for="category" class="text-gray-500 text-base font-medium">Category:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="category"
						:options="category_options"
						v-model="category"
					></v-select>
				</div>
				<div
					class="select-container">
					<label for="language" class="text-gray-500 text-base font-medium">Language:</label>
					<v-select
						class="select w-full ml-3 font-medium"
						id="language"
						:options="language_options"
						v-model="language"
					></v-select>
				</div>
				<div
					class="input-keywords pr-3"
				>
					<input id="search" type="text" placeholder="Type here" v-model="keywords" class="border-0 w-full outline-none font-medium">
					<svg-vue icon="search-dark" width="18" height="18" class="fill-current text-white"></svg-vue>
				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-10 gap-x-7 mt-2" v-if="updates && updates.length>0">
				<UpdatesCardNew
                v-for="(item, i) in updates"
                :key="i"
                :title="item.title"
                :excerpt="item.excerpt"
                :categories="item.categories"
                :date="item.date"
                :link="item.link ? item.link : '#'"
                moreLabel="Continue Reading"
            ></UpdatesCardNew>
			</div>
			<div v-else-if="isLoaded">
				<p>No data found</p>
			</div>

			<div class="w-full inline-flex justify-center py-16" v-if="nextPage">
				<button class="more-press" @click="getData(++page)">Load More</button>
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
				return `background-color:#A0643D; margin:-1.2px`;
			else if (Element.toLowerCase().includes('blog'))
				return `background-color:#337c4c; margin:-1.2px`;
			else (Element.toLowerCase().includes('press'))
				return `background-color:#871D3D; margin:-1.2px`;
		},
		styleBorder(item) {
			let Element = item.categories[0].name;
			if (Element.toLowerCase().includes('news'))
				return `border-color:#A0643D`;
			else if (Element.toLowerCase().includes('blog'))
				return `border-color:#337c4c`;
			else (Element.toLowerCase().includes('press'))
				return `border-color:#871D3D`;
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

			if (param.hasOwnProperty("keywords")) {
				this.keywords = param.keywords;
			}

			if (param.hasOwnProperty("sort")) {
				let hasSort = this.sort_options.filter(v=>{
					return v.key == param.sort;
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
		this.getCategories().then(()=>{
			this.getLanguage().then(()=> {
				let param = ITSHelpers.getParam(window.location.href);
				if (param.hasOwnProperty("keywords") || param.hasOwnProperty("sort") || param.hasOwnProperty("lang") || param.hasOwnProperty("cat")) {
					this.getDefaultData();
				}else{
					this.getData(this.page);
				}
			});
		});
    },
};
</script>
<style lang="scss">
.select-container,
.input-keywords{
	@apply border-themeRed border-3 rounded-lg py-3 pl-3 inline-flex items-center bg-white;
	// &:nth-child(1){
	// 	@apply border-themeBlue;
	// }
	// &:nth-child(2){
	// 	@apply border-themeMagenta;
	// }
	// &:nth-child(3){
	// 	@apply border-themeRed;
	// }
	// &:nth-child(4){
	// 	@apply border-themeBrown;
	// }
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
.more-press {
	@apply bg-white border-3 border-themeRed px-16 py-5 rounded-xl text-xl transition-shadow;
	&:hover {
		@apply bg-gradient-to-b from-primary to-secondary text-white border-gray-100 #{!important};
	}
}
</style>
