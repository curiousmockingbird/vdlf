<template>
    <header
        class="header bg-white fixed z-50 w-full  transition-all ease-in-out duration-150  left-0"
    >
        <div
            class="flex flex-row pl-2 lg:pl-3 xl:pl-5 justify-between"
            :class="{ 'bg-white': !bgPrimary, 'bg-primary': bgPrimary }"
        >
            <div class="flex  justify-center self-center items-center">
                <a :href="$settings.app_url" class="logo self-center font-display font-hairline">
                    <img
                        :src="$images + '/VDLF-logo-header.png'"
                        class="icon max-w-full h-auto flex-shrink-0"
                        alt="VDLF"
                        width="192px"
                        height="81px"
                        style="min-width: 143px;"
                    />
                </a>
                <div class="language-switcher mx-5">
                    <div class="relative text-tiny xl:text-base form-select w-20">
                        <select
                            class="w-full cursor-pointer"
                            v-model="language"
                            @change="changeLanguage($event)"
                        >
                            <option value="en">ENG</option>
                            <option value="es">ESP</option>
                        </select>
                    </div>
                </div>
            </div>
            <nav
                class="desktop-nav relative hidden justify-self-center place-self-center  lg:flex w-auto justify-center"
                ref="nav"
            >
                <slot />
            </nav>
            <button
                class="block ml-auto mr-5 sm:mr-auto sm:mx-auto lg:hidden text-primary border-0 focus:outline-none"
                @click="toggleMenu"
            >
                <ViewGridIcon
                    v-if="!navOpen"
                    class="block h-8 w-8 self-center"
                    aria-hidden="true"
                />
                <XIcon v-else class="block h-8 w-8 self-center text-primary" aria-hidden="true" />
            </button>
            <div
                class="hidden sm:flex membership-menu text-sm xl:text-lg ml-auto lg:ml-0 flex items-center -right-1"
            >
                <a
                    :href="$settings.membershipPage"
                    :class="bgPrimary ? 'text-white' : 'text-secondary'"
                    class="py-8 font-bold px-4 text-base xl:text-lg "
                    >{{ $settings.label.membership }}</a
                >
                <div class="inline-flex items-center text-white bg-gradient-to-r from-primary text-base xl:text-lg  to-secondary font-bold pl-6 pr-4 relative left-1">
                    <a
                        :href="$settings.donatePage"
                        class="text-white py-8"
                        >{{ $settings.label.donate }}</a
                    >
                    <button
                        class="py-8 h-full border-0 border-0 px-4 hover:outline-none active:outline-none fill-current outline-none relative"
                        :class="bgPrimary ? 'text-white' : 'text-primary'"
                        @click="openSearchBar()"
                    >
                        <svg-vue
                            icon="search"
                            height="19px"
                            width="19px"
                            style="fill: none; "
                        ></svg-vue>
                    </button>
                </div>
            </div>
            <nav
                class="mobile-nav transition-transform transform-gpu duration-700 shadow-lg"
                :class="{ '-translate-x-full': !navOpen, 'translate-x-0': navOpen }"
            >
                <div class="container">
                    <div class="flex flex-row lg:flex-col justify-between">
                        <a
                            :href="$settings.app_url"
                            class="logo self-center font-display font-hairline"
                        >
                            <img
                                :src="$images + '/logo-footer.png'"
                                class="icon max-w-full h-auto flex-shrink-0"
                                alt="VDLF"
                                width="137px"
                                height="57px"
                            />
                        </a>
                        <button
                            class="text-white border-0 block sm:hidden focus:outline-none"
                            @click="toggleMenu"
                        >
                            <XIcon
                                class="block h-8 w-8 self-center text-white"
                                aria-hidden="true"
                            />
                        </button>
                    </div>
                </div>
                <slot name="mobile" />
            </nav>
        </div>
        <SearchBar></SearchBar>
    </header>
</template>
<script>
import { gsap } from "gsap";
import { ViewGridIcon, XIcon } from "@vue-hero-icons/outline";

