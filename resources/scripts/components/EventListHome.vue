<template>
  <div class="event-list">
    <h1 class="title">Upcoming Events</h1>
    <div v-if="loading" class="loading">Loading events...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else class="event-list-wrapper">
      <div v-for="event in events" :key="event.id" class="event-item">
        <h3 class="event-name">{{ event.name }}</h3>
        <h6 class="event-type">{{ event.eventType.name }}</h6>
        <p class="event-date">
          Date:
          <span class="bold">{{ formatDate(event.startDate) }}</span>
        </p>
        <p class="event-location" style="margin-bottom: 20px;">
          Location:
          <span v-if="event.locations && event.locations.length > 0 && event.locations[0].address">
            {{ event.locations[0].name }},
            {{ event.locations[0].address.addressLine1 }},
            {{ event.locations[0].address.city }},
            {{ event.locations[0].address.stateOrProvince }}
            {{ event.locations[0].address.zipOrPostalCode }}
          </span>
          <span v-else>No location</span>
        </p>
        <!-- <p class="event-description" style="white-space: pre-line;" v-if="event.description">{{ event.description }}</p>
        <p class="event-description" v-else>No description</p>
        <button class="save-button" @click="handleSave(event)">Save to Calendar</button> -->
      </div>

      <!-- Show Load More button if there are more events -->
      <div v-if="hasMore && !loadingMore" style="text-align: center; margin: 20px 0;">
        <button @click="loadMore">Load More</button>
        </div>
      </div>

      <div v-else-if="loadingMore" style="text-align: center; margin: 20px 0;">
        Loading more events...
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
      nextLink: "",
      loading: true,
      loadingMore: false,
      error: null,
      currentPage: 0,
      pagination: 1,
      count: 1,
      hasMore: false, // Will be set by the API response
    };
  },
  methods: {
    async fetchEvents(page = 0) {
      this.loading = page === 0; // Only show initial loader on first page
      this.loadingMore = page > 0; // Show a "loading more" state when loading subsequent pages
      const url = `https://proxy-server-for-events-api.vercel.app/api/proxy?page=${page}`;

      try {
        const response = await axios.get(url);
        const fetchedEvents = response.data.items || [];
        this.events = fetchedEvents;

      } catch (err) {
        this.error = "Failed to load events. Please try again.";
        console.error(err.response || err);
      } finally {
        this.loading = false;
        this.loadingMore = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return "Invalid date";
      const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        weekday: "long",
        hour: "2-digit",
        minute: "2-digit",
      };
      return new Date(dateString).toLocaleDateString("en-EN", options);
    },
    loadMore() {
      const url = '/events-2';
      window.open(url, "_blank");
    }
  },
  mounted() {
    this.fetchEvents();
  },
};
</script>

<style scoped>
.event-list {
  max-width: 800px;
  margin: 2rem auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.event-list-wrapper {
  /* Enable grid layout with 3 columns */
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  /* Spacing between columns/rows */
  gap: 20px;  
  /* Optional: center the grid container in its parent */
  max-width: 900px; /* enough width for 3 columns of 300px each */
  margin: 0 auto;
}

.title {
  font-size: 2.5rem;
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.loading,
.error {
  text-align: center;
  font-size: 1.2rem;
  color: #666;
}

.event-item {
  padding: 15px;
  margin-bottom: 15px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.event-name {
  font-size: 1.5rem;
  color: #333;
}
.event-type {
  font-size: 0.9rem;
  color: red;
  margin-bottom: 10px;
}

.event-date,
.event-description,
.event-location {
  font-size: 1rem;
  color: #555;
  margin-bottom: 5px;
}
.event-date .bold {
  font-weight: bold;
}

.event-location span {
  font-weight: bold;
}
</style>
