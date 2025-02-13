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

    if (taskName.length < 5 || taskName.length > 45) {
        showErrorMessage("El nombre de la tarea debe tener entre 5 y 25 caracteres.");
        return;
    }

    if (selectedCategories.length === 0) {
        showErrorMessage("Debes seleccionar una categoría.");
        return;
    }

    $.post("/create-tasks", {
        name: taskName,
        categories: selectedCategories,
        _token: $("meta[name='csrf-token']").attr("content")
    }, function () {
        loadTasks();
        $("#task-name").val("");
        $(".category-checkbox").prop("checked", false);
        showSuccessMessage("Se ha creado la tarea correctamente.");
    }).fail(() => {
        showErrorMessage("Error al añadir la tarea.");
    });
}

function deleteTask(taskId) {
    if (!confirm("¿Estás seguro de que quieres eliminar esta tarea?")) {
        return;
    }

    $.ajax({
        url: `/tasks/${taskId}`,
        type: "DELETE",
        data: { _token: $("meta[name='csrf-token']").attr("content") },
        success: function () {
            $(`#task-${taskId}`).remove();
            showSuccessMessage("Se ha eliminado la tarea correctamente.");

            // Verificar si la tabla está vacía
            if ($("#task-list tr").length === 0) {
                $("#task-list").html(`<tr id="no-tasks-message">
                    <td colspan="3" class="text-muted">No hay tareas programadas aún</td>
                </tr>`);
            }
        },
        error: function () {
            showErrorMessage("Error al eliminar la tarea.");
        }
    });
}

export { loadTasks, addTask, deleteTask };
