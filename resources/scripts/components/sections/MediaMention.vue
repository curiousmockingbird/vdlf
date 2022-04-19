<template>
	<section class=" min-h-screen bg-gray-100 pb-10 relative" id="filter-section">
		<img :src="$images + '/services-circles.png'" class="absolute -top-96 -right-96 bg-circle z-0" />
		<div class="container relative">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 py-10">
				<div
					class="select-container">
					<label for="month" class="text-gray-500 text-base font-medium">{{$settings.label.month}}:</label>
					<v-select
						class="select w-full font-medium"
						id="month"
						:options="month_options"
						v-model="month"
					></v-select>
				</div>
				<div
					class="select-container">
					<label for="year" class="text-gray-500 text-base font-medium">{{$settings.label.year}}:</label>
					<v-select
						class="select w-full font-medium"
						id="year"
						:options="year_options"
						v-model="year"
					></v-select>
				</div>
				<div
					class="select-container">
					<label for="topic" class="text-gray-500 text-base font-medium">{{$settings.label.topic}}:</label>
					<v-select
						class="select w-full font-medium"
						id="topic"
						:options="topic_options"
						v-model="topic"
					></v-select>
				</div>
				<div
					class="input-keywords"
				>
					<label for="keywords" class="pl-0 text-gray-500 text-base font-medium">{{ $settings.label.type_here }}</label>
					<div class="inline-flex items-center w-full pr-3">
						<input id="search" type="text" placeholder="......................." v-model="keywords" class="pl-3 border-0 w-full outline-none font-medium">
						<svg-vue icon="search-dark" width="18" height="18" class="fill-current text-white"></svg-vue>
					</div>
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-10 gap-x-7 my-5" v-if="updates && updates.length>0">
				<a :href="item.link?item.link:'#'" target="_blank" v-for="(item, i) in updates" :key="i" class="mention-card">
					<div class="p-7">
						<span class="my-2 w-full inline-block font-bold tracking-wider leading-normal" 
							v-html="item.categories.length
							? item.categories.map((el) => {
								if (el.name.toLowerCase().includes('tv'))
									return `<label style='color:#A0643D'>${el.name}</label>`;
								else
									return `<label style='color:#397894'>${el.name}</label>`;
							}).join(', ')
							: ''">
						</span>
						<h3 class="font-bold text-2xl leading-tight">{{ item.title }}</h3>
						<span class="text-gray-400 font-display w-full inline-block mt-1 mb-4">{{ item.date }}</span>
						<div class="mb-2 font-display text-base text-black" v-html="item.excerpt"></div>
					</div>
					<button class="text-left text-black py-8 px-7 rounded-b-md bg-themeBlue text-white mt-auto font-bold underline text-xl block">{{ $settings.label.continue_reading }}</button>
				</a>
			</div>
			<div v-else-if="isLoaded" class="p-5">
				<p>{{ $settings.label.no_data_found }}</p>
			</div>

			<div class="w-full inline-flex justify-center py-16" v-if="nextPage">
				<button class="more-press" @click="getData(++page)">{{ $settings.label.load_more }}</button>
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
			month:null,
			year:null,
			nextPage:false,
			updates:[],
			isLoaded:false,
			topic:null,
			month_options:[],
			year_options:[],
			page:1,
			topic_options: [],
		};
	},
	methods: {
        getData(page) {
			this.isLoaded = false;
            let formData = {
                page: page,
                perpage: 6,
                // year: this.$settings.year,
            };
			if (this.month) {
                formData.month = this.month.key;
			}
			if (this.topic) {
                formData.taxonomy = "topic";
				formData.categories = this.topic.key;
			}
			if (this.year) {
                formData.year = this.year.key;
			}
			if (this.keywords != '') {
                formData.keywords = this.keywords;
			}
            this.$api.Posts.getMentions(formData).then(({ data }) => {
                this.updates.push(...data.posts);
				this.nextPage = data.nextPage;
				const url = new URL(window.location);
				if (this.month)
					url.searchParams.set('select_month', this.month.key);
				else
					url.searchParams.delete('select_month');

				if (this.keywords && this.keywords != '')
					url.searchParams.set('keywords', this.keywords);
				else
					url.searchParams.delete('keywords');

				if (this.topic)
					url.searchParams.set('topic', this.topic.key);
				else
					url.searchParams.delete('topic');

				if (this.year)
					url.searchParams.set('select_year', this.year.key);
				else
					url.searchParams.delete('select_year');
					
				window.history.pushState({}, '', url);
				this.isLoaded = true;
            });
        },
		getTopic() {
			let formData = {
                language: this.$settings.language,
            };
			return this.$api.Posts.getTopic(formData).then(({ data }) => {
				data.forEach((item) => {
					let newItem = {
						key:item.key,
						label:item.label.replace(/&amp;/g, '&')
					}
					this.topic_options.push(newItem);
				})
			});
		},
		getYear() {
			let currentYear = new Date().getFullYear();
			for (let i=currentYear; i>=currentYear-2; i--) {
				this.year_options.push({
					"key":i,
					"label":i
				})
			}
		},
		getMonth() {
			this.month_options= [
				{"key": "01", "label": this.$settings.label.january},
				{"key": "02", "label": this.$settings.label.february},
				{"key": "03", "label": this.$settings.label.march},
				{"key": "04", "label": this.$settings.label.april},
				{"key": "05", "label": this.$settings.label.may},
				{"key": "06", "label": this.$settings.label.june},
				{"key": "07", "label": this.$settings.label.july},
				{"key": "08", "label": this.$settings.label.august},
				{"key": "09", "label": this.$settings.label.september},
				{"key": "10", "label": this.$settings.label.october},
				{"key": "11", "label": this.$settings.label.november},
				{"key": "12", "label": this.$settings.label.december},
			];
		},
		submitFilter() {
			this.updates=[];
			this.page = 1;
			this.getData(this.page);
		},
		getDefaultData() {
			let param = ITSHelpers.getParam(window.location.href);
			if (param.hasOwnProperty("select_month")) {
				let hasMonth = this.month_options.filter(v=>{
					return v.key == param.select_month;
				});
				if (hasMonth) {
					this.month = hasMonth[0];
				}
			}

			if (param.hasOwnProperty("topic")) {
				let hasTopic = this.topic_options.filter(v=>{
					return v.key == param.topic;
				});

				if (hasTopic) {
					this.topic = hasTopic[0];
				}
			}

			if (param.hasOwnProperty("select_year")) {
				let hasYear = this.year_options.filter(v=>{
					return v.key == param.select_year;
				});

				if (hasYear) {
					this.year = hasYear[0];
				}
			}

			if (param.hasOwnProperty("keywords")) {
				this.keywords = param.keywords;
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
		topic() {
			if (!this.isLoaded) return;
			this.submitFilter();
		},
		month() {
			if (!this.isLoaded) return;
			this.submitFilter();
		},
		year() {
			if (!this.isLoaded) return;
			this.submitFilter();
		}
	},
	created() {
		this.getYear();
		this.getMonth();
		this.getTopic().then(()=>{
			let param = ITSHelpers.getParam(window.location.href);
			if (param.hasOwnProperty("keywords") || param.hasOwnProperty("topic") || param.hasOwnProperty("select_month") || param.hasOwnProperty("select_year")) {
				this.getDefaultData();
			}else{
				this.getData(this.page);
			}
		});
    },
};
</script>
<style lang="scss">
.mention-card {
	@apply cursor-pointer flex flex-col h-full rounded-lg border-3 border-themeBlue bg-white rounded-xl;
	&:hover {
		@apply bg-gradient-to-b from-primary to-secondary text-white border-gray-100 #{!important};
		h3, span, button, label, div {
			color:#FFF !important;
			background-color: transparent !important;
		}
	}
}
</style>
