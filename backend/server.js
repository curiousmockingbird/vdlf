require('dotenv').config(); // Load environment variables from .env

const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const sendContactEmail = require('./api/sendContactEmail'); // Import the email handler

const app = express();
app.use(cors());

const PORT = 4000;

// Add console logs after loading environment variables to verify their values
console.log('EMAIL_USER:', process.env.EMAIL_USER);
console.log('EMAIL_PASS:', process.env.EMAIL_PASS ? 'Loaded' : 'Not loaded');

// Middlewares
app.use(bodyParser.json());

// Set up the route
app.post('/api/send-contact-email', sendContactEmail);

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
