<style>
    .book-search {
    max-width: 900px;
    margin: auto;
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
}

.search-form .form-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.search-form input,
.search-form select,
.search-form button {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

.search-form button {
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background 0.3s ease;
}

.search-form button:hover {
    background-color: #0056b3;
}

.book-results {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.book-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.book-card h4 {
    margin-top: 0;
    color: #333;
}

.status-available {
    color: green;
    font-weight: bold;
}

.status-unavailable {
    color: red;
    font-weight: bold;
}

.issue-btn {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.issue-btn:hover {
    background-color: #218838;
}
</style>