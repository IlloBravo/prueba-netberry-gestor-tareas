import { loadTasks, addTask, removeTask } from "./tasks.js";

$(document).ready(function () {
    loadTasks();

    $(document).on("click", "#add-task", () => addTask());

    $(document).on("click", ".delete-task", function () {
        let taskId = $(this).data("id");
        removeTask(taskId);
    });
});
