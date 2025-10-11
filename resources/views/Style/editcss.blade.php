<style>


/* === Headings === */
.h1 {
    text-align: center;
    color: #2c2c54;
    margin-top: 30px;
}

.p {
    text-align: center;
    color: #555;
    font-size: 15px;
    margin-bottom: 20px;
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
}

/* === Labels and Inputs === */
label {
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 6px;
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
    transition: 0.2s ease-in-out;
    background-color: #fafafa;
    resize: vertical;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
select:focus,
input[type="file"]:focus,
textarea:focus {
    border-color: #6a5acd;
    box-shadow: 0 0 5px rgba(106, 90, 205, 0.3);
    outline: none;
}

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
    transition: 0.3s ease;
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
</style>
