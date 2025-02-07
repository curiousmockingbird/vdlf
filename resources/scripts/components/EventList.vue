
<template>
  <div class="event-list">
    <h1 class="title">Upcoming Events</h1>
    <div v-if="loading" class="loading">Loading events...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else>
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
        <p class="event-description" style="white-space: pre-line;" v-if="event.description">{{ event.description }}</p>
        <p class="event-description" v-else>No description</p>
        <button class="save-button" @click="handleSave(event)">Save to Calendar</button>
      </div>
      </div>

      <!-- Page Navigation Controls -->
      <div class="pagination-container">
        <button :disabled="currentPage <= 1" @click="goToPreviousPage" class="pagination-button">
          < Previous
        </button>
        <span>{{ currentPage }} of {{ totalPages }}</span>
        <button :disabled="currentPage >= totalPages" @click="goToNextPage" class="pagination-button">
          Next >
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      events: [],
      loading: true,
      error: null,
      currentPage: 1,
      totalPages: 1,
      pageSize: 10
    };
  },
  methods: {
    async fetchEvents(page = 1) {
      this.loading = true;
      // if your proxy expects ?page=0-based:
      // or you can pass ?page=page-1 and do skip = page * pageSize on the server

      try {
        const response = await axios.get(
          `https://proxy-server-for-events-api.vercel.app/api/proxy?page=${page}`
        );
        const fetchedEvents = response.data.items || [];
        this.events = fetchedEvents;

        // If the API returns a total event count:
        const totalCount = response.data.count || 0;
        this.totalPages = Math.ceil(totalCount / this.pageSize);

        this.currentPage = page;
        this.error = null;
      } catch (err) {
        this.error = "Failed to load events. Please try again.";
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
    goToNextPage() {
      if (this.currentPage < this.totalPages) {
        this.fetchEvents(this.currentPage + 1);
      }
    },
    goToPreviousPage() {
      if (this.currentPage > 1) {
        this.fetchEvents(this.currentPage - 1);
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
    generateGoogleCalendarLink(event) {
      const startDate = new Date(event.startDate)
        .toISOString()
        .replace(/-|:|\.\d\d\d/g, "");
      const endDate = new Date(event.endDate)
        .toISOString()
        .replace(/-|:|\.\d\d\d/g, "");
      const details = encodeURIComponent(event.description || "No description");
      const location = encodeURIComponent(
        event.locations &&
          event.locations.length > 0 &&
          event.locations[0].address
          ? `${event.locations[0].address.addressLine1}, ${event.locations[0].address.city}, ${event.locations[0].address.stateOrProvince}, ${event.locations[0].address.zipOrPostalCode}`
          : "No location"
      );
      return `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(
        event.name
      )}&dates=${startDate}/${endDate}&details=${details}&location=${location}&sf=true&output=xml`;
    },
    handleSave(event) {
      const url = this.generateGoogleCalendarLink(event);
      window.open(url, "_blank");
    },
  },
  mounted() {
    this.fetchEvents(1); // start with page 1

  }
  

};
</script>

<style scoped>
.event-list {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

.save-button {
  background-color: #4caf50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.save-button:hover {
  background-color: #45a049;
}

.pagination-container {
  color: red;
  text-align: center;
  margin: 20px 0;
}

.pagination-button {
  background-color: #4caf50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}
</style>
