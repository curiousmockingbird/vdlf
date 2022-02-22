<template>
    <a class="press-card"
            :style="styleBorder(categories)"
            :href="link"
        >
        <div class="p-7">
            <span class="press-categories" 
                v-html="categories.length
                ? categories.map((el) => {
                    if (el.name.toLowerCase().includes('news'))
                        return `<label style='color:#A0643D'>${el.name}</label>`;
                    if (el.name.toLowerCase().includes('blog'))
                        return `<label style='color:#337c4c'>${el.name}</label>`;
                    if (el.name.toLowerCase().includes('press'))
                        return `<label style='color:#871D3D'>${el.name}</label>`;
                }).join(', ')
                : ''">
            </span>
            <h3 class="press-title">{{ title }}</h3>
            <span class="press-date">{{ date }}</span>
            <div class="press-content" v-html="excerpt"></div>
        </div>
        <button 
            class="text-left text-black py-8 px-7 rounded-b-md text-white mt-auto font-bold underline text-xl block"
            :style="styleButton(categories)"
        >{{ moreLabel }}</button>
    </a>
</template>

<script>
export default {
    props: {
        title: String,
        excerpt: String,
        date: String,
        link: String,
        categories: {
            type: Array,
            default: []
        },
        moreLabel: {
            type: String,
            default: "Continue Reading"
        }
    },
    methods: {
        styleButton(categories) {
			let Element = categories[0].name;
			if (Element.toLowerCase().includes('news'))
				return `background-color:#A0643D; margin:-1.2px`;
			else if (Element.toLowerCase().includes('blog'))
				return `background-color:#337c4c; margin:-1.2px`;
			else (Element.toLowerCase().includes('press'))
				return `background-color:#871D3D; margin:-1.2px`;
		},
		styleBorder(categories) {
			let Element = categories[0].name;
			if (Element.toLowerCase().includes('news'))
				return `border-color:#A0643D`;
			else if (Element.toLowerCase().includes('blog'))
				return `border-color:#337c4c`;
			else (Element.toLowerCase().includes('press'))
				return `border-color:#871D3D`;
		},
    },
};
</script>

<style lang="scss" scoped>
    .press-card {
        @apply font-normal text-themeBlack text-base; 
        .press-title {
            @apply font-bold text-2xl leading-tight;
        }

        .press-categories {
            @apply my-2 w-full inline-block font-bold tracking-wider leading-normal #{!important};
        }

        .press-date {
            @apply text-gray-400 font-display w-full inline-block mt-1 mb-4 #{!important};
        }

        .press-content {
            @apply mb-2 font-display overflow-hidden break-words #{!important};
        }

        @apply box-border cursor-pointer flex flex-col h-full rounded-xl bg-white border-3 #{!important};
        
        &:hover {
            @apply bg-gradient-to-b from-primary to-secondary text-white border-gray-100 #{!important};
            h3, span, button, label {
                color:#FFF !important;
                background-color: transparent !important;
            }
        }
    }
</style>