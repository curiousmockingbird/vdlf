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

    </div>
      <div class="pagination-container">
        <button :disabled="currentPage <= 1" @click="goToPreviousPage" class="pagination-button">
          <
        </button>
        <span>{{ currentPage }} of {{ totalPages }}</span>
        <button :disabled="currentPage >= totalPages" @click="goToNextPage" class="pagination-button">
          >
        </button>
      </div>

      <!-- Show Load More button if there are more events -->
      <div style="text-align: center;">
  <button
    style="background-color:rgb(167, 14, 40);"
    class="pagination-button"
    onclick="window.open('/upcoming-events', '_blank');"
  >
    See full list
  </button>
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
      currentPage: 1,
      totalPages: 1,
      pageSize: 6
      // hasMore: false, // Will be set by the API response
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
    }
  },
  mounted() {
    this.fetchEvents(1); // start with page 1

  }
};
</script>

<style scoped>
/* Base styling for larger screens */
.event-list {
  margin: 2rem auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* 
  The grid automatically tries to fit columns of at least 300px.
  If the parent container is ≥ 900px wide, you'll get 3 columns, 
  but on smaller screens it'll drop to 2 or 1 column automatically. 
*/
.event-list-wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px; 
  max-width: 950px;
  margin: 0 auto; 
}

.title {
  font-size: 2.5rem;
  text-align: center;
  margin-bottom: 20px;
  color: red;
}

.loading,
.error {
  text-align: center;
  font-size: 1.2rem;
  color: #666;
}

/* Card styling */
.event-item {
  padding: 15px;
  margin-bottom: 15px; /* grid gap handles columns, but you can keep margin for spacing below */
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Text styles */
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

/* 
  =============================
   MEDIA QUERIES FOR TABLETS
  =============================
  e.g., adjust for screens up to 768px wide
*/
@media (max-width: 768px) {
  .event-list {
    margin: 1rem auto; /* reduce outer margin */
    padding: 15px;
  }

  .title {
    font-size: 2rem;
    margin-bottom: 15px;
  }

  /* 
    If you want to allow columns on tablets, keep auto-fit as is; 
    or if you prefer only 2 columns max on tablets, you can use a 
    narrower max-width or even a new grid-template, etc.
  */

  .event-list-wrapper {
    max-width: 100%; /* let it use the full width of the container */
    padding: 0 10px; /* add some side padding so cards don't touch edges */
  }

  .event-item {
    margin-bottom: 20px;
  }
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

button[disabled] {
  opacity: 0.5;
  cursor: not-allowed;
}

/* 
  =============================
   MEDIA QUERIES FOR MOBILE
  =============================
  e.g., adjust for screens up to 480px or 576px
*/
@media (max-width: 576px) {
  .title {
    font-size: 1.7rem;
    margin-bottom: 10px;
  }

  .event-list {
    margin: 1rem auto;
    padding: 10px;
  }

  .event-list-wrapper {
    /* 
      If you really want a single column on smaller phones, 
      you could force it by overriding the grid rule:
        grid-template-columns: 1fr;
     */
    max-width: 100%;
  }

  .event-item {
    padding: 10px;
  }

  .event-name {
    font-size: 1.2rem;
  }
}
</style>
