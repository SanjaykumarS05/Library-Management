<style>
/* =========================
   Root Variables
========================= */
:root {
    --bg-color: #f5f6fa;
    --main-bg: #fff;
    --main-text: #333;
    --header-bg: #4a76a8;
    --button-bg: #3498db;
    --button-hover: #2980b9;
    --input-border: #ccc;
    --input-focus: #3498db;
    --card-shadow: rgba(0, 0, 0, 0.05);
}

/* Dark Mode */
body.dark-mode {
    --bg-color:#5747a3;
    --main-bg: #5747a3;
    --main-text: #eee;
    --header-bg: red;
    --button-bg: #6a5acd;
    --button-hover: #5747a3;
    --input-border: #555;
    --input-focus: #6a5acd;
    --card-shadow: #5747a3;
}

/* =========================
   Global Styles
========================= */
body {
    background-color: var(--bg-color);
    color: var(--main-text);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container.issue-return {
    max-width: 900px;
    margin: 80px auto 40px auto;
    padding: 20px;
    background-color: var(--main-bg);
    border-radius: 12px;
    box-shadow: 0 4px 12px var(--card-shadow);
}

.h2 ,.h3 {
    margin-bottom: 20px;
    font-weight: 600;
}

.h2 {
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.h3 {
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 30px;
}

/* =========================
   Form Styles
========================= */
form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

form div {
    flex: 1 1 200px;
    display: flex;
    flex-direction: column;
}

label {
    font-weight: 600;
    margin-bottom: 6px;
}

select, input[type="text"], input[type="date"] {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid var(--input-border);
    outline: none;
    transition: all 0.3s ease;
    font-size: 14px;
    background-color: var(--main-bg);
    color: var(--main-text);
}

select:focus, input[type="text"]:focus, input[type="date"]:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 6px rgba(52, 152, 219, 0.3);
}

/* =========================
   Buttons
========================= */
.button1 {
    background-color: var(--button-bg);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
}

button:hover, .button1:hover {
    background-color: var(--button-hover);
    transform: translateY(-2px);
}

/* =========================
   Section Styles
========================= */
.issue-book, .return-book {
    padding: 20px;
    background-color: var(--bg-color);
    border-radius: 10px;
    box-shadow: 0 4px 10px var(--card-shadow);
    margin-bottom: 30px;
}

hr {
    border: none;
    border-top: 1px solid var(--input-border);
    margin: 30px 0;
}

/* =========================
   Responsive
========================= */
@media (max-width: 768px) {
    .container.issue-return {
        padding: 15px;
        margin: 60px 15px;
    }

    form {
        flex-direction: column;
    }

    select, input[type="text"], input[type="date"] {
        width: 100%;
    }

    button, .button1 {
        width: 100%;
        text-align: center;
    }
}


</style>