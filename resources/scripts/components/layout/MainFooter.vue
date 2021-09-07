<template>
    <footer class="main-footer bg-primary">
        <div class="container mx-auto  ">
            <div class="w-full flex mb-10">
                <svg-vue
                    icon="logo.consortium-white"
                    alt="Consortium"
                    width="288px"
                    height="65px"
                ></svg-vue>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/3 pr-0 md:pr-10 pb-10 md:pb-0 text-sm">
                    <h3 class="text-white text-xl  font-normal font-display mb-6">
                        Find Us
                    </h3>
                    <p class="opacity-80 mb-4">
                        1020 19th Street, NW<br />
                        Suite 500 <br />
                        Washington, DC 20036
                    </p>
                    <p class="opacity-80">(202) 331-8080 <br />info@consortium.org</p>
                    <div class="hidden md:block">
                        <h3 class="text-white text-xl  font-normal font-display mb-5 mt-8">
                            Follow us on Social Media
                        </h3>
                        <socialMediaIcon></socialMediaIcon>
                    </div>
                </div>
                <div class="w-full md:w-1/3 pb-10 md:pb-0">
                    <h3 class="text-white text-xl  font-normal font-display mb-6">
                        Explore Our Website
                    </h3>
                    <div class="content-menus">
                        <slot />
                    </div>
                </div>

                <div class="w-full md:w-1/3 flex  flex-col pb-10 md:pb-0">
                    <h3 class="text-white text-xl  font-normal font-display mb-7">Contact Us</h3>
                    <div class="contact-form relative">
                        <loading :opacity="0" :active.sync="isLoading" :is-full-page="fullPage">
                        </loading>
                        <h5
                            class="p-4 text-red border-2 border-dark bg-lightBlue mt-3"
                            v-if="warningMessage"
                        >
                            {{ warningMessage }}
                        </h5>
                        <div
                            class="p-4 text-white border-2 border-white bg-primary mt-3"
                            v-if="statusMessage"
                            v-html="statusMessage"
                        ></div>
                        <form
                            v-else
                            @submit.prevent="submitForm"
                            action="#"
                            class="flex flex-col items-start"
                        >
                            <input
                                type="text"
                                v-model="name"
                                required
                                placeholder="Name"
                                class=" text-white border-2 bg-primary border-white text-sm py-2 px-4 font-normal placeholder-grey placeholder-opacity-70   rounded-full w-full	"
                            />
                            <input
                                type="email"
                                v-model="email"
                                required
                                placeholder="Email"
                                class=" text-white border-2 bg-primary border-white text-sm py-2 px-5 mt-4  rounded-full placeholder-grey placeholder-opacity-70	w-full"
                            />
                            <input
                                type="text"
                                placeholder="Reason for contacting"
                                v-model="reason"
                                required
                                class=" text-white border-2 bg-primary border-white text-sm py-2 px-5 mt-4  rounded-full placeholder-grey placeholder-opacity-70	w-full"
                            />
                            <div class="button-actions mt-5 md:mt-3">
                                <button
                                    type="submit"
                                    :disabled="statusMessage != null"
                                    :class="{ 'disabled:opacity-50': statusMessage != null }"
                                    class="bg-opacity-0 border-2 border-white font-normal text-white text-sm py-2 px-5 mt-3  rounded-full hover:bg-white hover:text-primary transition-colors"
                                >
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full md:w-1/3 flex  flex-col pb-10 md:pb-0 block md:hidden">
                    <h3 class="text-white text-2xl  font-display mb-3 mt-10">
                        Follow us on social media
                    </h3>
                    <socialMediaIcon class="md:justify-between"></socialMediaIcon>
                </div>
            </div>

            <div class="w-full flex justify-between items-end pt-10 pb-3">
                <!-- <div class="logo-footer p-2">
                    <img :src="$settings.logo_footer" alt="" width="222px" height="59px" />
                </div> -->
                <div class="footer-menus">
                    <slot name="navigation" />
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    props: ["itsLabel"],
    data() {
        return {
            statusMessage: null,
            warningMessage: null,
            name: null,
            email: null,
            reason: null,
            isLoading: false,
            fullPage: false,
        };
    },
    components: {
        Loading,
    },
    methods: {
        submitForm: function() {
            if (!this.email || !this.name) {
                this.warningMessage = "Name and Email Required";
                return false;
            }
            this.isLoading = true;
            var values = {
                input_values: {
                    input_1: this.name,
                    input_2: this.email,
                    input_3: this.reason,
                },
                form_id: this.$settings.subscribe_form_id,
            };
            //json encode array
            let data = JSON.stringify(values);
            this.$api.Contact.submitForm(data).then((response) => {
                if (response.status == "200") {
                    this.statusMessage = response.response.confirmation_message;
                } else {
                    this.warningMessage =
                        this.email + " failed to submit form : " + response.status;
                }
                setTimeout(() => {
                    this.isLoading = false;
                }, 500);
            });
        },
    },
};
</script>
<style lang="scss">
.main-footer {
    @apply text-white pt-16 pb-5;

    .nav {
        @apply flex flex-col;
    }

    .nav > li > a {
        @apply text-base text-sm opacity-75;
    }

    .nav > li {
        @apply mb-3;
    }

    .footer-menus .nav {
        @apply md:flex-row -mx-3;
        
        > li > a {
           @apply px-3;    
        }
    }
}
</style>
