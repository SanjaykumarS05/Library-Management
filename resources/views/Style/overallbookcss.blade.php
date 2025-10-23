<style>
   /* === Container === */
.container.issued-books {
    max-width: 100%;
    padding: 20px;
    background: #fdfdfd;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    transition: background 0.3s ease, color 0.3s ease;
}

/* === Page Title === */
.container.issued-books h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 26px;
    font-weight: 600;
    color: #2e3a59;
}

/* === Filter Bar === */
.filter-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
}

/* === Search Input Styles === */
.filter-bar input[type="text"],
.filter-bar select {
    padding: 10px 12px;
    border: 1px solid #bbb;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #fff;
}

.filter-bar input[type="text"]:focus,
.filter-bar select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
}

.filter-bar input[type="text"]:hover,
.filter-bar select:hover {
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

/* === Reset Filters Link === */
#resetFilters {
    display: inline-block;
    margin: 5px 0 15px 10px;
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
    border: 1px solid #007bff;
    padding: 6px 14px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

#resetFilters:hover {
    background-color: #007bff;
    color: #fff;
    transform: translateY(-1px);
}

/* === Filter Buttons === */
.filter-bar .buttons,
.filter-bar .btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: 0.3s ease, transform 0.2s ease;
}

.filter-bar .buttons {
    background-color: #28a745;
    color: #fff;
}

.filter-bar .buttons:hover {
    background-color: #218838;
    transform: translateY(-1px);
}

.filter-bar .btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.filter-bar .btn-warning:hover {
    background-color: #e0a800;
}

/* === Overall Stats === */
.count {
    font-weight: bold;
    color: #007bff;
}

/* === Barcode Cards Grid === */
.barcode {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

/* === Barcode Card === */
.barcode-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 15px 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
}

.barcode-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.barcode-card h4 {
    font-size: 18px;
    color: #007bff;
    margin-bottom: 10px;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
}

.barcode-card p {
    font-size: 14px;
    margin: 4px 0;
}

/* === Barcode Image === */
.barcode-card .barcode1 {
    display: block;
    margin: 10px 0;
    text-align: center;
}

/* === Card Buttons === */
.barcode-card .buttons.small-btn {
    background-color: #17a2b8;
    color: #fff;
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 6px;
}

.barcode-card .buttons.small-btn:hover {
    background-color: #117a8b;
    transform: translateY(-1px);
}

/* === Responsive Adjustments === */
@media screen and (max-width: 600px) {
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .filter-bar input[type="text"],
    .filter-bar select,
    .filter-bar .buttons,
    .filter-bar .btn {
        width: 100%;
    }

    #resetFilters {
        width: 100%;
        text-align: center;
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

/* === Dark Mode === */
body.dark-mode .container.issued-books {
    background-color: #1e1e2f;
    color: #ccc;
}

body.dark-mode .barcode-card {
    background-color: #2a2a3d;
    border-color: #555;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    color: #eee;
}

body.dark-mode .barcode-card h4 {
    color: #3b82f6;
}

body.dark-mode .barcode-card p {
    color: #ccc;
}

body.dark-mode .count {
    color: #22c55e;
}

body.dark-mode .buttons,
body.dark-mode .buttons.small-btn,
body.dark-mode .btn-warning {
    box-shadow: none;
}

body.dark-mode .buttons {
    background-color: #2563eb;
    color: #fff;
}

body.dark-mode .buttons:hover,
body.dark-mode .buttons.small-btn:hover {
    background-color: #1d4ed8;
}

/* === Print Styles === */
@media print {
    body {
        background: #fff;
        color: #000;
    }
    .filter-bar,
    .buttons,
    .btn-warning,
    .no-export {
        display: none !important;
    }
    .barcode-card {
        page-break-inside: avoid;
        box-shadow: none;
        border: 1px solid #000;
    }
}
body.dark-mode .filter-bar input[type="text"],
body.dark-mode .filter-bar select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    min-width: 180px;
    background-color: #2a2a3f;
    transition: all 0.3s ease;
    color: #eee;
}

body.dark-mode input[type="text"] {
    width: 100%;
    color: #eee;
    margin-bottom: 10px;
}


</style>