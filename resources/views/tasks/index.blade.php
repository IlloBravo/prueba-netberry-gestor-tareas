<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Gestor de Tareas</h2>

    <div class="mb-3">
        <input type="text" id="task-name" class="form-control" placeholder="Nueva tarea...">
        <div class="mt-2">
            @foreach ($categories as $category)
                <input type="checkbox" class="category-checkbox" value="{{ $category->id }}"> {{ $category->name }}
            @endforeach
        </div>
        <button id="add-task" class="btn btn-primary mt-2">Añadir</button>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Tarea</th>
            <th>Categorías</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="task-list"></tbody>
    </table>

    <div id="success-message" class="alert alert-success d-none" role="alert"></div>
    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
</div>

<script>
    function showSuccessMessage(message) {
        let successMessage = $("#success-message");
        successMessage.text(message).removeClass("d-none");

        setTimeout(function () {
            successMessage.addClass("d-none");
        }, 5000);
    }

    function showErrorMessage(message) {
        let errorMessage = $("#error-message");
        errorMessage.text(message).removeClass("d-none");

        setTimeout(function () {
            errorMessage.addClass("d-none");
        }, 5000);
    }

    $(document).ready(function () {
        loadTasks();

        function loadTasks() {
            $.get("/get-all-tasks", function (data) {
                let rows = "";
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

        $("#add-task").click(function () {
            let taskName = $("#task-name").val().trim();
            let selectedCategories = $(".category-checkbox:checked").map(function () {
                return parseInt($(this).val(), 10);
            }).get();

            if (taskName.length < 5 || taskName.length > 25) {
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
                _token: "{{ csrf_token() }}"
            }, function () {
                loadTasks();
                $("#task-name").val("");
                $(".category-checkbox").prop("checked", false);

                showSuccessMessage("Se ha creado la tarea correctamente.");
            }).fail(function () {
                showErrorMessage("Error al añadir la tarea.");
            });
        });

        $(document).on("click", ".delete-task", function () {
            let taskId = $(this).data("id");

            if (!confirm("¿Estás seguro de que quieres eliminar esta tarea?")) {
                return;
            }

            $.ajax({
                url: `/tasks/${taskId}`,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function () {
                    $(`#task-${taskId}`).remove();
                    showSuccessMessage("Se ha eliminado la tarea correctamente.");
                },
                error: function () {
                    showErrorMessage("Error al eliminar la tarea.");
                }
            });
        });
    });
</script>

</body>
</html>
