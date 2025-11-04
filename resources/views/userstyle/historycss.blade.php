<style>
/* history.css - Styling for Borrowing History Page */

/* =========================
   LIGHT MODE (Default)
========================= */

/* General Styling */
body {
    background-color: #f8fafc;
    color: #1f2937;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.mt-5 {
    margin-top: 3rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

/* Typography */
h2.fw-bold {
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.5rem;
    transition: color 0.3s ease;
}

.text-muted {
    color: #6b7280 !important;
    transition: color 0.3s ease;
}

.text-danger {
    color: #dc3545 !important;
}

.text-success {
    color: #198754 !important;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 8px;
    transition: transform 0.2s ease-in-out, background-color 0.3s ease, border-color 0.3s ease;
    background-color: #ffffff;
    border: 1px solid #e5e7eb;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.card-body {
    padding: 1.25rem;
}

.card-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    background-color: #f8f9fa;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

/* Summary Cards */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-3, .col-sm-6 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 576px) {
    .col-sm-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (min-width: 768px) {
    .col-md-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }
}

.card.text-center {
    text-align: center;
}

.card.text-center h5 {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
    transition: color 0.3s ease;
}

.card.text-center h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0;
    color: #111827;
    transition: color 0.3s ease;
}

/* Active Loans Section */
h4 {
    font-weight: 600;
    color: #111827;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.col-md-6 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 768px) {
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

.border-danger {
    border: 1px solid #dc3545 !important;
}

.border-success {
    border: 1px solid #198754 !important;
}

.card-body h5.fw-bold {
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
    color: #111827;
    transition: color 0.3s ease;
}

.card-body p.text-muted {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.card-body p {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}

.bg-danger {
    background-color: #dc3545 !important;
    color: white;
}

.bg-dark {
    background-color: #343a40 !important;
    color: white;
}

.bg-success {
    background-color: #198754 !important;
    color: white;
}

/* Table Styling */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #1f2937;
    border-collapse: collapse;
    transition: color 0.3s ease;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #e5e7eb;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #e5e7eb;
    background-color: #f8f9fa;
    font-weight: 600;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.table-light {
    background-color: #f8f9fa;
}

.align-middle {
    vertical-align: middle !important;
}

/* =========================
   DARK MODE
========================= */
body.dark-mode {
    background-color: #0f172a;
    color: #e2e8f0;
}

body.dark-mode h2.fw-bold {
    color: #f1f5f9;
}

body.dark-mode .text-muted {
    color: #94a3b8 !important;
}

body.dark-mode .card {
    background-color: #1e293b;
    border: 1px solid #334155;
}

body.dark-mode .card-header {
    background-color: #1e293b;
    border-bottom: 1px solid #334155;
    color: #e2e8f0;
}

body.dark-mode .card.text-center h5 {
    color: #cbd5e1;
}

body.dark-mode .card.text-center h2 {
    color: #f8fafc;
}

body.dark-mode h4 {
    color: #f1f5f9;
}

body.dark-mode .card-body h5.fw-bold {
    color: #f1f5f9;
}

body.dark-mode .table {
    color: #e2e8f0;
}

body.dark-mode .table th,
body.dark-mode .table td {
    border-top: 1px solid #334155;
    background-color: #1e293b;
}

body.dark-mode .table thead th {
    background-color: #1e293b;
    border-bottom: 2px solid #334155;
    color: #e2e8f0;
}

body.dark-mode .table-light {
    background-color: #1e293b;
}

body.dark-mode .border-danger {
    border: 1px solid #dc3545 !important;
}

body.dark-mode .border-success {
    border: 1px solid #198754 !important;
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

/* Light Mode Pagination */
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

.pagination li .page-link.active,
.pagination li .active .page-link {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    border: 1px solid #3498db;
    cursor: default;
}

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

.pagination li:first-child a,
.pagination li:first-child span,
.pagination li:last-child a,
.pagination li:last-child span {
    min-width: 40px;
    font-weight: 700;
}

.pagination li .page-link:not(.active):not(:hover) {
    background: transparent;
    border: none;
    color: #6c757d;
    cursor: default;
}

/* Dark Mode Pagination */
body.dark-mode .pagination li a {
    background-color: #2a2a3f;
    color: #60a5fa;
    border: 1px solid #475569;
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
    color: #94a3b8;
    border: 1px solid #475569;
}

body.dark-mode .pagination li .page-link:not(.active):not(:hover) {
    background: transparent;
    color: #94a3b8;
}


@media (max-width: 768px) {
    .container {
        padding: 0 10px;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table {
        font-size: 0.9rem;
    }
    
    .table th,
    .table td {
        padding: 0.5rem;
    }

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

/* Icon styling */
.bi {
    margin-right: 0.25rem;
}

/* =========================
   Additional Dark Mode Styles
========================= */
body.dark-mode .shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.2) !important;
}

body.dark-mode .card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

/* Table row hover effects */
body.dark-mode .table tbody tr:hover {
    background-color: #334155;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Scrollbar styling for dark mode */
body.dark-mode ::-webkit-scrollbar {
    width: 8px;
}

body.dark-mode ::-webkit-scrollbar-track {
    background: #1e293b;
}

body.dark-mode ::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 4px;
}

body.dark-mode ::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

/* Focus states for accessibility */
button:focus,
.pagination li a:focus {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}
body.dark-mode .pagination-wrapper,
body.dark-mode .pagination-wrapper p,
body.dark-mode .pagination-wrapper span,
body.dark-mode .pagination-wrapper .text-muted,
body.dark-mode .pagination-wrapper small {
    color: #f6f4f4 !important;  /* force light text */
}

/* Optional: improve visibility of numbers */
body.dark-mode .pagination-wrapper strong {
    color: #ffffff !important;
}

body.dark-mode button:focus,
body.dark-mode .pagination li a:focus {
    outline: 2px solid #60a5fa;
}
</style>