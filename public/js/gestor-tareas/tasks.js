import { fetchTasks, createTask as apiCreateTask, deleteTask as apiDeleteTask } from "./api.js";
import { renderTasks } from "./rendering.js";
import { showSuccessMessage, showErrorMessage } from "./messages.js";

let tasks = [];

export function loadTasks() {
    fetchTasks(data => {
        tasks = data;
        renderTasks(tasks);
    });
}

export function addTask() {
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

    apiCreateTask({ name: taskName, categories: selectedCategories }, response => {
        showSuccessMessage(response.message);
        loadTasks();
        $("#task-name").val("");
        $(".category-checkbox").prop("checked", false);
    }, xhr => {
        let errorMessages = xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join("<br>") : xhr.responseJSON?.message;
        showErrorMessage(errorMessages);
    });
}

export function removeTask(taskId) {
    if (!confirm("¿Estás seguro de que quieres eliminar esta tarea?")) {
        return;
    }

    apiDeleteTask(taskId, response => {
        showSuccessMessage(response.message);
        tasks = tasks.filter(task => task.id !== taskId);
        renderTasks(tasks);
    }, xhr => {
        let errorMessages = xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join("<br>") : xhr.responseJSON?.message;
        showErrorMessage(errorMessages);
    });
}
