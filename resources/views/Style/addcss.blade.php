<style>
    /* === Global Styles for Add Book Form === */
.form1 {
    max-width: 600px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.form h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form div {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.form label {
    font-weight: 600;
    margin-bottom: 5px;
    color: #555;
}

.form input[type="text"],
.form input[type="number"],
.form input[type="file"],
.form select {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.3s;
}

.form input[type="text"]:focus,
.form input[type="number"]:focus,
.form input[type="file"]:focus,
.form select:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.4);
}




input[type="file"] {
    padding: 3px;
}

@media screen and (max-width: 640px) {
    form {
        padding: 20px;
        margin: 10px;
    }
}
input:required, select:required {
    border-left: 4px solid #ff9800;
}
input[type="text"]:hover,
input[type="number"]:hover,
select:hover {
    border-color: #81c784;
}


</style>