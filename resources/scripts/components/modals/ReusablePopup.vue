<template>
  <div>
    <button v-if="show_button" class="bg-primary text-white py-3 px-5 rounded-md" @click.prevent="show">
      {{ label }}
    </button>
    <modal
      :name="'modal-card-'+id"
      class="text-left overflow-y-auto no-scrollbar"
      width="100%"
      height="100%"
      :scrollable="true"
      :draggable="true"
      styles="overflow-y: auto; border-radius: 16px; background: transparent;"
    >
        <div class="relative flex flex-col popup-bg relative overflow-hidden lg:flex-row justify-center items-center container pr-0">
            <button class="absolute top-3 right-0" @click.prevent="hide">
                <XIcon
                    class="h-12 w-12 cursor-pointer self-center text-white"
                    aria-hidden="true"
                    stroke-width="2"
                    size="1"
                />
            </button>
            <div class="content-text relative z-20">
                <div class="heading p-10">
                    <h1 class="text-black font-bold text-3xl md:text-4xl leading-tight">
                        {{ title }}
                    </h1>
                    <a
                        :href="btn_link"
                        class="block mt-6 text-2xl md:text-3xl flex items-center text-white font-bold"
                    >
                        <img
                            v-if="image_icon.id != ''"
                            :src="image_icon.url"
                            height="54px"
                            width="54px"
                            class="inline-block mr-5 py-5 svg"
                        />{{ btn_text }}</a
                    >
                </div>
            </div>

            <div class="content-img">
                <img
                    :src="image.url ? image.url : $images + '/hero-img.png'"
                    class="hero-image h-full z-20 "
                    style="max-height:calc(100vh - 100px)"
                />
            </div>
        </div>
    </modal>
  </div>
</template>

<script>
import { XIcon } from "@vue-hero-icons/outline";
export default {
    components: {
        XIcon
    },
    data() {
        return {
            image: {
                type: Object,
                default(){
                    return {
                        id:12461,
                        url:"http://vdlf.test/wp-content/uploads/2022/03/hi-res-May-Day-FB-profile-c3.jpg"
                    }
                }
            },
            image_icon: {
                type: Object,
                default(){ 
                    return {
                        id:9488,
                        url:"http://vdlf.test/wp-content/uploads/2021/09/Group-466.png"
                    }
                }
            },
        }
    },
    props: {
        title: {
            type: String,
            default: "May Day 2022: Our communities are rising up!"
        },
        id: {
            type: String,
            default: "5369779"
        },
        btn_link: {
            type: String,
            default: "email"
        },
        btn_text: {
            type: String,
            default: "Join Us"
        },
        image_string: {
            type: String,
            default: ""
        },
        image_icon_string: {
            type: String,
            default: ""
        },
        label: {
            type: String,
            default: "Click here to open popup"
        },
        show_button: {
            type: Boolean,
            default: true,
        },
        autoshow: {
            type: Boolean,
            default: true
        },
        background_color: {
            type: String,
            default: 'linear-gradient(180deg, #f0a341 0%, #c22d28 100%)'
        }
    },
    methods: {
        show() {
            this.$modal.show("modal-card-"+this.id);
        },
        hide() {
            this.$modal.hide("modal-card-"+this.id);
        },
    },
    created () {
        if (this.image_string) {
            this.image = JSON.parse(this.image_string)
        }

        if (this.image_icon_string) {
            this.image_icon = JSON.parse(this.image_icon_string)
        }
    },
    mounted() {
        if (this.autoshow) 
            this.show();
    },
};
</script>
<style lang="scss">
.popup-bg {
    background: linear-gradient(180deg, #f0a341 0%, #c22d28 100%);
}

.vm--modal {
    @apply flex items-center;
}
.vm--overlay {
    background-color: rgba(0, 0, 0, 0.4);
}
</style>
<style lang="scss" scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
  -ms-overflow-style: none;
  /* IE and Edge */
  scrollbar-width: none;
  /* Firefox */
}
</style>
