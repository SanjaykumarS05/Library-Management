<style>
    /* === Base Styles (Light Theme) === */
.dashboard-container {
    padding: 2rem;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    transition: background-color 0.3s, color 0.3s;
}

.user-info h2 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.user-info p {
    margin: 0.2rem 0;
    color: #7f8c8d;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}

.stat-card {
    background-color: #ffffff;
    border-left: 5px solid #3498db;
    padding: 1rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
}

.stat-card:hover {
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transform: translateY(-2px) scale(1.02);
}

.stat-card h3 {
    margin-bottom: 0.5rem;
    color: #34495e;
}

.utilisation, .low-stock, .recent-activity {
    margin-top: 2rem;
    background-color: #ffffff;
    padding: 1rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: background-color 0.3s, box-shadow 0.3s;
}

.utilisation h3, .low-stock h3, .recent-activity h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.low-stock ul, .recent-activity ul {
    list-style: none;
    padding-left: 0;
}

.low-stock li, .recent-activity li {
    padding: 0.3rem 0;
    border-bottom: 1px solid #ecf0f1;
    color: #7f8c8d;
}

.sub {
    color: #95a5a6;
    font-size: 0.9rem;
}

/* === Dark Theme Overrides === */
body.dark-mode .dashboard-container {
    background-color: #1e1e2f;
    color: #ddd;
}

body.dark-mode .user-info h2 {
    color: #fff;
}

body.dark-mode .user-info p,
body.dark-mode .low-stock li,
body.dark-mode .recent-activity li,
body.dark-mode .sub {
    color: #bbb;
}

body.dark-mode .stat-card,
body.dark-mode .utilisation,
body.dark-mode .low-stock,
body.dark-mode .recent-activity {
    background-color: #2a2a3d;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
}

body.dark-mode .stat-card h3,
body.dark-mode .utilisation h3,
body.dark-mode .low-stock h3,
body.dark-mode .recent-activity h3 {
    color: #fff;
}

body.dark-mode .low-stock li,
body.dark-mode .recent-activity li {
    border-bottom: 1px solid #444;
}

</style>
