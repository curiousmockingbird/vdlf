<template>
  <div class="event-list">
    <h1 class="title">Upcoming Events</h1>
    <div v-if="loading" class="loading">Loading events...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <div v-else>
      <div v-for="event in events" :key="event.id" class="event-item">
        <h3 class="event-name">{{ event.name }}</h3>
        <p class="event-date">
          Date:
            <sapn class="bold" 
            >{{ formatDate(event.startDate) }} 
            </sapn>
        </p>
        <p class="event-description" v-if="event.description">
          {{ event.description }}
        </p>
        <p class="event-description" v-else>No description</p>
        <p class="event-location">
          Location:
          <span
            v-if="
              event.locations &&
              event.locations.length > 0 &&
              event.locations[0].address
            "
          >
            {{ event.locations[0].address.addressLine1 }},
            {{ event.locations[0].address.city }},
            {{ event.locations[0].address.stateOrProvince }},
            {{ event.locations[0].address.zipOrPostalCode }}
          </span>
          <span v-else> No location </span>
        </p>
        <button class="save-button" @click="handleSave(event)">
          Save to Calendar
        </button>
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
        this.events = response.data.items || [];
        console.log("Events:", response.data.items[0]);
      } catch (err) {
        this.error = "Failed to load events. Please try again.";
        console.error(err.response || err);
      } finally {
        this.loading = false;
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
      return new Date(dateString).toLocaleDateString("en-EN", options); // What is this? Answer: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/toLocaleDateString
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
      const url = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(
        event.name
      )}&dates=${startDate}/${endDate}&details=${details}&location=${location}&sf=true&output=xml`;
      return url;
    },
    handleSave(event) {
      console.log("Save button clicked for event:", event);
      const url = this.generateGoogleCalendarLink(event);
      window.open(url, "_blank");
    },
  },
  mounted() {
    this.fetchEvents();
  },
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
</style>
