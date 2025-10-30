<style>
/* ============================================
   BARCODE GRID & CARDS (Light Theme)
============================================ */
.barcode {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.barcode-card {
    background-color: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.3s, background-color 0.3s, color 0.3s;
}

.barcode-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.barcode-card .barcode {
    margin-top: 10px;
}

.buttons {
    margin-bottom: 20px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 6px;
    border: none;
    background-color: #4CAF50;
    color: white;
    transition: 0.3s;
}

.buttons:hover {
    background-color: #45a049;
}

.barcode-scanner {
    margin-bottom: 20px;
    border: 2px solid #4CAF50;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.count {
    color: red;
    font-size: 27px;
    font-weight: bold;
    position: relative;
    top: 3px;
}

/* ============================================
   PRINT STYLES
============================================ */
@media print {
    .no-print { display: none; }
    .barcode-card { page-break-inside: avoid; width: 100%; }
}

/* ============================================
   DARK THEME OVERRIDES
============================================ */
body.dark-mode .barcode-card {
    background-color: #2a2a3d;
    border-color: #555;
    color: #ddd;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
}

body.dark-mode .barcode-card .barcode {
    background-color: #3a3a50;
}

body.dark-mode .buttons {
    background-color: #22c55e; /* green */
    color: #fff;
}

body.dark-mode .buttons:hover {
    background-color: #16a34a;
}

body.dark-mode .barcode-scanner {
    border-color: #22c55e;
    background-color: #3a3a50;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
}

body.dark-mode .count {
    color: #ff6b6b;
}
p{
    margin:-1;
}

</style>