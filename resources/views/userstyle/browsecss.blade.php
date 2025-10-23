<style>
/* ============ GENERAL ============ */
body {
    background-color: #f8fafc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #1f2937;
    transition: background-color 0.3s ease, color 0.3s ease;
}

body.dark-mode {
    background-color: #0f172a;
    color: #e2e8f0;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
}

/* ============ HEADER ============ */
.dashboard-header {
    text-align: left;
    margin-bottom: 30px;
}

.dashboard-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #111827;
    transition: color 0.3s ease;
}

body.dark-mode .dashboard-header h1 {
    color: #f1f5f9;
}

.dashboard-header p {
    font-size: 1rem;
    color: #6b7280;
    transition: color 0.3s ease;
}

body.dark-mode .dashboard-header p {
    color: #94a3b8;
}

/* ============ STATS CARDS ============ */
.stats-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    flex: 1;
    min-width: 200px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    text-align: center;
    padding: 20px;
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

body.dark-mode .stat-card {
    background: #1e293b;
    border: 1px solid #334155;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

body.dark-mode .stat-card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.stat-card h2 {
    font-size: 1.8rem;
    margin: 10px 0;
    color: #111827;
    transition: color 0.3s ease;
}

body.dark-mode .stat-card h2 {
    color: #f8fafc;
}

.stat-card p {
    color: #6b7280;
    font-size: 1rem;
    transition: color 0.3s ease;
}

body.dark-mode .stat-card p {
    color: #cbd5e1;
}

.stat-icon {
    font-size: 1.6rem;
    display: block;
    color: #2563eb;
    transition: color 0.3s ease;
}

body.dark-mode .stat-icon {
    color: #60a5fa;
}

/* ============ CATEGORY FILTER ============ */
.category-section {
    margin-bottom: 40px;
}

.category-section h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #111827;
    transition: color 0.3s ease;
}

body.dark-mode .category-section h3 {
    color: #f1f5f9;
}

.category-section p {
    color: #6b7280;
    margin-bottom: 15px;
    transition: color 0.3s ease;
}

body.dark-mode .category-section p {
    color: #94a3b8;
}

.category-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.category-item {
    background-color: #f3f4f6;
    border-radius: 25px;
    padding: 8px 16px;
    font-size: 0.9rem;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid #e5e7eb;
}

body.dark-mode .category-item {
    background-color: #334155;
    color: #e2e8f0;
    border: 1px solid #475569;
}

.category-item:hover {
    background-color: #2563eb;
    color: #fff;
    transform: translateY(-1px);
}

body.dark-mode .category-item:hover {
    background-color: #3b82f6;
    color: #fff;
}

.toggle-buttons {
    display: flex;
    gap: 15px;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 10px;
    margin-bottom: 20px;
    transition: border-color 0.3s ease;
}

body.dark-mode .toggle-buttons {
    border-bottom: 2px solid #334155;
}

.toggle-buttons button {
    background: none;
    border: none;
    font-weight: 600;
    cursor: pointer;
    color: #6b7280;
    transition: color 0.2s, border-bottom 0.2s;
    padding: 8px 16px;
    border-radius: 8px;
}

body.dark-mode .toggle-buttons button {
    color: #94a3b8;
}

.toggle-buttons button.active {
    color: #2563eb;
    border-bottom: 2px solid #2563eb;
}

body.dark-mode .toggle-buttons button.active {
    color: #60a5fa;
    border-bottom: 2px solid #60a5fa;
}

.toggle-buttons button:hover:not(.active) {
    background-color: #f3f4f6;
    color: #374151;
}

body.dark-mode .toggle-buttons button:hover:not(.active) {
    background-color: #334155;
    color: #e2e8f0;
}

/* ============ BOOK CARDS GRID ============ */
.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 25px;
}

.book-card {
    background-color: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid #e5e7eb;
    position: relative;
}

body.dark-mode .book-card {
    background-color: #1e293b;
    border: 1px solid #334155;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

body.dark-mode .book-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
}

.book-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 1px solid #e5e7eb;
    transition: border-color 0.3s ease;
}

body.dark-mode .book-image {
    border-bottom: 1px solid #334155;
    filter: brightness(0.9);
}

.book-content {
    padding: 16px;
}

.book-title {
    font-weight: 600;
    font-size: 1rem;
    color: #111827;
    transition: color 0.3s ease;
    margin-bottom: 8px;
}

body.dark-mode .book-title {
    color: #f8fafc;
}

.book-author {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 4px 0;
    transition: color 0.3s ease;
}

body.dark-mode .book-author {
    color: #cbd5e1;
}

.book-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin: 8px 0;
}

.book-tag {
    background-color: #f3f4f6;
    border-radius: 12px;
    padding: 4px 8px;
    font-size: 0.8rem;
    color: #374151;
    transition: all 0.3s ease;
}

body.dark-mode .book-tag {
    background-color: #334155;
    color: #e2e8f0;
}

.book-footer {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #e5e7eb;
    transition: border-color 0.3s ease;
}

body.dark-mode .book-footer {
    border-top: 1px solid #334155;
}

.book-footer p {
    font-size: 0.9rem;
    color: #6b7280;
    transition: color 0.3s ease;
}

body.dark-mode .book-footer p {
    color: #94a3b8;
}

.borrow-btn {
    background-color: #111827;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

body.dark-mode .borrow-btn {
    background-color: #f8fafc;
    color: #111827;
}

.borrow-btn:hover {
    background-color: #2563eb;
    color: white;
    transform: translateY(-1px);
}

body.dark-mode .borrow-btn:hover {
    background-color: #3b82f6;
    color: white;
}

.borrowed {
    background-color: #10b981;
    color: white;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 0.8rem;
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 1;
}

body.dark-mode .borrowed {
    background-color: #059669;
}

/* ============ DARK MODE TOGGLE BUTTON ============ */
.dark-mode-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #111827;
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

body.dark-mode .dark-mode-toggle {
    background: #f8fafc;
    color: #111827;
}

.dark-mode-toggle:hover {
    transform: scale(1.1);
}

/* ============ LOADING STATES ============ */
.book-card.loading {
    opacity: 0.7;
    pointer-events: none;
}

body.dark-mode .book-card.loading {
    opacity: 0.5;
}

/* ============ EMPTY STATE ============ */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6b7280;
}

body.dark-mode .empty-state {
    color: #94a3b8;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #374151;
}

body.dark-mode .empty-state h3 {
    color: #e2e8f0;
}

/* ============ RESPONSIVE DESIGN ============ */
@media (max-width: 768px) {
    .stats-cards { 
        flex-direction: column; 
    }
    
    .book-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .dark-mode-toggle {
        top: 10px;
        right: 10px;
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .book-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .category-list {
        justify-content: center;
    }
    
    .toggle-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .dashboard-header h1 {
        font-size: 1.5rem;
    }
}

/* ============ SCROLLBAR STYLING ============ */
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

/* ============ FOCUS STATES ============ */
button:focus,
.category-item:focus,
.borrow-btn:focus {
    outline: 2px solid #2563eb;
    outline-offset: 2px;
}

body.dark-mode button:focus,
body.dark-mode .category-item:focus,
body.dark-mode .borrow-btn:focus {
    outline: 2px solid #60a5fa;
}
</style>