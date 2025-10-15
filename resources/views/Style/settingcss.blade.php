<style>

/* ==============================
   Container & Layout
============================== */
.container.setting {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: background 0.3s ease, color 0.3s ease;
    color: #333;
}

/* ==============================
   Toggle Switch
============================== */
.setting-toggle {
    display: flex;
    justify-content: flex-start;
    gap: 20px;
    margin-bottom: 20px;
}

.setting-toggle label {
    font-weight: 600;
    cursor: pointer;
}

.setting-toggle input[type="checkbox"] {
    margin-right: 8px;
    transform: scale(1.2);
}

/* ==============================
   Forms & Inputs
============================== */
form h3 {
    margin-bottom: 15px;
    font-size: 1.5rem;
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 5px;
    color: #333;
    transition: color 0.3s ease;
}

form div {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
    transition: color 0.3s ease;
}

form input[type="text"],
form input[type="email"],
form input[type="date"],
form select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s, background 0.3s, color 0.3s;
    background-color: #fafafa;
    color: #333;
}

form input:focus,
form select:focus {
    border-color: #3498db;
    outline: none;
}

/* ==============================
   Profile Image
============================== */
.profile-image {
    display: block;
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #3498db;
    margin-bottom: 10px;
    transition: border-color 0.3s ease;
}

/* ==============================
   Buttons
============================== */
.button1 {
    padding: 10px 25px;
    background-color: #3498db;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.button1:hover {
    background-color: #2980b9;
    transform: translateY(-1px);
}

/* ==============================
   Responsive
============================== */
@media (max-width: 600px) {
    .container.setting {
        padding: 15px;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="date"],
    form select {
        font-size: 0.9rem;
    }
    .button1 {
        width: 100%;
    }
}
#password-form input[type="password"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    background-color: #fafafa;
    color: #333;
    transition: border-color 0.3s, background 0.3s, color 0.3s;
}

#password-form input[type="password"]:focus {
    border-color: #3498db;
    outline: none;
}

/* Buttons inside password form */
#password-form .button1 {
    background-color: #3498db; /* Different color to distinguish */
    color: #fff;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

#password-form .button1:hover {
    background-color: #2980b9;
    transform: translateY(-1px);
}

/* ==============================
   DARK THEME
============================== */

body.dark-mode #password-form input[type="password"] {
    background-color: #2a2a3d;
    color: #eee;
    border-color: #555;
}

body.dark-mode #password-form .button1 {
    background-color: #3498db;
}

body.dark-mode #password-form .button1:hover {
    background-color: #2980b9;
}
body.dark-mode .container.setting {
    background-color: #1f1f2e;
    color: #ccc;
    box-shadow: 0 4px 12px rgba(0,0,0,0.6);
}

body.dark-mode form h3 {
    color: #fff;
}

body.dark-mode form label {
    color: #ccc;
}

body.dark-mode form input[type="text"],
body.dark-mode form input[type="email"],
body.dark-mode form input[type="date"],
body.dark-mode form select {
    background-color: #2a2a3d;
    color: #eee;
    border-color: #555;
}

body.dark-mode .profile-image {
    border-color: #3b82f6;
}

body.dark-mode .button1 {
    background-color: #2563eb;
    color: #fff;
}

body.dark-mode .button1:hover {
    background-color: #1d4ed8;
}

</style>