export default {
    props: {
        blogName: String,
        bgWhite: String,
    },
    data() {
        return {
            bgPrimary: true,
            navOpen: false,
            activeClass: "active",
            language: null,
        };
    },
    components: {
        ViewGridIcon,
        XIcon,
    },
    methods: {
        changeLanguage(event) {
            const langWrapper = document.getElementById("language-switcher");
            let esLink = langWrapper.querySelector("[lang='es-ES']").getAttribute("href");
            let enLink = langWrapper.querySelector("[lang='en-US']").getAttribute("href");
            if (event.target.value == "en") {
                window.location.replace(enLink);
            } else {
                window.location.replace(esLink);
            }
        },
        toggleMenu() {
            this.navOpen = !this.navOpen;
            if (this.navOpen) {
                document.body.style.overflow = "hidden";
            } else {
                document.body.style.overflow = "unset";
            }
        },
    },
    created() {
        if (this.bgWhite) {
            this.bgPrimary = true;
        } else {
            this.bgPrimary = false;
        }
        this.language = this.$settings.language;
    },
    mounted() {
        document.querySelectorAll(".mobile-nav .menu-item-has-children").forEach((value, index) => {
            value.querySelectorAll("span")[0].addEventListener("click", (e) => {
                e.preventDefault();
                if (document.body.offsetWidth <= 1024) {
                    value.classList.toggle(this.activeClass);
                }
            });
        });
    },
};
</script>
<style lang="scss" scoped>
@screen md {
    header.header {
        background: linear-gradient(90deg, #ffffff 0%, #ffffff 50%, #c22d28 50%, #c22d28 100%);
    }
}
.language-switcher {
    .form-select {
        @apply p-0 rounded-md relative border-2 text-base text-white border-white;
        &:before {
            content: "";
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkiIGhlaWdodD0iMTEiIHZpZXdCb3g9IjAgMCAxOSAxMSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEgMS40MjUyOUw5LjQ4NTI4IDkuOTEwNTdMMTcuOTcwNiAxLjQyNTI5IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K");
            @apply absolute block right-2 inset-y-1/2 origin-center bg-no-repeat bg-contain;
            width: 14px;
            height: 7px;
            transform: translateY(-50%);
        }
        select {
            appearance: none;
            @apply py-1 px-2 mx-6 -left-6 relative z-30 uppercase tracking-wide w-full font-semibold;
            background-color: transparent;
        }
    }
}

.bg-white {
    .language-switcher {
        .form-select {
            @apply text-black border-black;
            &:before {
                filter: brightness(0);
            }
        }
    }

    nav {
        a {
            &:active,
            &:hover {
                @apply text-themeRed;
            }
        }
        li {
            &:hover > a,
            &.current_page_item a {
                @apply text-themeRed;
            }
        }
    }
}

nav.white-nav {
    a {
        @apply text-white;
    }
}

nav {
    @apply w-full;
    .menu-headernavigation-container {
        @apply w-full;
    }

    ul {
        @apply lg:flex items-center;
    }
    li {
        @apply relative;
        &:hover > a,
        &.current_page_item a {
            @apply text-white;
        }
    }
    a {
        @apply relative z-50 font-body text-lg lg:text-base xl:text-xl text-black font-semibold transition-colors leading-tight py-8 lg:whitespace-nowrap;

        &:active,
        &:hover {
            @apply text-white;
        }
    }
}
.desktop-nav {
    & > div > ul > li {
        @apply py-2;
    }
    ul > li {
        a {
            @apply px-1 lg:px-2 xl:px-2 2xl:px-4;
        }
        ul.sub-menu {
            background: rgba(255, 255, 255, 0.959);
            backdrop-filter: blur(2px);
            margin-top: 5px;
            @apply block transition-opacity z-30 opacity-0 invisible absolute rounded-sm;

            ul.sub-menu {
                @apply mt-0 top-0 z-40;
                left: 99%;
                background: #f6f7f9;
            }
            li.menu-item-has-children:after {
                @apply absolute;
                filter: invert(1);
                transform: translateY(-50%) rotate(-95deg);
                left: unset;
                bottom: unset;
                right: 10px;
                top: 30%;
            }
            li.menu-item {
                display: flex;
                margin: 0;
                a {
                    @apply text-black text-lg 2xl:text-xl font-semibold py-4 pl-4 pr-14 w-full border-b border-primary border-opacity-10;
                }
                a:hover {
                    @apply text-primary;
                }
            }
        }

        &.menu-item-has-children:hover {
            & > .sub-menu {
                visibility: visible;
                opacity: 1;
            }
        }
    }
}

.mobile-nav {
    @apply fixed z-50 top-0 left-0 bg-themeBlack text-white w-full h-screen md:w-96 overflow-y-auto;
    .nav {
        //margin-top: 10px;
        li {
            @apply py-0 ml-5 mx-0 relative;
            border-top: 1px solid rgba(255, 255, 255, 0.062);

            .sub-menu {
                max-height: 0;
                opacity: 0;
                visibility: hidden;
                transition: max-height 0.25s cubic-bezier(0, 0.7, 0, 1), opacity 0.2s ease-in-out;
                li {
                    &:last-child {
                        border-bottom: unset;
                    }
                }
            }
            span {
                display: none;
            }

            &.menu-item-has-children > span {
                @apply visible absolute top-0 right-0 h-full w-24 flex flex-col justify-center items-center;
                border-left: 1px solid rgba(255, 255, 255, 0.062);

                &:after {
                    @apply absolute;
                    content: url('data:image/svg+xml;charset=UTF-8, <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.666992 0.666748L4.33366 4.66675L8.00033 0.666748" stroke="white"/></svg>');
                    height: 26px;
                    width: 26px;
                    width: 10%;
                    top: 14px;
                }
            }

            &.menu-item-has-children:after {
                display: none;
            }

            &.menu-item-has-children.active {
                & > .sub-menu {
                    max-height: 1000px;
                    visibility: visible;
                    opacity: 1;
                    transition: max-height 0.3s ease-in-out, opacity 0.25s ease-in-out;
                }
            }
            &:last-child {
                border-bottom: 1px solid rgba(255, 255, 255, 0.151);
            }

            a {
                @apply break-words font-body block py-5 uppercase font-medium text-white;
                width: calc(100% - 120px);
            }
        }
    }
}
.logo svg,
.logo img {
    max-width: 240px;
}
@screen lg {
    .logo svg,
    .logo img {
        max-width: 320px;
    }
    .desktop-nav {
        @apply flex;
    }
    .mobile-nav {
        @apply hidden;
    }
}
</style>
