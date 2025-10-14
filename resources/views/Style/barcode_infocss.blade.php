<style>
/* ============================================
   GLOBAL LAYOUT (Light Theme)
============================================ */
body {
    font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e0e7ff, #f3e8ff);
    margin: 0;
    padding: 40px 10px;
    color: #333;
    transition: background 0.3s, color 0.3s;
}

/* ============================================
   HEADER & TITLE
============================================ */
.h1 {
    text-align: center;
    color: #2c2c54;
    font-size: 30px;
    margin-bottom: 10px;
    transition: color 0.3s;
}

.h3 {
    text-align: center;
    color: #4c51bf;
    font-weight: 600;
    margin-bottom: 25px;
    transition: color 0.3s;
}

/* ============================================
   CONTAINER / CARD STYLE
============================================ */
.container {
    background-color: #ffffff;
    max-width: 950px;
    margin: 30px auto 60px auto;
    padding: 35px 50px;
    border-radius: 15px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.container:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.15);
}

/* ============================================
   GRID FORM LAYOUT
============================================ */
.book-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 30px;
    margin-bottom: 25px;
}

/* ============================================
   LABELS & INPUTS
============================================ */
label {
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 6px;
    transition: color 0.3s;
}

input[type="text"],
input[type="date"],
select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fafafa;
    font-size: 15px;
    transition: all 0.2s ease;
}

input:focus,
select:focus {
    border-color: #6a5acd;
    box-shadow: 0 0 6px rgba(106, 90, 205, 0.3);
    background-color: #fff;
    outline: none;
}

/* ============================================
   BARCODE CARD
============================================ */
.barcode-card {
    grid-column: span 2;
    text-align: center;
    background: linear-gradient(145deg, #f3f4f6, #e5e7eb);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    margin-bottom: 10px;
    transition: background-color 0.3s, box-shadow 0.3s;
}

.barcode-card h4 {
    font-size: 22px;
    color: #2c2c54;
    margin-bottom: 10px;
    transition: color 0.3s;
}

.barcode1 {
    display: inline-block;
    background: #fff;
    border: 1px dashed #6a5acd;
    padding: 12px 18px;
    border-radius: 8px;
    margin-top: 10px;
}

/* ============================================
   BUTTONS
============================================ */
.buttons {
    grid-column: span 2;
    display: inline-block;
    background-color: #6a5acd;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    padding: 12px 35px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: 0.3s ease;
    text-align: center;
}

.buttons:hover {
    background-color: #5747a3;
    transform: translateY(-1px);
}

/* Specific color variations */
.buttons[style*="#4CAF50"] { background-color: #22c55e; }
.buttons[style*="#f44336"] { background-color: #ef4444; }
.buttons[style*="#2196F3"] { background-color: #3b82f6; }

/* ============================================
   FORM AREA
============================================ */
form {
    grid-column: span 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 30px;
    margin-top: 25px;
}

form label {
    grid-column: span 2;
}

/* ============================================
   STATUS FIELD
============================================ */
#status {
    font-weight: 600;
    text-transform: uppercase;
    color: #111;
}

/* ============================================
   RESPONSIVE DESIGN
============================================ */
@media (max-width: 768px) {
    .container { padding: 25px; }
    .book-info-grid,
    form { grid-template-columns: 1fr; gap: 15px; }
    .buttons { width: 100%; }
}

/* ============================================
   DARK THEME OVERRIDES
============================================ */
body.dark-mode {
    background: linear-gradient(135deg, #181824, #2a253a);
    color: #ddd;
}

body.dark-mode h1 { color: #fff; }
body.dark-mode h3 { color: #b0b0ff; }

body.dark-mode .container {
    background-color: #2a2a3d;
    box-shadow: 0 4px 18px rgba(0,0,0,0.5);
}

body.dark-mode label { color: #ddd; }

body.dark-mode input[type="text"],
body.dark-mode input[type="date"],
body.dark-mode select {
    background-color: #3a3a50;
    border: 1px solid #555;
    color: #eee;
}

body.dark-mode input:focus,
body.dark-mode select:focus {
    background-color: #42425c;
}

body.dark-mode .barcode-card {
    background: linear-gradient(145deg, #3a3a50, #2e2e40);
}

body.dark-mode .barcode-card h4 { color: #fff; }

body.dark-mode .barcode1 {
    background-color: #42425c;
    border-color: #6a5acd;
}

body.dark-mode .buttons { background-color: #6a5acd; }
body.dark-mode .buttons:hover { background-color: #5747a3; }

</style>
