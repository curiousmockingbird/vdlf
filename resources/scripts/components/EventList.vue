<template>
  <div class="event-list">
    <h1 style='font-size: 3rem;'>Upcoming Events</h1>
    <div v-if="loading">Loading events...</div>
    <div v-else-if="error">{{ error }}</div>
    <div v-else>
      <div v-for="event in events" :key="event.id" class="event-item">
        <h3>{{ event.name }}</h3>
        <p>Date: {{ formatDate(event.startDate) }}</p>
        <p>
          Location: 
          <span v-if="event.locations && event.locations.length > 0 && event.locations[0].address">
            {{ event.locations[0].address.addressLine1 }},
            {{ event.locations[0].address.city }},
            {{ event.locations[0].address.stateOrProvince }},
            {{ event.locations[0].address.zipOrPostalCode }}
          </span>
          <span v-else>
            No location
          </span>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EventList",
  data() {
    return {
      events: [],
      loading: true,
      error: null,
    };
  },
  methods: {
    async fetchEvents() {
      const url = "https://proxy-server-for-events-api.vercel.app/api/proxy";

      try {
        const response = await axios.get(url);
        // Extract events from the 'items' array in the response
        this.events = response.data.items || [];
      
      if (this.events[0]) {
        console.log('Available properties:', Object.keys(this.events[0]));
      }      
      } catch (err) {
        this.error = "Failed to load events. Please try again.";
        console.error(err.response || err);
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return "Invalid date";
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },
  },
  mounted() {
    this.fetchEvents();
 },
};
</script>

<style scoped>
.event-list {
  padding: 20px;
}

.event-item {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}
</style>
