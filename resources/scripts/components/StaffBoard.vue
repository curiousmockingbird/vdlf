<template>
    <section class="container our-staff-section">
        <div
            v-for="(cate, idx) in validCategories"
            :key="idx"
            class="pb-20 pt-10"
        >
            <h1
                v-if="showCategoryTitle"
                class="text-2xl uppercase tracking-widest text-primary font-display font-bold pb-2 mb-8 border-b-2 border-primary"
            >
                {{ cate.category_name }}
            </h1>
            <div
                class="grid grid-flow-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-5 gap-y-6"
            >
                <StaffCard
                    v-for="(staffItem, index) in cate.staff"
                    :key="staffItem.id || index"
                    :clickable="false"
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

        <!-- Rest of your template remains the same -->
    </section>
</template>
<script>
import VModal from "vue-js-modal";
import Vue from "vue";
Vue.use(VModal, { componentName: "vmodal" });
import { XIcon } from "@vue-hero-icons/outline";
export default {
    props: {
        showCategoryTitle: {
            type: Boolean,
            default: false,
        },
    },
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
    computed: {
        validCategories() {
            return this.categories.map((category) => {
                // Filter out invalid staff entries
                const validStaff = category.staff.filter((staffItem) => {
                    return (
                        staffItem &&
                        staffItem.title &&
                        staffItem.title.trim() !== ""
                    );
                });
                return {
                    ...category,
                    staff: validStaff,
                };
            });
        },
    },
    methods: {
        loadMore: function () {
            this.getData(++this.page);
        },
        openModal: function (staffData) {
            this.staffData = staffData;
            this.$modal.show("staff-modals");
        },
        getData() {
            this.isLoaded = false;
            let formData = new FormData();
            formData.append("page", 1);
            formData.append("language", this.$settings.language);
            this.$api.Posts.getStaff(formData).then(({ data }) => {
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
.staff-detail img[src*="logo.png"] {
    @apply p-5 bg-white;
    object-fit: contain !important;
}

.our-staff-section .social-media a {
    @apply text-base font-semibold border-b border-primary relative z-50;
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
