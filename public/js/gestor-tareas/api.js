export function fetchTasks(callback) {
    $.get("/get-all-tasks", function (data) {
        callback(data);
    });
}

export function createTask(taskData, successCallback, errorCallback) {
    $.post("/create-tasks", {
        ...taskData,
        _token: $("meta[name='csrf-token']").attr("content")
    })
        .done(successCallback)
        .fail(errorCallback);
}

export function deleteTask(taskId, successCallback, errorCallback) {
    $.ajax({
        url: `/tasks/${taskId}`,
        type: "DELETE",
        data: { _token: $("meta[name='csrf-token']").attr("content") }
    })
        .done(successCallback)
        .fail(errorCallback);
}
