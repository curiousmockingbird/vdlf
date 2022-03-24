<template>
    <footer class="main-footer bg-themeBlack relative overflow-hidden">
        <img
            class="absolute p-10 w-full h-full left-0 top-0 z-10 object-contain object-center"
            :src="$images + '/bg-footer.png'"
        />
        <div class="container relative z-20">
            <div class="w-full md:flex items-center justify-between mb-10">
                <img
                    :src="$images + '/VDLF-logo-footer.png'"
                    class="icon max-w-full h-auto flex-shrink-0"
                    alt="VDLF"
                    width="282px"
                    height="120px"
                />

                <div class="button-actions hidden lg:block my-3 md:my-0 -mx-5">
                    <a :href="$settings.membershipPage" class="text-2xl font-bold font-arial-black p-5 text-primary">{{
                        $settings.label.membership
                    }}</a>
                    <a :href="$settings.donatePage" class="text-2xl font-bold font-arial p-5 text-primary">{{
                        $settings.label.donate
                    }}</a>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-1/3 pr-0 md:pr-10 pb-5 md:pb-0 text-sm">
                    <h3 class="text-title">
                        {{ $settings.label.contact_us }}
                    </h3>
                    <p class="opacity-80 text-base font-display mb-4">
                        1027 S. 5th Street,
                        <br />Milwaukee, WI 53204 <br />Tel. 414-643-1620 <br />Fax. 414-643-1621
                        <br />Email: <a href="mailto:vdlf@vdlf.org">vdlf@vdlf.org</a>
                    </p>

                    <h3 class="text-title mt-6 pb-3">
                        {{ $settings.label.subscribe_heading }}
                    </h3>
                    <h5
                        class="p-2 text-white border-2 border-themeRed bg-themeRed my-3 rounded-lg"
                        v-if="warningMessage"
                    >
                        {{ warningMessage }}
                    </h5>
                    <div
                        class="p-2 text-white border-2 border-themeGreen bg-themeGreen my-3 rounded-lg"
                        v-if="statusMessage"
                        v-html="statusMessage"
                    ></div>
                    <form
                        v-else
                        @submit.prevent="submitForm"
                        class="flex w-auto h-12 relative md:mr-10 lg:mr-16 max-w-sm"
                    >
                        <input
                            type="email"
                            required
                            name="s"
                            v-model="email"
                            class="w-full p-3 h-full pr-20 font-display text-base rounded-md bg-themeGray placeholder-gray-200 focus:outline-none"
                            :placeholder="$settings.label.form.email_address"
                        />
                        <button
                            type="submit"
                            :disabled="statusMessage != null"
                            :class="{ 'disabled:opacity-50': statusMessage != null }"
                            class="bg-primary w-12 h-full top-0 right-0 flex items-center justify-center absolute rounded-md"
                        >
                            <ChevronRightIcon
                                class="text-white h-8 w-8 cursor-pointer self-center"
                                aria-hidden="true"
                                stroke-width="1"
                                size="2x"
                            />
                        </button>
                    </form>

                    <div class="sm:flex items-center mt-10">
                        <h3 class="text-white mb-5 sm:mb-0 text-xl font-semibold font-display mr-5">
                            {{ $settings.label.follow_us }}
                        </h3>
                        <socialMediaIcons></socialMediaIcons>
                    </div>
                </div>
                <div class="w-full mt-5 lg:mt-0 lg:w-2/3 pb-10 md:pb-0">
                    <div class="content-menus">
                        <slot />
                    </div>
                </div>
            </div>

            <div
                class="w-full copyright lg:flex justify-between items-end pt-3 md:pt-10 pb-3"
            >
                <div class="designby font-display small">
                    {{ $settings.label.developed_by }}
                    <a
                        href="http://indietechsolutions.com/"
                        class="font-semibold hover:text-primary"
                        target="_blank"
                        >IndieTech Solutions</a
                    >
                </div>
                <div class="footer-menus">
                    <slot name="navigation" />
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
// Import component
import { ChevronRightIcon } from "@vue-hero-icons/outline";
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    props: ["itsLabel"],
    data() {
        return {
            statusMessage: null,
            warningMessage: null,
            email: null,
            isLoading: false,
            fullPage: false,
        };
    },
    components: {
        Loading,
        ChevronRightIcon,
    },
    methods: {
        submitForm: function() {
            if (this.statusMessage != null) {
                console.log(this.statusMessage + " exists");
                return false;
            }

            if (!this.email) {
                this.warningMessage = "Email Required";
                return false;
            }
            this.isLoading = true;
            var values = {
                input_values: {
                    input_1: this.email,
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
    mounted() {
        for (let item of document.querySelectorAll(".content-menus>div>ul>li>a")) {
            if (item.getAttribute("href") == "#") {
                item.removeAttribute("href");
            }
        }
    },
};
</script>
<style lang="scss">
.copyright a {
    @apply text-white;
}
.main-footer {
    .content-menus .nav {
        @apply block -mx-4 w-full;
        column-count: 1;
        @screen sm {
            column-count: 2;
        }
        @screen lg {
            column-count: 3;
        }
        > li {
            @apply mx-4 mb-5;
        }
        > li > a {
            @apply font-semibold text-xl text-white w-full whitespace-nowrap opacity-100 md:cursor-text;
            &:hover {
                @apply text-white;
            }
        }

        a {
            @apply text-white opacity-80 text-base font-normal block font-display mb-1;
            &:hover {
                @apply text-primary;
            }
        }
    }
    .footer-menus .nav > li {
        @apply mb-0;
        a {
            @apply font-display;
            &:hover {
                @apply text-primary;
            }
        }
    }
    .text-title {
        @apply text-white text-xl font-semibold font-display mb-1;
    }
    > img {
        mix-blend-mode: luminosity;
    }

    @apply text-white pt-16 pb-10;

    .nav {
        @apply sm:flex flex-col;
    }

    .footer-menus .nav {
        @apply flex-row -mx-3 my-3 md:my-0 justify-center md:justify-start lg:justify-end;

        > li > a {
            @apply px-3;
        }
    }
}
</style>
