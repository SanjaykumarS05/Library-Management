<style>
    /* =========================
   Header & Page Titles
========================= */
.h2 {
    text-align: center;
    font-size: 26px;
    margin-bottom: 20px;
    color: #333;
    font-weight: 600;
}

/* =========================
   Search & Filter Bar
========================= */
.search-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 30px;
}

.search-form input[type="text"],
.search-form select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    min-width: 180px;
    transition: all 0.3s ease;
}

input[type="text"] {   
    width: 100%;
    margin-bottom: 10px;
}

.search-form input[type="text"]:focus,
.search-form select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
}


/* =========================
   Buttons
========================= */
.btn-success {
    background-color: #28a745;
    color: #fff;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* =========================
   Add Book Link
========================= */
a.addbook {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 16px;
    background-color: #28a745;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.3s ease, transform 0.3s ease;
}

a.addbook:hover {
    background-color: #218838;
    transform: translateY(-1px);
}

/* =========================
   Table Styles
========================= */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

thead {
    background-color: #007bff;
    color: #fff;
}

thead th {
    padding: 12px 10px;
    text-align: left;
    font-weight: 600;
}

tbody td {
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
    vertical-align: middle;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* =========================
   Cover Images
========================= */
td img {
    max-width: 100px;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

td img:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* =========================
   Action Buttons in Table
========================= */
td a, td .button1 {
    display: inline-block;
    margin: 2px 2px 2px 0;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    text-decoration: none;
    text-align: center;
    transition: 0.3s ease, transform 0.3s ease;
}

td a {
    background-color: #17a2b8;
    color: white;
}

td a:hover {
    background-color: #117a8b;
}

td .button1 {
    background-color: #dc3545;
    color: white;
}

td .button1:hover {
    background-color: #c82333;
}

/* =========================
   Availability & Stock Highlights
========================= */
td.Available {
    color: #28a745;
    font-weight: bold;
}

td.Unavailable {
    color: #dc3545;
    font-weight: bold;
}

/* =========================
   Responsive Table & Form
========================= */
@media screen and (max-width: 900px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead tr {
        display: none;
    }

    tbody tr {
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
    }

    tbody td {
        display: flex;
        justify-content: space-between;
        padding: 6px 10px;
        border-bottom: 1px dashed #ccc;
    }

    tbody td::before {
        content: attr(data-label);
        font-weight: bold;
    }

    td img {
        max-width: 80px;
    }
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

/* =========================
   Dark Theme
========================= */

body.dark-mode table {
    background-color: #2a2a3d;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    color: #eee;
}

body.dark-mode thead {
    background-color: #1f2a4d;
    color: #fff;
}

body.dark-mode tbody tr:hover {
    background-color: #3a3a50;
}

body.dark-mode td a {
    background-color: #3b82f6;
}

body.dark-mode td a:hover {
    background-color: #2563eb;
}

body.dark-mode td .button1 {
    background-color: #ef4444;
}

body.dark-mode td .button1:hover {
    background-color: #dc2626;
}

body.dark-mode a.addbook {
    background-color: #2563eb;
}

body.dark-mode a.addbook:hover {
    background-color: #1d4ed8;
}
body.dark-mode .search-bar input[type="text"]::placeholder,
body.dark-mode .search-form input[type="text"]::placeholder {
    color: #aaa;
}
body.dark-mode .h2 {
    color: #fff;
}

body.dark-mode .search-form input[type="text"],
body.dark-mode .search-form select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    min-width: 180px;
    background-color: #2a2a3f;
    transition: all 0.3s ease;
    color: #eee;
}
</style>