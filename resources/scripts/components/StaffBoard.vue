<template>
    <section class="container our-staff-section">
        <div v-for="(cate, idx) in categories" :key="idx" class="pb-20">
            <h1 class="text-2xl uppercase tracking-widest text-primary font-display font-bold py-10 pb-2 mb-7 border-b-2 border-primary">{{ cate.category_name}}</h1>
            <div class="grid grid-flow-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-5 gap-y-6">
                <StaffCard
                    v-for="(staffItem, index) in cate.staff"
                    :key="index"
                    clickable="false"
                    :avatar="staffItem.avatar"
                    :imagePosition="staffItem.image_position"
                    :title="staffItem.title"
                    :profession="staffItem.profession"
                    :email="staffItem.email"
                    :phone="staffItem.phone"
                    :year="staffItem.year"
                >
                </StaffCard>
            </div>
        </div>

        <vmodal
            name="staff-modals"
            :scrollable="true"
            width="100%"
            height="auto"
            classes="staff-modal relative"
            v-if="staffData"
        >
            <XIcon
                class="absolute h-10 w-10 cursor-pointer top-4 right-4 md:top-10 md:right-10 self-center text-white"
                aria-hidden="true"
                @click="$modal.hide('staff-modals')"
                stroke-width="1"
                size="1.5x"
            />
            <div class="container mx-auto flex flex-col lg:flex-row p-5 lg:pt-24 lg:pb-20 lg:px-16">
                <div class="w-full lg:w-1/4">
                    <img
                        :src="staffData.avatar"
                        class="w-full object-cover mx-auto max-h-48 md:max-h-full"
                        style="min-height: 320px; max-width:333px;"
                    />

                    <div class="staff-info mt-5">
                        <p class="block m-0 text-base text-white" v-if="staffData.email">
                            <span class="font-semibold border-b inline-block border-white mr-2"
                                >Email </span
                            ><a :href="mailto(staffData.email)" class="break-words" v-html="staffData.email"></a>
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-3/4 text-white lg:px-10 md:px-5 pt-10 lg:pt-0">
                    <h1
                        class="text-xl text-white md:text-2xl lg:text-3xl tracking-wider font-semibold"
                    >
                        {{ staffData.title }}
                    </h1>
                    <div class="text-lg text-white lg:text-xl font-light inline-block font-semibold" 
                        v-html="staffData.profession">
                    </div>
                    <br>{{ staffData.year }}
                    <div
                        v-html="staffData.content"
                        class="text-formatting-enable md:text-lg mt-10 font-regular"
                    ></div>
                </div>
            </div>
        </vmodal>
    </section>
</template>
<script>
import VModal from "vue-js-modal";
import Vue from "vue";
Vue.use(VModal, { componentName: "vmodal" });
import { XIcon } from "@vue-hero-icons/outline";
export default {
    components: {
        XIcon,
    },
    data() {
        return {
            staffData: {},
            staff: [],
            page: 1,
            moreData: false,
            categories: [],
        };
    },
    methods: {
        loadMore: function() {
            this.getData(++this.page);
        },
        openModal: function(staffData) {
            this.staffData = staffData;
            this.$modal.show('staff-modals');
        },
        getData() {
            this.isLoaded = false;
            let formData = new FormData;
            formData.append('page', 1);
            formData.append("language",this.$settings.language);
            this.$api.Posts.getStaff(formData).then(({data}) => {
                this.categories = data;
            });
        },
    },
    created() {
        this.getData();
    },
};
</script>
<style lang="scss">
img[src*="logo.png"] {
    @apply p-5 bg-white;
    object-fit: contain !important;
}
.our-staff-section .social-media a {
    @apply text-base font-semibold border-b border-primary relative z-50;
}
.staff-item img {
}
.staff-item:hover {
    img {
    }
}
svg[stroke-width="1"] {
    path {
        stroke-width: 1;
    }
}
.staff-modal {
    @apply bg-themeBlack;
}
</style>
