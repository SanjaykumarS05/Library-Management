<style>
    /* === Container === */
.container.book-search {
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
.container.book-search h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #2e3a59;
    transition: color 0.3s ease;
}

/* === Search Form === */
.search-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 30px;
}
.borrow-btn {
    background-color: #111827;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.borrow-btn:hover {
    background-color: #2563eb;
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


/* === Book Results Grid === */
.book-results {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* === Book Card === */
.book-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.book-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.book-card h4 {
    font-size: 18px;
    margin-bottom: 8px;
    color: #007bff;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
    transition: color 0.3s ease;
}

.book-card p {
    font-size: 14px;
    margin: 4px 0;
    transition: color 0.3s ease;
}

/* === Availability Status === */
.available {
    color: #28a745;
    font-weight: bold;
    transition: color 0.3s ease;
}

.unavailable {
    color: #dc3545;
    font-weight: bold;
    transition: color 0.3s ease;
}

/* === Issue Book Link === */
.book-card a {
    display: inline-block;
    margin-top: 10px;
    padding: 6px 14px;
    background-color: #17a2b8;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.3s ease, transform 0.3s ease;
}

.book-card a:hover {
    background-color: #117a8b;
    transform: translateY(-1px);
}

/* === Responsive Adjustments === */
@media screen and (max-width: 600px) {
    .search-form {
        flex-direction: column;
        align-items: center;
    }

    .book-results {
        grid-template-columns: 1fr;
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
/* === DARK THEME === */
body.dark-mode .container.book-search {
    background-color: #1e1e2f;
    color: #ccc;
}

body.dark-mode .h2 {
    color: #fff;
}
body.dark-mode .book-card {
    background-color: #2a2a3d;
    border-color: #555;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    color: #eee;
}

body.dark-mode .book-card h4 {
    color: #3b82f6;
}

body.dark-mode .book-card p {
    color: #ccc;
}

body.dark-mode .available {
    color: #22c55e;
}

body.dark-mode .unavailable {
    color: #f87171;
}

body.dark-mode .book-card a {
    background-color: #2563eb;
}

body.dark-mode .book-card a:hover {
    background-color: #1d4ed8;
}

body.dark-mode .search-form button {
    background-color: #2563eb;
}

body.dark-mode .search-form button:hover {
    background-color: #1d4ed8;
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