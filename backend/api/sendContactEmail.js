const nodemailer = require('nodemailer');

// const sendContactEmail = (req, res) => {
//     const { staffEmail, name, email, message } = req.body;

//     if (!staffEmail || !name || !email || !message) {
//         return res.status(400).json({ error: "All fields are required." });
//     }

//     // Set up nodemailer transport
//     const transporter = nodemailer.createTransport({
//         service: 'Gmail',
//         auth: {
//             user: process.env.EMAIL_USER,
//             pass: process.env.EMAIL_PASS,
//         },
//     });

//     const mailOptions = {
//         from: email,
//         to: staffEmail,
//         subject: `Contact from ${name}`,
//         text: message,
//     };

//     transporter.sendMail(mailOptions, (error, info) => {
//         if (error) {
//             return res.status(500).json({ error: 'Failed to send email' });
//         }
//         res.status(200).json({ message: 'Email sent successfully' });
//     });
// };

const sendContactEmail = (req, res) => {
    const { staffEmail, name, email, message } = req.body;

    // Check if all required fields are present
    if (!staffEmail || !name || !email || !message) {
        console.error("Missing required fields:", { staffEmail, name, email, message });
        return res.status(400).json({ error: "All fields are required." });
    }

    // Set up nodemailer transport
    const transporter = nodemailer.createTransport({
        service: 'Gmail',
        auth: {
            user: process.env.EMAIL_USER,
            pass: process.env.EMAIL_PASS,
        },
    });

    const mailOptions = {
        from: email,
        to: staffEmail,
        subject: `Contact from ${name}`,
        text: message,
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error("Error sending email:", error);
            return res.status(500).json({ error: 'Failed to send email' });
        }
        res.status(200).json({ message: 'Email sent successfully' });
    });
};


module.exports = sendContactEmail;
