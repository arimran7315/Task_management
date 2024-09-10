$(document).ready(function () {
    $("#search").on("keyup", function (e) {
        var search = $("#search").val();
        var role = $("#role").val();
       if(search == null || search == ""){
        loadData();
       }else{
        $.ajax({
            method: "POST",
            url: "api/search",
            data: { search: search },
        }).done(function (msg) {
            var tasks = msg.data; // Ensure this is an array
            // Ensure 'tasks' is an array
            if (!Array.isArray(tasks)) {
                tasks = [tasks]; // Convert single object to array
            }
            if (tasks.length != 0) {
                // Create table structure
                var tableData = `<table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>`;

                // Iterate over tasks array
                tasks.forEach((task) => {
                    tableData += `<tr>
                <td>${task.title}</td>
                <td>${task.description}</td>
                <td>${
                    task.status == 0
                        ? "To Do"
                        : task.status == 1
                        ? "In Progress"
                        : "Completed"
                }</td>
                <td>`;

                if (role == "Admin") {
                    tableData += `<a href="/task-view/${task.id}"><i class="bi bi-eye text-success fs-4 mx-1"></i></a>
                    <a href="/task-update/${task.id}" ><i class="bi bi-pencil fs-4 mx-1 text-warning"></i> </a>`;
                }
                if (role == "User") {
                    tableData += `<a href="/task-view/${task.id}"> <i class="bi bi-eye text-success fs-4 mx-1"></i></a>`;
                }
                if (role == "Manager") {
                    tableData += `<a href="/task-view/${task.id}"> <i class="bi bi-eye text-success fs-4 mx-1"></i></a>
                    <a href="/task-update/${task.id}" ><i class="bi bi-pencil fs-4 mx-1 text-warning"></i> </a>`;
                }

                    tableData += `</td></tr>`;
                });

                tableData += `</tbody></table>`;

                // Update the container with the new table
                $("#taskContainer").html(tableData);
                console.log(tasks);
            }else{
                taskContainer.innerHTML = `<table class="table">
            <thead class="table-dark">
               <tr>
                <th>
                    Title
                </th>
                <th>
                    description
                </th>
                <th>
                Status
                </th>
                <th>
                    Actions
                </th>
               </tr>
            </thead>
            <tbody>
            <tr class="text-center">
            <td class="text-danger " colspan="4">
            No Task Added Yet
            </td>
            </tr>`;
            }
        });
       }
    });
});

const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});
// theme
document.querySelector(".theme-toggle").addEventListener("click", () => {
    toggleLocalStorage();
    toggleRootClass();
});
function toggleRootClass() {
    const current = document.documentElement.getAttribute("data-bs-theme");
    const inverted = current == "dark" ? "light" : "dark";
    document.documentElement.setAttribute("data-bs-theme", inverted);
}
function toggleLocalStorage() {
    if (isLight()) {
        localStorage.removeItem("light");
    } else {
        localStorage.setItem("light", "set");
    }
}
function isLight() {
    return localStorage.getItem("light");
}
if (isLight()) {
    toggleRootClass();
}
// all posts
function loadData() {
    var role = document.querySelector("#role").value;

    fetch("api/tasks", {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            // console.log(data.data);
            if (data.data.length != 0) {
                var alltasks = data.data;
                const taskContainer = document.querySelector("#taskContainer");
                var tableData = `<table class="table">
            <thead class="table-dark">
               <tr>
                <th>
                    Title
                </th>
                <th>
                    description
                </th>
                <th>
                Status
                </th>
                <th>
                    Actions
                </th>
               </tr>
            </thead>
            <tbody>`;
                alltasks.forEach((task) => {
                    tableData += `<tr>
                    <td>
                        ${task.title}
                    </td>
                    <td>
                        ${task.description}
                    </td>
                    <td>`;
                    if (task.status == 0) {
                        tableData += `To Do `;
                    }
                    if (task.status == 1) {
                        tableData += `In Progress`;
                    }
                    if (task.status == 2) {
                        tableData += `Completed`;
                    }
                    tableData += `
                    </td>
                    <td>
                    `;
                    if (role == "Admin") {
                        tableData += `<a href="/task-view/${task.id}"><i class="bi bi-eye text-success fs-4 mx-1"></i></a>
                        <a href="/task-update/${task.id}" ><i class="bi bi-pencil fs-4 mx-1 text-warning"></i> </a>`;
                    }
                    if (role == "User") {
                        tableData += `<a href="/task-view/${task.id}"> <i class="bi bi-eye text-success fs-4 mx-1"></i></a>`;
                    }
                    if (role == "Manager") {
                        tableData += `<a href="/task-view/${task.id}"> <i class="bi bi-eye text-success fs-4 mx-1"></i></a>
                        <a href="/task-update/${task.id}" ><i class="bi bi-pencil fs-4 mx-1 text-warning"></i> </a>`;
                    }
                    `</div></td>
                </tr>`;
                });
                tableData += `</tbody></table>`;
                taskContainer.innerHTML = tableData;
                console.log("If");
                console.log(data.data);
            } else {
                console.log("Else");
                taskContainer.innerHTML = `<table class="table">
            <thead class="table-dark">
               <tr>
                <th>
                    Title
                </th>
                <th>
                    description
                </th>
                <th>
                Status
                </th>
                <th>
                    Actions
                </th>
               </tr>
            </thead>
            <tbody>
            <tr class="text-center">
            <td class="text-danger " colspan="4">
            No Task Added Yet
            </td>
            </tr>`;
            }
        });
}
loadData();
