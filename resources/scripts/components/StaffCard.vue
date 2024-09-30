<template>
  <div
    v-if="title"
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
      v-if="email || phone"
    >
      <p v-if="phone">
        <span class="font-semibold border-b inline-block border-primary mr-2">
          {{ phoneLabel }}
        </span>
        {{ phone }}
      </p>
      <p v-if="email">
        <span class="font-semibold border-b inline-block border-primary mr-2">
          {{ emailLabel }}
        </span>
        <a
          :href="emailLink"
          class="break-words relative z-10 cursor-pointer"
          target="_blank"
        >
          {{ email }}
        </a>
      </p>
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
    emailLabel: {
      type: String,
      default: 'Email',
    },
  },
  computed: {
    imagePositionClass() {
      return `object-${this.imagePosition}`;
    },
    emailLink() {
      return `mailto:${this.email}`;
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