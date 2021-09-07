<template>
    <header class="header   bg-primary  fixed z-50 w-screen ">
        <div class="container mx-auto">
            <div class="flex flex-row justify-between py-8 lg:py-5">
                <a :href="$settings.app_url" class="logo self-start font-display font-hairline">
                    <svg-vue
                        icon="logo.consortium-white"
                        alt="Consortium"
                        width="288px"
                        height="65px"
                    ></svg-vue>
                </a>

                <button
                    class="block ml-5 lg:hidden text-white border-0 focus:outline-none"
                    @click="toggleMenu"
                >
                    <MenuAlt3Icon
                        v-if="!navOpen"
                        class="block h-8 w-8 self-center"
                        aria-hidden="true"
                    />
                    <XIcon v-else class="block h-8 w-8 self-center text-white" aria-hidden="true" />
                </button>

                <div class="lg:flex hidden">
                    <nav
                        class="desktop-nav hidden justify-self-center place-self-center hidden lg:block w-full "
                        ref="nav"
                    >
                        <slot />
                    </nav>

                    <button
                        class="text-white border-0 hidden lg:block border-0 px-4 hover:outline-none active:outline-none fill-current outline-none justify-self-center place-self-center"
                        style="background: transparent;"
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
                <nav
                    class="mobile-nav transition-transform transform-gpu duration-700 shadow-lg"
                    :class="{ '-translate-x-full': !navOpen, 'translate-x-0': navOpen }"
                >
                    <div class="container">
                        <div class="flex flex-row lg:flex-col justify-between">
                            <a
                                :href="$settings.app_url"
                                class="logo block mt-5 mb-3 self-start font-display font-hairline"
                            >
                                <svg-vue
                                    icon="logo.consortium-white"
                                    alt="Changewire"
                                    width="288px"
                                    height="65px"
                                ></svg-vue>
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
        </div>
        <SearchBar></SearchBar>
    </header>
</template>
<script>
import { gsap } from "gsap";
import { MenuAlt3Icon, XIcon } from "@vue-hero-icons/outline";

export default {
    props: {
        blogName: String,
        homepage: String,
    },
    data() {
        return {
            scrollTop: true,
            navOpen: false,
            activeClass: "active",
        };
    },
    components: {
        MenuAlt3Icon,
        XIcon,
    },
    methods: {
        toggleMenu() {
            this.navOpen = !this.navOpen;
            if (this.navOpen) {
                document.body.style.overflow = "hidden";
            } else {
                document.body.style.overflow = "unset";
            }
        },
    },
    mounted() {
        document.querySelectorAll(".mobile-nav .menu-item-has-children").forEach((value, index) => {
            //value.querySelectorAll("a")[0].href = "#";
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
        //max-width: 175px;

        &.current_page_item a {
            @apply text-white;
        }

        &.menu-item-has-children:after {
            position: absolute;
            content: url('data:image/svg+xml;charset=UTF-8, <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.666992 0.666748L4.33366 4.66675L8.00033 0.666748" stroke="white"/></svg>');
            height: 28px;
            width: 28px;
            right: -15px;
            top: 8px;
        }
    }
    a {
        @apply font-body text-base text-white font-medium transition-colors leading-tight py-5 lg:whitespace-nowrap;

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
            @apply px-3 lg:px-0 lg:pl-2 lg:pr-4 xl:px-5;
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
                    @apply text-primary font-semibold py-4 pl-4 pr-14 w-full border-b border-primary border-opacity-10;
                }
                a:hover {
                    background: rgba(0, 0, 0, 0.034);
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
.search-bar {
    background: rgba(255, 255, 255, 0.308);
    input::placeholder {
        color: #fff;
    }
}

.mobile-nav {
    @apply fixed top-0 left-0 bg-primary text-white w-full h-screen md:w-96 overflow-y-auto;
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
