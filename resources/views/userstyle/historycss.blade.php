<style>
/* history.css - Styling for Borrowing History Page */

/* General Styling */
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
    color: #333;
    margin-bottom: 0.5rem;
}

.text-muted {
    color: #6c757d !important;
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
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
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
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.card.text-center h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0;
}

/* Active Loans Section */
h4 {
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
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
    color: #212529;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
}

.table-light {
    background-color: #f8f9fa;
}

.align-middle {
    vertical-align: middle !important;
}

/* Responsive adjustments */
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
}

/* Icon styling */
.bi {
    margin-right: 0.25rem;
}

</style>