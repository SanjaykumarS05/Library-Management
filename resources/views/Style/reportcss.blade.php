<style>
    /* =========================
   General Styles
========================= */

.container {
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: background 0.3s ease, box-shadow 0.3s ease;
}

/* =========================
   Headings
========================= */
h1.h1 {
    font-size: 30px;
    margin-bottom: 25px;
    color: #34495e;
    text-align: center;
}

/* =========================
   Filter Section
========================= */
.filter-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 25px;
}

.filter-section > div {
    display: flex;
    flex-direction: column;
    flex: 1 1 220px;
}

.filter-section label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #34495e;
}
label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #34495e;
}
input[type="text"] {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #bdc3c7;
    outline: none;
    transition: all 0.3s ease;
}

.filter-section select,
.filter-section input[type="text"],
.filter-section input[type="date"] {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #bdc3c7;
    outline: none;
    transition: all 0.3s ease;
}

.filter-section select:focus,
.filter-section input[type="text"]:focus,
.filter-section input[type="date"]:focus {
    border-color: #5dade2;
    box-shadow: 0 0 6px rgba(93,173,226,0.4);
}

/* =========================
   Inline Custom Date Range
========================= */
#custom-date-range {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

#custom-date-range label {
    margin-bottom: 0;
    white-space: nowrap;
    font-weight: 600;
    color: #34495e;
}

#custom-date-range input[type="date"] {
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #bdc3c7;
    outline: none;
    width: 150px;
    transition: all 0.3s ease;
}

#custom-date-range input[type="date"]:focus {
    border-color: #5dade2;
    box-shadow: 0 0 6px rgba(93,173,226,0.4);
}

/* =========================
   Buttons
========================= */
button.btn, a.btn {
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
    border: none;
    margin-right: 6px;
    transition: all 0.3s ease, transform 0.2s ease;
}

button.btn:hover, a.btn:hover { transform: translateY(-2px); }

button.btn-primary { background: linear-gradient(45deg,#3498db,#2980b9); color: #fff; }
button.btn-success { background: linear-gradient(45deg,#2ecc71,#27ae60); color: #fff; }
button.btn-warning { background: linear-gradient(45deg,#f39c12,#e67e22); color: #fff; }
a.btn-secondary { background: linear-gradient(45deg,#95a5a6,#7f8c8d); color: #fff; }

/* =========================
   Table Styles
========================= */
.table-responsive { overflow-x: auto; }

table.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
    min-width: 100%;
    transition: all 0.3s ease;
}

table.table th, table.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ecf0f1;
    text-align: left;
    vertical-align: middle;
    transition: background 0.3s ease, color 0.3s ease;
}

table.table th {
    background-color: #3498db;
    color: #fff;
    text-transform: uppercase;
    font-weight: 700;
    cursor: pointer;
}

table.table tr:nth-child(even) { background-color: #f9f9f9; }
table.table tr:hover { background-color: #ecf0f1; }

.text-center { text-align: center; }

/* =========================
   Responsive
========================= */
@media (max-width: 768px) {
    .filter-section { flex-direction: column; }
    #custom-date-range { flex-direction: column; align-items: flex-start; }
    #custom-date-range input[type="date"] { width: 100%; }
    table.table { font-size: 14px; }
}
#total-count {
   background: #28a745;
   color: #fff;
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
}

body.dark-mode #total-count {
    background-color: #22c55e;
    color: #fff;
}

p#total-count-wrapper {
    text-align: center;
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
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
   DARK MODE
========================= */
body.dark-mode {
    background-color: #121212;
    color: #ddd;
}

body.dark-mode .container {
    background-color: #1e1e2e;
    box-shadow: 0 6px 20px rgba(0,0,0,0.6);
}

body.dark-mode h1.h1 { color: #fff; }
body.dark-mode .filter-section label { color: #ddd; }

body.dark-mode label { color: #ddd; }

body.dark-mode input[type="text"]{
    background-color: #2a2a3f;
    border: 1px solid #555;
    color: #eee;
}

body.dark-mode .filter-section select,
body.dark-mode .filter-section input[type="text"],
body.dark-mode .filter-section input[type="date"] {
    background-color: #2a2a3f;
    border: 1px solid #555;
    color: #eee;
}

body.dark-mode .filter-section select:focus,
body.dark-mode .filter-section input[type="text"]:focus,
body.dark-mode .filter-section input[type="date"]:focus {
    border-color: #5dade2;
    box-shadow: 0 0 6px rgba(93,173,226,0.4);
}

body.dark-mode table.table th { background-color: #5dade2; color: #fff; }
body.dark-mode table.table tr:nth-child(even) { background-color: #2c2c3e; }
body.dark-mode table.table tr:hover { background-color: #3a3a50; }
body.dark-mode table.table td, body.dark-mode table.table th { color: #eee; }

body.dark-mode button.btn-primary { background: linear-gradient(45deg,#2563eb,#1d4ed8); }
body.dark-mode button.btn-success { background: linear-gradient(45deg,#22c55e,#16a34a); }
body.dark-mode button.btn-warning { background: linear-gradient(45deg,#f59e0b,#d97706); }
body.dark-mode a.btn-secondary { background: linear-gradient(45deg,#555,#777); }

</style>