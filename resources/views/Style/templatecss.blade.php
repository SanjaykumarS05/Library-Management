<style>
   /* =========================
   Root Variables
========================= */
:root {
    --bg-color: #f5f6fa;
    --header-bg: #4a76a8;
    --header-text: #fff;
    --sidebar-bg: #2c3e50;
    --sidebar-text: #fff;
    --main-bg: #fff;
    --main-text: #333;
    --button-bg: #4a76a8;
    --button-hover: #3a5f87;
    --search-bg: #fff;
    --search-text: #333;
    --hr-color: #4a76a8;
    --table-header-bg: #3498db;
    --table-header-text: #fff;
    --table-row-hover: #ecf0f1;
    --table-row-even: #f9f9f9;
}

/* Dark Mode */
body.dark-mode {
    --bg-color: #121212;
    --header-bg: #111227;
    --header-text: #f0f0f0;
    --sidebar-bg: #111227;
    --sidebar-text: #ddd;
    --main-bg: #1a1a2e;
    --main-text: #eee;
    --button-bg: #6a5acd;
    --button-hover: #5747a3;
    --search-bg: #2a2a3b;
    --search-text: #fff;
    --hr-color: #6a5acd;
    --table-header-bg: #5dade2;
    --table-header-text: #fff;
    --table-row-hover: #3a3a50;
    --table-row-even: #2c2c3e;
}

/* =========================
   Global Styles
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
aside {
    width: 260px;
    transition: all 0.3s ease;
}

aside.closed {
    margin-left: -260px; /* Hide sidebar */
}

main {
    transition: margin-left 0.3s ease;
    margin-left: 260px;
}

main.full-width {
    margin-left: 0;
}


body {
    display: flex;
    min-height: 100vh;
    background-color: var(--bg-color);
    color: var(--main-text);
}

/* =========================
   Header
========================= */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 60px;
    background-color: var(--header-bg);
    color: var(--header-text);
    padding: 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

header h1 {
    font-size: 22px;
    font-weight: 600;
}

header .search-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

header input[type="text"] {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    outline: none;
    width: clamp(200px, 25vw, 400px);
    background-color: var(--search-bg);
    color: var(--search-text);
}

header .search-container button,
header .search-container a {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-color: var(--button-bg);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    transition: all 0.3s ease;
    text-decoration: none;
}

header .search-container button:hover,
header .search-container a:hover {
    background-color: var(--button-hover);
    transform: scale(1.05);
}
/* ===== Layout Base ===== */
body {
    display: flex;
    margin: 0;
    height: 100vh;
    overflow: hidden;
}

/* ===== Sidebar ===== */
aside {
    width: 260px;
    background: #ffffff;
    border-right: 1px solid #dadada;
    height: 100vh;
    transition: width 0.3s ease;
    overflow: hidden;
}

aside.closed {
    width: 65px; /* collapsed width */
}

aside ul li a {
    display: block;
    padding: 12px;
    font-size: 15px;
    white-space: nowrap;
    text-decoration: none;
    color: #333;
    transition: padding 0.3s, opacity 0.3s;
}

aside.closed ul li a {
    padding-left: 5px;
    opacity: 0; /* hide text */
}

/* Logo + profile collapse */
aside.closed .profile-header,
aside.closed .profile-info,
aside.closed h3,
aside.closed p {
    display: none;
}

/* ===== Main Content ===== */
main {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    transition: margin-left 0.3s ease, width 0.3s ease;
}

/* When sidebar collapsed */
main.full-width {
    width: calc(100% - 65px);
}

/* ===== Menu Icon ===== */
#menuToggle {
    cursor: pointer;
    font-size: 30px;
    margin-right: 15px;
}

header form button {
    background-color: #e74c3c;
    padding: 8px 14px;
    border-radius: 6px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
}

header form button:hover {
    background-color: #c0392b;
}

/* =========================
   Sidebar
========================= */
aside {
    position: fixed;
    top: 60px;
    left: 0;
    width: 260px;
    height: calc(100% - 60px);
    background-color: var(--sidebar-bg);
    color: var(--sidebar-text);
    padding: 20px;
    overflow-y: auto;
}

aside .profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

aside .profile-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 2px solid #ccc;
}

aside .profile-info h2 {
    font-size: 16px;
    margin-bottom: 2px;
}

aside .profile-info p {
    font-size: 14px;
    color: var(--sidebar-text);
}

aside hr {
    border: 0;
    border-top: 1px solid var(--hr-color);
    margin: 10px 0;
}

aside nav ul {
    list-style: none;
    margin-top: 10px;
    padding-left: 0;
}

aside nav ul li {
    margin: 8px 0;
}

aside nav ul li a {
    color: var(--sidebar-text);
    text-decoration: none;
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

aside nav ul li a:hover {
    background-color: var(--header-bg);
}

body.dark-mode aside nav ul li a:hover {
    background-color: #3498db;
}
/* Scrollbar */
aside::-webkit-scrollbar {
    width: 6px;
}
aside::-webkit-scrollbar-track { background: var(--sidebar-bg); }
aside::-webkit-scrollbar-thumb { background-color: var(--header-bg); border-radius: 3px; }

/* =========================
   Main Content
========================= */
main {
    margin-left: 260px;
    margin-top: 60px;
    padding: 20px;
    flex: 1;
}

.content {
    background-color: var(--main-bg);
    color: var(--main-text);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* =========================
   Filter Section
========================= */
.filter-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.filter-section > div {
    display: flex;
    flex-direction: column;
    flex: 1 1 200px;
}

.filter-section label {
    font-weight: 600;
    margin-bottom: 6px;
}

.filter-section select,
.filter-section input[type="text"],
.filter-section input[type="date"] {
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    transition: all 0.3s ease;
}

.filter-section select:focus,
.filter-section input[type="text"]:focus,
.filter-section input[type="date"]:focus {
    border-color: var(--button-bg);
    box-shadow: 0 0 6px rgba(74,118,168,0.3);
}

/* =========================
   Total Count
========================= */
#total-count-wrapper {
    margin-top: 10px;
    font-size: 16px;
    font-weight: 600;
}

#total-count {
    color: var(--button-bg);
}

/* =========================
   Buttons
========================= */
button.btn, a.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    margin-right: 6px;
    transition: all 0.3s ease;
}

button.btn-primary { background: linear-gradient(45deg,#3498db,#2980b9); color: #fff; }
button.btn-success { background: linear-gradient(45deg,#2ecc71,#27ae60); color: #fff; }
button.btn-warning { background: linear-gradient(45deg,#f39c12,#e67e22); color: #fff; }
a.btn-secondary { background: linear-gradient(45deg,#95a5a6,#7f8c8d); color: #fff; }

button.btn:hover, a.btn:hover { transform: translateY(-2px); }

/* =========================
   Table Styles
========================= */
.table-responsive { overflow-x: auto; }

table.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    min-width: 800px;
}

table.table th, table.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ecf0f1;
    text-align: left;
}

table.table th {
    background-color: var(--table-header-bg);
    color: var(--table-header-text);
    font-weight: 700;
}

table.table tr:nth-child(even) { background-color: var(--table-row-even); }
table.table tr:hover { background-color: var(--table-row-hover); }

/* =========================
   Responsive
========================= */
@media (max-width: 768px) {
    aside { width: 180px; }
    main { margin-left: 180px; padding: 15px; }
    .filter-section { flex-direction: column; }
    table.table { font-size: 14px; }
    header h1 { font-size: 18px; }
    header input[type="text"] { width: 140px; }
}
     
</style>