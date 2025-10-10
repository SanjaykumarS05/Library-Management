<style>
    /* === Container === */


/* === Page Title === */
.container.book-search h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #2e3a59;
}
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
    transition: 0.3s ease;
}

.search-form input[type="text"]:focus,
.search-form select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
}

.search-form button {
    padding: 8px 18px;
    border: none;
    border-radius: 6px;
    background-color: #007bff;
    color: white;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s ease;
}

.search-form button:hover {
    background-color: #0056b3;
    transform: translateY(-1px);
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
}

.book-card p {
    font-size: 14px;
    margin: 4px 0;
}

/* === Availability Status === */
.available {
    color: #28a745;
    font-weight: bold;
}

.unavailable {
    color: #dc3545;
    font-weight: bold;
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
    transition: 0.3s ease;
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

</style>