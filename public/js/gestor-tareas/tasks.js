import { showSuccessMessage, showErrorMessage } from "./messages.js";

function loadTasks() {
    $.get("/get-all-tasks", function (data) {
        let rows = "";

        if (data.length === 0) {
            $("#task-list").html(`<tr id="no-tasks-message">
                <td colspan="3" class="text-muted">No hay tareas programadas.</td>
            </tr>`);
            return;
        }

        data.forEach(task => {
            rows += `<tr id="task-${task.id}">
                <td>${task.name}</td>
                <td>${task.categories.map(cat => cat.name).join(", ")}</td>
                <td><button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">X</button></td>
            </tr>`;
        });

        $("#task-list").html(rows);
    });
}

function addTask() {
    let taskName = $("#task-name").val().trim();
    let selectedCategories = $(".category-checkbox:checked").map(function () {
        return parseInt($(this).val(), 10);
    }).get();

    if (taskName.length < 5) {
        showErrorMessage("El nombre de la tarea debe tener al menos 5 caracteres.");
        return;
    }

    if (selectedCategories.length === 0) {
        showErrorMessage("Debes seleccionar al menos una categoría.");
        return;
    }

    $.post("/create-tasks", {
        name: taskName,
        categories: selectedCategories,
        _token: $("meta[name='csrf-token']").attr("content")
    })
        .done(function (response) {
            showSuccessMessage(response.message);
            loadTasks();
            $("#task-name").val("");
            $(".category-checkbox").prop("checked", false);
        })
        .fail(function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                let errorMessages = Object.values(xhr.responseJSON.errors).flat().join("<br>");
                showErrorMessage(errorMessages);
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                showErrorMessage(xhr.responseJSON.message);
            }
        });
}

function deleteTask(taskId) {
    if (!confirm("¿Estás seguro de que quieres eliminar esta tarea?")) {
        return;
    }

    $.ajax({
        url: `/tasks/${taskId}`,
        type: "DELETE",
        data: { _token: $("meta[name='csrf-token']").attr("content") }
    })
        .done(function (response) {
            showSuccessMessage(response.message);
            $(`#task-${taskId}`).remove();

            if ($("#task-list tr").length === 0) {
                $("#task-list").html(`<tr id="no-tasks-message">
                <td colspan="3" class="text-muted">No hay tareas programadas aún</td>
            </tr>`);
            }
        })
        .fail(function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                let errorMessages = Object.values(xhr.responseJSON.errors).flat().join("<br>");
                showErrorMessage(errorMessages);
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                showErrorMessage(xhr.responseJSON.message);
            }
        });
}

export { loadTasks, addTask, deleteTask };
