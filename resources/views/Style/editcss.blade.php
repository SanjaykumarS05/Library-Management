<style>
/* === Headings === */
.h1 {
    text-align: center;
    color: #2c2c54;
    margin-top: 30px;
    transition: color 0.3s ease;
}

.p {
    text-align: center;
    color: #555;
    font-size: 15px;
    margin-bottom: 20px;
    transition: color 0.3s ease;
}

/* === Main Form Container === */
.form {
    background-color: #ffffff;
    max-width: 900px;
    margin: 0 auto 50px auto;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 30px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

/* === Labels and Inputs === */
label {
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 6px;
    transition: color 0.3s ease;
}

input[type="text"],
input[type="number"],
input[type="file"],
input[type="email"],
select,
textarea {
    width: 100%;
    padding: 10px 12px;
    font-size: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fafafa;
    transition: all 0.3s ease;
    resize: vertical;
    color: #111;
}

input:focus,
select:focus,
textarea:focus,
input[type="file"]:focus {
    border-color: #6a5acd;
    box-shadow: 0 0 5px rgba(106, 90, 205, 0.3);
    outline: none;
}

/* === Textarea Min Height === */
textarea{
    min-height: 100px;
}

/* === Submit Button === */
.button1[type="submit"] {
    grid-column: span 2;
    background-color: #6a5acd;
    color: white;
    font-size: 16px;
    font-weight: 600;
    padding: 12px 0;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.button1[type="submit"]:hover {
    background-color: #5747a3;
}

/* === Responsive === */
@media (max-width: 768px) {
    .form {
        grid-template-columns: 1fr;
        padding: 25px;
    }
}

/* === DARK THEME OVERRIDES === */
body.dark-mode .h1,
body.dark-mode .p,
body.dark-mode label {
    color: #ddd;
}

body.dark-mode .form {
    background-color: #2a2a3d;
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
}

body.dark-mode input,
body.dark-mode select,
body.dark-mode textarea {
    background-color: #3a3a50;
    color: #eee;
    border-color: #555;
}

body.dark-mode input:focus,
body.dark-mode select:focus,
body.dark-mode textarea:focus {
    border-color: #6a5acd;
    box-shadow: 0 0 6px rgba(106,90,205,0.6);
}

body.dark-mode .button1[type="submit"] {
    background-color: #6a5acd;
    color: #fff;
}

body.dark-mode .button1[type="submit"]:hover {
    background-color: #5747a3;
}

</style>