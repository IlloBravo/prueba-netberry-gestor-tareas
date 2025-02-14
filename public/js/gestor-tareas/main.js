import { loadTasks, addTask, removeTask } from "./tasks.js";
import { setupSorting } from "./sorting.js";

$(document).ready(function () {
    loadTasks();
    setupSorting(() => loadTasks());

    $("#add-task").click(() => addTask());

    $(document).on("click", ".delete-task", function () {
        let taskId = $(this).data("id");
        removeTask(taskId);
    });
});
