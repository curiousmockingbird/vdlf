<template>
    <ul class="flex -mx-3">
        <li v-if="$settings.fb_url != ''" class="mx-3">
            <a :href="$settings.fb_url" target="_blank">
                <svg-vue
                    icon="social.facebook"
                    alt="facebook"
                    class="icon"
                    width="22px"
                    height="22px"
                    style="fill:none"
                ></svg-vue>
            </a>
        </li>
        <li v-if="$settings.tw_url != ''" class="mx-3">
            <a :href="$settings.tw_url" target="_blank">
                <svg-vue
                    icon="social.twitter"
                    alt="facebook"
                    class="icon"
                    width="22px"
                    height="22px"
                ></svg-vue>
            </a>
        </li>
        <li v-if="$settings.ig_url != ''" class="mx-3">
            <a :href="$settings.ig_url" target="_blank">
                <svg-vue
                    icon="social.instagram"
                    alt="youtube"
                    class="icon"
                    width="22px"
                    height="22px"
                ></svg-vue>
            </a>
        </li>
    </ul>
</template>
