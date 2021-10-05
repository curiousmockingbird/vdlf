<template>
    <div>
        <div class="horizontal-share lg:hidden">
            <div class="flex items-center justify-content-center">
                <ShareNetwork
                    network="facebook"
                    :url="url"
                    :title="title"
                    :description="description"
                    :hashtags="hashtags"
                    class="cursor-pointer"
                >
                    <svg-vue icon="share.facebook" width="40px" height="40px"></svg-vue>
                </ShareNetwork>

                <ShareNetwork
                    network="twitter"
                    :url="url"
                    :title="title"
                    :hashtags="hashtags"
                    class="ml-4 cursor-pointer"
                >
                    <svg-vue icon="share.twitter" width="40px" height="40px"></svg-vue>
                </ShareNetwork>

                <ShareNetwork
                    network="linkedin"
                    :title="title"
                    :url="url"
                    class="ml-4 cursor-pointer"
                >
                    <svg-vue icon="share.linkedin" width="40px" height="40px"></svg-vue>
                </ShareNetwork>
            </div>
            <span class="block text-2xl text-themeBlackAlt mt-3">Share this article</span>
        </div>
        <div class="vertical-share hidden lg:flex">
            <ShareNetwork
                network="facebook"
                :url="url"
                :title="title"
                :description="description"
                :hashtags="hashtags"
                class="cursor-pointer my-2"
            >
                <svg-vue icon="share.facebook-alt" width="52px" height="52px"></svg-vue>
            </ShareNetwork>

            <ShareNetwork
                network="twitter"
                :url="url"
                :title="title"
                :hashtags="hashtags"
                class="cursor-pointer my-2"
            >
                <svg-vue icon="share.twitter-alt" width="52px" height="52px"></svg-vue>
            </ShareNetwork>

            <ShareNetwork
                network="linkedin"
                :title="title"
                :url="url"
                class="cursor-pointer my-2"
            >
                <svg-vue icon="share.linkedin-alt" width="52px" height="52px"></svg-vue>
            </ShareNetwork>
            <span class="block my-2 text-2xl text-darkMagenta mt-3 transform -rotate-90 w-54 pr-5 relative hidden md:block" style="z-index:-1">Share</span>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        "url": {
            type:String,
            default:window.location.href
        },
        "title": {
            type:String,
            default:"Changewire"
        },
        "hashtags": {
            type:String,
            default:"#changewire"
        },
        "description": {
            type:String,
            default:null
        }
    },
    methods: {
        isTop:function() {
            let sidebarShare = document.querySelector(".vertical-share");
            let footerTop = document.querySelector("footer").offsetTop;
            if (window.scrollY < (footerTop - 540)) {
                sidebarShare.classList.add("active");
            } else{
                sidebarShare.classList.remove("active");
            }
        }
    },
    mounted() {
        let newParent = document.querySelector("main");
        var fragment = document.createDocumentFragment();
        fragment.appendChild(document.querySelector(".vertical-share"));
        newParent.appendChild(fragment);
        this.isTop();
        window.addEventListener("scroll", this.isTop);
    },
}
</script>

<style lang="scss">
    .horizontal-share,
    .vertical-share {
        svg path {
            fill:#AA6C42;
        }
    }
    .vertical-share {
        @apply transition-all duration-700 ease-in-out left-5 -bottom-full z-50 fixed flex flex-col items-center w-16;
        &.active {
            @apply bottom-1/4;
        }
        a {
            @apply bg-white rounded-full;
            width:53px;
        }
    }
</style>