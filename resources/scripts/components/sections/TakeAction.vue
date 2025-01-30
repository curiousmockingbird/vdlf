<template>
    <SectionContainer
        containerClasses="md:min-h-content flex flex-col justify-center py-5 md:py-20 lg:py-0"
        :style="`background-color:${background}`"
    >
    <EventListHome />
        <h3 class="text-xl md:text-4xl tracking-widest font-bold text-white mb-5">{{ title }}</h3>
        <div class="content-fellows w-full">
            <div id="fellow-slides" class="relative">
                <VueSlickCarousel
                    v-bind="sliderSettings"
                    class="slideshow mt-5 mb-8 -mx-2"
                    v-if="ActionsData && ActionsData.length > 0"
                >
                    <template #prevArrow>
                        <div class="VueCarousel-navigation-prev">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </div>
                    </template>
                    <template #nextArrow>
                        <div class="VueCarousel-navigation-next">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </div>
                    </template>
                    <div v-for="(item, i) in ActionsData" :key="i">
                        <ActionCard
                            :title="item.title"
                            :description="item.excerpt"
                            :link="item.link"
                            :label="label"
                            :buttonLabel="item.label"
                            :icon="item.icon ? item.icon : null"
                            :body="item.content"
                            class="mx-4"
                        ></ActionCard>
                    </div>
                </VueSlickCarousel>
            </div>
        </div>
    </SectionContainer>
</template>
<script>
import EventListHome from "./../EventListHome.vue";
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

export default {
    components: { VueSlickCarousel, EventListHome },
    data() {
        return {
            ActionsData: [],
            sliderSettings: {
                dots: false,
                infinite: true,
                speed: 800,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplaySpeed: 6000,
                swipeToSlide: true,
                swipe: true,
                centerPadding: "60px",
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: true,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            },
        };
    },
    props: {
        background: {
            default: "transparent",
        },
        ActionsName: String,
        title: {
            type: String,
            default: "Take Action",
        },
        label: {
            type: String,
            default: "Action",
        },
        perpage: {
            type: String,
            default: 3,
        },
    },
    methods: {
        getData() {
            let formData = {
                perpage: this.perpage,
                sortby: "latest",
                language: this.$settings.language,
            };
            if (this.ActionsName && this.ActionsName != "none") {
                formData.taxonomy = "action_name";
                formData.categories = this.ActionsName;
            }
            this.$api.Posts.getAction(formData).then(({ data }) => {
                this.ActionsData.push(...data.posts);
            });
        },
    },
    mounted() {
        this.getData();
    },
};
</script>

<style lang="scss">
.slick-prev:before,
.slick-next:before {
    display: none !important;
}
.VueCarousel-navigation-prev,
.VueCarousel-navigation-next {
    @apply bg-themeOrange inset-y-1/2 bg-opacity-0 lg:bg-opacity-20 rounded-lg px-1 absolute  z-30;
    display: inline-table;
    svg {
        @apply h-10 w-10 text-black;
    }

    &:hover {
        @apply bg-opacity-40;
    }
}
@screen lg {
    .VueCarousel-navigation-prev {
        left: 20px !important;
    }
    .VueCarousel-navigation-next {
        right: 20px !important;
    }
}
.slick-track {
    display: flex !important;
}

.slick-slide {
    height: inherit !important;
    div,
    article {
        @apply h-full;
    }
}
</style>
