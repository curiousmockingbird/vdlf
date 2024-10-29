<template>
  <div
    class="overflow-hidden border-2 bg-transparent rounded-lg border-secondary flex flex-col staff-item"
    :class="{'cursor-pointer': clickable}"
    @click="$emit('click', $event)"
  >
    <img
      :src="avatar"
      class="w-full h-64 object-cover"
      :class="imagePositionClass"
      :alt="title"
    />
    <div class="header bg-transparent p-3 w-full">
      <h4 class="text-lg text-black font-semibold">{{ title }}</h4>
      <div
        class="text-base profession leading-tight mt-1 text-black mb-0"
        v-html="profession"
      ></div>
      {{ year }}
    </div>
    <div
      class="block break-all text-base p-3 m-0 text-black mt-auto"
      v-if="phone"
    >
      <p>
        <span class="font-semibold border-b inline-block border-primary mr-2">
          {{ phoneLabel }}
        </span>
        {{ phone }}
      </p>
    </div>
    <!-- Contact Button -->
    <div class="block text-base p-3 m-0 text-black mt-auto">
      <button
        @click.stop="emitScrollToContactForm"
        class="px-4 py-2 bg-primary text-white rounded-lg cursor-pointer"
      >
        Contact
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    avatar: {
      type: String,
      required: true,
    },
    imagePosition: {
      type: String,
      default: 'cover',
    },
    title: {
      type: String,
      required: true,
    },
    profession: {
      type: String,
      default: '',
    },
    email: {
      type: String,
      default: '',
    },
    phone: {
      type: String,
      default: '',
    },
    year: {
      type: String,
      default: '',
    },
    clickable: {
      type: Boolean,
      default: false,
    },
    phoneLabel: {
      type: String,
      default: 'Phone',
    },
  },
  computed: {
    imagePositionClass() {
      return `object-${this.imagePosition}`;
    },
  },
  methods: {
    emitScrollToContactForm() {
      if (this.email && this.email.trim() !== '') {
        console.log('email', this.email);
        this.$emit("open-contact-modal", {
          title: this.title,
          email: this.email,
          phone: this.phone,
          profession: this.profession,
        });
      } else {
        alert('Email unavailable');
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.staff-item > img[src*="logo.png"] {
  @apply p-5 bg-white;
  object-fit: contain !important;
}
.staff-item:hover {
  @apply bg-gradient-to-b from-primary to-secondary text-white;
  h4,
  span,
  .profession,
  a,
  p {
    color: #fff !important;
    background-color: transparent !important;
  }
}
</style>
