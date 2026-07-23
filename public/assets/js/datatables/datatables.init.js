/*
Template Name: StarCode & Dashboard Template
Author: StarCode Kh
Version: 1.1.0
Website: https://StarCode Kh.in/
Contact: StarCode Kh@gmail.com
File: Main Js File
*/

//basic example
if (document.querySelector("#basic_tables")) {
    new DataTable("#basic_tables");
}

//row Borders example
if (document.querySelector("#rowBorder")) {
    new DataTable("#rowBorder");
}

//Hoverable example
if (document.querySelector("#hoverableTable")) {
    new DataTable("#hoverableTable");
}

//Hoverable example
if (document.querySelector("#borderedTable")) {
    new DataTable("#borderedTable");
}

//Alternative pagination
if (document.querySelector("#alternativePagination")) {
    new DataTable("#alternativePagination", {
        pagingType: "full_numbers",
    });
}

//Hidden columns
if (document.querySelector("#hiddenColumns")) {
    new DataTable("#hiddenColumns", {
        columnDefs: [
            {
                target: 2,
                visible: false,
                searchable: false,
            },
            {
                target: 3,
                visible: false,
            },
        ],
    });
}

//add rows
let table;
let counter = 1;

function addNewRow() {
    if (table) {
        table.row
            .add([
                counter + ".1",
                counter + ".2",
                counter + ".3",
                counter + ".4",
                counter + ".5",
            ])
            .draw(false);
        counter++;
    }
}

if (document.querySelector("#example")) {
    table = new DataTable("#example");
    const addRowBtn = document.querySelector("#addRow");
    if (addRowBtn) {
        addRowBtn.addEventListener("click", addNewRow);
        addNewRow();
    }
}

//Show / hide columns dynamically
if (document.querySelector("#tableDynamically")) {
    const tableDynamically = new DataTable("#tableDynamically", {
        pageLength: 5,
    });

    document.querySelectorAll("button.toggle-vis").forEach((el) => {
        el.addEventListener("click", function (e) {
            e.preventDefault();

            let columnIdx = e.target.getAttribute("data-column");
            let column = tableDynamically.column(columnIdx);

            // Toggle the visibility
            column.visible(!column.visible());
        });
    });
}

//Row selection and deletion (single row)
if (document.querySelector("#rowSelectionDeletion")) {
    const rowSelectionDeletion = new DataTable("#rowSelectionDeletion");

    rowSelectionDeletion.on("click", "tbody tr", (e) => {
        let classList = e.currentTarget.classList;

        if (classList.contains("selected")) {
            classList.remove("selected");
        } else {
            rowSelectionDeletion
                .rows(".selected")
                .nodes()
                .each((row) => row.classList.remove("selected"));
            classList.add("selected");
        }
    });

    const deleteButton = document.querySelector("#deleteButton");
    if (deleteButton) {
        deleteButton.addEventListener("click", function () {
            rowSelectionDeletion.row(".selected").remove().draw(false);
        });
    }
}

//Custom filtering - range search
const minEl = document.querySelector("#min");
const maxEl = document.querySelector("#max");

if (minEl && maxEl && document.querySelector("#customFiltering")) {
    // Custom range filtering function
    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = parseInt(minEl.value, 10);
        let max = parseInt(maxEl.value, 10);
        let age = parseFloat(data[3]) || 0; // use data for the age column

        if (
            (isNaN(min) && isNaN(max)) ||
            (isNaN(min) && age <= max) ||
            (min <= age && isNaN(max)) ||
            (min <= age && age <= max)
        ) {
            return true;
        }

        return false;
    });

    const customFiltering = new DataTable("#customFiltering");

    // Changes to the inputs will trigger a redraw to update the table
    minEl.addEventListener("input", function () {
        customFiltering.draw();
    });
    maxEl.addEventListener("input", function () {
        customFiltering.draw();
    });
}
