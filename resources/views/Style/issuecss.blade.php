<style>

.container.issue-return {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.h2 {
    text-align: center;
    color: #2e3a59;
    margin-bottom: 20px;
    transition: color 0.3s ease;
}

.h3 {
    color: #007bff;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
    transition: color 0.3s ease, border-color 0.3s ease;
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
    transition: color 0.3s ease;
}

select, input[type="date"] {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #fafafa;
    color: #111;
}

select:focus, input[type="date"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
    outline: none;
}

/* === Section Separation === */
hr {
    margin: 25px 0;
    border: 0;
    border-top: 1px solid #ddd;
    transition: border-color 0.3s ease;
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
    transition: background-color 0.3s ease;
}

/* === DARK THEME OVERRIDES === */
body.dark-mode .container.issue-return {
    background-color: #2a2a3d;
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
}

body.dark-mode .h2 {
    color: #ddd;
}

body.dark-mode .h3 {
    color: #82aaff;
    border-color: #555;
}

body.dark-mode label {
    color: #ccc;
}

body.dark-mode select,
body.dark-mode input[type="date"] {
    background-color: #3a3a50;
    color: #eee;
    border-color: #555;
}

body.dark-mode select:focus,
body.dark-mode input[type="date"]:focus {
    border-color: #82aaff;
    box-shadow: 0 0 6px rgba(130,170,255,0.5);
}

body.dark-mode hr {
    border-top-color: #555;
}

body.dark-mode select option[selected] {
    background-color: #465478;
}

</style>