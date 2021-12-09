<template>
	<section class=" min-h-screen bg-gray-100 pb-10" id="filter-section">
		<div class="container">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-10 gap-x-7 my-10" v-if="updates && updates.length>0">
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
						<div class="mb-2 font-display" v-html="item.excerpt"></div>
					</div>
					<button class="text-left text-black py-8 px-7 rounded-b-md bg-themeBlue text-white mt-auto font-bold underline text-xl block">Continue Reading</button>
				</a>
			</div>
			<div v-else-if="isLoaded" class="p-5">
				<p>No data found</p>
			</div>

			<div class="w-full inline-flex justify-center pt-10 mb-24" v-if="nextPage">
				<button class="bg-white border-2 border-themeBlue px-16 py-5 rounded-xl font-bold hover:shadow-2xl" @click="getData(++page)">Load More</button>
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
			category:'all',
			nextPage:false,
			updates:[],
			isLoaded:false,
			page:1,
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
            this.$api.Posts.getMentions(formData).then(({ data }) => {
                this.updates.push(...data.posts);
				this.nextPage = data.nextPage;
				this.isLoaded = true;
            });
        },
    },
	created() {
		this.getData(this.page);
    },
};
</script>
<style lang="scss">
.mention-card {
	@apply cursor-pointer flex flex-col h-full rounded-lg hover:shadow-2xl bg-white;
	&:hover {
		@apply bg-gradient-to-b from-primary to-secondary text-white;
		h3, span, button, label {
			color:#FFF !important;
			background-color: transparent !important;
		}
	}
}
</style>
