<?php
if (!isset($profitLossData)) {
    echo "No data available.";
    return;
}

echo "<h1>Profit and Loss Report</h1>";
echo "<table border='1'>";
echo "<tr><th>Item Name</th><th>Description</th><th>Unit</th><th>Total Cost</th><th>Total Revenue</th><th>Profit/Loss</th></tr>";
foreach ($profitLossData as $item) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($item['namaBarang']) . "</td>";
    echo "<td>" . htmlspecialchars($item['keterangan']) . "</td>";
    echo "<td>" . htmlspecialchars($item['satuan']) . "</td>";
    echo "<td>$" . number_format($item['totalCost'], 2) . "</td>";
    echo "<td>$" . number_format($item['totalRevenue'], 2) . "</td>";
    echo "<td>$" . number_format($item['profit'], 2) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
