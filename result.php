<?php
function straight_line_depreciation($capital, $years)
{
    return $capital / $years;
}

function declining_balance_depreciation($capital, $rate, $year)
{
    return $capital * $rate * pow((1 - $rate), $year - 1);
}

function double_declining_balance_depreciation($capital, $rate, $year)
{
    return $capital * 2 * $rate * pow((1 - 2 * $rate), $year - 1);
}

$capital = $_POST['capital'];
$non_capital = $_POST['non_capital'];
$opex = $_POST['opex'];
$oil_price = $_POST['oil_price'];
$tax_rate = $_POST['tax_rate'] / 100;
$production = $_POST['production'];

$years = count($production);
$depreciation_rate = 1 / $years;

echo "<div style='width: 80%; margin: auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 50px;'>";
echo "<h1 style='text-align: center;'>Hasil Perhitungan</h1>";

echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse;'>";
echo "<tr>
        <th>Tahun</th>
        <th>Produksi (MBBL)</th>
        <th>Investasi (Capital) (\$M)</th>
        <th>Investasi (Non-Capital) (\$M)</th>
        <th>OPEX (\$M)</th>
        <th>Di (\$M)</th>
        <th>Taxable Income (\$M)</th>
        <th>Tax (\$M)</th>
        <th>NCF Undiscounted (\$M)</th>
      </tr>";

$total_ncf = - ($capital + $non_capital);
echo "<tr>
        <td>0</td>
        <td></td>
        <td>" . htmlspecialchars($capital) . "</td>
        <td>" . htmlspecialchars($non_capital) . "</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>" . htmlspecialchars($total_ncf) . "</td>
      </tr>";

for ($i = 0; $i < $years; $i++) {
    $income = $production[$i] * $oil_price;
    $depreciation = declining_balance_depreciation($capital, $depreciation_rate, $i + 1);
    $taxable_income = $income - $depreciation - $opex;
    $tax = $taxable_income * $tax_rate;
    $ncf = $income - $opex - $tax;
    $total_ncf += $ncf;
    echo "<tr>
            <td>" . ($i + 1) . "</td>
            <td>" . htmlspecialchars($production[$i]) . "</td>
            <td>"  . "</td>
            <td>"  . "</td>
            <td>" . htmlspecialchars($opex) . "</td>
            <td>" . htmlspecialchars($depreciation) . "</td>
            <td>" . htmlspecialchars($taxable_income) . "</td>
            <td>" . htmlspecialchars($tax) . "</td>
            <td>" . htmlspecialchars($ncf) . "</td>
          </tr>";
}

echo "</table>";
echo "<br><p>Total Net Cash Flow (tanpa diskon): " . htmlspecialchars($total_ncf) . "M</p>";
echo "</div>";
