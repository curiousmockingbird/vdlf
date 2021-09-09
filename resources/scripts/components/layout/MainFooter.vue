<template>
    <footer class="main-footer bg-themeBlack relative">
        <img class="absolute p-10 w-full h-full left-0 top-0 z-10 object-contain object-center" :src="$images+'/bg-footer.png'" />
        <div class="container relative z-20">
            <div class="w-full md:flex items-center justify-between mb-10">
                <img :src="$images+'/logo-footer.png'" class="icon max-w-full h-auto"
                    alt="VDLF"
                    width="282px"
                    height="120px" />

                <div class="button-actions my-3 md:my-0 -mx-5">
                    <a href="#" class="text-2xl font-bold font-arial-black p-5 text-primary">Membership</a>
                    <a href="#" class="text-2xl font-bold font-arial p-5 text-primary">Donate</a>
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/3 pr-0 md:pr-10 pb-5 md:pb-0 text-sm">
                    <h3 class="text-title">
                        Contact Us
                    </h3>
                    <p class="opacity-80 text-base font-display mb-4">
                        1027 S. 5th Street, 
                        <br>Milwaukee, WI 53204
                        <br>Tel. 414-643-1620  
                        <br>Fax. 414-643-1621 
                        <br>Email: email@email.com
                    </p>

                    <h3 class="text-title mt-6 mb-3">
                        Subscribe to our newsletter
                    </h3>
                    <form class="flex w-auto h-12 relative md:mr-10 lg:mr-16">
                        <input type="text" name="s" class="w-full p-3 h-full pr-20 font-display text-base rounded-md bg-themeGray placeholder-gray-200 focus:outline-none" :value="email" placeholder="Email address..." />
                        <button type="submit" class="bg-primary w-12 h-full top-0 right-0 flex items-center justify-center absolute rounded-md">
                            <ChevronRightIcon
                                class="text-white h-5 w-5 cursor-pointer self-center"
                                aria-hidden="true"
                                stroke-width="1"
                                size="1.5x"
                            />
                        </button>
                    </form>

                    <div class="flex items-center mt-10">
                        <h3 class="text-white text-xl font-semibold font-display mr-5">
                            Follow us on
                        </h3>
                        <socialMediaIcon></socialMediaIcon>
                    </div>
                </div>
                <div class="w-full md:w-2/3 pb-10 md:pb-0">
                    <div class="content-menus">
                        <slot />
                    </div>
                </div>
            </div>

            <div class="w-full md:flex flex-row-reverse justify-between items-end pt-3 md:pt-10 pb-3">
                <div class="footer-menus">
                    <slot name="navigation" />
                </div>
                <div class="designby font-display small"
                    >Website designed and developed by 
                    <a href="http://indietechsolutions.com/" class="font-semibold hover:text-primary" target="_blank"
                        >IndieTech Solutions</a
                    >
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
            name: null,
            email: null,
            reason: null,
            isLoading: false,
            fullPage: false,
        };
    },
    components: {
        Loading,
        ChevronRightIcon
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
    .content-menus .nav {
        @apply block -mx-4 w-full;
        column-count: 1;
        @screen sm {
            column-count: 2;
        }
        @screen lg {
            column-count: 3;
        }
        >li {
            @apply mx-4 mb-5;
        }
        >li>a {
            @apply font-semibold text-xl text-white w-full whitespace-nowrap opacity-100;
            &:hover{
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
    .footer-menus .nav >li {
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
        @apply flex-row -mx-3 my-3 md:my-0 justify-center md:justify-end;
        
        > li > a {
           @apply px-3;    
        }
    }
}
</style>
