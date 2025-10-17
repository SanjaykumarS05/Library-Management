<style>
/* ============ GENERAL ============ */
body {
    background-color: #f8fafc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #1f2937;
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
}

.dashboard-header p {
    font-size: 1rem;
    color: #6b7280;
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
}

.stat-card:hover {
    transform: translateY(-3px);
}

.stat-card h2 {
    font-size: 1.8rem;
    margin: 10px 0;
    color: #111827;
}

.stat-card p {
    color: #6b7280;
    font-size: 1rem;
}

.stat-icon {
    font-size: 1.6rem;
    display: block;
    color: #2563eb;
}

/* ============ CATEGORY FILTER ============ */
.category-section {
    margin-bottom: 40px;
}

.category-section h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.category-section p {
    color: #6b7280;
    margin-bottom: 15px;
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
    transition: background 0.2s;
}

.category-item:hover {
    background-color: #2563eb;
    color: #fff;
}

.toggle-buttons {
    display: flex;
    gap: 15px;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.toggle-buttons button {
    background: none;
    border: none;
    font-weight: 600;
    cursor: pointer;
    color: #6b7280;
    transition: color 0.2s, border-bottom 0.2s;
}

.toggle-buttons button.active {
    color: #2563eb;
    border-bottom: 2px solid #2563eb;
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
    transition: transform 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.book-card:hover {
    transform: translateY(-5px);
}

.book-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 1px solid #e5e7eb;
}

.book-content {
    padding: 16px;
}

.book-title {
    font-weight: 600;
    font-size: 1rem;
    color: #111827;
}

.book-author {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 4px 0;
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
}

.book-footer {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.book-footer p {
    font-size: 0.9rem;
    color: #6b7280;
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

.borrowed {
    background-color: #10b981;
    color: white;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 0.8rem;
    position: absolute;
    top: 12px;
    right: 12px;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-cards { flex-direction: column; }
}
</style>