<style>
    /* Book Requests Page Styling */
    .book-requests-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* =========================
       LIGHT MODE (Default)
    ========================= */
    
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .stat-card.approved {
        border-left-color: #27ae60;
    }

    .stat-icon {
        font-size: 2rem;
        color: #3498db;
    }

    .stat-card.approved .stat-icon {
        color: #27ae60;
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
        border: 1px solid #e9ecef;
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
        background-color: white;
        color: #2c3e50;
    }

    .form-control:focus {
        outline: none;
        border-color: #3498db;
    }

    .form-control::placeholder {
        color: #6c757d;
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
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-1px);
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

    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid #e9ecef;
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
        border-bottom: 1px solid #e9ecef;
    }

    .requests-table tbody tr {
        transition: background-color 0.3s ease;
    }

    .requests-table tbody tr:hover {
        background-color: #f8f9fa;
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
        color: #3498db;
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
        background: white;
    }

    /* =========================
       DARK MODE
    ========================= */
    body.dark-mode {
        background-color: #1a1a2e;
        color: #e0e0e0;
    }

    body.dark-mode .page-title {
        color: #ffffff;
    }

    body.dark-mode .page-subtitle {
        color: #b0b0b0;
    }

    body.dark-mode .stat-card {
        background: #2a2a3f;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        border-left: 4px solid #3498db;
    }

    body.dark-mode .stat-card.approved {
        border-left-color: #27ae60;
    }

    body.dark-mode .stat-icon {
        color: #3498db;
    }

    body.dark-mode .stat-card.approved .stat-icon {
        color: #27ae60;
    }

    body.dark-mode .stat-content h3 {
        color: #ffffff;
    }

    body.dark-mode .stat-label {
        color: #b0b0b0;
    }

    body.dark-mode .card {
        background: #2a2a3f;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        border: 1px solid #3a3a4f;
    }

    body.dark-mode .card-header {
        background: #2d2d44;
        border-bottom: 1px solid #3a3a4f;
    }

    body.dark-mode .card-header h3 {
        color: #ffffff;
    }

    body.dark-mode .form-group label {
        color: #e0e0e0;
    }

    body.dark-mode .form-control {
        background-color: #2a2a3f;
        border: 2px solid #3a3a4f;
        color: #e0e0e0;
    }

    body.dark-mode .form-control:focus {
        border-color: #3498db;
        background-color: #2a2a3f;
        color: #e0e0e0;
    }

    body.dark-mode .form-control::placeholder {
        color: #888;
    }

    body.dark-mode .section-header h2 {
        color: #ffffff;
    }

    body.dark-mode .table-responsive {
        border: 1px solid #3a3a4f;
    }

    body.dark-mode .requests-table {
        background: #2a2a3f;
    }

    body.dark-mode .requests-table th {
        background: #2d2d44;
        color: #ffffff;
        border-bottom: 2px solid #3a3a4f;
    }

    body.dark-mode .requests-table td {
        border-bottom: 1px solid #3a3a4f;
    }

    body.dark-mode .requests-table tbody tr:hover {
        background-color: #2d2d44;
    }

    body.dark-mode .book-title {
        color: #ffffff;
    }

    body.dark-mode .category-badge {
        background: #1e3a5f;
        color: #3498db;
    }

    body.dark-mode .request-date {
        color: #b0b0b0;
    }

    body.dark-mode .date-icon {
        color: #3498db;
    }

    body.dark-mode .status-pending {
        background: #3a2e1e;
        color: #ffc107;
    }

    body.dark-mode .status-approved {
        background: #1a3a2e;
        color: #4caf50;
    }

    body.dark-mode .status-rejected {
        background: #3a1e1e;
        color: #f44336;
    }

    body.dark-mode .notes-cell {
        color: #b0b0b0;
    }

    body.dark-mode .no-requests {
        background: #2a2a3f;
        color: #b0b0b0;
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
        color: #3498db;
        border: 1px solid #3a3a4f;
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
        border: 1px solid #3a3a4f;
    }

    body.dark-mode .pagination li .page-link:not(.active):not(:hover) {
        background: transparent;
        color: #888;
    }

    /* =========================
       Responsive Design
    ========================= */
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
        .stats-section {
            grid-template-columns: 1fr;
        }
        
        .card-body {
            padding: 1rem;
        }

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

    /* Additional Dark Mode Enhancements */
    body.dark-mode select.form-control {
        background-color: #2a2a3f;
        color: #e0e0e0;
    }

    body.dark-mode select.form-control option {
        background-color: #2a2a3f;
        color: #e0e0e0;
    }

    /* Scrollbar Styling for Dark Mode */
    body.dark-mode ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    body.dark-mode ::-webkit-scrollbar-track {
        background: #2a2a3f;
    }

    body.dark-mode ::-webkit-scrollbar-thumb {
        background: #3a3a4f;
        border-radius: 4px;
    }

    body.dark-mode ::-webkit-scrollbar-thumb:hover {
        background: #4a4a5f;
    }
</style>