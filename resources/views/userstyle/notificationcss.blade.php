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
/* =========================
   Pagination Styles
========================= */
.pagination-wrapper {
    margin-top: 25px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.pagination {
    display: inline-flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.pagination li {
    display: inline-block;
    margin: 0;
}

.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

/* Page links */
.pagination li a {
    background-color: #f8f9fa;
    color: #3498db;
    border: 1px solid #dee2e6;
}

.pagination li a:hover {
    background-color: #3498db;
    color: white;
    border-color: #3498db;
    transform: translateY(-2px);
}

/* Active page */
.pagination li .page-link.active,
.pagination li .active .page-link {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    border: 1px solid #3498db;
    cursor: default;
}

/* Disabled pages */
.pagination li .page-link.disabled,
.pagination li .disabled .page-link {
    background-color: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
    cursor: not-allowed;
    opacity: 0.6;
}

.pagination li .page-link.disabled:hover,
.pagination li .disabled .page-link:hover {
    background-color: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    transform: none;
}

/* Previous/Next buttons - Make them arrows */
.pagination li:first-child a,
.pagination li:first-child span,
.pagination li:last-child a,
.pagination li:last-child span {
    min-width: 40px;
    font-weight: 700;
}



/* Ellipsis */
.pagination li .page-link:not(.active):not(:hover) {
    background: transparent;
    border: none;
    color: #6c757d;
    cursor: default;
}

/* =========================
   Responsive Pagination
========================= */
@media (max-width: 768px) {
    .pagination {
        gap: 4px;
    }
    
    .pagination li a,
    .pagination li span {
        min-width: 35px;
        height: 35px;
        padding: 0 8px;
        font-size: 13px;
    }
    
    .pagination li:first-child a,
    .pagination li:first-child span,
    .pagination li:last-child a,
    .pagination li:last-child span {
        min-width: 35px;
    }
}
.text-success {
    color: #155724;              /* Darker green text for professionalism */
    font-weight: 600;             /* Bold */
    background-color: #d4edda;    /* Soft, muted green background */
    padding: 4px 10px;            /* Slightly larger padding for balance */
    border-radius: 12px;          /* Smooth rounded corners */
    font-size: 0.95rem;           /* Slightly bigger, readable font */
    display: inline-block;
    border: 1px solid #c3e6cb;   /* Subtle border for better separation */
    transition: all 0.3s ease;    /* Smooth hover effect */
}

/* Optional hover effect */
.text-success:hover {
    background-color: #c3e6cb;
    color: #0b2e13;
    cursor: default;
}

.status-select {
    padding: 6px 12px;                /* Comfortable padding */
    font-size: 0.95rem;               /* Readable text */
    font-weight: 500;                 /* Slightly bold text */
    color: #333;                      /* Dark text for readability */
    background-color: #f8f9fa;        /* Light gray background */
    border: 1px solid #ced4da;        /* Subtle border */
    border-radius: 6px;               /* Smooth rounded corners */
    outline: none;                    /* Remove default outline */
    transition: all 0.3s ease;        /* Smooth hover/focus effect */
    min-width: 120px;                 /* Prevent shrinking too small */
    cursor: pointer;                  /* Pointer cursor on hover */
}

/* Hover effect */
.status-select:hover {
    border-color: #80bdff;            /* Light blue border on hover */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25); /* Subtle shadow */
}

/* Focus effect */
.status-select:focus {
    border-color: #007bff;            /* Highlight on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    background-color: #fff;            /* White background on focus */
}

@media (max-width: 480px) {
    .pagination {
        gap: 2px;
    }
    
    .pagination li a,
    .pagination li span {
        min-width: 32px;
        height: 32px;
        padding: 0 6px;
        font-size: 12px;
    }
    
    .pagination li:first-child a,
    .pagination li:first-child span,
    .pagination li:last-child a,
    .pagination li:last-child span {
        min-width: 32px;
    }
}

/* Dark mode pagination */
body.dark-mode .pagination li a {
    background-color: #2a2a3f;
    color: #ddd;
    border: 1px solid #444;
}

body.dark-mode .pagination li a:hover {
    background-color: #3498db;
    color: white;
    border-color: #3498db;
}

body.dark-mode .pagination li .page-link.active,
body.dark-mode .pagination li .active .page-link {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    border: 1px solid #3498db;
}

body.dark-mode .pagination li .page-link.disabled,
body.dark-mode .pagination li .disabled .page-link {
    background-color: #2a2a3f;
    color: #888;
    border: 1px solid #444;
}

body.dark-mode .pagination li .page-link:not(.active):not(:hover) {
    background: transparent;
    color: #888;
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