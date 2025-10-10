<style>

.container.issue-return {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.h2 {
    text-align: center;
    color: #2e3a59;
    margin-bottom: 20px;
}

.h3 {
    color: #007bff;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
}

/* === Forms === */
form div {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
}

select, input[type="date"] {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
}

select:focus, input[type="date"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
    outline: none;
}

/* === Buttons === */
button[type="submit"] {
    display: inline-block;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

/* === Section Separation === */
hr {
    margin: 25px 0;
    border: 0;
    border-top: 1px solid #ddd;
}

/* === Responsive Design === */
@media screen and (max-width: 640px) {
    .container.issue-return {
        padding: 15px;
    }

    button[type="submit"] {
        width: 100%;
    }
}

/* === Optional: Highlight selected book === */
select option[selected] {
    background-color: #e0f0ff;
}

</style>