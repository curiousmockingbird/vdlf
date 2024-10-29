<template>
  <div class="mb-4">
    <h2 class="text-xl font-semibold">Contact {{ staffTitle }}</h2>
    <h4 class="text-l font-semibold mb-4">{{ staffProfession }}</h4>
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block text-sm font-bold mb-2">Your Name:</label>
        <input v-model="form.name" type="text" required class="w-full p-2 border rounded-lg"/>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-bold mb-2">Your Email:</label>
        <input v-model="form.email" type="email" required class="w-full p-2 border rounded-lg"/>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-bold mb-2">Your Message:</label>
        <textarea v-model="form.message" required class="w-full p-2 border rounded-lg" rows="5"></textarea>
      </div>
      <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">
        Send Message
      </button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    staffTitle: {
      type: String,
      required: true,
    },
    staffEmail: {
      type: String,
      required: true,
    },
    staffProfession: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: '',
      },
    };
  },
  methods: {
    submitForm() {
      const payload = {
        staffEmail: this.staffEmail,
        name: this.form.name,
        email: this.form.email,
        message: this.form.message,
      };

      // Log the payload for debugging
      console.log('Form submitted with payload:', payload);
      // Emit the payload to the parent
      this.$emit("submit-contact-form", payload);
    },
  },
};
</script>

<style scoped>
/* Add any necessary styling here */
</style>
