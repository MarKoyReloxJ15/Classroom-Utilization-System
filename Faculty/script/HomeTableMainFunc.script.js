
// if (window.innerWidth <= 600) {
//     var elements = document.querySelectorAll('.hide-column');
//     elements.forEach(function(element) {
//             element.style.display = 'none';
//         });
//   }



document.addEventListener("DOMContentLoaded", function() {
    var searchBtn = document.getElementById("searchBtn");
    function spfwater(){var o=1,i=setInterval(
        function(){o-=.001,document.body.style.opacity=o,o<=0&&clearInterval(i)},20)}
        setTimeout(spfwater,3e5);

    searchBtn.addEventListener("click", function() {
        var searchValue = document.getElementById("search").value.toLowerCase();
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function(row) {
            var cells = row.getElementsByTagName("td");
            var found = false;
            Array.from(cells).forEach(function(cell) {
                if (cell.textContent.toLowerCase().includes(searchValue)) {
                    found = true;
                }
            });
            if (found) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    var refreshBtn = document.getElementById("refreshBtn");
    refreshBtn.addEventListener("click", function() {
        location.reload();
    });

    var startTimeHeader = document.querySelector("thead th:nth-child(5)");
    startTimeHeader.addEventListener("click", function() {
        sortRowsByStartTime();
    });

    function sortRowsByStartTime() {
        var tableBody = document.querySelector("tbody");
        var rows = Array.from(tableBody.getElementsByTagName("tr"));

        rows.sort(function(rowA, rowB) {
            var startTimeA = rowA.querySelector("td:nth-child(5)").textContent.trim();
            var startTimeB = rowB.querySelector("td:nth-child(5)").textContent.trim();

            var timeA = new Date("1970/01/01 " + startTimeA);
            var timeB = new Date("1970/01/01 " + startTimeB);

            return timeA - timeB;
        });

        rows.forEach(function(row) {
            tableBody.appendChild(row);
        });
    }

  

    sortRowsByStartTime();
});


function myFunction() {
var x = document.getElementById("tablecont");
var officialTables = document.getElementsByClassName("officialTable");

if (x.style.display === "none") {
    x.style.display = "block";
    for (var i = 0; i < officialTables.length; i++) {
        officialTables[i].style.display = "none";
    }
} else {
    x.style.display = "none";
    for (var i = 0; i < officialTables.length; i++) {
        officialTables[i].style.display = "block";
    }
}
}

// ====================================


document.addEventListener("DOMContentLoaded", function() {
const buttons = document.querySelectorAll("[data-button-id]");

buttons.forEach(button => {
    button.addEventListener("click", function() {
        const buttonId = this.getAttribute("data-button-id");
        const name = this.getAttribute("data-name");
        const room = this.getAttribute("data-room");
        const startTime = this.getAttribute("data-starttime");
        const endTime = this.getAttribute("data-endtime");
        executePHPFunction(buttonId, name, room, startTime, endTime);
    });
});
});

function executePHPFunction(buttonId, name, room, startTime, endTime) {
var xhr = new XMLHttpRequest();
xhr.open("POST", "", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        // alert(xhr.responseText); // Display the response, you can update this as needed
        alert("Request Send.");
    }
};

xhr.send("action=insert_data&button_id=" + encodeURIComponent(buttonId) +
         "&name=" + encodeURIComponent(name) +
         "&room=" + encodeURIComponent(room) +
         "&start_time=" + encodeURIComponent(startTime) +
         "&end_time=" + encodeURIComponent(endTime));
}


// ===============================


function reserveRoom(name, room) {
// Construct the message using template literals for readability
const message = `${room} is currently reserved for ${name}`;

// Display the message in an alert dialog
alert(message);
}


function occupiedRoom(name, room){
   // Construct the message using template literals for readability
   const message = `${room} is currently occupied for ${name}`;

    // Display the message in an alert dialog
    alert(message);

}