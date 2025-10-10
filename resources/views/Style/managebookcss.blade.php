<style>
    /* === Body & Container === */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f6f7fb;
    margin: 0;
    padding: 20px;
    color: #333;
}

h2 {
    text-align: center;
    font-size: 25px;
    margin-bottom: 20px;
}

/* === Add Book Link === */
a[href*="books.create"] {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 16px;
    background-color: #28a745;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.3s ease;
}

a[href*="books.create"]:hover {
    background-color: #218838;
    transform: translateY(-1px);
}

/* === Table Styles === */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

thead {
    background-color: #007bff;
    color: white;
}

thead th {
    padding: 12px 10px;
    text-align: left;
}

tbody td {
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* === Availability & Stock === */
td:nth-child(6) {
    font-weight: bold;
}

td:nth-child(6).Available {
    color: #28a745;
}

td:nth-child(6).Unavailable {
    color: #dc3545;
}

td:nth-child(7) {
    text-align: center;
    font-weight: bold;
}

/* === Cover Image === */
td img {
    max-width: 100px;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* === Action Buttons === */
td a,
td button {
    display: inline-block;
    margin: 2px 2px 2px 0;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
    text-decoration: none;
    transition: 0.3s ease;
}

td a {
    background-color: #17a2b8;
    color: white;
}

td a:hover {
    background-color: #117a8b;
    transform: translateY(-1px);
}

td button {
    background-color: #dc3545;
    color: white;
}

td button:hover {
    background-color: #c82333;
    transform: translateY(-1px);
}

/* === Responsive Table === */
@media screen and (max-width: 900px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead tr {
        display: none;
    }

    tbody tr {
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
    }

    tbody td {
        display: flex;
        justify-content: space-between;
        padding: 6px 10px;
        border: none;
        border-bottom: 1px dashed #ccc;
    }

    tbody td::before {
        content: attr(data-label);
        font-weight: bold;
    }

    td img {
        max-width: 80px;
    }
}
.addbook{
   display: inline-block;
    margin: 2px 2px 2px 0;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
    text-decoration: none;
    transition: 0.3s ease;
    background-color: #17a2b8;
    color: white;
    position: relative;
    left: 1030px;
    bottom:20px;
    scale:1.4;
}

.addbook:hover {
    background-color: #117a8b;
    transform: translateY(-1px);
}

</style>