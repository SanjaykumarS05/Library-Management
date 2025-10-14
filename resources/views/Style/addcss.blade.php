<style>
    /* === Base Styles (Light Theme) === */
body {
    background-color: #f5f5f5;
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: background-color 0.3s, color 0.3s;
}

/* === Headings & Paragraphs === */
.h1 {
    text-align: center;
    color: #2c2c54;
    margin-top: 30px;
    font-size: 28px;
}
.p {
    text-align: center;
    color: #555;
    font-size: 15px;
    margin-bottom: 20px;
}

/* === Main Form Card === */
.form {
    background-color: #ffffff;
    max-width: 900px;
    margin: 30px auto 60px auto;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 30px;
    transition: background-color 0.3s, box-shadow 0.3s;
}

/* === Labels === */
label {
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 6px;
}

/* === Inputs, Selects, Textareas === */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
input[type="file"],
select,
textarea {
    width: 100%;
    padding: 10px 12px;
    font-size: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fafafa;
    color: #333;
    transition: background-color 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s;
    resize: vertical;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #6a5acd;
    box-shadow: 0 0 6px rgba(106, 90, 205, 0.3);
    outline: none;
}

/* === Checkbox === */
input[type="checkbox"] {
    margin-top: 8px;
    accent-color: #6a5acd;
}

/* === File Upload Preview === */
img {
    border-radius: 8px;
    border: 1px solid #ddd;
    margin-top: 10px;
}

/* === Submit Button === */
.button1 {
    grid-column: span 2;
    display: block;
    margin: 20px auto 0 auto;
    background-color: #6a5acd;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    padding: 12px 40px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button1:hover,
[type="submit"]:hover {
    background-color: #5747a3;
}

/* === Responsive Design === */
@media (max-width: 768px) {
    .form {
        grid-template-columns: 1fr;
        padding: 25px;
    }
    .button1 {
        width: 100%;
    }
}

/* === Dark Theme Overrides === */
body.dark-mode {
    background-color: #1e1e2f;
    color: #ddd;
}

body.dark-mode .h1 {
    color: #fff;
}

body.dark-mode .p {
    color: #ccc;
}

body.dark-mode .form {
    background-color: #2a2a3d;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
}

body.dark-mode label {
    color: #ddd;
}

body.dark-mode input[type="text"],
body.dark-mode input[type="email"],
body.dark-mode input[type="password"],
body.dark-mode input[type="number"],
body.dark-mode input[type="file"],
body.dark-mode select,
body.dark-mode textarea {
    background-color: #3a3a4d;
    color: #fff;
    border: 1px solid #555;
}

body.dark-mode input:focus,
body.dark-mode select:focus,
body.dark-mode textarea:focus {
    border-color: #8c82ff;
    box-shadow: 0 0 6px rgba(140, 130, 255, 0.3);
}

body.dark-mode .button1 {
    background-color: #8c82ff;
}

body.dark-mode .button1:hover {
    background-color: #6a5acd;
}

body.dark-mode img {
    border: 1px solid #555;
}

</style>