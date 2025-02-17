export function fetchTasks(callback) {
    $.ajax({
        url: "/get-all-tasks",
        type: "GET",
        dataType: "json"
    })
        .done(callback)
        .fail(error => console.error("Error fetching tasks:", error));
}

export function createTask(taskData, successCallback, errorCallback) {
    $.ajax({
        url: "/create-tasks",
        type: "POST",
        data: {
            ...taskData,
            _token: $("meta[name='csrf-token']").attr("content")
        },
        dataType: "json"
    })
        .done(successCallback)
        .fail(errorCallback);
}

export function deleteTask(taskId, successCallback, errorCallback) {
    $.ajax({
        url: `/tasks/${taskId}`,
        type: "DELETE",
        data: { _token: $("meta[name='csrf-token']").attr("content") },
        dataType: "json"
    })
        .done(successCallback)
        .fail(errorCallback);
}
