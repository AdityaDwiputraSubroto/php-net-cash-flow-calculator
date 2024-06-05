<!DOCTYPE html>
<html>

<head>
    <title>Perhitungan Keuangan Lapangan Minyak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="number"],
        input[type="text"] {
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
        }

        .dynamic-inputs {
            margin-top: 10px;
        }

        .dynamic-inputs div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .dynamic-inputs div span {
            margin-right: 10px;
        }

        .dynamic-inputs input[type="number"] {
            flex: 1;
        }

        .dynamic-inputs button {
            margin-left: 5px;
            padding: 10px;
            background: red;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .add-button {
            padding: 10px;
            background: green;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"] {
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Masukkan Data Perhitungan</h1>
        <form action="result.php" method="post">
            <label for="capital">Capital ($M):</label>
            <input type="number" id="capital" name="capital" required>

            <label for="non_capital">Non-Capital ($M):</label>
            <input type="number" id="non_capital" name="non_capital" required>

            <label for="opex">Biaya Operasi per Tahun ($M):</label>
            <input type="number" id="opex" name="opex" required>

            <label for="oil_price">Harga Minyak ($/BBL):</label>
            <input type="number" id="oil_price" name="oil_price" required>

            <label for="tax_rate">Pajak (%):</label>
            <input type="number" id="tax_rate" name="tax_rate" required>

            <label for="production">Produksi per Tahun (MBBL):</label>
            <div class="dynamic-inputs">
                <div>
                    <span>Tahun 1:</span>
                    <input type="number" name="production[]" required>
                    <button type="button" onclick="removeRow(this)">Delete</button>
                </div>
            </div>
            <button type="button" class="add-button" onclick="addRow()">Tambah Produksi</button>

            <input type="submit" value="Hitung">
        </form>
    </div>

    <script>
        let yearCounter = 2;

        function addRow() {
            const div = document.createElement('div');
            div.innerHTML = '<span>Tahun ' + yearCounter + ':</span><input type="number" name="production[]" required><button type="button" onclick="removeRow(this)">Delete</button>';
            document.querySelector('.dynamic-inputs').appendChild(div);
            yearCounter++;
        }

        function removeRow(button) {
            button.parentElement.remove();
            yearCounter--;
            updateYearLabels();
        }

        function updateYearLabels() {
            const spans = document.querySelectorAll('.dynamic-inputs div span');
            spans.forEach((span, index) => {
                span.innerText = 'Tahun ' + (index + 1) + ':';
            });
        }
    </script>
</body>

</html>