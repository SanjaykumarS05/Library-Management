<style>
    .dashboard-container {
    padding: 2rem;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f9f9f9;
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
.sub{
    color: #95a5a6;
    font-size: 0.9rem;
}
</style>