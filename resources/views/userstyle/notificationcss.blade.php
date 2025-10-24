<style>
/* ==============================
   Container & Layout
============================== */
.container.setting {
    max-width: 100%
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
    flex-wrap: wrap;
}

.setting-toggle label {
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 8px 16px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.setting-toggle label:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}

.setting-toggle input[type="checkbox"] {
    margin-right: 8px;
    transform: scale(1.2);
}

/* ==============================
   Headings
============================== */
.container.setting h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    color: #333;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

.container.setting h3 {
    margin-bottom: 20px;
    font-size: 1.5rem;
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 8px;
    color: #333;
    transition: color 0.3s ease;
}

/* ==============================
   Tables
============================== */
.container.setting table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.container.setting th {
    background: #3498db;
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.container.setting td {
    padding: 12px 15px;
    border-bottom: 1px solid #f1f1f1;
    color: #555;
    transition: all 0.3s ease;
}

.container.setting tbody tr:hover {
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.container.setting tbody tr:nth-child(even) {
    background: #fafafa;
}

/* ==============================
   Forms & Inputs
============================== */
#send-email-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 600px;
    margin: 0 auto;
}

#send-email-form label {
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
    transition: color 0.3s ease;
}

#send-email-form input[type="text"],
#send-email-form select,
#send-email-form textarea {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s, background 0.3s, color 0.3s;
    background-color: #fafafa;
    color: #333;
    font-family: inherit;
}

#send-email-form textarea {
    resize: vertical;
    min-height: 120px;
}

#send-email-form input:focus,
#send-email-form select:focus,
#send-email-form textarea:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

/* ==============================
   Status Select
============================== */
.status-select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #fafafa;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 120px;
}

.status-select:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

/* ==============================
   Buttons
============================== */
.button1, #send-email-btn {
    padding: 12px 30px;
    background-color: #3498db;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    align-self: flex-start;
    margin-top: 10px;
}

.button1:hover, #send-email-btn:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* ==============================
   Status Styles
============================== */
.status-approved {
    color: #27ae60;
    font-weight: bold;
}

.status-pending {
    color: #f39c12;
    font-weight: bold;
}

.status-rejected {
    color: #e74c3c;
    font-weight: bold;
}

/* ==============================
   Empty States
============================== */
.container.setting p {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px 20px;
    background: #f8f9fa;
    border-radius: 8px;
    margin: 20px 0;
}

/* ==============================
   Responsive
============================== */
@media (max-width: 768px) {
    .container.setting {
        padding: 15px;
        margin: 10px;
    }
    
    .setting-toggle {
        flex-direction: column;
        gap: 10px;
    }
    
    .setting-toggle label {
        width: 100%;
        justify-content: center;
    }
    
    .container.setting table {
        display: block;
        overflow-x: auto;
    }
    
    .container.setting th,
    .container.setting td {
        padding: 10px 8px;
        font-size: 0.9rem;
    }
    
    #send-email-form {
        max-width: 100%;
    }
    
    .button1, #send-email-btn {
        width: 100%;
        align-self: stretch;
    }
}

@media (max-width: 480px) {
    .container.setting h1 {
        font-size: 1.5rem;
    }
    
    .container.setting h3 {
        font-size: 1.25rem;
    }
    
    .container.setting th,
    .container.setting td {
        padding: 8px 6px;
        font-size: 0.8rem;
    }
}

/* ==============================
   Section Transitions
============================== */
#book-section,
#received-section,
#sent-section {
    transition: all 0.3s ease-in-out;
}

/* ==============================
   DARK THEME
============================== */
body.dark-mode .container.setting {
    background-color: #1f1f2e;
    color: #ccc;
    box-shadow: 0 4px 12px rgba(0,0,0,0.6);
}

body.dark-mode .container.setting h1 {
    color: #fff;
    border-bottom-color: #3b82f6;
}

body.dark-mode .container.setting h3 {
    color: #fff;
    border-bottom-color: #2a2a3d;
}

body.dark-mode .setting-toggle label {
    background: #2a2a3d;
    color: #ccc;
}

body.dark-mode .setting-toggle label:hover {
    background: #3a3a4d;
}

body.dark-mode .container.setting table {
    background: #2a2a3d;
}

body.dark-mode .container.setting th {
    background: #2563eb;
    color: #fff;
}

body.dark-mode .container.setting td {
    color: #ccc;
    border-bottom-color: #3a3a4d;
}

body.dark-mode .container.setting tbody tr:hover {
    background: #3a3a4d;
}

body.dark-mode .container.setting tbody tr:nth-child(even) {
    background: #2d2d3d;
}

body.dark-mode #send-email-form label {
    color: #ccc;
}

body.dark-mode #send-email-form input[type="text"],
body.dark-mode #send-email-form select,
body.dark-mode #send-email-form textarea {
    background-color: #2a2a3d;
    color: #eee;
    border-color: #555;
}

body.dark-mode .status-select {
    background-color: #2a2a3d;
    color: #eee;
    border-color: #555;
}

body.dark-mode .button1,
body.dark-mode #send-email-btn {
    background-color: #2563eb;
    color: #fff;
}

body.dark-mode .button1:hover,
body.dark-mode #send-email-btn:hover {
    background-color: #1d4ed8;
}

body.dark-mode .container.setting p {
    color: #999;
    background: #2a2a3d;
}

/* Password form styles for consistency */
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
    background-color: #3498db;
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
</style>