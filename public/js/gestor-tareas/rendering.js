export function renderTasks(tasks) {
    let rows = "";

    if (tasks.length === 0) {
        $("#task-list").html(`<tr id="no-tasks-message">
            <td colspan="4" class="text-muted">No hay tareas programadas.</td>
        </tr>`);
        return;
    }

    tasks.forEach(task => {
        rows += `<tr id="task-${task.id}">
            <td>${task.id}</td>
            <td>${task.name}</td>
            <td>${task.categories.map(cat => cat.name).join(", ")}</td>
            <td><button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">X</button></td>
        </tr>`;
    });

    $("#task-list").html(rows);
}
