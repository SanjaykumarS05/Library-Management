<style>
    /* Book Requests Page Styling */
.book-requests-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* Header Section */
.header-section {
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    color: #7f8c8d;
    margin-bottom: 0;
}

/* Stats Section */
.stats-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    border-left: 4px solid #3498db;
}

.stat-card.approved {
    border-left-color: #27ae60;
}

.stat-icon {
    font-size: 2rem;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin: 0;
}

/* Request Form Section */
.request-form-section {
    margin-bottom: 3rem;
}

.card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 1.5rem;
    border-bottom: 1px solid #e9ecef;
}

.card-header h3 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.card-body {
    padding: 2rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #3498db;
}

.btn-primary {
    background: #3498db;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #2980b9;
}

/* Requests Table Section */
.section-header {
    margin-bottom: 1.5rem;
}

.section-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}
.requests-table tbody tr {
    border-bottom: 1px solid #ccc;
}

.requests-table tbody tr:hover {
    background-color: #f9f9f9;
}

.table-responsive {
    overflow-x: auto;
}

.requests-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.requests-table th {
    background: #f8f9fa;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e9ecef;
}

.requests-table td {
    padding: 1rem;
    vertical-align: top;
}

.book-title {
    font-weight: 600;
    color: #2c3e50;
}

.category-badge {
    background: #e8f4fd;
    color: #3498db;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.request-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #7f8c8d;
}

.date-icon {
    font-size: 0.9rem;
}

.status-badge {
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: capitalize;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-approved {
    background: #d1edff;
    color: #004085;
    font-weight: 700;
}

.status-rejected {
    background: #f8d7da;
    color: #721c24;
}

.notes-cell {
    color: #7f8c8d;
    max-width: 200px;
}

.no-requests {
    padding: 3rem 1rem;
    text-align: center;
    color: #7f8c8d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .book-requests-container {
        padding: 1rem 0.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .stats-section {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .requests-table {
        font-size: 0.9rem;
    }
    
    .requests-table th,
    .requests-table td {
        padding: 0.75rem 0.5rem;
    }
}

@media (max-width: 480px) {
    .stats-section {
        grid-template-columns: 1fr;
    }
    
    .card-body {
        padding: 1rem;
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

</style>
