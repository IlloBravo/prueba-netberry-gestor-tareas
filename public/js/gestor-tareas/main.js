import { loadTasks, addTask, deleteTask } from "./tasks.js";

$(document).ready(function () {
    loadTasks();

    $("#add-task").click(function () {
        addTask();
    });

    $(document).on("click", ".delete-task", function () {
        let taskId = $(this).data("id");
        deleteTask(taskId);
    });
});
