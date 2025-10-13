<style>


.h2 {
    text-align: center;
    color: #2e3a59;
    margin-bottom: 20px;
}

.h3 {
    text-align: center;
    color: #444;
}

/* === Buttons === */
.buttons {
    display: inline-block;
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 18px;
    margin: 10px 5px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease;
}

.buttons:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

.barcode {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

/* === Barcode Card === */
.barcode-card {
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
}

.barcode-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.barcode-card h4 {
    color: #007bff;
    font-size: 18px;
    margin-bottom: 8px;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
}

.barcode-card p {
    font-size: 14px;
    margin: 4px 0;
    color: #555;
}


.count {
    background: #28a745;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
}

/* === Print Styles === */
@media print {
    body {
        background: white;
        color: black;
    }

    .buttons {
        display: none !important;
    }

    .barcode {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .no-print {
        display: none !important;
    }
    .barcode-card {
        page-break-inside: avoid;
        border: 1px solid #aaa;
        box-shadow: none;
        margin-bottom: 10px;
    }
}

.barcode-card.highlight {
    border-color: #4CAF50 !important;
    box-shadow: 0 0 15px rgba(76, 175, 80, 0.5) !important;
}

center {
    text-align: center;
}
</style>
