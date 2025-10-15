<style>
    /* =========================
   General Styles
========================= */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
    color: #2c3e50;
    transition: background 0.3s ease, color 0.3s ease;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 25px;
    background-color: #fff;
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
    min-width: 800px;
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