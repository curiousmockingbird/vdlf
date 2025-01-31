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
                    @open-contact-modal="scrollToContactForm"
                />
            </div>
        </div>

        <!-- Contact Form Section -->
        <div id="contact-form-section" class="contact-form-section pt-10">
            <ContactForm
                v-if="selectedStaff"
                :staffTitle="selectedStaff.title"
                :staffProfession="selectedStaff.profession"
                :staffEmail="selectedStaff.email"
                @submit-contact-form="handleContactFormSubmission"
            />
        </div>
    </section>
</template>

<script>
import VModal from "vue-js-modal";
import Vue from "vue";
Vue.use(VModal, { componentName: "v-modal", dynamic: true, injectModalsContainer: true });

import StaffCard from "./StaffCard.vue";
import ContactForm from "./ContactForm.vue";
import EventList from "./EventList.vue"
import { XIcon } from "@vue-hero-icons/outline";
import axios from "axios";

export default {
    props: {
        showCategoryTitle: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        StaffCard,
        ContactForm,
        XIcon,
        EventList,
    },
    data() {
        return {
            categories: [{ category_name: '', staff: [] }],
            selectedStaff: null,
        };
    },
    computed: {
        validCategories() {
            return this.categories.map((category) => {
                const validStaff = category.staff.filter(
                    (staffItem) => staffItem && staffItem.title && staffItem.title.trim() !== ""
                );
                return {
                    ...category,
                    staff: validStaff,
                };
            });
        },
    },
    methods: {
        scrollToContactForm(staff) {
            this.selectedStaff = staff;
            this.$nextTick(() => {
                const contactFormSection = document.getElementById('contact-form-section');
                if (contactFormSection) {
                    contactFormSection.scrollIntoView({ behavior: 'smooth', block: "center" });
                }
            });
        },
        handleContactFormSubmission(payload) {
        // Log the payload to verify it is received from the child component
        console.log('Payload received in parent:', payload, payload.staffEmail);

axios.post('https://contact-form-last.vercel.app/api/email-api', payload, {
    headers: {
        'Content-Type': 'application/json',
    },
})
.then(() => {
    alert("Message sent successfully");
    this.selectedStaff = null;
})
.catch((error) => {
    console.error("Error sending contact email:", error.response ? error.response.data : error.message);
    alert("An error occurred while sending the message. Please try again later.");
});
    },
        getData() {
            this.isLoaded = false;
            let formData = new FormData();
            formData.append("page", 1);
            formData.append("language", this.$settings.language);
            this.$api.Posts.getStaff(formData).then(({ data }) => {
                this.categories = data;
            }).catch((error) => {
                console.error("Error fetching staff data:", error);
                alert("An error occurred while fetching staff data. Please try again later.");
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

.contact-form-section {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}
</style>
