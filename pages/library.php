<?php
// Database connection (Update with your credentials)

$pdo = new PDO("mysql:host=localhost;dbname=hrsystem", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch options from the database
$stmt = $pdo->query("SELECT id, fruit FROM fruits");
$options = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select to Store Array</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        select { width: 100%; font-size: 16px; padding: 8px; margin-top: 10px; }
        .selected-items { display: flex; flex-wrap: wrap; margin-top: 10px; gap: 5px; }
        .item { display: flex; align-items: center; background-color: #f0f0f0; padding: 5px 10px; border-radius: 5px; }
        .remove-btn { margin-left: 8px; cursor: pointer; color: red; font-weight: bold; }
        button { margin-top: 15px; padding: 8px 12px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Select and Store Items</h2>

    <!-- Dropdown populated from PHP -->
    <form method="POST" action="save_selection.php">
        <select name="selected_option" id="selectInput" onchange="addItem(this)">
            <option value="" disabled selected>Select an option</option>
            <?php foreach ($options as $option): ?>
                <option value="<?= $option['id'] ?>"><?= htmlspecialchars($option['fruit']) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="selected-items" id="selectedItems"></div>

        <!-- Hidden input to store selected values as JSON -->
        <input type="hidden" name="selected_values" id="selectedValues">

        <button type="submit">Save Selection</button>
    </form>

    <h3>Stored Values (JSON):</h3>
    <pre id="valueArrayOutput">[]</pre>

    <script>
        let selectedValuesArray = [];
        let select = document.getElementById("selectInput");
        let selectedItemsContainer = document.getElementById("selectedItems");
        let valueArrayOutput = document.getElementById("valueArrayOutput");
        let hiddenInput = document.getElementById("selectedValues");

        function addItem(selectElement) {
            if (selectElement.value) {
                let selectedOption = selectElement.options[selectElement.selectedIndex];
                let text = selectedOption.text;
                let value = selectedOption.value;

                addSelectedItem(text, value);
                selectedValuesArray.push(value);
                updateArrayOutput();

                selectElement.remove(selectElement.selectedIndex); // Remove from dropdown
                selectElement.selectedIndex = 0;
            }
        }

        function addSelectedItem(text, value) {
            let item = document.createElement("div");
            item.classList.add("item");
            item.innerHTML = `${text} <span class="remove-btn" onclick="removeItem(this, '${text}', '${value}')">❌</span>`;
            selectedItemsContainer.appendChild(item);
        }

        function removeItem(element, text, value) {
            element.parentElement.remove();
            selectedValuesArray = selectedValuesArray.filter(item => item !== value);
            updateArrayOutput();

            // Restore option back to select
            let option = document.createElement("option");
            option.value = value;
            option.textContent = text;
            select.appendChild(option);
        }

        function updateArrayOutput() {
            valueArrayOutput.textContent = JSON.stringify(selectedValuesArray, null, 2);
            hiddenInput.value = JSON.stringify(selectedValuesArray); // Store in hidden input for PHP
        }
    </script>

</body>
</html>
