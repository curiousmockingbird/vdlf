<template>
    <div class="search-bar bg-themeBlack w-full">
        <div class="container mx-auto h-full flex items-center">
            <form method="GET" :action="this.$settings.app_url" class="py-1 flex items-center justify-center w-full">
            <input type="text" name="s" class="w-full p-4 rounded-lg" :value="keywords" placeholder="Type here..." />
            <button type="submit" class="bg-primary rounded-lg p-2 search-button">
                <SearchIcon
                    class="text-white h-10 w-10 cursor-pointer self-center"
                    aria-hidden="true"
                    stroke-width="1"
                    size="1.5x"
                />
            </button>
            <button type="button" class="bg-lightBlue border-none absolute top-2 right-2" @click="closeSearchBar()">
                <XIcon
                    class="text-primary h-10 w-10 cursor-pointer self-center text-primary"
                    aria-hidden="true"
                    stroke-width="1"
                    size="1.5x"
                />
            </button>
            </form>
        </div>
    </div>
</template>

<script>
import { XIcon, SearchIcon } from "@vue-hero-icons/outline";
export default {
    data() {
        return {
            keywords:"",
        }
    },
    components: {
        XIcon,
        SearchIcon
    },
    created() {
        let uri = window.location.search.substring(1); 
        let params = new URLSearchParams(uri);
        this.keywords = params.get("s");
    },
}
</script>
<style lang="scss" scoped>
    .search-bar {
        @apply fixed top-0 left-0 z-50 h-32 transform -translate-y-full transition-transform duration-500;
        &.active {
            @apply translate-y-0;
        }
    }
</style>