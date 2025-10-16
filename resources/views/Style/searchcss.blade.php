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

</style>