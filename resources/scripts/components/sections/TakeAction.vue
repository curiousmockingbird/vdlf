<template>
    <SectionContainer containerClasses="md:min-h-screen flex flex-col justify-center py-20 lg:py-0">
        <h3 class="text-xl md:text-4xl tracking-widest font-bold text-white mb-5">{{ title }}</h3>
        <div class="content-fellows w-full overflow-hidden">
            <div id="fellow-slides" class="relative">
                <VueSlickCarousel
                    v-bind="sliderSettings"
                    class="slideshow mt-5 mb-8 -mx-2"
                    v-if="ActionsData && ActionsData.length > 0"
                >
                <div 
                    v-for="(item, i) in ActionsData" 
                    :key="i">
                    <ActionCard
                        :title="item.title"
                        :description="item.excerpt"
                        :link="item.link"
                        :label="label"
                        :buttonLabel="item.label"
                        :body="item.content"
                    ></ActionCard>
                </div>
                </VueSlickCarousel>
            </div>
        </div>
    </SectionContainer>
</template>
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

export default {
    components: { VueSlickCarousel },
    data() {
        return {
            ActionsData:[],
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
                centerPadding:'20px'
            },
        };
    },
    props: {
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
            default:3,
        }
    },
    methods: {
        getData() {
            let formData = {
                perpage: this.perpage,
                sortby: "latest",
                language: this.$settings.language,
            };
            if (this.ActionsName && this.ActionsName!="None") {
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
    .slick-track
    {
        display: flex !important;
    }

    .slick-slide
    {
        height: inherit !important;
        div,article {
            @apply h-full;
        }
    }
</style>